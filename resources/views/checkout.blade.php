<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-amber-950 dark:text-amber-200 leading-tight">
            Finalizar Compra 💳
        </h2>
        @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">¡Atención!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <form action="{{ route('checkout.procesar') }}" method="POST" class="flex flex-col lg:flex-row gap-8">
                @csrf

                {{-- Columna Izquierda: Formulario de Datos --}}
                <div class="w-full lg:w-2/3">
                    <div class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
                        <h3 class="text-xl font-black text-amber-900 dark:text-amber-400 mb-6 border-b border-amber-200 dark:border-slate-700 pb-4">
                            1. Datos de Envío y Facturación
                        </h3>

                        {{-- Mensaje para invitados --}}
                        @guest
                            <div class="mb-6 p-4 bg-amber-50 dark:bg-slate-900/50 rounded-lg text-sm text-amber-800 dark:text-amber-300">
                                ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="font-bold underline hover:text-amber-600">Inicia sesión</a> para rellenar esto más rápido.
                            </div>
                        @endguest

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            {{-- Nombre --}}
                            <div>
                                <label for="nombre" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nombre *</label>
                                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', Auth::user()?->name) }}" required
                                       class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:ring-amber-500 focus:border-amber-500">
                                @error('nombre') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Apellidos --}}
                            <div>
                                <label for="apellidos" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Apellidos *</label>
                                <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required
                                       class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:ring-amber-500 focus:border-amber-500">
                                @error('apellidos') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Email --}}
                            <div class="md:col-span-2">
                                <label for="email" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Correo Electrónico *</label>
                                <input type="email" id="email" name="email" value="{{ old('email', Auth::user()?->email) }}" required
                                       class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:ring-amber-500 focus:border-amber-500">
                                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Teléfono --}}
                            <div class="md:col-span-2">
                                <label for="telefono" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Teléfono de contacto *</label>
                                <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" required
                                       class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:ring-amber-500 focus:border-amber-500">
                                @error('telefono') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Dirección --}}
                            <div class="md:col-span-2">
                                <label for="direccion" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Dirección de entrega *</label>
                                <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" placeholder="Calle, número, piso, puerta..." required
                                       class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:ring-amber-500 focus:border-amber-500">
                                @error('direccion') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Ciudad --}}
                            <div>
                                <label for="ciudad" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Ciudad *</label>
                                <input type="text" id="ciudad" name="ciudad" value="{{ old('ciudad') }}" required
                                       class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:ring-amber-500 focus:border-amber-500">
                                @error('ciudad') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Código Postal --}}
                            <div>
                                <label for="codigo_postal" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Código Postal *</label>
                                <input type="text" id="codigo_postal" name="codigo_postal" value="{{ old('codigo_postal') }}" required
                                       class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:ring-amber-500 focus:border-amber-500">
                                @error('codigo_postal') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Columna Derecha: Resumen y Botón de Pago --}}
                <div class="w-full lg:w-1/3">
                    <div class="bg-amber-50 dark:bg-slate-800 p-6 sm:p-8 rounded-2xl shadow-sm border border-amber-200 dark:border-slate-700 sticky top-24">
                        <h3 class="text-xl font-black text-amber-900 dark:text-amber-400 mb-6 border-b border-amber-200 dark:border-slate-700 pb-4">
                            2. Tu Pedido
                        </h3>
                        
                        {{-- Lista miniatura de productos --}}
                        <div class="space-y-4 mb-6 border-b border-amber-200 dark:border-slate-700 pb-6">
                            @foreach($items as $item)
                                <div class="flex justify-between items-center text-sm">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-slate-800 dark:text-white">{{ $item->cantidad }}x</span>
                                        <span class="text-slate-600 dark:text-slate-300 truncate max-w-[150px]">{{ $item->producto->nombre }}</span>
                                    </div>
                                    <span class="font-bold text-amber-800 dark:text-amber-400">
                                        {{ number_format($item->precio * $item->cantidad, 2) }} €
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        {{-- Totales --}}
                        <div class="space-y-2 mb-6 text-sm">
                            <div class="flex justify-between text-slate-600 dark:text-slate-300">
                                <span>Subtotal</span>
                                <span>{{ number_format($total, 2) }} €</span>
                            </div>
                            <div class="flex justify-between text-slate-600 dark:text-slate-300">
                                <span>Envío</span>
                                <span class="text-emerald-600 font-bold">Gratis</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center mb-8 border-t border-amber-200 dark:border-slate-700 pt-4">
                            <span class="text-lg font-black text-slate-900 dark:text-white">Total a pagar</span>
                            <span class="text-2xl font-black text-amber-800 dark:text-amber-400">{{ number_format($total, 2) }} €</span>
                        </div>

                        {{-- Botón (Simularemos el pago por ahora) --}}
                        <button type="submit" class="w-full py-4 bg-emerald-600 hover:bg-emerald-700 text-white text-center font-black text-lg rounded-xl shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-2">
                            Confirmar y Pagar 🔒
                        </button>
                        
                        <p class="text-center text-xs text-slate-500 mt-4">
                            Al hacer clic confirmas tu pedido. (Simulación - No se cobrará nada real).
                        </p>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
