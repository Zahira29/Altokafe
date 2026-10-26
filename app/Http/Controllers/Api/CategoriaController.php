<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        return CategoriaResource::collection(Categoria::orderBy('OrdenVisual')->get());
    }

    // Aquí se usa la FUNCIÓN 1: la categoría con todos sus productos
    public function show($id)
    {
        $categoria = Categoria::with('productos')->find($id);
        if (!$categoria) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }
        return new CategoriaResource($categoria);
    }
}
