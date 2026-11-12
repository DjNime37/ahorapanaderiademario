<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-amber-950 dark:text-amber-200 leading-tight">
            🥖 Mario Bakery — {{ __('Artisanal Workshop') }}
        </h2>
    </x-slot>

    {{-- El contenedor delimita el ancho a max-w-7xl y centra el contenido --}}
    <div class="contenedor-sitio">
        
        {{-- Hero Slider Component --}}
        <x-hero-slider />

        {{-- Ventajas y Envíos --}}
        <section class="features-grid">
            @foreach($ventajas as $item)
                <div class="feature-card">
                    <span class="feature-icon">{{ $item['icono'] }}</span>
                    <h3 class="feature-title">{{ __($item['titulo']) }}</h3>
                    <p class="feature-desc">{{ __($item['texto']) }}</p>
                </div>
            @endforeach
        </section>

        {{-- Productos Destacados --}}
        <section>
            <div class="section-header">
                <div>
                    <h2 class="text-2xl font-black text-amber-950 dark:text-white">{{ __('Our Specialties') }}</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('Baked daily with natural sourdough') }}</p>
                </div>
                <a href="{{ route('categorias.index') }}" class="text-amber-800 dark:text-amber-400 font-bold hover:underline text-sm">
                    {{ __('View all') }} ({{ count($destacados) }}) &rarr;
                </a>
            </div>

            <div class="products-mockup-grid">
                @foreach($destacados as $producto)
                    <article class="product-mockup-card group">
                        <span class="card-tag">{{ __($producto['etiqueta']) }}</span>
                        
                        <div class="card-image-wrap">
                            <img src="{{ asset($producto['imagen']) }}" alt="{{ $producto['nombre'] }}">
                        </div>

                        <div class="card-body">
                            <span class="card-category">{{ __($producto['categoria']) }}</span>
                            <h3 class="card-title">{{ $producto['nombre'] }}</h3>
                            <p class="card-desc">{{ $producto['descripcion'] }}</p>
                            
                            <div class="card-footer">
                                <span class="card-price">{{ number_format($producto['precio'], 2) }} €</span>
                                <a href="{{ route('productos.show', $producto['id']) }}" class="btn-add">{{ __('View Details') }}</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        {{-- Banner Proceso Artesanal --}}
        <section class="banner-artesanal">
            <div>
                <h2 class="text-3xl font-extrabold text-amber-200 mb-4">{{ __('The Secret of Our Crumb') }}</h2>
                <p class="text-amber-100/90 text-sm leading-relaxed">
                    {{ __('At Mario Bakery we take our time. We select stone-ground ancient grains and respect resting times of over 36 hours. The result is a digestible, flavorful, and long-lasting bread.') }}
                </p>
                <div class="banner-stats">
                    <div class="stat-item">
                        <h3>36h</h3>
                        <p>{{ __('Fermentation') }}</p>
                    </div>
                    <div class="stat-item">
                        <h3>100%</h3>
                        <p>{{ __('Sourdough') }}</p>
                    </div>
                    <div class="stat-item">
                        <h3>0%</h3>
                        <p>{{ __('Additives') }}</p>
                    </div>
                </div>
            </div>
            <div class="banner-img">
                <img src="{{ asset('images/mohamed-hassouna-N4gtuEZ5gWc-unsplash.jpg') }}" alt="{{ __('Artisanal Process') }}" class="w-full h-full object-cover">
            </div>
        </section>

    </div>
</x-app-layout>
