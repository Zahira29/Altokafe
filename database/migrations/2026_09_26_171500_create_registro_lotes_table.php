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
        Schema::create('registro_lotes', function (Blueprint $table) {
            $table->id('id_registro_lote');
            $table->string('codigo_lote', 50)->unique();                                   // R11
            $table->foreignId('id_proveedor')->constrained('proveedores', 'id_proveedor'); // R5
            $table->foreignId('id_catador')->nullable()->constrained('catadores', 'id_catador');
            $table->timestamp('fecha_registro')->useCurrent();                             // R12
            $table->decimal('puntaje', 4, 2)->nullable();
            $table->boolean('estado_catacion')->default(false);                            // R7 / R13: solo catado sí/no
            $table->text('observaciones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_lotes');
    }
};
