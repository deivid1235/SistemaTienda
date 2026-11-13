@extends('public.app')
@section('content')

<section id="productos" class="relative bg-slate-50/70 py-12 sm:py-16 font-sans scroll-mt-24 overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:24px_24px] opacity-40 pointer-events-none"></div>
    <div class="relative w-full pl-6 sm:pl-12 lg:pl-28 pr-4 sm:pr-8 lg:pr-12">
        <div class="mb-8 sm:mb-10 border-b border-slate-200/80 pb-6">
            <span class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-widest text-[#b8952d] mb-2">
                <span class="w-2 h-2 rounded-full bg-[#b8952d]"></span>
                Explora nuestra tienda
            </span>
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <p class="text-slate-500 text-sm sm:whitespace-nowrap">
                    Descubre nuestros productos disponibles con la mejor calidad y garantía.
                </p>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 xl:gap-8 items-start">
            <aside class="lg:col-span-3 xl:col-span-2">
                <div class="bg-white border border-slate-200/90 rounded-3xl p-5 shadow-sm sticky top-24">
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
                        <h3 class="text-sm font-black text-[#0F1D3A] uppercase tracking-wider">
                            Categorías
                        </h3>
                        <span class="text-xs font-bold text-slate-400 bg-slate-100 px-2.5 py-0.5 rounded-full">
                            {{ $categorias->count() }}
                        </span>
                    </div>
                    <div class="flex lg:flex-col gap-2 overflow-x-auto pb-2 lg:pb-0 scrollbar-none">
                        @foreach($categorias as $item)
                            @php
                                $isActive = $categoria->id == $item->id;
                            @endphp
                            <a href="{{ route('categorias', $item->id) }}"
                                class="group/cat flex items-center justify-between gap-2.5 px-3 py-2.5 rounded-2xl transition-all duration-200 shrink-0 lg:shrink
                                {{ $isActive ? 'bg-[#0F1D3A] text-white shadow-md shadow-[#0F1D3A]/20' : 'text-slate-600 hover:bg-slate-50 hover:text-[#0F1D3A]' }}">
                                <div class="flex items-center gap-2.5">
                                    <span class="w-4 h-4 rounded-md border flex items-center justify-center shrink-0 transition-colors
                                        {{ $isActive ? 'bg-[#b8952d] border-[#b8952d]' : 'border-slate-300 bg-white group-hover/cat:border-[#0F1D3A]' }}">
                                        @if($isActive)
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        @endif
                                    </span>
                                    <i class="fa-solid fa-tag text-xs transition-colors {{ $isActive ? 'text-[#b8952d]' : 'text-slate-400 group-hover/cat:text-[#0F1D3A]' }}"></i>
                                    <span class="text-sm font-bold tracking-tight">{{ $item->nombre }}</span>
                                </div>
                                <svg class="hidden lg:block w-3.5 h-3.5 transition-transform duration-200 {{ $isActive ? 'text-[#b8952d] translate-x-0.5' : 'text-slate-300 group-hover/cat:text-[#0F1D3A] group-hover/cat:translate-x-0.5' }}"
                                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>
            {{-- LADO DERECHO: PRODUCTOS --}}
            <div class="lg:col-span-9 xl:col-span-10">
                <div class="bg-white border border-slate-200/80 rounded-2xl px-6 py-4 mb-6 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div>
                        <h3 class="text-xl sm:text-2xl font-black text-[#0F1D3A]">{{ $categoria->nombre }}</h3>
                        <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Productos disponibles en esta categoría.</p>
                    </div>
                    <span class="self-start sm:self-center inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-[#0F1D3A]/5 text-[#0F1D3A]">
                        {{ $productos->count() }} {{ $productos->count() === 1 ? 'producto' : 'productos' }}
                    </span>
                </div>
                @forelse($productos as $producto)
                    @if($loop->first)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-6">
                    @endif
                        <article class="group relative bg-white border border-slate-200/90 rounded-3xl p-4 shadow-sm hover:shadow-xl hover:shadow-slate-900/10 hover:border-[#b8952d]/60 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between w-full overflow-hidden">
                            <div class="absolute -right-10 -bottom-10 w-36 h-36 bg-[#0F1D3A]/5 rounded-full blur-2xl group-hover:bg-[#b8952d]/20 transition-all duration-500 pointer-events-none"></div>
                            <div class="relative bg-gradient-to-br from-slate-50 via-white to-slate-100/80 aspect-square overflow-hidden rounded-2xl border border-slate-100 group-hover:border-[#b8952d]/30 transition-colors">
                                @if($producto->imagen)
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-full object-contain p-4 group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                @else
                                    <div class="flex flex-col items-center justify-center h-full text-slate-400">
                                        <div class="w-12 h-12 rounded-2xl bg-slate-100/80 border border-slate-200/60 flex items-center justify-center mb-2 text-slate-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                            </svg>
                                        </div>
                                        <span class="text-[11px] font-semibold tracking-wide">Sin imagen</span>
                                    </div>
                                @endif
                                <div class="absolute top-3 right-3 z-10">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-bold backdrop-blur-md shadow-xs
                                        {{ $producto->activo
                                            ? 'bg-emerald-50/95 text-emerald-700 ring-1 ring-inset ring-emerald-500/20'
                                            : 'bg-rose-50/95 text-rose-700 ring-1 ring-inset ring-rose-500/20' }}">
                                        <span class="w-1.5 h-1.5 rounded-full
                                            {{ $producto->activo ? 'bg-emerald-500' : 'bg-rose-500' }}">
                                        </span>
                                        {{ $producto->activo ? 'Disponible' : 'Agotado' }}
                                    </span>
                                </div>
                            </div>
                            <div class="pt-4 px-1 flex flex-col flex-grow relative z-10">
                                <div class="flex items-center gap-1.5 mb-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#b8952d]"></span>
                                    <p class="text-[10px] font-extrabold text-[#b8952d] uppercase tracking-widest">
                                        {{ $producto->modelo ?: 'General' }}
                                    </p>
                                </div>
                                <h3 class="text-sm sm:text-[15px] font-black text-[#0F1D3A] leading-snug line-clamp-2 group-hover:text-[#b8952d] transition-colors">
                                    {{ $producto->nombre }}
                                </h3>
                                @if($producto->descripcion)
                                    <p class="text-xs text-slate-500 mt-1.5 line-clamp-2 leading-relaxed">
                                        {{ $producto->descripcion }}
                                    </p>
                                @endif
                                <div class="mt-auto pt-4">
                                    <div class="flex items-baseline justify-between mb-3">
                                        <span class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">
                                            Precio
                                        </span>
                                        <div class="text-lg sm:text-xl font-black text-[#0F1D3A] tracking-tight">
                                            <span class="text-xs font-bold text-slate-500 mr-0.5">S/</span>{{ number_format($producto->precio_unitario, 2) }}
                                        </div>
                                    </div>

                                    {{-- Botón Carrito --}}
                                    <div class="pt-3 border-t border-slate-100">
                                        <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" @disabled(!$producto->activo)
                                                class="w-full py-2.5 px-4 bg-[#0F1D3A] hover:bg-[#b8952d] text-white hover:text-gray-950 font-extrabold text-xs rounded-xl transition-all duration-300 shadow-sm hover:shadow-md flex items-center justify-center gap-2 uppercase tracking-wider disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-[#0F1D3A] disabled:hover:text-white">
                                                <span>Agregar al carrito</span>
                                                <svg class="w-4 h-4 stroke-current" fill="none" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @if($loop->last)
                        </div>
                    @endif
                @empty
                    <div class="bg-white text-center py-16 px-6 border border-slate-200/90 rounded-3xl shadow-xs">
                        <div class="w-16 h-16 bg-slate-50 border border-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-[#0F1D3A]/60 shadow-xs">
                            <i class="fa-solid fa-box-open text-2xl"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-black text-[#0F1D3A]">
                            Próximamente nuevos productos
                        </h3>
                        <p class="text-slate-500 text-sm mt-1.5 max-w-sm mx-auto">
                            Actualmente no hay productos disponibles en esta categoría. Explora otras categorías del menú.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

@endsection