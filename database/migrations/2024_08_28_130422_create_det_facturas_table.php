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
        Schema::create('det_facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_factura')->constrained('facturacion')->onDelete('restrict')->onUpdate('cascade');
            $table->foreignId('producto_id')->constrained('productos', 'id_pro')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('det_facturas');
    }
};
