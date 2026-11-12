<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $guarded = [];

    public function articulos() {
        return $this->hasMany(PedidoArticulo::class);
    }

    public function usuario() {
        return $this->belongsTo(User::class, 'user_id');
    }}

