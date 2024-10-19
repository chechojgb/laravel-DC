<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class det_productos extends Model
{
    use HasFactory;
    
    protected $table = 'det_productos';
    protected $fillable = ['id_productos', 'proveedor', 'foto', 'foto2', 'foto3', 'foto4'];
    protected $primaryKey = 'id_det';

    public function producto()
    {
        return $this->belongsTo(productos::class, 'id_productos');
    }
}
