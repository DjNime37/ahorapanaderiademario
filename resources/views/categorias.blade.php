<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nuestras Categorias
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">        
                    @foreach($categorias as $categoria)
                        <article class="card-categoria">
                        @php 
                            $rutaImagen = asset($categoria->imagen);
                        @endphp
                        <img src="{{$rutaImagen}}" alt="{{$categoria->nombre}}" class="card-categoria-img">
                        <div class="card-contenido">
                            <h3 class="card-titulo">{{$categoria->nombre}}</h3>
                            <p class="card-desc">{{$categoria->descripcion}}</p>
                        </div>
                        <a href="{{ route('categorias.show', $categoria->nombre) }}" class="btn.categoria">Ver productos</a>

                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
