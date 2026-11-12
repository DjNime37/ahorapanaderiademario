<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-amber-950 dark:text-amber-200 leading-tight">
            {{ $producto->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            
            {{-- Alerta de Éxito (Se muestra cuando añadimos al carrito) --}}
            @if(session('success'))
                <div class="bg-emerald-100 border border-emerald-400 text-emerald-800 px-4 py-3 rounded-xl shadow-sm flex items-center gap-2">
                    <span>✅</span> {{ session('success') }}
                    <a href="{{ route('carrito.index') }}" class="ml-auto font-bold underline hover:text-emerald-900">Ver Carrito</a>
                </div>
            @endif

            {{-- Miga de pan / Volver --}}
            <div>
                <a href="{{ route('categorias.show', $producto->categoria->nombre) }}" 
                   class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-amber-800 dark:text-amber-400 hover:underline">
                    &larr; Volver a {{ $producto->categoria->nombre }}
                </a>
            </div>

            {{-- Ficha Principal del Producto --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-2xl p-6 lg:p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12 items-center">
                    
                    {{-- Columna 1: Imagen --}}
                    <div class="relative overflow-hidden rounded-xl bg-slate-100 dark:bg-slate-900 aspect-square">
                        @php 
                            $rutaImagen = str_starts_with($producto->imagen, 'http') 
                                            ? $producto->imagen 
                                            : asset($producto->imagen);
                        @endphp
                        <img src="{{ $rutaImagen }}" 
                             alt="{{ $producto->nombre }}" 
                             class="w-full h-full object-cover">

                        <div class="absolute top-4 left-4">
                            @if($producto->disponible)
                                <span class="text-xs font-bold uppercase tracking-wider bg-emerald-500 text-white px-3 py-1.5 rounded-full shadow-md">
                                    Disponible
                                </span>
                            @else
                                <span class="text-xs font-bold uppercase tracking-wider bg-red-500 text-white px-3 py-1.5 rounded-full shadow-md">
                                    Agotado
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Columna 2: Detalles y CTA --}}
                    <div class="flex flex-col justify-between space-y-6">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-widest text-amber-600 dark:text-amber-400">
                                {{ $producto->categoria->nombre }}
                            </span>
                            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white mt-1 mb-4">
                                {{ $producto->nombre }}
                            </h1>
                            <p class="text-2xl sm:text-3xl font-black text-amber-800 dark:text-amber-400 mb-6">
                                {{ number_format($producto->precio, 2) }} €
                            </p>
                            <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed">
                                {{ $producto->descripcion }}
                            </p>
                        </div>

                        {{-- Panel de Compra (AHORA ES UN FORMULARIO) --}}
                        <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST" class="pt-6 border-t border-slate-200 dark:border-slate-700 space-y-4">
                            @csrf
                            <div class="flex items-center space-x-4">
                                <label for="cantidad" class="text-xs font-bold uppercase text-slate-500 dark:text-slate-400">
                                    Cantidad:
                                </label>
                                <select id="cantidad" name="cantidad" class="rounded-lg border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white text-sm focus:ring-amber-500 focus:border-amber-500">
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <button type="submit" 
                                    class="w-full py-3.5 px-6 bg-amber-800 hover:bg-amber-900 text-white font-bold rounded-xl shadow-md hover:shadow-lg transition-all duration-200 text-center disabled:opacity-50 disabled:cursor-not-allowed"
                                    {{ !$producto->disponible ? 'disabled' : '' }}>
                                {{ $producto->disponible ? 'Añadir al Carrito 🛒' : 'Producto No Disponible' }}
                            </button>
                        </form>
                    </div>

                </div>
            </div>

            {{-- Sección: Productos Relacionados --}}
            @if($relacionados->isNotEmpty())
                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">
                        También te puede gustar de {{ $producto->categoria->nombre }}
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        @foreach($relacionados as $rel)
                            @php 
                                $imgRel = str_starts_with($rel->imagen, 'http') ? $rel->imagen : asset($rel->imagen);
                            @endphp
                            <a href="{{ route('productos.show', $rel->id) }}" class="group block bg-white dark:bg-gray-800 rounded-xl p-4 border border-slate-200 dark:border-slate-700 hover:border-amber-500 transition-all">
                                <div class="aspect-video overflow-hidden rounded-lg mb-3 bg-slate-100 dark:bg-slate-900">
                                    <img src="{{ $imgRel }}" alt="{{ $rel->nombre }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <h4 class="font-bold text-slate-900 dark:text-white text-sm group-hover:text-amber-600 transition-colors">
                                    {{ $rel->nombre }}
                                </h4>
                                <p class="text-amber-700 dark:text-amber-400 font-extrabold text-xs mt-1">
                                    {{ number_format($rel->precio, 2) }} €
                                </p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
