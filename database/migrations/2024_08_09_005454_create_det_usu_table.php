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
        Schema::create('det_usu', function (Blueprint $table) {
            $table->id('id_det_usu');
            $table->foreignId('id_usuario')->constrained('usuarios')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nombres')->nullable();
            $table->string('apellidos')->nullable();
            $table->string('rol')->nullable();
            $table->string('estado')->nullable();
            $table->string('foto')->nullable();
            $table->string('telefono')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('det_usu');
    }
};
