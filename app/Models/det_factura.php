<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class det_factura extends Model
{
    use HasFactory;

    public function producto()
    {
        return $this->belongsTo(productos::class, 'producto_id');
    }
    public function facturacion() {
        return $this->belongsTo(facturacion::class, 'id_factura');
    }
}
