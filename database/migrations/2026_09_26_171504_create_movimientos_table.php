<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id('id_movimiento');
            $table->timestamp('fecha_hora')->useCurrent();
            $table->foreignId('id_inventario')->constrained('inventario', 'id_inventario');
            $table->foreignId('id_almacen')->constrained('almacenes', 'id_almacen');            // R15
            $table->foreignId('id_usuario')->constrained('usuarios', 'id_usuario');                              // R21
            $table->foreignId('id_tipo_movimiento')->constrained('tipo_movimientos', 'id_tipo_movimiento'); // R20
            $table->foreignId('id_registro_lote')->nullable()->constrained('registro_lotes', 'id_registro_lote'); // R22
            $table->decimal('cantidad', 10, 2);
            $table->text('motivo_observacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
