@extends('public.app')
@section('content')
    <div class="bg-[#d4af37] text-gray-950 text-xs font-bold py-2 px-4 shadow-inner">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-center gap-2 text-center">
            <span class="bg-red-600 text-white text-[10px] uppercase font-extrabold px-2 py-0.5 rounded-md tracking-wider">
                Envío Gratis
            </span>
            <span class="tracking-wide">
                ENVÍO GRATIS EN COMPRAS MAYORES A S/ 299 | Aplica para todos los productos
            </span>
        </div>
    </div>

    <main id="inicio" class="bg-white py-12 sm:py-16 font-sans scroll-mt-24">
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 lg:py-10 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-8 items-center">
                <div class="max-w-xl text-center lg:text-left mx-auto lg:mx-0">
                    <p class="text-[#0F1D3A] text-xs sm:text-sm font-bold tracking-[0.2em] uppercase mb-3 sm:mb-4">Calidad y variedad garantizada</p>
                    <h1 class="text-4xl sm:text-5xl lg:text-[4.5rem] font-black leading-[1.05] sm:leading-[0.95] tracking-tighter mb-4">
                        Todo lo que <br class="hidden sm:inline">
                        necesitas en un <span class="text-[#0F1D3A]">solo lugar</span>
                    </h1>
                    <p class="text-gray-500 text-sm sm:text-base leading-relaxed mb-6 max-w-md mx-auto lg:mx-0">Encuentra una gran variedad de artículos y productos seleccionados para ti. Los mejores precios y calidad en cada compra.</p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="#productos"
                        class="w-full sm:w-auto bg-[#0F1D3A] hover:bg-[#1a2f59] text-white px-6 py-3.5 text-xs font-bold uppercase tracking-wider transition-colors flex items-center justify-center gap-3 rounded-lg shadow-lg">
                            Ver catálogo general
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                        <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-500 font-medium">
                            <span class="w-2 h-2 rounded-full bg-[#b8952d] shrink-0"></span>
                            Novedades y ofertas disponibles
                        </div>
                    </div>
                </div>
                
                <!-- IMAGEN PRINCIPAL -->
                <div class="relative w-full max-w-sm sm:max-w-md mx-auto aspect-square lg:aspect-auto lg:h-[450px] flex items-center justify-center">
                    <div class="absolute inset-0 bg-[#E8E8E3] rounded-full scale-90 blur-3xl opacity-50"></div>
                    <div class="absolute inset-4 sm:inset-8 bg-[#0F1D3A] -rotate-6 shadow-2xl shadow-[#0F1D3A]/30 rounded-2xl"></div>
                    <img
                        src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?q=80&w=1000&auto=format&fit=crop"
                        alt="Productos destacados"
                        class="relative z-10 w-[85%] h-auto object-contain -rotate-12 drop-shadow-[0_35px_35px_rgba(0,0,0,0.4)] hover:scale-105 transition-transform duration-700 ease-out">
                    <div class="absolute bottom-0 right-0 sm:right-4 z-20 bg-white p-3 sm:p-4 shadow-xl w-40 sm:w-44 border border-black/5 rounded-xl">
                        <h3 class="text-[11px] font-black uppercase tracking-wider mb-0.5">
                            GRUPO AOSC
                        </h3>
                        <p class="text-[10px] text-gray-500">
                            Variedad para tu hogar y estilo.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section id="productos" class="bg-white py-12 sm:py-16 font-sans scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 text-left">
                <p class="text-slate-600 text-xs sm:text-base md:text-lg lg:text-xl mt-2 font-medium max-w-none leading-relaxed tracking-normal whitespace-nowrap overflow-x-auto scrollbar-none">
                    Descubre nuestro catálogo completo de productos disponibles con la mejor calidad del mercado.
                </p>
            </div>

            @forelse($productos as $producto)
                @if($loop->first)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 justify-items-center">
                @endif
                        <article class="group relative bg-white border border-slate-200 rounded-3xl p-4 shadow-lg shadow-slate-900/5 hover:shadow-xl hover:border-[#0F1D3A] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between w-full max-w-xs overflow-hidden">
                            <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-[#0F1D3A]/5 rounded-full blur-2xl group-hover:bg-[#b8952d]/20 transition-all duration-500 pointer-events-none"></div>
                            <div class="relative bg-gradient-to-b from-slate-50 to-slate-100/60 aspect-square overflow-hidden rounded-2xl border border-slate-100 group-hover:border-[#b8952d]/30 transition-colors">
                                @if($producto->imagen)
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-full object-contain p-3 group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                @else
                                    <div class="flex flex-col items-center justify-center h-full text-slate-400">
                                        <span class="text-2xl mb-1">📦</span>
                                        <span class="text-[10px] font-medium">Sin imagen</span>
                                    </div>
                                @endif
                                <div class="absolute top-2.5 right-2.5 z-10">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold backdrop-blur-md shadow-xs transition-all
                                        {{ $producto->activo 
                                            ? 'bg-emerald-50/90 text-emerald-800 ring-1 ring-inset ring-emerald-300/60' 
                                            : 'bg-rose-50/90 text-rose-700 ring-1 ring-inset ring-rose-300/60' }}">
                                        <span class="relative flex h-2 w-2 shrink-0">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 {{ $producto->activo ? 'bg-emerald-400' : 'bg-rose-400' }}"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 {{ $producto->activo ? 'bg-emerald-600' : 'bg-rose-500' }}"></span>
                                        </span>
                                        {{ $producto->activo ? 'Disponible' : 'No disponible' }}
                                    </span>
                                </div>
                            </div>
                            <div class="pt-3.5 flex flex-col flex-grow relative z-10">
                                <p class="text-[10px] font-black text-[#b8952d] uppercase tracking-wider mb-0.5">{{ $producto->modelo ?: 'General' }}</p>
                                <h3 class="text-xs sm:text-sm font-black text-slate-900 group-hover:text-[#0F1D3A] transition-colors line-clamp-2 leading-snug">{{ $producto->nombre }}</h3>
                                @if($producto->descripcion)
                                    <p class="text-[11px] text-slate-500 mt-1 line-clamp-1 leading-normal font-medium">{{ $producto->descripcion }}</p>
                                @endif
                                <div class="mt-3 flex items-baseline gap-2">
                                    <span class="text-base sm:text-lg font-black text-[#0F1D3A] tracking-tight">S/ {{ number_format($producto->precio_unitario, 2) }}</span>
                                </div>
                                <div class="mt-3 pt-2.5 border-t border-slate-100">
                                    <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full py-2.5 px-4 bg-[#b8952d] hover:bg-[#9e7d23] text-gray-950 font-extrabold text-xs rounded-full transition-all shadow-md hover:shadow-lg active:scale-95 flex items-center justify-center gap-2 uppercase tracking-wider">
                                            <span>Agregar</span>
                                            <svg class="w-4 h-4 stroke-current" fill="none" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                            </svg>
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
  

    <section id="panelCategorias" class="bg-white py-12 sm:py-16 font-sans scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 text-left">
                <p class="text-slate-600 text-xs sm:text-base md:text-lg lg:text-xl mt-2 font-medium max-w-none leading-relaxed tracking-normal whitespace-nowrap overflow-x-auto scrollbar-none">
                    Explora nuestras categorías y descubre todos los productos disponibles en la tienda.
                </p>
            </div>
            <p class="text-sm text-slate-500 mb-5 font-normal">Selecciona una categoría para ver sus productos.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($categorias as $categoria)
                    <a href="{{ route('categorias', ['categoria' => $categoria->id]) }}"
                    class="group relative flex items-center gap-5 p-4 sm:p-5 bg-gradient-to-r from-white via-white to-amber-50/30 border border-slate-200 rounded-3xl shadow-lg shadow-slate-900/5 hover:border-[#0F1D3A] hover:shadow-xl hover:-translate-y-1 transition-all duration-300 w-full overflow-hidden">
                        <div class="relative w-20 h-20 sm:w-24 sm:h-24 shrink-0 rounded-full bg-white flex items-center justify-center overflow-hidden border border-slate-200 p-2 shadow-sm group-hover:border-[#b8952d]/50 transition-colors">
                            @if($categoria->imagen)
                                <img src="{{ asset('storage/' . $categoria->imagen) }}" alt="{{ $categoria->nombre }}" class="w-full h-full object-cover rounded-full group-hover:scale-105 transition-transform duration-500 ease-out" loading="lazy">
                            @else
                                <svg class="w-10 h-10 text-[#0F1D3A] group-hover:scale-105 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0 relative z-10">
                            <h3 class="font-black text-base sm:text-lg text-[#0F1D3A] tracking-wide uppercase group-hover:scale-105 origin-left transition-transform truncate">{{ $categoria->nombre }}</h3>
                            <p class="text-xs sm:text-sm text-slate-600 mt-0.5 font-medium whitespace-nowrap transition-colors">Explorar productos</p>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-[#0F1D3A] flex items-center justify-center shrink-0 transition-all duration-300 shadow-md group-hover:scale-110 group-hover:bg-[#1a2f59] relative z-10">
                            <svg class="w-4 h-4 text-white group-hover:translate-x-0.5 transition-transform duration-300"
                                fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/>
                            </svg>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="text-4xl mb-2">📂</div>
                        <h3 class="text-sm font-bold text-slate-800">No hay categorías disponibles</h3>
                        <p class="text-xs text-slate-400 mt-1">Pronto agregaremos nuevas secciones.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="panelMarcas" class="bg-white py-12 sm:py-16 font-sans scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 text-left">
                <p class="text-slate-600 text-xs sm:text-base md:text-lg lg:text-xl mt-2 font-medium max-w-none leading-relaxed tracking-normal whitespace-nowrap overflow-x-auto scrollbar-none">
                    Explora nuestras marcas y descubre todos sus productos disponibles.
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @forelse($marcas as $marca)
                    <a href="{{ route('home', ['marca' => $marca->id]) }}" 
                    class="group relative flex items-center gap-4 p-4 bg-gradient-to-r from-white via-white to-amber-50/30 border border-slate-200 rounded-3xl shadow-lg shadow-slate-900/5 hover:border-[#0F1D3A] hover:shadow-xl hover:-translate-y-1 transition-all duration-300 w-full overflow-hidden">
                        <div class="relative w-20 h-20 sm:w-24 sm:h-24 shrink-0 rounded-full bg-white flex items-center justify-center overflow-hidden border border-slate-200 p-2.5 shadow-sm group-hover:border-[#b8952d]/50 transition-colors">
                            @if($marca->logo)
                                <img src="{{ asset('storage/' . $marca->logo) }}" alt="{{ $marca->nombre }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500 ease-out" loading="lazy">
                            @elseif($marca->imagen)
                                <img src="{{ asset('storage/' . $marca->imagen) }}" alt="{{ $marca->nombre }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500 ease-out" loading="lazy">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#0F1D3A] group-hover:scale-105 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M3 3h7l11 11-7 7L3 10V3z"/>
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0 relative z-10">
                            <h3 class="font-black text-base sm:text-lg text-[#0F1D3A] tracking-wide uppercase group-hover:scale-105 origin-left transition-transform truncate">{{ $marca->nombre }}</h3>
                            <p class="text-xs sm:text-sm text-slate-600 mt-0.5 font-medium whitespace-nowrap transition-colors">Explorar productos</p>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-[#0F1D3A] flex items-center justify-center shrink-0 transition-all duration-300 shadow-md group-hover:scale-110 group-hover:bg-[#1a2f59] relative z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white group-hover:translate-x-0.5 transition-transform duration-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 5 7 7-7 7"/>
                            </svg>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <div class="text-4xl mb-2">🏷️</div>
                        <h3 class="text-sm font-bold text-slate-800">No hay marcas disponibles</h3>
                        <p class="text-xs text-slate-400 mt-1">Pronto agregaremos nuevas marcas.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection