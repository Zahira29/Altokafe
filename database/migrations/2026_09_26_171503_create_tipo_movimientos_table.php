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
        Schema::create('tipo_movimientos', function (Blueprint $table) {
            $table->id('id_tipo_movimiento');
            $table->string('descripcion', 50);   // Ingreso Lote, Consumo, Merma...
            $table->integer('factor');           // R20: +1 suma, -1 resta
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_movimientos');
    }
};
