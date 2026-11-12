<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoArticulo extends Model
{
    protected $table = 'pedido_articulos';
    protected $guarded = [];

    public function pedido() {
        return $this->belongsTo(Pedido::class);
    }
}

