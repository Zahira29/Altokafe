@extends('layouts.layout')
@section('titulo', 'Registrar movimiento')

@section('contenido')
    <h1 class="text-3xl font-bold mb-6">Registrar movimiento</h1>

    <form action="{{ route('movimientos.store') }}" method="POST" class="bg-white rounded shadow p-6 max-w-2xl">
        @csrf
        <div class="grid gap-4">
            <div>
                <label class="block font-semibold mb-1">Ingrediente</label>
                <select name="IdIngrediente" class="w-full border rounded p-2 bg-white">
                    <option value="">-- Selecciona --</option>
                    @foreach ($ingredientes as $ing)
                        <option value="{{ $ing->IdIngrediente }}" @selected(old('IdIngrediente') == $ing->IdIngrediente)>
                            {{ $ing->Nombre }} (hay {{ $ing->inventario->CantidadActual ?? 0 }} {{ $ing->UnidadMedida }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1">Tipo de movimiento</label>
                <select name="TipoMovimiento" class="w-full border rounded p-2 bg-white">
                    <option value="Entrada" @selected(old('TipoMovimiento') === 'Entrada')>Entrada (compra / reposición)</option>
                    <option value="Salida" @selected(old('TipoMovimiento') === 'Salida')>Salida (uso / merma)</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold mb-1">Cantidad</label>
                <input type="number" step="0.01" name="Cantidad" value="{{ old('Cantidad') }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-semibold mb-1">Motivo (opcional)</label>
                <input type="text" name="Motivo" value="{{ old('Motivo') }}" class="w-full border rounded p-2" maxlength="100">
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <button class="bg-amber-700 hover:bg-amber-800 text-white font-bold py-2 px-4 rounded">Registrar</button>
            <a href="{{ route('movimientos.index') }}" class="py-2 px-4 text-stone-600 hover:underline">Cancelar</a>
        </div>
    </form>
@endsection
