<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prod_opinion extends Model
{
    use HasFactory;
    protected $table = 'prod_opinion';
    public function producto()
    {
        return $this->belongsTo(productos::class, 'producto_id');
    }
}
