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
        Schema::create('prod_opinion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos', 'id_pro')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_usuario')->constrained('usuarios')->onDelete('cascade')->onUpdate('cascade');
            $table->string('calificacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prod_opinion');
    }
};
