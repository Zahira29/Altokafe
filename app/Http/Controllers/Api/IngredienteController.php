<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIngredienteRequest;
use App\Http\Requests\UpdateIngredienteRequest;
use App\Http\Resources\IngredienteResource;
use App\Models\Inventario;
use App\Models\Ingrediente;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class IngredienteController extends Controller
{
    public function index()
    {
        return IngredienteResource::collection(Ingrediente::with('inventario')->get());
    }

    public function store(StoreIngredienteRequest $request)
    {
        $datos = $request->validated();

        // Se crea el ingrediente y su fila de inventario (con stock 0) juntos
        $ingrediente = DB::transaction(function () use ($datos) {
            $ingrediente = Ingrediente::create([
                'Nombre' => $datos['Nombre'],
                'UnidadMedida' => $datos['UnidadMedida'],
            ]);
            Inventario::create([
                'IdIngrediente' => $ingrediente->IdIngrediente,
                'CantidadActual' => 0,
                'StockMinimo' => $datos['StockMinimo'] ?? 0,
                'UltimaActualizacion' => now(),
            ]);
            return $ingrediente;
        });

        return (new IngredienteResource($ingrediente->load('inventario')))
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $ingrediente = Ingrediente::with(['inventario', 'productos'])->find($id);
        if (!$ingrediente) {
            return response()->json(['message' => 'Ingrediente no encontrado'], 404);
        }
        return new IngredienteResource($ingrediente);
    }

    public function update(UpdateIngredienteRequest $request, $id)
    {
        $ingrediente = Ingrediente::find($id);
        if (!$ingrediente) {
            return response()->json(['message' => 'Ingrediente no encontrado'], 404);
        }

        $datos = $request->validated();

        DB::transaction(function () use ($ingrediente, $datos) {
            $ingrediente->update(collect($datos)->only(['Nombre', 'UnidadMedida'])->all());

            // El stock actual NO se cambia aquí, solo con movimientos. El mínimo sí.
            if (array_key_exists('StockMinimo', $datos) && $datos['StockMinimo'] !== null) {
                Inventario::where('IdIngrediente', $ingrediente->IdIngrediente)
                    ->update(['StockMinimo' => $datos['StockMinimo']]);
            }
        });

        return new IngredienteResource($ingrediente->fresh('inventario'));
    }

    public function destroy($id)
    {
        $ingrediente = Ingrediente::find($id);
        if (!$ingrediente) {
            return response()->json(['message' => 'Ingrediente no encontrado'], 404);
        }

        try {
            DB::transaction(function () use ($ingrediente) {
                $ingrediente->productos()->detach();
                Inventario::where('IdIngrediente', $ingrediente->IdIngrediente)->delete();
                $ingrediente->delete();
            });
        } catch (QueryException $e) {
            // pasa si ya tiene movimientos registrados
            return response()->json(['message' => 'No se puede eliminar: el ingrediente tiene movimientos'], 409);
        }

        return response()->json(['message' => 'Ingrediente eliminado'], 200);
    }
}
