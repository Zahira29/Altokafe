@extends('layouts.layout')
@section('titulo', 'Movimientos')

@section('contenido')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Movimientos de inventario</h1>
        <a href="{{ route('movimientos.create') }}"
           class="bg-amber-700 hover:bg-amber-800 text-white font-bold py-2 px-4 rounded">+ Registrar movimiento</a>
    </div>

    <table class="w-full bg-white rounded shadow text-left">
        <thead class="bg-stone-800 text-amber-50">
            <tr>
                <th class="p-3">Fecha</th>
                <th class="p-3">Ingrediente</th>
                <th class="p-3">Tipo</th>
                <th class="p-3">Cantidad</th>
                <th class="p-3">Motivo</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($movimientos as $mov)
                <tr class="border-t">
                    <td class="p-3 text-sm">{{ $mov->FechaHora?->format('d/m/Y H:i') }}</td>
                    <td class="p-3 font-semibold">{{ $mov->ingrediente->Nombre ?? '-' }}</td>
                    <td class="p-3">
                        @if ($mov->TipoMovimiento === 'Entrada')
                            <span class="text-green-700 font-semibold">Entrada</span>
                        @else
                            <span class="text-red-700 font-semibold">Salida</span>
                        @endif
                    </td>
                    <td class="p-3">{{ $mov->Cantidad }} {{ $mov->ingrediente->UnidadMedida ?? '' }}</td>
                    <td class="p-3 text-sm">{{ $mov->Motivo }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="p-6 text-center text-stone-500">Todavía no hay movimientos.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
