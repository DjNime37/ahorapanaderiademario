<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class HomeController extends Controller
{
    public function __invoke() 
    {
        $destacados = [
            [
                'id' => 1,
                'nombre' => 'Hogaza de Masa madre especial',
                'categoria' => 'Panadería',
                'descripcion' => 'Hogaza con ingredientes 100% naturales, de masa madre especial y con 36h de maduración,',
                'precio' => 4.20,
                'etiqueta' => 'Especial',
                'imagen' => 'images/mohamed-hassouna-N4gtuEZ5gWc-unsplash.jpg'
            ],
            [
                'id' => 2,
                'nombre' => 'Barra campesina',
                'categoria' => 'Panadería',
                'descripcion' => 'Hogaza con ingredientes 100% naturales, de masa madre especial y con 36h de maduración,',
                'precio' => 2.20,
                'etiqueta' => 'Top Ventas',
                'imagen' => 'images/mohamed-hassouna-N4gtuEZ5gWc-unsplash.jpg'
            ],             
            [
                'id' => 3,
                'nombre' => 'trenza de panaderia',
                'categoria' => 'Bollos',
                'descripcion' => 'Bollos 100% caseros, elaborados cada día en nuestro obrador',
                'precio' => 1.20,
                'etiqueta' => 'Especial',
                'imagen' => 'images/daniel-masajada-Kdtd6fDxkmI-unsplash.jpg'
            ],             
            [
                'id' => 4,
                'nombre' => 'Chapata candeal',
                'categoria' => 'Panadería',
                'descripcion' => 'Hogaza con ingredientes 100% naturales, de masa madre especial y con 36h de maduración,',
                'precio' => 2.20,
                'etiqueta' => 'Especial',
                'imagen' => 'images/mohamed-hassouna-N4gtuEZ5gWc-unsplash.jpg'
            ]
        ];

        $ventajas = [
            ['icono' => '🚚', 'titulo' => 'Envíos en el Día', 'texto' => 'Gratis en pedidos > 20€. Entrega en 2h.'],
            ['icono' => '🌾', 'titulo' => 'Harinas Orgánicas', 'texto' => 'Sin aditivos ni conservantes.'],
            ['icono' => '🥖', 'titulo' => 'Horneado Continuo', 'texto' => 'Tres hornadas diarias a las 7h, 11h y 17h.'],
            ['icono' => '🛡️', 'titulo' => 'Garantía Frescura', 'texto' => 'Satisfacción 100% garantizada.']
        ];
        
        return view('index', compact('destacados', 'ventajas'));
    
    }
}

