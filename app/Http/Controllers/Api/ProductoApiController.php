<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductoResource;
use App\Repositories\ProductoRepositoryInterface;
use OpenApi\Attributes as OA;

class ProductoApiController extends Controller
{
    protected $productoRepoInterface;

    public function __construct(
        productoRepositoryInterface $productoRepoInterface
    ) 
    {   
        $this->productoRepoInterface = $productoRepoInterface;
    }

    #[OA\Get (
    path:"/api/productos",
    summary: "Lista de productos",
    description: "Devuelve todos los productos disponibles en la panaderia",
    tags: ["Productos"]
    )]
    #[OA\Response (
        response:200,
        description: "Operación exitosa"
    )]

    public function index()
    {
        $productos = $this->productoRepoInterface->all();
        return ProductoResource::collection($productos);
    }
}
