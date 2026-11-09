<?php

namespace App\Repositories;

interface ProductoRepositoryInterface
{
    public function all();

    public function find(int $id);
}