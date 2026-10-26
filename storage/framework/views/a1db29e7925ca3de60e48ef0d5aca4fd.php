<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALTOKAFE - Inventario y Trazabilidad</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f7f5ef] text-gray-800 font-sans">
    <nav class="bg-[#0f2e1b] text-white p-4 flex justify-between items-center px-10 border-b border-emerald-900">
        <div class="flex items-center space-x-3">
            <div class="w-9 h-9 text-white flex items-center justify-center">
                <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="5" class="w-full h-full">
                    <path d="M50 50 C35 20, 65 20, 50 50 Z" />
                    <path d="M50 50 C20 35, 20 65, 50 50 Z" />
                    <path d="M50 50 C35 80, 65 80, 50 50 Z" />
                    <path d="M50 50 C80 35, 80 65, 50 50 Z" />
                    <circle cx="50" cy="50" r="4" fill="currentColor" />
                </svg>
            </div>
            <div>
                <h1 class="text-xl font-bold tracking-widest leading-none">ALTOKAFE</h1>
                <span class="text-[10px] block font-light tracking-wider text-emerald-300 mt-1 uppercase">Inventario y Trazabilidad</span>
            </div>
        </div>

        <div class="space-x-8 text-sm font-medium">
            <a href="/" class="text-yellow-400 font-semibold border-b-2 border-yellow-400 pb-1">INICIO</a>
            <a href="#" class="hover:text-emerald-300 transition">INGRESO</a>
            <a href="#" class="hover:text-emerald-300 transition">TUESTE</a>
            <a href="#" class="hover:text-emerald-300 transition">STOCK</a>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto mt-8 p-4 grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- Formulario para Registrar Nuevo Lote -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 h-fit">
            <h2 class="text-lg font-bold text-gray-700 mb-4">Registrar Nuevo Lote</h2>

            <?php if(session('success')): ?>
                <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-3 py-2 rounded-xl mb-4 text-xs">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded-xl mb-4 text-xs">
                    <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>• <?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('lotes.store')); ?>" method="POST" class="space-y-4 text-xs">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="block font-semibold mb-1 text-gray-600">Código de Lote</label>
                    <input type="text" name="codigo_lote" value="<?php echo e(old('codigo_lote')); ?>" placeholder="Ej. LOT-2026-003" class="w-full border rounded-lg p-2 focus:outline-emerald-600" required>
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-gray-600">Proveedor / Finca</label>
                    <select name="id_proveedor" class="w-full border rounded-lg p-2 focus:outline-emerald-600" required>
                        <option value="">Seleccione un proveedor</option>
                        <?php $__currentLoopData = $proveedores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($prov->id_proveedor); ?>"><?php echo e($prov->nombre_finca); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-gray-600">Puntaje Catación (Opcional)</label>
                    <input type="number" step="0.01" name="puntaje" value="<?php echo e(old('puntaje')); ?>" placeholder="Ej. 85.5" class="w-full border rounded-lg p-2 focus:outline-emerald-600">
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-gray-600">Estado de Catación</label>
                    <select name="estado_catacion" class="w-full border rounded-lg p-2 focus:outline-emerald-600">
                        <option value="0">Pendiente</option>
                        <option value="1">Catado</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold mb-1 text-gray-600">Observaciones</label>
                    <textarea name="observaciones" rows="2" class="w-full border rounded-lg p-2 focus:outline-emerald-600" placeholder="Notas de sabor, condición..."></textarea>
                </div>

                <button type="submit" class="w-full bg-[#0f2e1b] text-white py-2.5 rounded-xl font-bold hover:bg-emerald-900 transition">
                    Guardar Lote
                </button>
            </form>
        </div>

        <!-- Tabla de Lotes Registrados -->
        <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-700 mb-4">Control de Lotes e Inventario</h2>
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b text-gray-400 uppercase text-xs">
                        <th class="py-3">Código</th>
                        <th class="py-3">Finca / Proveedor</th>
                        <th class="py-3">Puntaje</th>
                        <th class="py-3">Estado Catación</th>
                        <th class="py-3">Catador</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $lotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="py-3 font-semibold text-emerald-950"><?php echo e($lote->codigo_lote); ?></td>
                        <td class="py-3"><?php echo e($lote->proveedor->nombre_finca ?? 'Sin Proveedor'); ?></td>
                        <td class="py-3 font-medium"><?php echo e($lote->puntaje ?? 'N/A'); ?> pts</td>
                        <td class="py-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold <?php echo e($lote->estado_catacion ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700'); ?>">
                                <?php echo e($lote->estado_catacion ? 'Catado' : 'Pendiente'); ?>

                            </span>
                        </td>
                        <td class="py-3 text-gray-500">
                            <?php echo e($lote->catador ? $lote->catador->nombre . ' ' . $lote->catador->apellido : 'Por Asignar'); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="py-6 text-center text-gray-400">No hay lotes registrados. Llena el formulario para agregar uno.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
<?php /**PATH C:\xampp\cafeteria-app\resources\views/altokafe/index.blade.php ENDPATH**/ ?>