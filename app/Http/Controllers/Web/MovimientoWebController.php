<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovimientoRequest;
use App\Models\Ingrediente;
use App\Models\MovimientoInventario;
use DomainException;

class MovimientoWebController extends Controller
{
    public function index()
    {
        $movimientos = MovimientoInventario::with('ingrediente')
            ->orderByDesc('IdMovimiento')
            ->limit(50)
            ->get();

        return view('movimientos.index', compact('movimientos'));
    }

    public function create()
    {
        $ingredientes = Ingrediente::with('inventario')->orderBy('Nombre')->get();
        return view('movimientos.create', compact('ingredientes'));
    }

    public function store(StoreMovimientoRequest $request)
    {
        try {
            MovimientoInventario::registrar($request->validated());
        } catch (DomainException $e) {
            return back()->withInput()->withErrors(['Cantidad' => $e->getMessage()]);
        }

        return redirect()->route('movimientos.index')->with('success', 'Movimiento registrado y stock actualizado.');
    }
}
