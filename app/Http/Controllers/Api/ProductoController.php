<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Http\Resources\ProductoResource;
use App\Models\Producto;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index()
    {
        return ProductoResource::collection(Producto::with('categoria')->get());
    }

    public function store(StoreProductoRequest $request)
    {
        $producto = Producto::create($request->validated());
        return (new ProductoResource($producto->fresh()))
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $producto = Producto::with(['categoria', 'ingredientes'])->find($id);
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        return new ProductoResource($producto);
    }

    public function update(UpdateProductoRequest $request, $id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        $producto->update($request->validated());
        return new ProductoResource($producto->fresh());
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        try {
            DB::transaction(function () use ($producto) {
                $producto->ingredientes()->detach(); // quita sus filas de Producto_Ingrediente
                $producto->delete();
            });
        } catch (QueryException $e) {
            // pasa si el producto ya está en algún pedido (llave foránea)
            return response()->json(['message' => 'No se puede eliminar: el producto tiene pedidos asociados'], 409);
        }

        return response()->noContent(); // 204
    }
}
