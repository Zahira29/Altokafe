<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ProductoWebController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->orderBy('Nombre')->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('OrdenVisual')->get();
        return view('productos.create', compact('categorias'));
    }

    public function store(StoreProductoRequest $request)
    {
        $datos = $request->validated();
        $datos['Disponible'] = $request->boolean('Disponible'); // el checkbox no se envía si está sin marcar

        Producto::create($datos);

        return redirect()->route('productos.index')->with('success', 'Producto registrado correctamente.');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::orderBy('OrdenVisual')->get();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $datos = $request->validated();
        $datos['Disponible'] = $request->boolean('Disponible');

        $producto->update($datos);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado.');
    }

    public function destroy(Producto $producto)
    {
        try {
            DB::transaction(function () use ($producto) {
                $producto->ingredientes()->detach();
                $producto->delete();
            });
        } catch (QueryException $e) {
            return redirect()->route('productos.index')
                ->with('error', 'No se puede eliminar: el producto tiene pedidos asociados.');
        }

        return redirect()->route('productos.index')->with('success', 'Producto eliminado.');
    }
}
