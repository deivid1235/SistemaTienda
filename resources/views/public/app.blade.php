<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupoaosc | Tienda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-slate-50">

    {{-- Menú principal --}}
    <div class="bg-gray-100 border-b border-gray-200 text-xs py-2 px-4">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 text-center sm:text-left">
            <div class="inline-flex flex-wrap items-center justify-center gap-1.5 bg-[#76FF03] text-gray-950 font-bold px-3 py-1 rounded-full text-[11px] shadow-xs">
                <svg class="w-3.5 h-3.5 text-black fill-current shrink-0" viewBox="0 0 24 24">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                </svg>
                <span>¿Comienza tu pedido?</span>
                <a href="#" class="underline hover:opacity-80">Elige tu dirección</a>
            </div>
            
            <div class="flex items-center justify-center gap-4 sm:gap-6 text-gray-600 text-[11px] font-semibold flex-wrap">
                <a href="#" class="flex items-center gap-1 hover:text-black transition-colors">
                    <svg class="w-3.5 h-3.5 text-rose-500 fill-current shrink-0" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    <span>Mis Favoritos</span>
                    <span class="bg-gray-200 text-gray-700 rounded-full px-1.5 py-0.2 text-[10px]">0</span>
                </a>
                <a href="#" class="flex items-center gap-1 hover:text-black transition-colors">
                    <svg class="w-3.5 h-3.5 text-gray-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span>Sigue tu pedido</span>
                </a>
            </div>
        </div>
    </div>

    <header class="sticky top-0 z-50 bg-[#0407e2] text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 gap-2">
                <!-- Botón Menú Móvil -->
                <button id="btn-menu-mobile" type="button" class="md:hidden p-2 rounded-lg text-white hover:bg-white/10 focus:outline-none" aria-label="Abrir menú">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Logo y Nombre -->
                <a href="#inicio" class="flex items-center gap-2 sm:gap-3 shrink-0 min-w-0">
                    @if(isset($compania) && $compania?->logo)
                        <img src="{{ asset('uploads/companias/' . $compania->logo) }}" alt="Logo de la empresa" class="h-9 sm:h-11 md:h-12 w-auto object-contain shrink-0">
                    @endif
                    <span class="text-xs sm:text-sm md:text-base font-bold tracking-tight text-white truncate max-w-[120px] sm:max-w-[180px] md:max-w-none">
                        {{ $compania?->nombre_comercial ?? 'GRUPO' }}
                    </span>
                </a>

                <!-- Navegación Desktop -->
                <nav class="hidden md:flex items-center gap-6 lg:gap-8 uppercase font-bold text-xs tracking-wider">
                    <a href="#inicio" class="flex items-center gap-1.5 text-white hover:text-[#76FF03] transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Inicio
                    </a>
                    <a href="#panelCategorias" class="flex items-center gap-1.5 text-white hover:text-[#76FF03] transition-colors">
                        <svg class="w-4 h-4 text-[#76FF03]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="7" height="7" rx="1"/>
                            <rect x="14" y="3" width="7" height="7" rx="1"/>
                            <rect x="3" y="14" width="7" height="7" rx="1"/>
                            <rect x="14" y="14" width="7" height="7" rx="1"/>
                        </svg>
                        Categorías
                    </a>
                    <a href="#panelMarcas" class="flex items-center gap-1.5 text-white hover:text-[#76FF03] transition-colors">
                        <svg class="w-4 h-4 text-[#76FF03]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.59 13.41 13.42 20.6a2 2 0 0 1-2.83 0L3 13V3h10l7.59 7.59a2 2 0 0 1 0 2.82Z"/>
                            <circle cx="7.5" cy="7.5" r="1.5"/>
                        </svg>
                        Marcas
                    </a>
                    <a href="#productos" class="flex items-center gap-1.5 text-white hover:text-[#76FF03] transition-colors">
                        <svg class="w-4 h-4 text-[#76FF03]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        Productos
                    </a>
                </nav>

                <!-- Acciones de la derecha (Buscar, Iniciar Sesión, Carrito) -->
                <div class="flex items-center gap-2 sm:gap-4">
                    <form action="" method="GET" class="relative hidden lg:block">
                        <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar productos..." class="w-40 xl:w-48 pl-3 pr-8 py-1.5 bg-white/10 text-white placeholder-white/70 border border-white/20 rounded-full text-xs outline-none focus:bg-white focus:text-gray-800 focus:placeholder-gray-400 transition-all">
                        <button type="submit" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-white/80 hover:text-white">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </form>

                    <a href="#" class="hidden sm:flex items-center gap-1.5 text-xs font-semibold hover:text-[#76FF03] border-r border-white/20 pr-4 shrink-0 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>Iniciar Sesión</span>
                    </a>

                    <!-- Botón de Carrito con Verde  -->
                    <a href="#" class="bg-[#76FF03] hover:bg-[#64DD17] text-gray-950 px-3 sm:px-3.5 py-1.5 rounded-full flex items-center gap-1.5 sm:gap-2 font-black text-xs shadow-md transition-transform active:scale-95 shrink-0">
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
                            class="relative flex items-center gap-2 focus:outline-none">
                            <i class="fas fa-shopping-cart text-xl"></i>
                            <span class="w-5 h-5 rounded-full bg-[#D50000] text-white flex items-center justify-center text-[10px] font-extrabold shrink-0 shadow-xs">
                                {{ collect(session('carrito', []))->sum('cantidad') }}
                            </span>
                        </button>
                    </a>
                    </a>
                </div>
            </div>

            <!-- Menú Desplegable Móvil -->
            <div id="menu-desplegable-mobile" class="hidden md:hidden pb-5 pt-2 border-t border-white/20">
                <nav class="flex flex-col gap-3 uppercase font-bold text-xs tracking-wider">
                    <a href="#inicio" class="flex items-center gap-2 text-white hover:text-[#76FF03] py-1 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Inicio
                    </a>
                    <a href="#panelCategorias" class="flex items-center gap-2 text-white hover:text-[#76FF03] py-1 transition-colors">
                        <svg class="w-4 h-4 text-[#76FF03]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="7" height="7" rx="1"/>
                            <rect x="14" y="3" width="7" height="7" rx="1"/>
                            <rect x="3" y="14" width="7" height="7" rx="1"/>
                            <rect x="14" y="14" width="7" height="7" rx="1"/>
                        </svg>
                        Categorias de Productos
                    </a>
                    <a href="#panelMarcas" class="flex items-center gap-2 text-white hover:text-[#76FF03] py-1 transition-colors">
                        <svg class="w-4 h-4 text-[#76FF03]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.59 13.41 13.42 20.6a2 2 0 0 1-2.83 0L3 13V3h10l7.59 7.59a2 2 0 0 1 0 2.82Z"/>
                            <circle cx="7.5" cy="7.5" r="1.5"/>
                        </svg>
                        Marcas
                    </a>
                    <a href="#productos" class="flex items-center gap-2 text-white hover:text-[#76FF03] py-1 transition-colors">
                        <svg class="w-4 h-4 text-[#76FF03]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        Productos
                    </a>
                    <a href="#" class="flex items-center gap-2 text-white hover:text-[#76FF03] py-1 transition-colors">
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
    {{-- Aquí se mostrará el contenido de home.blade.php --}}
    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="bg-[#0407e2] text-white pt-12 pb-8 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 pb-10 border-b border-white/20">
                <div class="space-y-3">
                    <h2 class="text-2xl font-black tracking-tight text-white">
                        GRUPO<span class="text-[#76FF03]">AOSC.</span>
                    </h2>
                    <p class="text-white/80 text-xs sm:text-sm leading-relaxed">
                        Tu estilo, tu camino. Encuentra las mejores zapatillas y calzado con calidad garantizada y actitud en cada paso.
                    </p>
                    <div class="flex items-center gap-2 pt-2">
                        <a href="#" class="w-8 h-8 rounded-full bg-white/10 hover:bg-[#76FF03] hover:text-gray-950 flex items-center justify-center text-white transition-all">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-white/10 hover:bg-[#76FF03] hover:text-gray-950 flex items-center justify-center text-white transition-all">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-[#76FF03] mb-3">Enlaces rápidos</h3>
                    <ul class="space-y-2 text-xs text-white/80">
                        <li><a href="#inicio" class="hover:text-[#76FF03] transition-colors">Inicio</a></li>
                        <li><a href="#productos" class="hover:text-[#76FF03] transition-colors">Catálogo de Productos</a></li>
                        <li><a href="#" class="hover:text-[#76FF03] transition-colors">Términos y Condiciones</a></li>
                        <li><a href="#" class="hover:text-[#76FF03] transition-colors">Política de Privacidad</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-[#76FF03] mb-3">Atención al cliente</h3>
                    <ul class="space-y-2 text-xs text-white/80">
                        <li><a href="#" class="hover:text-[#76FF03] transition-colors">Sigue tu pedido</a></li>
                        <li><a href="#" class="hover:text-[#76FF03] transition-colors">Preguntas frecuentes</a></li>
                        <li><a href="#" class="hover:text-[#76FF03] transition-colors">Cambios y devoluciones</a></li>
                        <li><a href="#" class="hover:text-[#76FF03] transition-colors">Contáctanos</a></li>
                    </ul>
                
                    <div class="mt-4 pt-3 border-t border-white/10">
                        <a href="{{ route('libro.reclamacion') }}" class="inline-flex items-center gap-3.5 group text-xs text-white/90 hover:text-[#76FF03] transition-colors">
                            <div class="w-20 h-20 rounded-2xl bg-white/10 group-hover:bg-white/20 flex items-center justify-center p-2 shrink-0 transition-colors shadow-sm">
                                <img src="{{ asset('image/Libro_Reclamaciones.png') }}"alt="Libro de Reclamaciones"
                                class="w-full h-full object-contain brightness-0 invert group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="flex flex-col">
                                <span class="font-extrabold text-sm sm:text-base text-white group-hover:text-[#76FF03] transition-colors">Libro de Reclamaciones</span>
                                <span class="text-[11px] text-white/70 font-medium">Conforme a la Ley N° 29571</span>
                            </div>
                        </a>
                    </div>

                </div>

                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-[#76FF03] mb-3">Ofertas exclusivas</h3>
                    <p class="text-xs text-white/80 mb-3">Suscríbete para recibir promociones e información de lanzamientos.</p>
                    <form action="#" method="POST" class="space-y-2">
                        <input type="email" placeholder="Tu correo electrónico" class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-xs text-white placeholder-white/65 outline-none focus:bg-white focus:text-gray-900 focus:placeholder-gray-400 focus:ring-2 focus:ring-[#76FF03] transition-all">
                        <button type="submit" class="w-full py-2 px-4 bg-[#76FF03] hover:bg-[#6be002] text-gray-950 font-extrabold text-xs rounded-lg transition-colors shadow-sm uppercase tracking-wider">
                            Suscribirme
                        </button>
                    </form>
                </div>
            </div>

            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-white/80 text-center sm:text-left">
                <p>© {{ date('Y') }} GRUPOAOSC. Todos los derechos reservados.</p>
                <div class="flex items-center justify-center gap-4 text-[11px] font-medium flex-wrap">
                    <span class="flex items-center gap-1">💳 Pagos 100% seguros</span>
                    <span class="flex items-center gap-1">🚚 Envíos a todo el país</span>
                </div>
            </div>
        </div>
    </footer>



    {{-- ================= MENSAJE FLOTANTE DE ÉXITO ================= --}}
   @if (session('success'))
        <div id="alertaExito"
            class="fixed top-4 left-1/2 -translate-x-1/2 z-[99999] transition-all duration-300">
            <div class="flex items-center gap-2.5 bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-sm font-semibold px-5 py-2.5 rounded-xl shadow-md backdrop-blur-sm">
                <svg class="w-4 h-4 text-emerald-600 fill-current shrink-0" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif
    {{-- ================= MENSAJE FLOTANTE DE ERROR ================= --}}
    @if (session('error'))
        <div id="alertaError"
            class="fixed top-4 left-1/2 -translate-x-1/2 z-[99999]">
            <div class="flex items-center gap-2 bg-red-50 border border-red-100
                        text-red-600 text-sm font-medium px-5 py-2.5
                        rounded-lg shadow-sm">
                <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif
    {{-- ================= CONTENIDO DE LA VISTA ================= --}}
   
    <div id="modalEliminar"
        class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-24">
        <div class="absolute inset-0 bg-black/20"
            onclick="cerrarModalEliminar()">
        </div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-lg font-semibold text-slate-800">Eliminar</h2>
                <button type="button" onclick="cerrarModalEliminar()"class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark"></i></button>
            </div>
            {{-- MENSAJE --}}
            <div class="flex items-center gap-3 mb-8">
                <i class="fa-solid fa-triangle-exclamation text-amber-500 text-lg"></i>
                <p class="text-sm text-slate-600">¿Desea eliminar el producto del carrito?</p>
            </div>
            {{-- FORMULARIO --}}
            <form id="formEliminar" action="#" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end gap-3">
                    <button type="button"
                        onclick="cerrarModalEliminar()" class="px-4 py-2 rounded-md border border-slate-200text-slate-600 text-sm font-semibold hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-md bg-[#D50000] hover:bg-red-700 text-white text-sm font-semibold">
                        Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        window.confirmarEliminar = function(url) {
            const modal = document.getElementById('modalEliminar');
            const formulario = document.getElementById('formEliminar');
            if (!modal || !formulario) {
                console.error('No se encontró el modal de eliminación.');
                return;
            }
            formulario.action = url;
            modal.classList.remove('hidden');
        };
        window.cerrarModalEliminar = function() {
            const modal = document.getElementById('modalEliminar');
            if (modal) {
                modal.classList.add('hidden');
            }
        };
        document.addEventListener('DOMContentLoaded', function() {
            ['alertaExito', 'alertaError'].forEach(function(id) {
                const alerta = document.getElementById(id);
                if (alerta) {
                    setTimeout(function() {
                        alerta.style.transition = 'opacity .4s ease';
                        alerta.style.opacity = '0';
                        setTimeout(function() {
                            alerta.remove();
                        }, 400);
                    }, 3000);
                }
            });
        });
    </script>

</body>
</html>
