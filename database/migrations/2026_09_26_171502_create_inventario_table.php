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
        Schema::create('inventario', function (Blueprint $table) {
            $table->id('id_inventario');
            $table->string('codigo_producto', 50)->unique();   // R17
            $table->string('nombre_producto', 150);
            $table->string('tipo_cafe', 30);                   // R18: Verde, Tostado, Insumo, Bebida
            $table->string('unidad_medida', 10);               // kg, g, bolsa, taza
            $table->decimal('stock_actual', 10, 2)->default(0); // R19: se calcula con movimientos
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario');
    }
};
