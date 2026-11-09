<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Productos extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'imagen',
        'precio',
        'disponible',
        'categoria_id'
    ];

    public function categoria() {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}

