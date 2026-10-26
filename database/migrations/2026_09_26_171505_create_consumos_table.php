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
        Schema::create('consumos', function (Blueprint $table) {
            $table->id('id_consumo');
            $table->string('nombre_bebida', 100);
            $table->foreignId('id_inventario_insumo')->constrained('inventario', 'id_inventario'); // café tostado
            $table->decimal('gramos_por_taza', 6, 2);                                              // R24
            $table->text('descripcion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumos');
    }
};
