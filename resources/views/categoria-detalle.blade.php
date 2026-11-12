<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-amber-950 dark:text-amber-200 leading-tight">
            Categoría: {{ $categoria->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Alerta de Éxito (Se muestra cuando añadimos al carrito) --}}
            @if(session('success'))
                <div class="bg-emerald-100 border border-emerald-400 text-emerald-800 px-4 py-3 rounded-xl shadow-sm flex items-center gap-2">
                    <span>✅</span> {{ session('success') }}
                    <a href="{{ route('carrito.index') }}" class="ml-auto font-bold underline hover:text-emerald-900">Ver Carrito</a>
                </div>
            @endif

            {{-- Encabezado de la Categoría --}}
            <div class="bg-amber-900 text-white rounded-2xl p-8 shadow-md">
                <a href="{{ route('categorias.index') }}" class="inline-block text-xs font-bold uppercase tracking-wider text-amber-300 hover:text-amber-200 mb-4">
                    &larr; Volver a Categorías
                </a>
                <h1 class="text-3xl font-black text-amber-100 mb-2">{{ $categoria->nombre }}</h1>
                <p class="text-amber-200/90 text-sm max-w-2xl leading-relaxed">{{ $categoria->descripcion }}</p>
            </div>

            {{-- Listado de Productos en Grid --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-6 border-b border-slate-200 dark:border-slate-700 pb-3">
                    Productos disponibles ({{ $categoria->productos->count() }})
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @forelse($categoria->productos as $producto)
                        <article class="border border-slate-200 dark:border-slate-700 rounded-xl p-5 flex flex-col justify-between bg-slate-50 dark:bg-slate-900/50 hover:border-amber-500 transition-colors">
                            <div>
                                @php 
                                    $rutaImagen = str_starts_with($producto->imagen, 'http') 
                                        ? $producto->imagen 
                                        : asset($producto->imagen);
                                @endphp

                                {{-- Imagen con enlace al detalle --}}
                                <a href="{{ route('productos.show', $producto->id) }}" class="block mb-4 overflow-hidden rounded-lg group">
                                    <img src="{{ $rutaImagen }}" 
                                         alt="{{ $producto->nombre }}" 
                                         class="card-categoria-img w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                </a>

                                <div class="flex justify-between items-start mb-2">
                                    {{-- Título con enlace al detalle --}}
                                    <h4 class="font-bold text-slate-900 dark:text-white text-lg hover:text-amber-600 transition-colors">
                                        <a href="{{ route('productos.show', $producto->id) }}">
                                            {{ $producto->nombre }}
                                        </a>
                                    </h4>
                                    <span class="font-black text-amber-700 dark:text-amber-400 text-base shrink-0 ml-2">
                                        {{ number_format($producto->precio, 2) }} €
                                    </span>
                                </div>

                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-4 line-clamp-3 leading-relaxed">
                                    {{ $producto->descripcion }}
                                </p>
                            </div>

                            <div class="pt-4 border-t border-slate-200 dark:border-slate-700 flex justify-between items-center">
                                @if($producto->disponible)
                                    <span class="text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 px-2 py-1 rounded-md">Disponible</span>
                                @else
                                    <span class="text-[10px] font-bold uppercase tracking-wider bg-red-100 text-red-800 px-2 py-1 rounded-md">Agotado</span>
                                @endif

                                {{-- FORMULARIO DE AÑADIR AL CARRITO (Añade 1 ud por defecto) --}}
                                <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="text-xs font-bold bg-amber-800 hover:bg-amber-900 text-white px-4 py-2 rounded-lg shadow-sm transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                            {{ !$producto->disponible ? 'disabled' : '' }}>
                                        Añadir 🛒
                                    </button>
                                </form>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-full text-center py-12 text-slate-500">
                            No hay productos registrados en esta categoría actualmente.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
