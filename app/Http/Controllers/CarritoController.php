<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\Carrito;
use App\Models\CarritoItem;
use Illuminate\Support\Facades\Auth;



class CarritoController extends Controller
{
    private function obtenerCarrito(){
        if (Auth::check()) {
            return Carrito::firstOrCreate(['user_id' => Auth::id()]);
        } else {
            return Carrito::firstOrCreate(['session_id' => session()->getId()]);
        }
    }

    public function index(){
        $carrito = $this->obtenerCarrito();

        $items = $carrito->items()->with('producto')->get();

        $total = $items->sum(function($item) {
            return $item->precio * $item->cantidad;
        });

        return view('carrito', compact('items', 'total'));
    }

    public function agregar(Request $request, $id){
        $producto = Productos::findOrFail($id);
        $carrito = $this->obtenerCarrito();
        $cantidad = $request->input('cantidad', 1);

        $item = $carrito->items()->where('producto_id', $producto->id)->first(); 

        if ($item) {
            $item->cantidad += $cantidad;
            $item->save();
        } else {
            $carrito->items()->create([
                'producto_id' => $producto->id,
                'cantidad' => $cantidad,
                'precio' => $producto->precio
            ]);
        }

        return redirect()->back()->with('success', 'i' . $producto->nombre . __(' added to the cart'));
    }

    public function actualizar(Request $request, $id)
    {
        $item = CarritoItem::findOrFail($id);
        
        if ($request->accion == 'sumar') {
            $item->cantidad++;
        } elseif ($request->accion == 'restar' && $item->cantidad > 1) {
            $item->cantidad--;
        }
        
        $item->save();

        return redirect()->route('carrito.index');
    }

    public function eliminar($id){
        $carrito = $this->obtenerCarrito();

        $carrito->items()->where('id', $id)->delete();

        return redirect()->route('carrito.index')->with('success', __('Product removed from cart...'));
    }

    public function vaciar(){
        $carrito = $this->obtenerCarrito();

        $carrito->items()->delete();

        return redirect()->route('carrito.index')->with('success', __('Your cart is empty...'));    }

}

