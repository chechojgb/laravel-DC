<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id_pro';
    
    protected $fillable = [
        'nombre',
        'categoria',
        'precio',
        'descripcion',
        'estado',
        'stock'
    ];
    public function detProducto()
    {
        return $this->hasOne(det_productos::class, 'id_productos');
    }
    public function detOpinion() {
        return $this->hasMany(prod_opinion::class, 'producto_id');
    }
}
