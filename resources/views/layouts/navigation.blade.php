@php
    // Obtenemos todas las categorías
    $categoriasNav = \App\Models\Categoria::all();

    // Calculamos los items del carrito para este usuario/sesión
    $cartCount = 0;
    $carritoActivo = \Illuminate\Support\Facades\Auth::check() 
        ? \App\Models\Carrito::where('user_id', \Illuminate\Support\Facades\Auth::id())->first()
        : \App\Models\Carrito::where('session_id', session()->getId())->first();
        
    if ($carritoActivo) {
        // Sumamos la columna 'cantidad' de todos sus items
        $cartCount = $carritoActivo->items()->sum('cantidad');
    }
@endphp

<nav x-data="{ open: false }" class="bg-white dark:bg-slate-900 border-b border-amber-200 dark:border-slate-800 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            {{-- IZQUIERDA: Logo y Enlaces --}}
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="font-black text-2xl text-amber-800 dark:text-amber-400 flex items-center gap-2">
                        <span>🍞</span> MarioBakery
                    </a>
                </div>

                <!-- Navigation Links (Escritorio) -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        Inicio
                    </x-nav-link>

                    {{-- Foreach dinámico de Categorías --}}
                    @foreach($categoriasNav as $cat)
                        <x-nav-link :href="route('categorias.show', $cat->nombre)" :active="request()->is('categorias/' . $cat->nombre)">
                            {{ $cat->nombre }}
                        </x-nav-link>
                    @endforeach
                </div>
            </div>

            {{-- DERECHA: Carrito y Usuario --}}
            <div class="flex items-center">
                
                <!-- ICONO DEL CARRITO (Dinámico) -->
                <div class="flex items-center sm:ms-6 mr-4 sm:mr-0">
                    {{-- Cambiamos el href="#" por la ruta real del carrito --}}
                    <a href="{{ route('carrito.index') }}" class="relative p-2 text-amber-700 hover:text-amber-900 dark:text-amber-400 dark:hover:text-amber-300 transition-colors" title="Ver carrito">
                        <!-- SVG Heroicon 'ShoppingCart' -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        
                        <!-- Contador Dinámico -->
                        @if($cartCount > 0)
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-[10px] font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-red-500 rounded-full shadow-sm">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                </div>

                <!-- Settings Dropdown (Usuario logueado) -->
                @auth
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-bold rounded-md text-amber-800 dark:text-amber-400 bg-amber-50 dark:bg-slate-800 hover:text-amber-900 dark:hover:text-amber-300 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('dashboard')">Mi Panel</x-dropdown-link>
                                <x-dropdown-link :href="route('profile.edit')">Perfil</x-dropdown-link>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        Cerrar Sesión
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <!-- Botones Login/Registro (Invitados) -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-4">
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-amber-600 dark:hover:text-amber-400">Iniciar Sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-bold bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition">Registrarse</a>
                        @endif
                    </div>
                @endauth

                <!-- Hamburger (Menú Móvil) -->
                <div class="-me-2 flex items-center sm:hidden ml-2">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-amber-500 hover:text-amber-600 hover:bg-amber-100 dark:hover:bg-slate-800 focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Móvil) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-amber-50 dark:bg-slate-900 border-t border-amber-200 dark:border-slate-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">Inicio</x-responsive-nav-link>
            
            {{-- Foreach dinámico de Categorías para Móvil --}}
            @foreach($categoriasNav as $cat)
                <x-responsive-nav-link :href="route('categorias.show', $cat->nombre)" :active="request()->is('categorias/' . $cat->nombre)">
                    {{ $cat->nombre }}
                </x-responsive-nav-link>
            @endforeach
        </div>
    </div>
</nav>
