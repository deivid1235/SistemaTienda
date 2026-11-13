<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupoaosc | Tienda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-slate-50">
    <div class="bg-gray-100 border-b border-gray-200 text-xs py-2 px-4">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 text-center sm:text-left">
            <div class="inline-flex flex-wrap items-center justify-center gap-1.5 bg-[#d4af37] text-gray-950 font-bold px-3 py-1 rounded-full text-[11px] shadow-xs">
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

    <header class="sticky top-0 z-50 text-white shadow-md" style="background-color: #0f1d3a;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 gap-2">
                <button id="btn-menu-mobile" type="button" class="md:hidden p-2 rounded-lg text-white hover:bg-white/10 focus:outline-none" aria-label="Abrir menú">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <a href="{{ route('home') }}#inicio" class="flex items-center gap-2 sm:gap-3 shrink-0 min-w-0">
                    @if(isset($compania) && $compania?->logo)
                        <img src="{{ asset('uploads/companias/' . $compania->logo) }}" alt="Logo de la empresa" class="h-9 sm:h-11 md:h-12 w-auto object-contain shrink-0">
                    @endif
                    <span class="text-xs sm:text-sm md:text-base font-bold tracking-tight text-white truncate max-w-[120px] sm:max-w-[180px] md:max-w-none">
                        {{ $compania?->nombre_comercial ?? 'GRUPO' }}
                    </span>
                </a>
                <nav class="hidden md:flex items-center gap-2 lg:gap-4 uppercase font-bold text-xs tracking-wider">
                    <a href="{{ route('home') }}#inicio" class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-white border border-transparent hover:border-[#d4af37] hover:text-[#d4af37] transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Inicio
                    </a>
                    <a href="{{ route('home') }}#panelCategorias" class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-white border border-transparent hover:border-[#d4af37] hover:text-[#d4af37] transition-colors">
                        <svg class="w-4 h-4 text-[#d4af37]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="7" height="7" rx="1"/>
                            <rect x="14" y="3" width="7" height="7" rx="1"/>
                            <rect x="3" y="14" width="7" height="7" rx="1"/>
                            <rect x="14" y="14" width="7" height="7" rx="1"/>
                        </svg>
                        Categorías
                    </a>
                    <a href="{{ route('home') }}#panelMarcas" class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-white border border-transparent hover:border-[#d4af37] hover:text-[#d4af37] transition-colors">
                        <svg class="w-4 h-4 text-[#d4af37]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.59 13.41 13.42 20.6a2 2 0 0 1-2.83 0L3 13V3h10l7.59 7.59a2 2 0 0 1 0 2.82Z"/>
                            <circle cx="7.5" cy="7.5" r="1.5"/>
                        </svg>
                        Marcas
                    </a>
                    <a href="{{ route('home') }}#productos" class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-white border border-transparent hover:border-[#d4af37] hover:text-[#d4af37] transition-colors">
                        <svg class="w-4 h-4 text-[#d4af37]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        Productos
                    </a>
                </nav>
                <div class="flex items-center gap-2 sm:gap-4">
                    <form action="" method="GET" class="relative hidden lg:block">
                        <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar productos..." class="w-40 xl:w-48 pl-3 pr-8 py-1.5 bg-white/10 text-white placeholder-white/70 border border-white/20 rounded-full text-xs outline-none focus:bg-white focus:text-gray-800 focus:placeholder-gray-400 transition-all">
                        <button type="submit" class="absolute right-2.5 top-1/2 -translate-y-1/2 text-white/80 hover:text-white">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </form>
                    <label for="modalLoginCheck" class="hidden sm:flex items-center gap-1.5 text-xs font-semibold px-3 py-2 rounded-lg text-white border border-transparent hover:border-[#d4af37] hover:text-[#d4af37] transition-colors shrink-0 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>Iniciar Sesión</span>
                    </label>
                    <button type="button" onclick="document.getElementById('panelCarrito').classList.toggle('hidden')" class="bg-[#d4af37] hover:bg-[#b8952d] text-gray-950 px-3 sm:px-3.5 py-1.5 rounded-full flex items-center gap-1.5 sm:gap-2 font-black text-xs shadow-md transition-transform active:scale-95 shrink-0">
                        <svg class="w-4 h-4 fill-current shrink-0" viewBox="0 0 24 24">
                            <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 1.99-2-.9-2-2-2z"/>
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
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span class="w-5 h-5 rounded-full bg-[#D50000] text-white flex items-center justify-center text-[10px] font-extrabold shrink-0 shadow-xs">
                            {{ collect(session('carrito', []))->sum('cantidad') }}
                        </span>
                    </button>
                    <a href="" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-full text-sm font-semibold text-white whitespace-nowrap shrink-0 bg-white/5 border border-white/15 hover:border-[#d4af37] hover:bg-[#d4af37]/10 hover:text-[#d4af37] transition-all">
                        <svg class="w-4 h-4 text-[#d4af37] shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <span>Mi cuenta</span>
                    </a>
                </div>
            </div>
            <div id="menu-desplegable-mobile" class="hidden md:hidden pb-5 pt-2 border-t border-white/20">
                <nav class="flex flex-col gap-2 uppercase font-bold text-xs tracking-wider">
                    <a href="{{ route('home') }}#inicio" class="flex items-center gap-2 text-white px-3 py-2 rounded-lg border border-transparent hover:border-[#d4af37] hover:text-[#d4af37] transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Inicio
                    </a>
                    <a href="{{ route('home') }}#panelCategorias" class="flex items-center gap-2 text-white px-3 py-2 rounded-lg border border-transparent hover:border-[#d4af37] hover:text-[#d4af37] transition-colors">
                        <svg class="w-4 h-4 text-[#d4af37]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="7" height="7" rx="1"/>
                            <rect x="14" y="3" width="7" height="7" rx="1"/>
                            <rect x="3" y="14" width="7" height="7" rx="1"/>
                            <rect x="14" y="14" width="7" height="7" rx="1"/>
                        </svg>
                        Categorias de Productos
                    </a>
                    <a href="{{ route('home') }}#panelMarcas" class="flex items-center gap-2 text-white px-3 py-2 rounded-lg border border-transparent hover:border-[#d4af37] hover:text-[#d4af37] transition-colors">
                        <svg class="w-4 h-4 text-[#d4af37]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.59 13.41 13.42 20.6a2 2 0 0 1-2.83 0L3 13V3h10l7.59 7.59a2 2 0 0 1 0 2.82Z"/>
                            <circle cx="7.5" cy="7.5" r="1.5"/>
                        </svg>
                        Marcas
                    </a>
                    <a href="{{ route('home') }}#productos" class="flex items-center gap-2 text-white px-3 py-2 rounded-lg border border-transparent hover:border-[#d4af37] hover:text-[#d4af37] transition-colors">
                        <svg class="w-4 h-4 text-[#d4af37]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                        Productos
                    </a>
                    <a href="#" class="flex items-center gap-2 text-white px-3 py-2 rounded-lg border border-transparent hover:border-[#d4af37] hover:text-[#d4af37] transition-colors">
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

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="text-white pt-12 pb-8 font-sans" style="background-color: #0F1D3A;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 pb-10 border-b border-white/20">
                <div class="space-y-3">
                    <h2 class="text-2xl font-black tracking-tight text-white">
                        GRUPO<span class="text-[#b8952d]">AOSC.</span>
                    </h2>
                    <p class="text-white/80 text-xs sm:text-sm leading-relaxed">
                        Tu estilo, tu camino. Encuentra las mejores zapatillas y calzado con calidad garantizada y actitud en cada paso.
                    </p>
                    <div class="flex items-center gap-2 pt-2">
                        <a href="#" class="w-8 h-8 rounded-full bg-white/10 hover:bg-[#b8952d] hover:text-gray-950 flex items-center justify-center text-white transition-all">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-white/10 hover:bg-[#b8952d] hover:text-gray-950 flex items-center justify-center text-white transition-all">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-[#b8952d] mb-3">Enlaces rápidos</h3>
                    <ul class="space-y-2 text-xs text-white/80">
                        <li><a href="#inicio" class="hover:text-[#b8952d] transition-colors">Inicio</a></li>
                        <li><a href="#productos" class="hover:text-[#b8952d] transition-colors">Catálogo de Productos</a></li>
                        <li><a href="#" class="hover:text-[#b8952d] transition-colors">Términos y Condiciones</a></li>
                        <li><a href="#" class="hover:text-[#b8952d] transition-colors">Política de Privacidad</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-[#b8952d] mb-3">Atención al cliente</h3>
                    <ul class="space-y-2 text-xs text-white/80">
                        <li><a href="#" class="hover:text-[#b8952d] transition-colors">Sigue tu pedido</a></li>
                        <li><a href="#" class="hover:text-[#b8952d] transition-colors">Preguntas frecuentes</a></li>
                        <li><a href="#" class="hover:text-[#b8952d] transition-colors">Cambios y devoluciones</a></li>
                        <li><a href="#" class="hover:text-[#b8952d] transition-colors">Contáctanos</a></li>
                    </ul>
                
                    <div class="mt-4 pt-3 border-t border-white/10">
                        <a href="{{ route('libro.reclamacion') }}" class="inline-flex items-center gap-3.5 group text-xs text-white/90 hover:text-[#b8952d] transition-colors">
                            <div class="w-20 h-20 rounded-2xl bg-white/10 group-hover:bg-white/20 flex items-center justify-center p-2 shrink-0 transition-colors shadow-sm">
                                <img src="{{ asset('image/Libro_Reclamaciones.png') }}" alt="Libro de Reclamaciones"
                                class="w-full h-full object-contain brightness-0 invert group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <div class="flex flex-col">
                                <span class="font-extrabold text-sm sm:text-base text-white group-hover:text-[#b8952d] transition-colors">Libro de Reclamaciones</span>
                                <span class="text-[11px] text-white/70 font-medium">Conforme a la Ley N° 29571</span>
                            </div>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-[#b8952d] mb-3">Ofertas exclusivas</h3>
                    <p class="text-xs text-white/80 mb-3">Suscríbete para recibir promociones e información de lanzamientos.</p>
                    <form action="#" method="POST" class="space-y-2">
                        <input type="email" placeholder="Tu correo electrónico" class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-xs text-white placeholder-white/65 outline-none focus:bg-white focus:text-gray-900 focus:placeholder-gray-400 focus:ring-2 focus:ring-[#b8952d] transition-all">
                        <button type="submit" class="w-full py-2 px-4 bg-[#b8952d] hover:bg-[#9e7d23] text-gray-950 font-extrabold text-xs rounded-lg transition-colors shadow-sm uppercase tracking-wider">
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

    
    <div id="panelCarrito" class="hidden fixed top-0 right-0 w-96 max-w-full h-screen bg-white shadow-2xl z-50 flex flex-col justify-between font-sans">
        <div class="p-5 flex items-center justify-between sticky top-0 z-10 shadow-md" style="background-color: #0F1D3A;">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#b8952d] text-gray-950 flex items-center justify-center font-bold shadow-inner">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-bold text-[#b8952d] tracking-tight leading-tight">Mi Carrito</h2>
                    <p class="text-xs text-blue-100 font-medium mt-0.5">Tus productos seleccionados</p>
                </div>
            </div>
            <button onclick="document.getElementById('panelCarrito').classList.add('hidden')"
                class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center font-bold text-xl transition-colors">
                &times;
            </button>
        </div>

        @php
            $carrito = session('carrito', []);
            $total = 0;
            $cantidadTotal = collect($carrito)->sum('cantidad');
        @endphp
        <div class="p-5 overflow-y-auto flex-1 space-y-3 bg-slate-50/50">
            @forelse($carrito as $id => $producto)
                @php
                    $subtotal = ($producto['precio_unitario'] ?? 0) * ($producto['cantidad'] ?? 0);
                    $total += $subtotal;
                @endphp
                
                <div class="group relative flex items-center justify-between gap-3 p-3.5 bg-white border border-slate-100 rounded-2xl shadow-xs hover:border-[#b8952d] transition-all">
                    <div class="w-16 h-16 shrink-0 flex items-center justify-center bg-slate-50 rounded-xl border border-slate-100 overflow-hidden">
                        @if(!empty($producto['imagen']))
                            <img src="{{ asset('storage/' . ltrim($producto['imagen'], '/')) }}" alt="{{ $producto['nombre'] ?? 'Producto' }}" class="w-full h-full object-contain p-1"
                                onerror="this.onerror=null; this.style.display='none';">
                        @else
                            <span class="text-xl">📦</span>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-xs sm:text-sm text-slate-800 line-clamp-1 group-hover:text-[#0F1D3A] transition-colors leading-snug">
                            {{ $producto['nombre'] }}
                        </h3>
                        
                        <div class="flex items-center gap-2.5 mt-1.5 text-xs text-slate-600">
                            <span class="font-medium">S/ {{ number_format($producto['precio_unitario'] ?? 0, 2) }}</span>
                            <span class="text-slate-300">|</span>
                            <div class="flex items-center gap-2">
                                <form action="{{ route('carrito.disminuir', $producto['id']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-6 h-6 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded flex items-center justify-center transition-colors">-</button>
                                </form>
                                <span class="font-bold text-slate-800 text-xs">{{ $producto['cantidad'] ?? 0 }}</span>
                                <form action="{{ route('carrito.agregar', $producto['id']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-6 h-6 bg-[#b8952d] hover:bg-[#9e7d23] text-gray-950 font-bold rounded flex items-center justify-center transition-colors">+</button>
                                </form>
                            </div>
                        </div>
                        <span class="font-bold text-xs text-[#0F1D3A] block mt-1.5">
                            Subtotal: S/ {{ number_format($subtotal, 2) }}
                        </span>
                    </div>
                    <button type="button" onclick="window.confirmarEliminar('{{ route('carrito.eliminar', $id) }}')"
                        class="group/btn relative w-9 h-9 flex items-center justify-center rounded-xl bg-rose-50 border border-rose-100 text-rose-500 hover:bg-rose-500 hover:text-white transition-all duration-200 active:scale-95 shrink-0 shadow-xs"
                        title="Eliminar producto">
                        <svg class="w-4 h-4 fill-current transition-transform group-hover/btn:scale-110" viewBox="0 0 24 24">
                            <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"/>
                        </svg>
                    </button>
                </div>
            @empty
                <div class="text-center py-20 px-4">
                    <div class="w-16 h-16 bg-[#b8952d]/20 text-gray-950 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-inner">
                        <svg class="w-8 h-8 fill-current text-[#0F1D3A]" viewBox="0 0 24 24">
                            <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-slate-800">Tu carrito está vacío</h3>
                    <p class="text-slate-500 text-xs mt-1 max-w-[200px] mx-auto font-normal leading-relaxed">Explora nuestros productos y agrega tus favoritos.</p>
                </div>
            @endforelse
        </div>

        <!-- Footer del Carrito / Totales y Botón de Checkout -->
        <div class="p-5 border-t border-slate-100 bg-white shadow-lg space-y-3">
            <div class="space-y-2 text-xs text-slate-600">
                <div class="flex justify-between font-medium">
                    <span>Total de artículos ({{ $cantidadTotal }})</span>
                    <span class="font-semibold text-slate-800">S/ {{ number_format($total, 2) }}</span>
                </div>
                <div class="pt-2 border-t border-slate-100 flex justify-between items-center text-sm font-bold">
                    <span class="text-slate-900">Total a pagar:</span>
                    <span class="text-base font-black text-slate-900"><span class="text-[#0F1D3A]">S/</span> {{ number_format($total, 2) }}</span>
                </div>
            </div>
            <a href="#" class="w-full py-3.5 bg-[#b8952d] hover:bg-[#9e7d23] text-gray-950 font-extrabold text-xs uppercase tracking-wider rounded-xl transition-all duration-300 shadow-md flex items-center justify-center gap-2 active:scale-95">
                <span>Continuar compra</span>
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
    </div>

    <div>
        <input type="checkbox" id="modalLoginCheck" class="hidden peer">
        <div id="modalLogin" class="fixed inset-0 z-50 hidden peer-checked:flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="relative w-full max-w-md bg-[#f5f6f8] rounded-3xl p-8 sm:p-10 shadow-2xl transition-all font-sans">
                <label for="modalLoginCheck"
                    class="absolute top-4 right-5 text-gray-400 hover:text-gray-700 text-2xl font-bold cursor-pointer">
                    &times;
                </label>
                <h2 class="text-2xl sm:text-3xl font-black text-center text-[#0F1D3A] tracking-wider uppercase mb-8">INICIAR SESIÓN</h2>
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="flex items-center gap-2 text-sm font-bold text-[#0F1D3A] mb-1">
                            <i class="fas fa-envelope text-[#0F1D3A]"></i>
                            Correo electrónico
                        </label>
                        <input type="email" name="email" required placeholder="Ingresa tu correo electrónico" class="w-full bg-transparent border-b border-gray-300 py-2 text-sm text-gray-800 placeholder-gray-400 outline-none focus:border-[#0F1D3A] transition-colors">
                    </div>
                    <div>
                        <label class="flex items-center gap-2 text-sm font-bold text-[#0F1D3A] mb-1">
                            <i class="fas fa-lock text-[#0F1D3A]"></i>
                            Contraseña
                        </label>
                        <input type="password" name="password" required placeholder="Ingresa tu contraseña" class="w-full bg-transparent border-b border-gray-300 py-2 text-sm text-gray-800 placeholder-gray-400 outline-none focus:border-[#0F1D3A] transition-colors">
                    </div>

                    <p class="text-xs text-gray-500 leading-relaxed pt-1">
                        ¿Olvidaste tu contraseña? No te preocupes, pide un código verificador por
                        <a href="#" class="font-bold text-[#0F1D3A] hover:underline">correo</a>
                        para cambiar tu contraseña.
                    </p>
                    <button type="submit" class="w-full py-3.5 bg-[#0F1D3A] hover:bg-[#1a2f59] text-white font-extrabold text-sm uppercase tracking-wider rounded-xl transition-colors shadow-md active:scale-[0.99]">
                        INGRESAR
                    </button>
                </form>
                <div class="mt-6 text-center space-y-4">
                    <label for="modalRegistroCheck"
                        class="cursor-pointer text-sm font-bold text-[#0F1D3A] hover:underline">
                        Registrar cuenta
                    </label>
                    <div class="flex items-center justify-center gap-3 pt-1">
                        <a href="#" class="w-9 h-9 rounded-full bg-white shadow-sm flex items-center justify-center hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-full bg-white shadow-sm flex items-center justify-center hover:scale-110 transition-transform">
                            <svg class="w-5 h-5 fill-[#1877F2]" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <input type="checkbox" id="modalRegistroCheck" class="hidden peer">
        <div id="modalRegistro"  class="fixed inset-0 z-[60] hidden peer-checked:flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto bg-[#f5f6f8] rounded-3xl p-5 sm:p-6 shadow-2xl font-sans">
                <label for="modalRegistroCheck"
                    class="absolute top-4 right-5 text-gray-400 hover:text-gray-700 text-2xl font-bold cursor-pointer transition-colors">
                    &times;
                </label>
                <div class="text-center mb-6">
                    <h2 class="text-xl sm:text-2xl font-black text-[#0F1D3A] tracking-wider uppercase">
                        REGISTRO DE CLIENTE 
                    </h2>
                    <p class="text-xs text-gray-500 mt-1">
                        Completa tus datos para crear tu cuenta en <span class="font-bold text-[#0F1D3A]">GRUPOAOSC.</span>
                    </p>
                </div>
                <form action="{{ route('cliente_externo.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <h3 class="text-xs font-black text-[#0F1D3A] uppercase tracking-wider mb-3 border-b border-gray-300 pb-1.5 flex items-center gap-2">
                            <i class="fas fa-lock text-[#0F1D3A]"></i> Información de acceso
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-[#0F1D3A] mb-1"><i class="fas fa-envelope text-[#0F1D3A] mr-1"></i> Correo electrónico *</label>
                                <input type="email" name="correo" required maxlength="150" value="{{ old('correo') }}" placeholder="ejemplo@correo.com" autocomplete="email"
                                    class="w-full bg-white border border-gray-200 rounded-xl px-3.5 py-2.5 text-xs outline-none focus:border-[#0F1D3A] transition-colors">
                                @error('correo')
                                    <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-[#0F1D3A] mb-1">
                                    <i class="fas fa-key text-[#0F1D3A] mr-1"></i> Contraseña *
                                </label>
                                <input type="password" name="contrasena" required minlength="8"
                                    placeholder="Mínimo 8 caracteres"
                                    autocomplete="new-password"
                                    class="w-full bg-white border border-gray-200 rounded-xl px-3.5 py-2.5 text-xs outline-none focus:border-[#0F1D3A] transition-colors">
                                @error('contrasena')
                                    <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xs font-black text-[#0F1D3A] uppercase tracking-wider mb-3 border-b border-gray-300 pb-1.5 flex items-center gap-2">
                            <i class="fas fa-user text-[#0F1D3A]"></i> Información personal
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-[#0F1D3A] mb-1"><i class="fas fa-user-tag text-[#0F1D3A] mr-1"></i> Nombres *</label>
                                <input type="text" name="nombre" required maxlength="100" value="{{ old('nombre') }}"placeholder="Ingrese sus nombres"
                                class="w-full bg-white border border-gray-200 rounded-xl px-3.5 py-2.5 text-xs outline-none focus:border-[#0F1D3A] transition-colors">
                                @error('nombre')
                                    <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-[#0F1D3A] mb-1"><i class="fas fa-user-tag text-[#0F1D3A] mr-1"></i> Apellidos *</label>
                                <input type="text" name="apellido" required maxlength="100"
                                    value="{{ old('apellido') }}"
                                    placeholder="Ingrese sus apellidos"
                                    class="w-full bg-white border border-gray-200 rounded-xl px-3.5 py-2.5 text-xs outline-none focus:border-[#0F1D3A] transition-colors">
                                @error('apellido')
                                    <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-[#0F1D3A] mb-1"><i class="fas fa-id-card text-[#0F1D3A] mr-1"></i> Tipo de documento *</label>
                                <select name="tipo_documento" required
                                    class="w-full bg-white border border-gray-200 rounded-xl px-3.5 py-2.5 text-xs outline-none focus:border-[#0F1D3A] transition-colors">
                                    <option value="">Seleccionar documento</option>
                                    <option value="DNI" {{ old('tipo_documento') == 'DNI' ? 'selected' : '' }}>DNI</option>
                                    <option value="CE" {{ old('tipo_documento') == 'CE' ? 'selected' : '' }}>Carné de extranjería</option>
                                    <option value="PASAPORTE" {{ old('tipo_documento') == 'PASAPORTE' ? 'selected' : '' }}>Pasaporte</option>
                                </select>
                                @error('tipo_documento')
                                    <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-[#0F1D3A] mb-1"><i class="fas fa-hashtag text-[#0F1D3A] mr-1"></i> Número de documento *</label>
                                <input type="text" name="numero_documento" required maxlength="20" value="{{ old('numero_documento') }}" placeholder="Ingrese su documento" class="w-full bg-white border border-gray-200 rounded-xl px-3.5 py-2.5 text-xs outline-none focus:border-[#0F1D3A] transition-colors">
                                @error('numero_documento')
                                    <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold text-[#0F1D3A] mb-1"><i class="fas fa-phone text-[#0F1D3A] mr-1"></i> Celular *</label>
                                <input type="tel" name="celular" required maxlength="15" value="{{ old('celular') }}" placeholder="Ingrese su celular"
                                    class="w-full bg-white border border-gray-200 rounded-xl px-3.5 py-2.5 text-xs outline-none focus:border-[#0F1D3A] transition-colors">
                                @error('celular')
                                    <p class="text-red-500 text-[10px] mt-0.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xs font-black text-[#0F1D3A] uppercase tracking-wider mb-3 border-b border-gray-300 pb-1.5 flex items-center gap-2">
                            <i class="fas fa-file-signature text-[#0F1D3A]"></i> Declaraciones</h3>
                        <div class="space-y-2.5 text-xs">
                            <div class="flex items-start gap-2.5">
                                <input type="checkbox" name="acepta_terminos" value="1" required  {{ old('acepta_terminos') ? 'checked' : '' }}class="w-4 h-4 mt-0.5 accent-[#0F1D3A]">
                                <label class="text-gray-700">
                                    He leído y acepto los
                                    <a href="#" target="_blank" class="text-[#0F1D3A] font-bold underline hover:text-[#b8952d]">
                                        términos y condiciones</a>
                                    de GRUPOAOSC.
                                </label>
                            </div>
                            @error('acepta_terminos')
                                <p class="text-red-500 text-[10px]">{{ $message }}</p>
                            @enderror
                            <div class="flex items-start gap-2.5">
                                <input type="checkbox" name="declaracion_jurada" value="1" required {{ old('declaracion_jurada') ? 'checked' : '' }}
                                    class="w-4 h-4 mt-0.5 accent-[#0F1D3A]">
                                <label class="text-gray-700">
                                    Declaro bajo juramento que los datos proporcionados son verdaderos.
                                </label>
                            </div>
                            @error('declaracion_jurada')
                                <p class="text-red-500 text-[10px]">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="estado" value="1">
                    <div class="flex flex-col sm:flex-row gap-2.5 pt-2">
                        <label for="modalRegistroCheck" class="flex-1 text-center cursor-pointer py-3 rounded-xl border border-gray-300 text-gray-600 font-bold text-xs hover:bg-gray-100 transition-colors">
                            CANCELAR</label>
                        <button type="submit" class="flex-1 py-3 bg-[#0F1D3A] hover:bg-[#1a2f59] text-white font-extrabold text-xs uppercase tracking-wider rounded-xl transition-colors shadow-md">
                            CREAR CUENTA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- ================= MENSAJE FLOTANTE DE ÉXITO ================= --}}
    @if (session('success'))
        <div id="alertaExito" class="fixed top-4 left-1/2 -translate-x-1/2 z-[9999]">
        <div class="flex items-center gap-2 bg-green-50 border border-green-100
                    text-green-600 text-sm font-medium px-5 py-2.5
                    rounded-lg shadow-sm">
            <i class="fa-solid fa-circle-check text-green-500"></i>
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
