<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIngredienteRequest;
use App\Http\Requests\UpdateIngredienteRequest;
use App\Models\Inventario;
use App\Models\Ingrediente;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class IngredienteWebController extends Controller
{
    public function index()
    {
        $ingredientes = Ingrediente::with('inventario')->orderBy('Nombre')->get();
        return view('ingredientes.index', compact('ingredientes'));
    }

    public function create()
    {
        return view('ingredientes.create');
    }

    public function store(StoreIngredienteRequest $request)
    {
        $datos = $request->validated();

        DB::transaction(function () use ($datos) {
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
        });

        return redirect()->route('ingredientes.index')
            ->with('success', 'Ingrediente registrado con stock 0. Usa Movimientos para ingresar stock.');
    }

    public function edit(Ingrediente $ingrediente)
    {
        $ingrediente->load('inventario');
        return view('ingredientes.edit', compact('ingrediente'));
    }

    public function update(UpdateIngredienteRequest $request, Ingrediente $ingrediente)
    {
        $datos = $request->validated();

        DB::transaction(function () use ($ingrediente, $datos) {
            $ingrediente->update(collect($datos)->only(['Nombre', 'UnidadMedida'])->all());

            if (array_key_exists('StockMinimo', $datos) && $datos['StockMinimo'] !== null) {
                Inventario::where('IdIngrediente', $ingrediente->IdIngrediente)
                    ->update(['StockMinimo' => $datos['StockMinimo']]);
            }
        });

        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente actualizado.');
    }

    public function destroy(Ingrediente $ingrediente)
    {
        try {
            DB::transaction(function () use ($ingrediente) {
                $ingrediente->productos()->detach();
                Inventario::where('IdIngrediente', $ingrediente->IdIngrediente)->delete();
                $ingrediente->delete();
            });
        } catch (QueryException $e) {
            return redirect()->route('ingredientes.index')
                ->with('error', 'No se puede eliminar: el ingrediente tiene movimientos registrados.');
        }

        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente eliminado.');
    }
}
