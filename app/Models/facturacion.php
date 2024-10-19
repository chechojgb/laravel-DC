<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturacion extends Model
{
    use HasFactory;
    protected $table = 'facturacion';

    // Relación con det_facturas (una factura tiene muchos detalles de factura)
    public function detFacturas(){
        return $this->hasMany(det_factura::class, 'id_factura');
    }

    
    // Relación con usuarios (una factura pertenece a un usuario)
    public function usuario() {
        return $this->belongsTo(usuarios::class, 'user_id');
    }
    
}
