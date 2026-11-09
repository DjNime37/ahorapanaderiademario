<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;


class CategoriaController extends Controller
{
    public function index() {
        $categorias = Categoria::all();

        return view('categorias', compact('categorias'));
    }

    public function show($nombreCategoria) {
        $categoria = Categoria::where('nombre', $nombreCategoria)->firstOrFail();

        return view('categoria-detalle', compact('categoria'));
    }
}

