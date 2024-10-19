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
        // Elimina la tabla si ya existe
        Schema::dropIfExists('det_productos');
        
        Schema::create('det_productos', function (Blueprint $table) {
            $table->id('id_det');
            $table->foreignId('id_productos')->constrained('productos', 'id_pro')->onDelete('cascade')->onUpdate('cascade');
            $table->string('proveedor', 30)->nullable();
            $table->string('foto', 140)->nullable();
            $table->date('fecha_creacion')->nullable();
            $table->string('foto2', 140)->nullable();
            $table->string('foto3', 150)->nullable();
            $table->string('foto4', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('det_productos');
    }
};
