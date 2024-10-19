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
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_pro'); // Cambiar a 'id' para la clave primaria
            $table->string('nombre', 30)->nullable();
            $table->string('categoria', 30)->nullable();
            $table->integer('precio')->nullable();
            $table->text('descripcion')->nullable();
            $table->string('estado', 20)->nullable();
            $table->integer('stock')->nullable();
            $table->integer('id_vendedor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
