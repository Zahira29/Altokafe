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
        Schema::create('control_stock', function (Blueprint $table) {
            $table->id('id_control_stock');
            $table->foreignId('id_inventario')->constrained('inventario', 'id_inventario');
            $table->foreignId('id_almacen')->constrained('almacenes', 'id_almacen');
            $table->decimal('stock_minimo', 10, 2);
            $table->decimal('stock_maximo', 10, 2);
            $table->decimal('punto_reorden', 10, 2);          // R26
            $table->timestamp('fecha_actualizacion')->useCurrent()->useCurrentOnUpdate();  // R27
            $table->foreignId('id_usuario_configura')->constrained('usuarios', 'id_usuario');               // R27
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('control_stock');
    }
};
