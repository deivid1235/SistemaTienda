@extends('public.app')
@section('content')
<body class="bg-[#F4F4F0] text-[#111] font-sans selection:bg-[#269ad5] selection:text-white overflow-x-hidden">
    <!-- CINTA SUPERIOR (Top Bar) -->
    <div class="bg-gray-100 border-b border-gray-200 text-xs py-2 px-4">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 text-center sm:text-left">
            <div class="inline-flex flex-wrap items-center justify-center gap-1.5 bg-amber-400 text-gray-900 font-bold px-3 py-1 rounded-full text-[11px] shadow-xs">
                <svg class="w-3.5 h-3.5 text-rose-600 fill-current shrink-0" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
                <span>¿Comienza tu pedido?</span>
                <a href="#" class="underline hover:opacity-80">Elige tu dirección</a>
            </div>
            
            <div class="flex items-center justify-center gap-4 sm:gap-6 text-gray-600 text-[11px] font-semibold flex-wrap">
                <a href="#" class="flex items-center gap-1 hover:text-[#269ad5] transition-colors">
                    <svg class="w-3.5 h-3.5 text-rose-500 fill-current shrink-0" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    <span>Mis Favoritos</span>
                    <span class="bg-gray-200 text-gray-700 rounded-full px-1.5 py-0.2 text-[10px]">0</span>
                </a>
                <a href="#" class="flex items-center gap-1 hover:text-[#269ad5] transition-colors">
                    <svg class="w-3.5 h-3.5 text-gray-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span>Sigue tu pedido</span>
                </a>
            </div>
        </div>
    </div>

    <!-- HEADER PRINCIPAL (#269ad5) -->
    <header class="sticky top-0 z-50 bg-[#0407e2] text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 gap-2">
                
                <!-- BOTÓN MENÚ HAMBURGUESA (SÓLO CELULARES) -->
                <button id="btn-menu-mobile" type="button" class="md:hidden p-2 rounded-lg text-white hover:bg-white/10 focus:outline-none" aria-label="Abrir menú">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <!-- LOGO -->
                <a href="#inicio" class="text-xl sm:text-2xl font-black tracking-tight text-white flex items-center gap-1 shrink-0">
                    GRUPO<span class="text-amber-300">AOSC.</span>
                </a>
                <!-- NAVEGACIÓN EN ESCRITORIO (DESKTOP) -->
                <nav class="hidden md:flex items-center gap-6 lg:gap-8 uppercase font-bold text-xs tracking-wider">
                    <a href="#inicio" class="flex items-center gap-1.5 text-white hover:text-amber-300 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Inicio
                    </a>
                    <a href="#"
                    onclick="event.preventDefault(); document.getElementById('panelCategorias').classList.remove('hidden')"
                    class="flex items-center gap-1.5 text-white hover:text-amber-300 transition-colors">

                        <svg class="w-4 h-4 text-amber-300" fill="none"
                            stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <rect x="3" y="3" width="7" height="7" rx="1"/>
                            <rect x="14" y="3" width="7" height="7" rx="1"/>
                            <rect x="3" y="14" width="7" height="7" rx="1"/>
                            <rect x="14" y="14" width="7" height="7" rx="1"/>
                        </svg>

                        Categorías
                    </a>
                    <a href="#productos" class="flex items-center gap-1.5 text-white hover:text-amber-300 transition-colors">
                        <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        Productos
                    </a>
                </nav>

                <!-- BUSCADOR, INICIAR SESIÓN Y CARRITO -->
                <div class="flex items-center gap-2 sm:gap-4">
                    <form action="" method="GET" class="relative hidden lg:block">
                        <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar productos..." class="w-40 xl:w-48 pl-3 pr-8 py-1.5 bg-white/10 text-white placeholder-white/70 border border-white/20 rounded-full text-xs outline-none focus:bg-white focus:text-gray-800 focus:placeholder-gray-400 transition-all">
                        <button type="submit" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-white/80 hover:text-white">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </form>

                    <a href="#" class="hidden sm:flex items-center gap-1.5 text-xs font-semibold hover:text-amber-300 border-r border-white/20 pr-4 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>Iniciar Sesión</span>
                    </a>

                    <!-- BOTÓN CARRITO ESTILO CÁPSULA AMARILLO -->
                    <a href="#" class="bg-amber-400 hover:bg-amber-300 text-gray-900 px-3 sm:px-3.5 py-1.5 rounded-full flex items-center gap-1.5 sm:gap-2 font-black text-xs shadow-md transition-transform active:scale-95 shrink-0">
                        <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24">
                            <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
                        </svg>
                        @php
                            $total = 0;
                            foreach (session('carrito', []) as $producto) {
                                $precio = $producto['precio_unitario'] ?? 0;
                                $cantidad = $producto['cantidad'] ?? 0;

                                $total += $precio * $cantidad;
                            }
                        @endphp
                        <span>S/ {{ number_format($total, 2) }}</span>
                        <button type="button"
                            onclick="document.getElementById('panelCarrito').classList.toggle('hidden')"
                            class="relative flex items-center gap-2">
                            <i class="fas fa-shopping-cart text-xl"></i>
                            <span class="w-5 h-5 rounded-full bg-rose-600 text-white flex items-center justify-center text-[10px] font-bold shrink-0">
                                {{ collect(session('carrito', []))->sum('cantidad') }}
                            </span>
                        </button>
                    </a>
                </div>
            </div>

            <!-- DESPLEGABLE DEL MENÚ EN MÓVILES -->
            <div id="menu-desplegable-mobile" class="hidden md:hidden pb-5 pt-2 border-t border-white/20">
                <nav class="flex flex-col gap-3 uppercase font-bold text-xs tracking-wider">
                    <a href="#inicio" class="flex items-center gap-2 text-white hover:text-amber-300 py-1 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Inicio
                    </a>
                    <a href="#productos" class="flex items-center gap-2 text-white hover:text-amber-300 py-1 transition-colors">
                        <svg class="w-4 h-4 text-amber-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        Productos
                    </a>
                    <a href="#" class="flex items-center gap-2 text-white hover:text-amber-300 py-1 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Iniciar Sesión
                    </a>
                </nav>
                <form action="" method="GET" class="mt-3 relative">
                    <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar productos..." class="w-full pl-3 pr-8 py-2 bg-white/10 text-white placeholder-white/70 border border-white/20 rounded-lg text-xs outline-none focus:bg-white focus:text-gray-800 focus:placeholder-gray-400">
                    <button type="submit" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-white/80 hover:text-white">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </header> 

    <!-- BANNER DE PROMOCIÓN AMARILLO -->
    <div class="bg-amber-400 text-gray-900 text-xs font-bold py-2 px-4 shadow-inner">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-center gap-2 text-center">
            <span class="bg-rose-600 text-white text-[10px] uppercase font-extrabold px-2 py-0.5 rounded-md tracking-wider">Envío Gratis</span>
            <span>ENVÍO GRATIS EN COMPRAS MAYORES A S/ 299 | Aplica para todos los productos</span>
        </div>
    </div>

    <!-- HERO PRINCIPAL -->
    <main id="inicio" class="min-h-auto lg:min-h-screen flex items-center">
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 items-center">
                <div class="max-w-xl text-center lg:text-left mx-auto lg:mx-0">
                    <p class="text-[#269ad5] text-xs sm:text-sm font-bold tracking-[0.2em] uppercase mb-4 sm:mb-6">Tu estilo, tu camino</p>
                    <h1 class="text-5xl sm:text-6xl lg:text-[5.5rem] font-black leading-[1.05] sm:leading-[0.9] tracking-tighter mb-6">
                        Da el siguiente <br class="hidden sm:inline">
                        paso con <span class="text-[#0407e2]">estilo</span>
                    </h1>
                    <p class="text-gray-500 text-base sm:text-lg leading-relaxed mb-10 max-w-md mx-auto lg:mx-0">Encuentra las zapatillas que van contigo. Comodidad, diseño y actitud en cada paso.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-6">
                        <a href="#productos"
                           class="w-full sm:w-auto bg-[#0407e2] hover:bg-[#0407e2] text-white px-8 py-4 text-sm font-bold uppercase tracking-wider transition-colors flex items-center justify-center gap-3 rounded-lg shadow-lg">
                            Explorar colección
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                        <div class="flex items-center gap-2 text-sm text-gray-500 font-medium">
                            <span class="w-2 h-2 rounded-full bg-[#2E8B57] shrink-0"></span>
                            Nueva colección disponible
                        </div>
                    </div>
                </div>
                
                <!-- IMAGEN PRINCIPAL -->
                <div class="relative w-full max-w-md mx-auto aspect-square lg:aspect-auto lg:h-[550px] flex items-center justify-center">
                    <div class="absolute inset-0 bg-[#E8E8E3] rounded-full scale-90 blur-3xl opacity-50"></div>
                    <div class="absolute inset-4 sm:inset-8 bg-[#0407e2] -rotate-6 shadow-2xl shadow-[#0407e2]/30 rounded-2xl"></div>
                    <img
                        src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1000&auto=format&fit=crop"
                        alt="Zapatilla deportiva"
                        class="relative z-10 w-[85%] h-auto object-contain -rotate-12 drop-shadow-[0_35px_35px_rgba(0,0,0,0.4)] hover:scale-105 transition-transform duration-700 ease-out">
                    <div class="absolute bottom-0 right-0 sm:right-4 z-20 bg-white p-4 sm:p-5 shadow-xl w-44 sm:w-48 border border-black/5 rounded-xl">
                        <h3 class="text-xs font-black uppercase tracking-wider mb-1">
                            STEPUP / 01
                        </h3>
                        <p class="text-[11px] text-gray-500">
                            Diseñadas para moverte.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!-- SECCIÓN DE PRODUCTOS -->
    <section id="productos" class="bg-white py-12 sm:py-16 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 text-left">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                    <span class="text-amber-400 italic">Nuestros</span> <span class="text-[#269ad5] italic">productos.</span>
                </h2>
                <p class="text-slate-500 text-sm mt-1.5 font-normal max-w-lg leading-relaxed">
                    Descubre nuestro catálogo completo de productos disponibles con la mejor calidad.
                </p>
            </div>

            @forelse($productos as $producto)
                @if($loop->first)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 justify-items-center">
                @endif
                    <article class="group relative bg-white border border-gray-100 rounded-xl p-3 shadow-xs hover:shadow-lg hover:border-[#269ad5]/30 transition-all duration-300 flex flex-col justify-between w-full max-w-xs">
                        <div class="relative bg-gray-50 aspect-square overflow-hidden rounded-lg border border-gray-100/60">
                            @if($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" 
                                    alt="{{ $producto->nombre }}" 
                                    class="w-full h-full object-contain p-3 group-hover:scale-105 transition-transform duration-500" 
                                    loading="lazy">
                            @else
                                <div class="flex flex-col items-center justify-center h-full text-gray-400">
                                    <span class="text-2xl mb-1">📦</span>
                                    <span class="text-[10px] font-medium">Sin imagen</span>
                                </div>
                            @endif
                            <div class="absolute top-2 right-2">
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[11px] font-semibold backdrop-blur-md shadow-xs
                                    {{ $producto->activo ? 'bg-sky-50/95 text-[#269ad5] ring-1 ring-inset ring-[#269ad5]/30' : 'bg-rose-50/95 text-rose-700 ring-1 ring-inset ring-rose-600/20' }}">
                                    <span class="relative flex h-1.5 w-1.5 shrink-0">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 
                                            {{ $producto->activo ? 'bg-[#269ad5]' : 'bg-rose-400' }}"></span>
                                        <span class="relative inline-flex rounded-full h-1.5 w-1.5
                                            {{ $producto->activo ? 'bg-[#269ad5]' : 'bg-rose-500' }}"></span>
                                    </span>
                                    {{ $producto->activo ? 'Disponible' : 'No disponible' }}
                                </span>
                            </div>
                        </div>
                        <div class="pt-3 flex flex-col flex-grow">
                            <p class="text-[10px] font-bold text-amber-500 uppercase tracking-wider mb-0.5">{{ $producto->modelo ?: 'General' }}</p>
                            <h3 class="text-xs sm:text-sm font-bold text-slate-800 group-hover:text-[#269ad5] transition-colors line-clamp-2">{{ $producto->nombre }}</h3>
                            @if($producto->descripcion)
                                <p class="text-[11px] text-slate-500 mt-1 line-clamp-1 leading-normal font-normal">{{ $producto->descripcion }}</p>
                            @endif
                            <div class="mt-2.5 flex items-baseline gap-2">
                                <span class="text-sm sm:text-base font-black text-slate-900">S/ {{ number_format($producto->precio_unitario, 2) }}</span>
                            </div>
                            <div class="mt-2.5 pt-2 border-t border-gray-100">
                                <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full py-2 px-3 bg-[#269ad5] hover:bg-[#1d7fa3] text-white font-bold text-xs rounded-lg transition-colors shadow-xs active:scale-95">
                                        Agregar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>
                @if($loop->last)
                    </div>
                @endif
            @empty
                <div class="text-center py-12">
                    <div class="text-5xl mb-3">📦</div>
                    <h3 class="text-xl font-bold text-slate-800">Próximamente nuevos productos</h3>
                    <p class="text-slate-500 text-xs mt-1 font-normal">No hay productos disponibles por el momento.</p>
                </div>
            @endforelse
        </div>
    </section>

    <div id="panelCarrito" class="hidden fixed top-0 right-0 w-96 max-w-full h-screen bg-white shadow-2xl z-50 flex flex-col justify-between font-sans">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between bg-white sticky top-0 z-10">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-sky-50 text-[#269ad5] flex items-center justify-center font-bold">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-black text-gray-900 leading-tight">Mi Carrito</h2>
                    <p class="text-[11px] text-gray-400 font-medium">Tus productos seleccionados</p>
                </div>
            </div>
            <button onclick="document.getElementById('panelCarrito').classList.add('hidden')"
                class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 flex items-center justify-center font-bold transition-colors">
                &times;
            </button>
        </div>

        @php
            $carrito = session('carrito', []);
            $total = 0;
            $cantidadTotal = collect($carrito)->sum('cantidad');
        @endphp
        <div class="p-5 overflow-y-auto flex-1 space-y-3 bg-gray-50/50">
            @forelse($carrito as $id => $producto)
                @php
                    $subtotal = ($producto['precio_unitario'] ?? 0) * ($producto['cantidad'] ?? 0);
                    $total += $subtotal;
                @endphp
                
                <div class="group relative flex items-center justify-between gap-3 p-3.5 bg-white border border-gray-100 rounded-2xl shadow-2xs hover:border-[#269ad5]/40 transition-all">
                    
                    <!-- IMAGEN DEL PRODUCTO -->
                    <div class="w-16 h-16 shrink-0 flex items-center justify-center bg-gray-50 rounded-xl border border-gray-100/80 overflow-hidden">
                        @if(!empty($producto['imagen']))
                            <img src="{{ asset('storage/' . ltrim($producto['imagen'], '/')) }}" alt="{{ $producto['nombre'] ?? 'Producto' }}" class="w-full h-full object-contain p-1"
                                onerror="this.onerror=null; this.style.display='none';">
                        @else
                            <span class="text-xl">📦</span>
                        @endif
                    </div>

                    <!-- INFORMACIÓN DEL PRODUCTO -->
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-xs sm:text-sm text-slate-800 line-clamp-1 group-hover:text-[#269ad5] transition-colors">
                            {{ $producto['nombre'] }}
                        </h3>
                        
                        <div class="flex items-center gap-2 mt-1 text-[11px] text-gray-500">
                            <span>S/ {{ number_format($producto['precio_unitario'] ?? 0, 2) }}</span>
                            <span class="text-gray-300">|</span>
                            <div class="flex items-center gap-2">
                                <form action="{{ route('carrito.disminuir', $producto['id']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-gray-200 px-2 py-1 rounded">-</button>
                                </form>
                                <span class="font-bold">{{ $producto['cantidad'] ?? 0 }}</span>
                                <form action="{{ route('carrito.agregar', $producto['id']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-600 text-white px-2 py-1 rounded">+</button>
                                </form>
                            </div>
                        </div>
                        <span class="font-black text-xs text-[#269ad5] block mt-1.5">
                            Subtotal: S/ {{ number_format($subtotal, 2) }}
                        </span>
                    </div>

                    <!-- BOTÓN ELIMINAR MEJORADO -->
                    <button type="button" onclick="window.confirmarEliminar('{{ route('carrito.eliminar', $id) }}')"
                        class="group/btn relative w-9 h-9 flex items-center justify-center rounded-xl bg-rose-50 border border-rose-100 text-rose-500 hover:bg-rose-500 hover:text-white transition-all duration-200 active:scale-95 shrink-0 shadow-2xs"
                        title="Eliminar producto">
                        <svg class="w-4 h-4 fill-current transition-transform group-hover/btn:scale-110" viewBox="0 0 24 24">
                            <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"/>
                        </svg>
                    </button>
                </div>

            @empty
                <!-- CARRITO VACÍO MINIMALISTA -->
                <div class="text-center py-20 px-4">
                    <div class="w-16 h-16 bg-sky-50 text-[#269ad5] rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-inner">
                        <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                            <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-800">Tu carrito está vacío</h3>
                    <p class="text-slate-400 text-xs mt-1 max-w-[200px] mx-auto">Explora nuestros productos y agrega tus favoritos.</p>
                </div>
            @endforelse
        </div>

        <!-- PIE DEL PANEL (TOTALES Y BOTÓN DE COMPRA) -->
        <div class="p-5 border-t border-gray-100 bg-white shadow-lg space-y-3">
            <div class="space-y-1.5 text-xs text-gray-500">
                <div class="flex justify-between">
                    <span>Total de artículos ({{ $cantidadTotal }})</span>
                    <span class="font-semibold text-gray-700">S/ {{ number_format($total, 2) }}</span>
                </div>
                <div class="pt-2 border-t border-gray-100 flex justify-between items-center text-sm font-bold">
                    <span class="text-gray-900">Total a pagar:</span>
                <span class="text-lg font-black text-black"><span class="text-rose-600">S/</span> {{ number_format($total, 2) }}</span>
                </div>
            </div>

            <a href="#" class="w-full py-3.5 bg-amber-400 hover:bg-amber-300 text-gray-900 font-extrabold text-xs uppercase tracking-wider rounded-xl transition-all shadow-md flex items-center justify-center gap-2 active:scale-95">
                <span>Continuar compra</span>
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>


    
<div id="panelCategorias"
     class="hidden fixed top-0 left-0 w-96 max-w-full h-screen bg-white shadow-2xl z-[9999] flex flex-col justify-between font-sans">
    {{-- ENCABEZADO --}}
    <div class="p-5 border-b border-gray-100 flex items-center justify-between bg-white sticky top-0 z-10">

        <div class="flex items-center gap-2.5">

            <div class="w-9 h-9 rounded-xl bg-sky-50 text-[#269ad5] flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                     stroke-width="2" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>
            </div>

            <div>
                <h2 class="text-base font-black text-gray-900 leading-tight">
                    Nuestras categorías
                </h2>
                <p class="text-[11px] text-gray-400 font-medium">
                    Explora nuestra tienda
                </p>
            </div>
        </div>

        <a href="#"
           onclick="event.preventDefault(); document.getElementById('panelCategorias').classList.add('hidden')"
           class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 flex items-center justify-center font-bold text-xl">
            &times;
        </a>
    </div>


    {{-- LISTADO DE CATEGORÍAS --}}
    <div class="p-5 overflow-y-auto flex-1 space-y-3 bg-gray-50/50">

        <p class="text-xs text-gray-500 mb-4">
            Selecciona una categoría para ver sus productos.
        </p>

        @forelse($categorias as $categoria)

            <a href="{{ route('home', ['categoria' => $categoria->id]) }}"
               class="group flex items-center gap-3 p-4 bg-white border border-gray-100 rounded-2xl shadow-sm hover:border-[#269ad5]/40 hover:shadow-md transition-all">

                <div class="w-12 h-12 shrink-0 rounded-xl bg-sky-50 text-[#269ad5] flex items-center justify-center group-hover:bg-[#269ad5] group-hover:text-white transition-all">

                    <svg class="w-6 h-6" fill="none"
                         stroke="currentColor" stroke-width="1.8"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M4 4h6v6H4zM14 4h6v6h-6zM4 14h6v6H4zM14 14h6v6h-6z"/>
                    </svg>
                </div>

                <div class="flex-1 min-w-0">
                    <h3 class="font-bold text-sm text-slate-800 group-hover:text-[#269ad5]">
                        {{ $categoria->nombre }}
                    </h3>
                    <p class="text-[11px] text-gray-400">
                        Explorar productos
                    </p>
                </div>

                <svg class="w-4 h-4 text-gray-400"
                     fill="none" stroke="currentColor"
                     stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="m9 18 6-6-6-6"/>
                </svg>

            </a>

        @empty

            <div class="text-center py-20">
                <h3 class="font-bold text-gray-800">
                    No hay categorías disponibles
                </h3>
            </div>

        @endforelse

    </div>


    {{-- PIE DEL PANEL --}}
    <div class="p-5 border-t border-gray-100 bg-white shadow-lg">

        <a href="#"
           onclick="event.preventDefault(); document.getElementById('panelCategorias').classList.add('hidden')"
           class="w-full py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-extrabold text-xs uppercase tracking-wider rounded-xl transition-all flex items-center justify-center gap-2">

            Cerrar categorías

        </a>

    </div>

</div>

@endsection