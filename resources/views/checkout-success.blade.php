<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-amber-950 dark:text-amber-200 leading-tight">
            ¡Pedido Completado! 🎉
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white dark:bg-gray-800 p-8 sm:p-12 rounded-2xl shadow-sm border border-emerald-200 dark:border-emerald-900/50 text-center relative overflow-hidden">
                
                {{-- Decoración de fondo --}}
                <div class="absolute top-0 left-0 w-full h-2 bg-emerald-500"></div>

                <div class="w-20 h-20 bg-emerald-100 text-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <h1 class="text-3xl font-black text-slate-900 dark:text-white mb-2">
                    ¡Gracias por tu compra, {{ $pedido->nombre }}!
                </h1>
                
                <p class="text-slate-600 dark:text-slate-300 mb-8 text-lg">
                    Tus cruasanes ya casi están en el horno. Hemos enviado un correo con los detalles a <span class="font-bold text-slate-800 dark:text-white">{{ $pedido->email }}</span>.
                </p>

                <div class="bg-slate-50 dark:bg-slate-900/50 rounded-xl p-6 mb-8 text-left max-w-lg mx-auto border border-slate-100 dark:border-slate-700">
                    <h3 class="font-bold text-slate-800 dark:text-white mb-4 border-b border-slate-200 dark:border-slate-700 pb-2">Resumen de tu pedido</h3>
                    
                    <div class="grid grid-cols-2 gap-y-3 text-sm">
                        <span class="text-slate-500 dark:text-slate-400">Número de Pedido:</span>
                        <span class="font-bold text-slate-900 dark:text-white text-right">#{{ str_pad($pedido->id, 5, '0', STR_PAD_LEFT) }}</span>
                        
                        <span class="text-slate-500 dark:text-slate-400">Fecha:</span>
                        <span class="font-bold text-slate-900 dark:text-white text-right">{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
                        
                        <span class="text-slate-500 dark:text-slate-400">Total pagado:</span>
                        <span class="font-bold text-emerald-600 dark:text-emerald-400 text-right">{{ number_format($pedido->total, 2) }} €</span>
                    </div>

                    <div class="mt-4 pt-4 border-t border-slate-200 dark:border-slate-700 text-sm">
                        <span class="block text-slate-500 dark:text-slate-400 mb-1">Enviado a:</span>
                        <span class="block font-bold text-slate-800 dark:text-white">{{ $pedido->direccion }}</span>
                        <span class="block text-slate-600 dark:text-slate-300">{{ $pedido->codigo_postal }} - {{ $pedido->ciudad }}</span>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('productos.index') }}" class="inline-block bg-amber-600 hover:bg-amber-700 text-white font-bold py-3 px-8 rounded-xl transition-colors">
                        Seguir Comprando
                    </a>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-block bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-800 dark:text-white font-bold py-3 px-8 rounded-xl transition-colors">
                            Ver mis pedidos
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
