<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovimientoRequest;
use App\Http\Resources\MovimientoResource;
use App\Models\MovimientoInventario;
use DomainException;

class MovimientoController extends Controller
{
    public function index()
    {
        $movimientos = MovimientoInventario::with('ingrediente')
            ->orderByDesc('IdMovimiento')
            ->get();

        return MovimientoResource::collection($movimientos);
    }

    public function store(StoreMovimientoRequest $request)
    {
        try {
            $movimiento = MovimientoInventario::registrar($request->validated());
        } catch (DomainException $e) {
            // por ejemplo: sacar más de lo que hay
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return (new MovimientoResource($movimiento->load('ingrediente')))
            ->response()
            ->setStatusCode(201);
    }
}
