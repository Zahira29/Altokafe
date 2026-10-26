<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMeseroRequest;
use App\Http\Requests\UpdateMeseroRequest;
use App\Http\Resources\MeseroResource;
use App\Models\Mesero;
use Illuminate\Database\QueryException;

class MeseroController extends Controller
{
    public function index()
    {
        return MeseroResource::collection(Mesero::all());
    }

    public function store(StoreMeseroRequest $request)
    {
        $mesero = Mesero::create($request->validated());
        return (new MeseroResource($mesero->fresh()))
            ->response()
            ->setStatusCode(201);
    }

    public function show($id)
    {
        $mesero = Mesero::find($id);
        if (!$mesero) {
            return response()->json(['message' => 'Mesero no encontrado'], 404);
        }
        return new MeseroResource($mesero);
    }

    public function update(UpdateMeseroRequest $request, $id)
    {
        $mesero = Mesero::find($id);
        if (!$mesero) {
            return response()->json(['message' => 'Mesero no encontrado'], 404);
        }
        $mesero->update($request->validated());
        return new MeseroResource($mesero->fresh());
    }

    public function destroy($id)
    {
        $mesero = Mesero::find($id);
        if (!$mesero) {
            return response()->json(['message' => 'Mesero no encontrado'], 404);
        }

        try {
            $mesero->delete();
        } catch (QueryException $e) {
            // pasa si el mesero ya atendió pedidos
            return response()->json(['message' => 'No se puede eliminar: el mesero tiene pedidos. Mejor ponlo como Inactivo'], 409);
        }

        return response()->json(['message' => 'Mesero eliminado'], 200);
    }
}
