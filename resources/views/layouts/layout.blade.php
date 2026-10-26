<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Cafetería')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-amber-50 text-stone-800">

    <nav class="bg-stone-800 text-amber-50">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center gap-8">
            <span class="text-xl font-bold">☕ Cafetería</span>
            <a href="{{ route('productos.index') }}" class="hover:text-amber-300">Productos</a>
            <a href="{{ route('ingredientes.index') }}" class="hover:text-amber-300">Ingredientes y stock</a>
            <a href="{{ route('movimientos.index') }}" class="hover:text-amber-300">Movimientos</a>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-8">

        @if (session('success'))
            <div class="mb-4 rounded bg-green-100 border border-green-400 text-green-800 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 rounded bg-red-100 border border-red-400 text-red-800 px-4 py-3">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded bg-red-100 border border-red-400 text-red-800 px-4 py-3">
                <p class="font-bold">Revisa estos campos:</p>
                <ul class="list-disc ml-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('contenido')
    </main>

</body>
</html>
