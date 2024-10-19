<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalles_envio extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'ciudad', 'email', 'direccion', 'telefono', 'barrio'];
}
