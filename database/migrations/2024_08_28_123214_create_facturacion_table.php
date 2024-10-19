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
        Schema::create('facturacion', function (Blueprint $table) {
            $table->id();
            // Permitir que 'user_id' sea nullable para que pueda establecerse en NULL
            $table->foreignId('user_id')->nullable()->constrained('usuarios')->onDelete('set null')->onUpdate('cascade');
            $table->string('numero_factura');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturacion');
    }
};
