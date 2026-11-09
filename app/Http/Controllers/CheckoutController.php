<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Pedido;
use App\Models\PedidoArticulo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PedidoConfirmado;
use Stripe\Stripe;
use Stripe\Checkout\Session;


class CheckoutController extends Controller
{
    private function obtenerCarrito(){
        if (Auth::check()) {
            return Carrito::where('user_id', Auth::id())->first();
        } else {
            return Carrito::where('session_id', session()->getId())->first();
        }
    }

    public function index() {
        $carrito = $this->obtenerCarrito();

        if (!$carrito || $carrito->items->count() === 0) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío');
        }
        $items = $carrito->items()->with('producto')->get();
        $total = $items->sum(function($item) {
            return $item->precio * $item->cantidad;
        });

        return view('checkout', compact('items', 'total'));
    }

    public function procesar(Request $request) {
        $request->validate([
            'nombre'=>'required|string|max:255',
            'apellidos'=>'required|string|max:255',
            'email'=>'required|email|max:255',
            'telefono'=>'required|string|max:25',
            'direccion'=>'required|string|max:255',
            'ciudad'=>'required|string|max:255',
            'codigo_postal'=>'required|string|max:10',
        ]);

        $carrito = $this->obtenerCarrito();

        $items = $carrito->items()->with('producto')->get();
        $total = $items->sum(function($item) {
            return $item->precio * $item->cantidad;
        });

        $pedido = Pedido::create([
            'user_id' => Auth::check() ? Auth::id():null,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'codigo_postal' => $request->codigo_postal,
            'total' => $total,
            'estado' => 'pendiente',
            'metodo_pago' => 'tarjeta'
        ]);

        $lineItemsStripe = [];

        foreach ($items as $item) {
            $nombreProducto = $item->producto ? $item->producto->nombre : 'Producto no disponible';
            PedidoArticulo::create([
            'pedido_id' => $pedido->id,
            'producto_id' => $item->producto_id,
            'nombre_producto' => $nombreProducto,
            'precio_unitario' => $item->precio,
            'cantidad' => $item->cantidad,
            ]);

            $lineItemsStripe[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $nombreProducto,
                        ],
                        'unit_amount' => intval($item->precio*100),
                    ],
                    'quantity' => $item->cantidad,
            ];
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $checkout_session = Session::create([
                    'line_items' => $lineItemsStripe,
                    'mode' => 'payment',
                    'success_url' => route('checkout.success', $pedido->id),
                    'cancel_url' => route('checkout.cancel', $pedido->id),
                ]);

        return redirect()->away($checkout_session->url);
    }

    public function success(Pedido $pedido) {
        if (Auth::check() && $pedido->user_id !==Auth::id()) {
            abort(403);
        }

        if ($pedido->estado !== 'pagado') {
            $pedido->update(['estado' => 'pagado']);
            Mail::to($pedido->email)->send(new PedidoConfirmado($pedido));        
        }


        $carrito = $this->obtenerCarrito();
        if ($carrito) {
             $carrito->items()->delete();
        }
    
        return view('checkout-success', compact('pedido'));
    }

        public function cancel(Pedido $pedido) {
        if (Auth::check() && $pedido->user_id !==Auth::id()) {
            abort(403);
        }
        $pedido->update(['estado' => 'cancelado']);

        $pedido->delete();
    
        return redirect()->route('checkout.index')->with('error', 'Has cancelado el pago, puedes volver a intentarlo para finalizar tu compra');
    }

}

