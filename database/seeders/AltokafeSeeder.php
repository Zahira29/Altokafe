<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AltokafeSeeder extends Seeder
{
    public function run(): void
    {
        $idProveedor = DB::table('proveedores')->insertGetId([
            'nombre_finca' => 'Finca La Esmeralda',
            'contacto' => 'Carlos Mendoza',
            'telefono' => '987654321',
            'ubicacion' => 'Quillabamba, Cusco',
        ]);

        $idCatador = DB::table('catadores')->insertGetId([
            'nombre' => 'Ana',
            'apellido' => 'Torres',
            'numero_movil' => '912345678',
            'direccion' => 'Cusco Centro',
            'certificacion_grado' => 'Q Grader',
        ]);

        DB::table('registro_lotes')->insert([
            [
                'codigo_lote' => 'LOT-2026-001',
                'id_proveedor' => $idProveedor,
                'id_catador' => $idCatador,
                'fecha_registro' => now()->subDays(3),
                'puntaje' => 86.50,
                'estado_catacion' => true,
                'observaciones' => 'Notas a jazmín y miel',
            ],
            [
                'codigo_lote' => 'LOT-2026-002',
                'id_proveedor' => $idProveedor,
                'id_catador' => null,
                'fecha_registro' => now(),
                'puntaje' => null,
                'estado_catacion' => false,
                'observaciones' => 'Pendiente de catación',
            ]
        ]);
    }
}
