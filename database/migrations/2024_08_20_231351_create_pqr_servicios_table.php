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
        Schema::create('pqr_servicios', function (Blueprint $table) {
            $table->id('id_servicios');
            $table->string('num_servicio');
            $table->string('nombre')->nullable();
            $table->string('email');
            $table->string('motivo');
            $table->string('detalle');
            $table->string('foto')->nullable();
            $table->string('estado')->nullable();
            $table->string('tipo_servicio')->nullable();
            $table->string('respuesta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pqr_servicios');
    }
};
