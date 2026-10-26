<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALTOKAFE - Inventario y Trazabilidad</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f7f5ef] text-gray-800 font-sans">
    <nav class="bg-[#0f2e1b] text-white p-4 flex justify-between items-center px-10">
        <h1 class="text-xl font-bold tracking-widest">ALTOKAFE <span class="text-xs block font-normal text-emerald-300">INVENTARIO Y TRAZABILIDAD</span></h1>
        <div class="space-x-6 text-sm">
            <a href="/" class="text-yellow-400 font-semibold border-b-2 border-yellow-400">INICIO</a>
            <a href="#" class="hover:text-emerald-300">INGRESO (R1)</a>
            <a href="#" class="hover:text-emerald-300">TUESTE (R2)</a>
            <a href="#" class="hover:text-emerald-300">STOCK (R4)</a>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto mt-8 p-4">
        <!-- Banner de mensajes de éxito -->
        @if(session('success'))
            <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Banner FIFO (Regla R2) -->
        @if(isset($sugeridoFIFO) && $sugeridoFIFO)
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl mb-8 text-sm">
            📌 <strong>Asignación de Tueste (Regla FIFO - R2):</strong> Lote sugerido más antiguo disponible:
            <strong>{{ $sugeridoFIFO->codigo_lote }}</strong>
            ({{ $sugeridoFIFO->fecha_registro ? \Carbon\Carbon::parse($sugeridoFIFO->fecha_registro)->format('Y-m-d') : 'Sin Fecha' }}).
        </div>
        @endif

        <!-- Tabla de Lotes -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-700 mb-4">Control de Lotes e Inventario</h2>
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b text-gray-400 uppercase text-xs">
                        <th class="py-2">Código</th>
                        <th class="py-2">Finca / Proveedor</th>
                        <th class="py-2">Puntaje</th>
                        <th class="py-2">Estado Catación (R1)</th>
                        <th class="py-2">Catador</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lotes as $lote)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 font-semibold">{{ $lote->codigo_lote }}</td>
                        <td class="py-3">{{ $lote->proveedor->nombre_finca ?? 'Sin Proveedor' }}</td>
                        <td class="py-3">{{ $lote->puntaje ?? 'N/A' }} pts</td>
                        <td class="py-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $lote->estado_catacion ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ $lote->estado_catacion ? 'Catado' : 'Pendiente' }}
                            </span>
                        </td>
                        <td class="py-3 text-gray-500">
                            {{ $lote->catador ? $lote->catador->nombre . ' ' . $lote->catador->apellido : 'Por Asignar' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-400">No hay lotes registrados. Ejecuta el seeder para ver datos de prueba.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
