<?php

namespace App\Repositories;

class ProductoRepository
{
    public function all()
    {
        $modelClass = '\App\Models\Producto';
        return $modelClass::with('categoria')->get();
    }

    /**
     * @param int|string $id
     */
    public function find($id)
    {
        $modelClass = '\App\Models\Producto';
        return $modelClass::with('categoria')->find($id);
    }
}