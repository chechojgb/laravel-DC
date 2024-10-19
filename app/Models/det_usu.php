<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class det_usu extends Model
{
    use HasFactory;

    protected $table = 'det_usu';
    protected $fillable = ['id_det_usu', 'id_usuario', 'nombres', 'apellidos', 'rol', 'estado', 'foto', 'telefono'];
    protected $primaryKey = 'id_det_usu';

    // Definir la relación con el modelo usuarios
    public function usuario()
    {
        return $this->belongsTo(usuarios::class, 'id_usuario');
    }
}
