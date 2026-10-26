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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id('id_proveedor');
            $table->string('nombre_finca', 150);
            $table->string('contacto', 100)->nullable();   // R6: puede quedar incompleto al inicio
            $table->string('telefono', 20)->nullable();    // R6
            $table->string('ubicacion', 150)->nullable();  // R6
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
