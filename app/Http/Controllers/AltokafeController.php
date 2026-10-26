<?php

namespace App\Http\Controllers;

use App\Models\RegistroLote;
use App\Models\Proveedor;
use App\Http\Requests\StoreLoteRequest;
use App\Http\Resources\RegistroLoteResource;
use Illuminate\Http\JsonResponse;

class AltokafeController extends Controller
{
    public function index()
    {
        $lotes = RegistroLote::with(['proveedor', 'catador'])->get();
        $proveedores = Proveedor::all();

        // Sugerencia FIFO (Regla R2)
        $sugeridoFIFO = RegistroLote::where('estado_catacion', true)
            ->orderBy('fecha_registro', 'asc')
            ->first();

        return view('altokafe.index', compact('lotes', 'proveedores', 'sugeridoFIFO'));
    }

    public function store(StoreLoteRequest $request)
    {
        RegistroLote::create($request->validated());
        return redirect()->back()->with('success', 'Lote registrado correctamente.');
    }

    // Endpoint API para Postman / Evaluador
    public function apiIndex(): JsonResponse
    {
        $lotes = RegistroLote::with(['proveedor', 'catador'])->get();
        return response()->json(RegistroLoteResource::collection($lotes));
    }
}
