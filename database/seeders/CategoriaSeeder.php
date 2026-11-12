<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;


class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            'nombre' => 'Panadería',
            'descripcion' => 'Panes artesanales de fermentacion lenta(36h)',
            'imagen' =>'images/mohamed-hassouna-N4gtuEZ5gWc-unsplash.jpg'
        ]);
        Categoria::create([
            'nombre' => 'Bollería',
            'descripcion' => 'Nuestros famosos bollos elaborados a diario en nuestro obrador tradicional',
            'imagen' =>'images/daniel-masajada-Kdtd6fDxkmI-unsplash.jpg'
        ]);
        Categoria::create([
            'nombre' => 'Pastelería',
            'descripcion' => 'Postres perfectos para esa ocasión especial',
            'imagen' =>'images/stephen-wheeler-LRIQuZyxKRM-unsplash.jpg'
        ]);    
    }
}

