<?php

namespace App\Http\Controllers;

use App\Repositories\ProductoRepositoryInterface;
use App\Http\Resources\ProductoResource;

class ProductoController extends Controller
{
    protected $productoRepository;

    public function __construct(ProductoRepositoryInterface $productoRepository)
    {
        $this->productoRepository = $productoRepository;
    }

    public function index()
    {
        $datos = $this->productoRepository->all();
        return ProductoResource::collection($datos);
    }
}
