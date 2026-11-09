<section class="hero-slider">
    @php $mainSlide = $slides[0]; @endphp
    <div class="slide-item">
        {{-- Capa de oscurecimiento para lectura clara del texto --}}
        <div class="slide-overlay"></div>
        
        <img src="{{ asset($mainSlide['imagen']) }}" 
             alt="{{ $mainSlide['titulo'] }}" 
             class="absolute inset-0 w-full h-full object-cover">
        
        <div class="slide-content">
            <span class="badge-hero">{{ $mainSlide['badge'] ?? 'Especialidad' }}</span>
            <h1 class="text-3xl md:text-5xl font-black leading-tight mb-3">{{ $mainSlide['titulo'] }}</h1>
            <p class="text-amber-100/90 text-lg mb-6 font-normal leading-relaxed">{{ $mainSlide['subtitulo'] }}</p>
            <a href="/productos" class="btn-primary">Explorar Catálogo</a>
        </div>
    </div>
</section>
