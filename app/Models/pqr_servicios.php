<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pqr_servicios extends Model
{
    protected $primaryKey = 'id_servicios';
    use HasFactory;
    protected $fillable = [
        'id_servicios', 'respuesta', 'estado'
    ];
}
