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
        Schema::create('catadores', function (Blueprint $table) {
            $table->id('id_catador');
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('numero_movil', 20);
            $table->string('direccion', 150);
            $table->string('certificacion_grado', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catadores');
    }
};
