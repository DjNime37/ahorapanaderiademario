<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-amber-950 dark:text-amber-200 leading-tight">
            Tu Carrito de la Compra 🍞
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Alertas y Mensajes --}}
            @if(session('success'))
                <div class="mb-8 bg-emerald-100 border border-emerald-400 text-emerald-800 px-4 py-3 rounded-xl shadow-sm relative flex items-center gap-2">
                    <span>✅</span> {{ session('success') }}
                </div>
            @endif

            @if($items->count() > 0)
                <div class="flex flex-col lg:flex-row gap-8">
                    
                    {{-- Columna Izquierda: Lista de Productos --}}
                    <div class="w-full lg:w-2/3 space-y-4">
                        @foreach($items as $item)
                            <div class="flex flex-col sm:flex-row items-center justify-between bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 gap-6">
                                
                                {{-- 1. Imagen y Nombre --}}
                                <div class="flex items-center gap-4 w-full sm:w-auto">
                                    @php 
                                        $img = str_starts_with($item->producto->imagen, 'http') ? $item->producto->imagen : asset($item->producto->imagen);
                                    @endphp
                                    <img src="{{ $img }}" alt="{{ $item->producto->nombre }}" class="w-20 h-20 sm:w-24 sm:h-24 object-cover rounded-xl shadow-sm">
                                    
                                    <div>
                                        <h3 class="font-black text-lg text-slate-800 dark:text-white">{{ $item->producto->nombre }}</h3>
                                        <p class="text-sm font-bold text-amber-600 dark:text-amber-400 mt-1">
                                            {{ number_format($item->precio, 2) }} € <span class="text-slate-400 text-xs font-normal">/ ud</span>
                                        </p>
                                    </div>
                                </div>

                                {{-- 2. Controles de Cantidad y Total --}}
                                <div class="flex items-center justify-between w-full sm:w-auto gap-6 sm:gap-8">
                                    
                                    {{-- Botones de + y - --}}
                                    <form action="{{ route('carrito.actualizar', $item->id) }}" method="POST" class="flex items-center bg-slate-50 dark:bg-slate-900 rounded-lg border border-slate-200 dark:border-slate-700">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="accion" value="restar" class="px-3 py-1 text-slate-600 dark:text-slate-400 hover:text-amber-600 font-bold transition">
                                            -
                                        </button>
                                        <input type="number" name="cantidad" value="{{ $item->cantidad }}" class="w-12 text-center bg-transparent border-none text-sm font-bold text-slate-900 dark:text-white focus:ring-0 p-0" readonly>
                                        <button type="submit" name="accion" value="sumar" class="px-3 py-1 text-slate-600 dark:text-slate-400 hover:text-amber-600 font-bold transition">
                                            +
                                        </button>
                                    </form>

                                    {{-- Subtotal del Artículo --}}
                                    <div class="text-right min-w-[80px]">
                                        <p class="text-lg font-black text-amber-800 dark:text-amber-400">
                                            {{ number_format($item->precio * $item->cantidad, 2) }} €
                                        </p>
                                    </div>

                                    {{-- 3. Botón Eliminar --}}
                                    <form action="{{ route('carrito.eliminar', $item->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors" title="Eliminar producto">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        @endforeach

                        {{-- Botones Inferiores del Listado --}}
                        <div class="flex justify-between items-center pt-4 px-2">
                            <form action="{{ route('carrito.vaciar') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-bold flex items-center gap-1 transition">
                                    <span>Vaciar todo el carrito</span>
                                </button>
                            </form>
                            <a href="{{ route('productos.index') }}" class="text-sm text-amber-700 dark:text-amber-400 hover:underline font-bold">
                                &larr; Seguir comprando
                            </a>
                        </div>
                    </div>

                    {{-- Columna Derecha: Resumen de Pedido --}}
                    <div class="w-full lg:w-1/3">
                        <div class="bg-amber-50 dark:bg-slate-800 p-6 md:p-8 rounded-2xl shadow-sm border border-amber-200 dark:border-slate-700 sticky top-24">
                            <h3 class="text-xl font-black text-amber-900 dark:text-amber-400 mb-6 border-b border-amber-200 dark:border-slate-700 pb-4">
                                Resumen del Pedido
                            </h3>
                            
                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between text-slate-600 dark:text-slate-300 font-medium">
                                    <span>Subtotal</span>
                                    <span>{{ number_format($total, 2) }} €</span>
                                </div>
                                <div class="flex justify-between text-slate-600 dark:text-slate-300 font-medium">
                                    <span>Impuestos (IVA incl.)</span>
                                    <span>0.00 €</span>
                                </div>
                                <div class="flex justify-between text-slate-600 dark:text-slate-300 font-medium">
                                    <span>Gastos de envío</span>
                                    <span class="text-emerald-600 dark:text-emerald-400 font-bold">¡Gratis!</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center border-t border-amber-200 dark:border-slate-700 pt-6 mb-8">
                                <span class="text-2xl font-black text-slate-900 dark:text-white">Total</span>
                                <span class="text-3xl font-black text-amber-800 dark:text-amber-400">{{ number_format($total, 2) }} €</span>
                            </div>

                            {{-- Botón de Checkout Preparado --}}
                            <a href="{{ url('/checkout') }}" class="block w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white text-center font-black text-lg rounded-xl shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                                Proceder al Pago 🔒
                            </a>
                            
                            <p class="text-center text-xs text-slate-500 mt-4 flex items-center justify-center gap-1">
                                Pagos seguros con encriptación SSL
                            </p>
                        </div>
                    </div>

                </div>
            @else
                {{-- Pantalla de Carrito Vacío --}}
                <div class="bg-white dark:bg-gray-800 text-center py-20 px-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 max-w-2xl mx-auto mt-8">
                    <span class="text-7xl mb-6 block">🛒</span>
                    <h3 class="text-3xl font-black text-slate-800 dark:text-white mb-4">Tu carrito está vacío</h3>
                    <p class="text-slate-500 dark:text-slate-400 mb-8 text-lg">¡Nuestros hornos están llenos de cosas ricas esperándote, no los dejes enfriar!</p>
                    <a href="{{ route('productos.index') }}" class="inline-block bg-amber-600 hover:bg-amber-700 text-white font-bold py-4 px-10 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 text-lg">
                        Ir al Catálogo de Productos
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
