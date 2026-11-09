<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $fillable = ['user_id', 'session_id'];

    public function items() {
        return $this->hasMany(CarritoItem::class);
    }
}

