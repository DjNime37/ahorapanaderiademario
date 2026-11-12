<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class heroSlider extends Component
{
    public array $slides;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->slides = [
            [
                'titulo' => 'Masa madre con 36h de fermentación',
                'subtitulo' => 'La corteza mas crujiente y con mejor aroma',
                'imagen' => 'images/mohamed-hassouna-N4gtuEZ5gWc-unsplash.jpg',
                'badge' => 'Especialidad de la casa'
            ],
            [
                'titulo' => 'Bollos recien hechos cada hora',
                'subtitulo' => 'No te quedes sin probar los mejores bollos de Madrid',
                'imagen' => 'images/daniel-masajada-Kdtd6fDxkmI-unsplash.jpg',
                'badge' => 'Especialidad top'
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hero-slider');
    }
}

