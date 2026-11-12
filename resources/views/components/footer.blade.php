<footer class="bg-amber-950 text-amber-100/70 border-t border-amber-900 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            {{-- Columna 1: Marca --}}
            <div class="space-y-4">
                <a href="{{ route('home') }}" class="font-black text-2xl text-amber-400 flex items-center gap-2">
                    <span>🍞</span> MarioBakery
                </a>
                <p class="text-sm">
                    Amasando momentos felices desde 2024. Ingredientes de primera calidad, masa madre y mucho amor en cada horneado.
                </p>
            </div>

            {{-- Columna 2: Enlaces Rápidos --}}
            <div>
                <h3 class="text-amber-400 font-bold uppercase tracking-wider mb-4">Nuestra Tienda</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('categorias.index') }}" class="hover:text-white transition">Categorías</a></li>
                    <li><a href="{{ route('productos.index') }}" class="hover:text-white transition">Todos los Productos</a></li>
                    <li><a href="#" class="hover:text-white transition">Sobre Nosotros</a></li>
                    <li><a href="#" class="hover:text-white transition">Política de Envíos</a></li>
                </ul>
            </div>

            {{-- Columna 3: Contacto --}}
            <div>
                <h3 class="text-amber-400 font-bold uppercase tracking-wider mb-4">Atención al Cliente</h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-center gap-2">
                        <span>📍</span> Calle del Horno, 12, Madrid
                    </li>
                    <li class="flex items-center gap-2">
                        <span>📞</span> +34 912 345 678
                    </li>
                    <li class="flex items-center gap-2">
                        <span>✉️</span> hola@Mariobakery.com
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-amber-900/50 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center text-xs">
            <p>&copy; {{ date('Y') }} MarioBakery. Todos los derechos reservados.</p>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-white transition">Aviso Legal</a>
                <a href="#" class="hover:text-white transition">Política de Privacidad</a>
            </div>
        </div>
    </div>
</footer>
