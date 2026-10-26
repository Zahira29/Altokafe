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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre', 100);
            $table->string('email', 150)->unique();                          // R2: el correo no se repite
            $table->string('password');
            $table->enum('rol', ['Barista', 'Tostador', 'Admin']);           // R1: todo usuario tiene rol
            $table->boolean('activo')->default(true);                        // R3: inactivo no entra, pero se conserva
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
