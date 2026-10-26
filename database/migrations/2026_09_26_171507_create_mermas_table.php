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
        Schema::create('mermas', function (Blueprint $table) {
            $table->id('id_merma');
            $table->foreignId('id_movimiento')->unique()->constrained('movimientos', 'id_movimiento'); // R23
            $table->enum('causa_merma', ['Error de tueste', 'Deterioro', 'Muestra', 'Otro']);         // R29 (lista a confirmar)
            $table->string('evidencia_url', 255)->nullable();                                          // R30
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mermas');
    }
};
