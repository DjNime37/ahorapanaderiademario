<?php

namespace App\Repositories;

class ProductoRepository implements ProductoRepositoryInterface
{
    public function all()
    {
        $modelClass = '\App\Models\Productos';
        return $modelClass::with('categoria')->get();
    }

    public function find(int $id)
    {
        $modelClass = '\App\Models\Productos';
        return $modelClass::with('categoria')->find($id);
    }
}