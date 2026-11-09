<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Productos;
use App\Models\Categoria;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $panaderia = Categoria::where('nombre', 'Panadería')->first();
        $bolleria = Categoria::where('nombre', 'Bollería')->first();
        $pasteleria = Categoria::where('nombre', 'Pastelería')->first();

        // -------------------------------------------------------------------
        // 1. PANADERÍA (12 Productos)
        // -------------------------------------------------------------------
        if ($panaderia) {
            $panes = [
                ['nombre' => 'Pan de masa madre', 'descripcion' => 'Pan artesanal de fermentación lenta (36h)', 'precio' => 3.50, 'imagen' => 'https://images.unsplash.com/photo-1589367920969-ab8e050bbb04?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Hogaza Tradicional', 'descripcion' => 'Hogaza rústica de trigo molido a piedra', 'precio' => 4.00, 'imagen' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Baguette Artesanal', 'descripcion' => 'Corteza muy crujiente y alta hidratación', 'precio' => 1.80, 'imagen' => 'https://images.unsplash.com/photo-1586444248902-2f64eddc13df?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Pan de Centeno y Semillas', 'descripcion' => '70% harina de centeno con pipas de girasol y sésamo', 'precio' => 4.20, 'imagen' => 'https://images.unsplash.com/photo-1549931319-a545dcf3bc73?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Pan de Espelta 100% Integral', 'descripcion' => 'Elaborado con grano entero de espelta ecológica', 'precio' => 4.80, 'imagen' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Ciabatta Italiana de Olivas', 'descripcion' => 'Pan de aceite de oliva con aceitunas negras', 'precio' => 2.90, 'imagen' => 'https://images.unsplash.com/photo-1586444248902-2f64eddc13df?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Pan de Cereal y Maíz', 'descripcion' => 'Pan suave con harina de maíz tostado y 5 cereales', 'precio' => 3.60, 'imagen' => 'https://images.unsplash.com/photo-1549931319-a545dcf3bc73?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Hogaza de Pasas y Nueces', 'descripcion' => 'Masa fermentada ideal para maridar con quesos', 'precio' => 5.50, 'imagen' => 'https://images.unsplash.com/photo-1589367920969-ab8e050bbb04?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Pan de Molde de Mantequilla', 'descripcion' => 'Miga esponjosa con leche entera y mantequilla', 'precio' => 4.10, 'imagen' => 'https://images.unsplash.com/photo-1549931319-a545dcf3bc73?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Panecillos Rústicos (Pack 6)', 'descripcion' => 'Surtido de panecillos variados con amapola y sésamo', 'precio' => 3.50, 'imagen' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Focaccia de Romero y Sal', 'descripcion' => 'Horneada con aceite AOVE y romero fresco', 'precio' => 3.80, 'imagen' => 'https://images.unsplash.com/photo-1586444248902-2f64eddc13df?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Pan de Ajo y Hierbas', 'descripcion' => 'Impregnado con mantequilla de ajo asado', 'precio' => 3.20, 'imagen' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?q=80&w=600&auto=format&fit=crop'],
            ];

            foreach ($panes as $item) {
                Productos::create([
                    'categoria_id' => $panaderia->id,
                    'nombre'       => $item['nombre'],
                    'descripcion'  => $item['descripcion'],
                    'precio'       => $item['precio'],
                    'imagen'       => $item['imagen'],
                    'disponible'   => true,
                ]);
            }
        }

        // -------------------------------------------------------------------
        // 2. BOLLERÍA (12 Productos)
        // -------------------------------------------------------------------
        if ($bolleria) {
            $bollos = [
                ['nombre' => 'Croissant de Mantequilla', 'descripcion' => 'Hojaldre tradicional de mantequilla asturiana', 'precio' => 1.80, 'imagen' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Napolitana de Chocolate', 'descripcion' => 'Hojaldre crujiente con doble barra de cacao', 'precio' => 2.40, 'imagen' => 'https://images.unsplash.com/photo-1608198093002-ad4e005484ec?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Cinnamon Roll', 'descripcion' => 'Brioche enrollado con canela y glaseado suave', 'precio' => 3.20, 'imagen' => 'https://images.unsplash.com/photo-1509365465985-25d11c17e812?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Croissant de Pistacho', 'descripcion' => 'Relleno de crema fluida de pistacho artesanal', 'precio' => 3.90, 'imagen' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Brioche Trenzado de Azúcar', 'descripcion' => 'Aromatizado con agua de azahar y perlas de azúcar', 'precio' => 3.80, 'imagen' => 'https://images.unsplash.com/photo-1509365465985-25d11c17e812?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Ensaimada Tradicional', 'descripcion' => 'Masa ligera y esponjosa nevada en azúcar glas', 'precio' => 2.60, 'imagen' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Palmera de Chocolate Negro', 'descripcion' => 'Hojaldre crujiente bañado en cobertura de chocolate', 'precio' => 2.80, 'imagen' => 'https://images.unsplash.com/photo-1608198093002-ad4e005484ec?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Napolitana de Crema', 'descripcion' => 'Rellena de crema pastelera elaborada al día', 'precio' => 2.30, 'imagen' => 'https://images.unsplash.com/photo-1608198093002-ad4e005484ec?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Suizo de Leche con Azúcar', 'descripcion' => 'Panecillo tierno cortado y coronado con azúcar', 'precio' => 1.90, 'imagen' => 'https://images.unsplash.com/photo-1509365465985-25d11c17e812?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Donut Artesano Glaseado', 'descripcion' => 'Masa frita con cobertura de vainilla', 'precio' => 2.20, 'imagen' => 'https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Caracola de Pasas y Crema', 'descripcion' => 'Espiral de hojaldre tierno con pasas maceradas', 'precio' => 2.70, 'imagen' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Brioche Relleno de Nocciola', 'descripcion' => 'Relleno con crema de avellanas y cacao', 'precio' => 3.50, 'imagen' => 'https://images.unsplash.com/photo-1509365465985-25d11c17e812?q=80&w=600&auto=format&fit=crop'],
            ];

            foreach ($bollos as $item) {
                Productos::create([
                    'categoria_id' => $bolleria->id,
                    'nombre'       => $item['nombre'],
                    'descripcion'  => $item['descripcion'],
                    'precio'       => $item['precio'],
                    'imagen'       => $item['imagen'],
                    'disponible'   => true,
                ]);
            }
        }

        // -------------------------------------------------------------------
        // 3. PASTELERÍA (12 Productos)
        // -------------------------------------------------------------------
        if ($pasteleria) {
            $pasteles = [
                ['nombre' => 'Pastel de fresa', 'descripcion' => 'Pastel de 3 capas de nata y fresa', 'precio' => 13.50, 'imagen' => 'https://images.unsplash.com/photo-1586788680434-30d324b2d46f?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Tarta Cheesecake San Sebastián', 'descripcion' => 'Tarta de queso tostada con centro muy cremoso', 'precio' => 26.00, 'imagen' => 'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Tarta Tatin de Manzana', 'descripcion' => 'Receta francesa con manzanas caramelizadas', 'precio' => 24.00, 'imagen' => 'https://images.unsplash.com/photo-1568571780765-9276ac8b75a2?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Éclair de Chocolate', 'descripcion' => 'Pasta choux rellena de crema de cacao 70%', 'precio' => 4.50, 'imagen' => 'https://images.unsplash.com/photo-1603532648955-039310d9ed75?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Tartaleta de Frutos Rojos', 'descripcion' => 'Base crujiente sablé con frambuesas y moras', 'precio' => 5.20, 'imagen' => 'https://images.unsplash.com/photo-1519869325930-281384150729?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Tarta Red Velvet', 'descripcion' => 'Bizcocho rojo de cacao con crema de queso', 'precio' => 28.00, 'imagen' => 'https://images.unsplash.com/photo-1586788680434-30d324b2d46f?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Milhojas de Crema', 'descripcion' => 'Capas de hojaldre con crema pastelera y merengue', 'precio' => 4.20, 'imagen' => 'https://images.unsplash.com/photo-1587314168485-3236d6710814?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Carrot Cake con Nueces', 'descripcion' => 'Bizcocho especiado de zanahoria y crema suave', 'precio' => 25.00, 'imagen' => 'https://images.unsplash.com/photo-1621303837174-89787a7d4729?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Coulant de Chocolate', 'descripcion' => 'Bizcocho templado con corazón fluido de cacao', 'precio' => 4.80, 'imagen' => 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Tarta Sacher', 'descripcion' => 'Bizcocho denso de chocolate con mermelada de albaricoque', 'precio' => 27.00, 'imagen' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Caja de Macarons (6 ud)', 'descripcion' => 'Surtido de sabores variados artesanales', 'precio' => 12.50, 'imagen' => 'https://images.unsplash.com/photo-1569864358642-9d1684040f43?q=80&w=600&auto=format&fit=crop'],
                ['nombre' => 'Tartaleta de Limón y Merengue', 'descripcion' => 'Crema de limón sobre galleta sablé y merengue tostado', 'precio' => 4.90, 'imagen' => 'https://images.unsplash.com/photo-1519869325930-281384150729?q=80&w=600&auto=format&fit=crop'],
            ];

            foreach ($pasteles as $item) {
                Productos::create([
                    'categoria_id' => $pasteleria->id,
                    'nombre'       => $item['nombre'],
                    'descripcion'  => $item['descripcion'],
                    'precio'       => $item['precio'],
                    'imagen'       => $item['imagen'],
                    'disponible'   => true,
                ]);
            }
        }
    }
}
