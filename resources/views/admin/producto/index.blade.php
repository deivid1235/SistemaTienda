@extends('layouts.admin.app')
@section('title', 'Productos')
@section('js')
@endsection
@section('content')
    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-solid fa-box-open text-slate-600"></i>
        Listado de Productos
    </h1>
        
    <div class="bg-white rounded-3xl shadow-md p-6">
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mb-4">
            <button type="button" onclick="document.getElementById('panelFiltros').classList.toggle('hidden')" 
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50" >
                <i class="fa-solid fa-filter"></i> Mostrar filtros 
            </button>
            <button type="button" onclick="document.getElementById('modalNuevoProducto').classList.remove('hidden')"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 sm:py-2 rounded-md text-white text-sm font-semibold shrink-0 hover:opacity-90 transition-opacity"
                style="background-color: var(--active-pink);"><i class="fa-solid fa-circle-plus"></i>Nuevo
            </button>

        </div>

        <div class="overflow-x-auto mt-4">
            <div id="panelFiltros" class="{{ request()->filled('buscar') ? '' : 'hidden' }} mt-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <form action="{{ url('/admin/producto') }}" method="GET">
                        <div class="flex flex-col sm:flex-row gap-3 items-center">
                            <div class="relative w-full sm:flex-1 sm:max-w-xl">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="buscador" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar producto..."
                                class="w-full pl-9 pr-4 py-2.5 sm:py-2 rounded-md border border-slate-200 bg-white text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            </div>
                            {{-- BOTONES --}}
                            <div class="flex gap-2 w-full sm:w-auto">
                                <button type="submit" class="px-4 py-2 rounded-md text-white text-sm font-semibold" style="background-color: var(--active-pink);">
                                    Buscar
                                </button>
                                <a href="{{ url('/admin/producto') }}"class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-white">
                                    Limpiar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <div class="w-full overflow-x-auto">
                <table class="w-full min-w-[1000px] table-auto border-collapse text-left text-xs sm:text-sm">
                   <thead>
                        <tr class="border-b border-slate-200 bg-slate-100 text-left text-sm text-slate-700">
                            <th class="w-16 whitespace-nowrap px-4 py-4 font-bold">#</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Imagen</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Nombre del Producto</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Código Interno</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Código de Barras</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Categoría</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Marca</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Precio Unitario</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Stock Actual</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Estado</th>
                            <th class="whitespace-nowrap px-4 py-4 text-right font-bold">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($productos as $index => $producto)
                            <tr class="border-b border-slate-100">
                                <td class="py-4 px-4 text-slate-600"> {{ $productos->firstItem() + $index }}</td>
                                <td class="py-4 px-4">
                                    @if($producto->imagen)
                                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-12 h-12 rounded-lg object-cover border border-slate-200">
                                    @else
                                        <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center">
                                            <i class="fa-solid fa-box text-slate-400 text-xl"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4 px-4">
                                    <div class="font-semibold text-slate-800">{{ $producto->nombre }}</div>
                                    <div class="text-xs text-slate-500 mt-1">{{ $producto->modelo ?? 'Sin modelo' }}</div>
                                </td>
                                <td class="py-4 px-4 text-slate-600">{{ $producto->codigo_interno ?? '-' }}</td>
                                <td class="py-4 px-4 text-slate-600"> {{ $producto->codigo_barras ?? '-' }}</td>
                                <td class="py-4 px-4 text-slate-600">{{ $producto->categoriaProducto->nombre ?? '-' }}</td>
                                <td class="py-4 px-4 text-slate-600">{{ $producto->marca->nombre ?? '-' }}</td>
                                <td class="py-4 px-4 text-slate-800 font-semibold">{{ number_format($producto->precio_unitario, 2) }}</td>
                                <td class="py-4 px-4 text-slate-600">{{ number_format($producto->stock_actual, 2) }}</td>
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                        {{ old('activo', $producto->activo ?? 1) ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20' : 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20' }}">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75
                                                {{ old('activo', $producto->activo ?? 1) ? 'bg-emerald-400' : 'bg-rose-400' }}"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2
                                                {{ old('activo', $producto->activo ?? 1) ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                        </span>
                                        {{ old('activo', $producto->activo ?? 1) ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                {{-- ACCIONES --}}
                                <td class="py-4 px-4 relative">
                                    <div class="flex justify-end">
                                        <div class="relative">
                                            <input type="checkbox" id="menuProducto{{ $producto->id }}" class="peer hidden">
                                            <label for="menuProducto{{ $producto->id }}"
                                                class="flex items-center justify-center w-9 h-9 rounded-lg cursor-pointertext-slate-600 hover:bg-slate-100 hover:text-slate-900
                                                transition-colors border border-slate-300"><i class="fa-solid fa-ellipsis-vertical text-lg"></i>
                                            </label>
                                            <div class="hidden peer-checked:block absolute right-0 bottom-full mb-2 w-48 h-24 overflow-y-scroll overscroll-contain bg-white rounded-md  shadow-xl border border-slate-200 z-[99999]">
                                                <div class="py-1">
                                                    {{-- VER --}}
                                                    <button type="button" onclick="document.getElementById('modalVerProducto{{ $producto->id }}').classList.remove('hidden')"
                                                        class="w-full flex items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 text-left">
                                                        <i class="fa-solid fa-eye w-4"></i>Ver
                                                    </button>
                                                    {{-- MODAL VER PRODUCTO --}}
                                                    <div id="modalVerProducto{{ $producto->id }}"class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
                                                        <div class="absolute inset-0 bg-black/10"></div>
                                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-4xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
                                                            <div class="flex items-center justify-between mb-4">
                                                                <h2 class="text-xl font-semibold text-slate-800 flex items-center gap-2">
                                                                    <i class="fa-solid fa-eye text-slate-600"></i>
                                                                    Ver Producto
                                                                </h2>
                                                                <a href="{{ route('producto') }}"class="text-slate-400 hover:text-slate-600 text-lg"><i class="fa-solid fa-xmark"></i></a>
                                                            </div>
                                                            {{-- PESTAÑAS --}}
                                                            <input type="radio" name="ver_producto_{{ $producto->id }}" id="verProd1_{{ $producto->id }}" class="peer/verProd1 hidden" checked>
                                                            <input type="radio" name="ver_producto_{{ $producto->id }}" id="verProd2_{{ $producto->id }}" class="peer/verProd2 hidden">
                                                            <input type="radio" name="ver_producto_{{ $producto->id }}" id="verProd3_{{ $producto->id }}" class="peer/verProd3 hidden">
                                                            <input type="radio" name="ver_producto_{{ $producto->id }}" id="verProd4_{{ $producto->id }}" class="peer/verProd4 hidden">
                                                            <div class="flex overflow-x-auto border-b border-slate-200 mb-6 gap-4 sm:gap-6">
                                                                <label for="verProd1_{{ $producto->id }}" class="pb-3 text-sm font-semibold cursor-pointer whitespace-nowrap peer-checked/verProd1:text-indigo-600 peer-checked/verProd1:border-b-2 peer-checked/verProd1:border-indigo-600 text-slate-500">
                                                                    <i class="fa-solid fa-box mr-2"></i>Información Básica
                                                                </label>
                                                                <label for="verProd2_{{ $producto->id }}" class="pb-3 text-sm font-semibold cursor-pointer whitespace-nowrap peer-checked/verProd2:text-indigo-600 peer-checked/verProd2:border-b-2 peer-checked/verProd2:border-indigo-600 text-slate-500">
                                                                    <i class="fa-solid fa-tags mr-2"></i>Precios y Costos
                                                                </label>
                                                                <label for="verProd3_{{ $producto->id }}" class="pb-3 text-sm font-semibold cursor-pointer whitespace-nowrap peer-checked/verProd3:text-indigo-600 peer-checked/verProd3:border-b-2 peer-checked/verProd3:border-indigo-600 text-slate-500">
                                                                    <i class="fa-solid fa-barcode mr-2"></i>Códigos e Imágenes
                                                                </label>
                                                                <label for="verProd4_{{ $producto->id }}" class="pb-3 text-sm font-semibold cursor-pointer whitespace-nowrap peer-checked/verProd4:text-indigo-600 peer-checked/verProd4:border-b-2 peer-checked/verProd4:border-indigo-600 text-slate-500">
                                                                    <i class="fa-solid fa-boxes-stacked mr-2"></i>Stock
                                                                </label>
                                                            </div>
                                                            {{-- 1. INFORMACIÓN BÁSICA --}}
                                                            <div class="hidden peer-checked/verProd1:block space-y-4">
                                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                    <div class="md:col-span-2">
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Nombre del Producto</label>
                                                                        <div class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700"> {{ $producto->nombre ?? '—' }}</div>
                                                                    </div>
                                                                    <div class="md:col-span-2">
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Descripción</label>
                                                                        <div class="w-full min-h-[60px] rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">{{ $producto->descripcion ?? '—' }}</div>
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Modelo</label>
                                                                        <div class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">{{ $producto->modelo ?? '—' }}</div>
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Categoría</label>
                                                                        <div class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">{{ $categorias->firstWhere('id', $producto->categoria_productos_id)?->nombre ?? '—' }}</div>
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Marca</label>
                                                                        <div class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">{{ $marcas->firstWhere('id', $producto->marca_id)?->nombre ?? '—' }}</div>
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Unidad de Medida</label>
                                                                        <div class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">{{ $unidades->firstWhere('id', $producto->unidad_id)?->codigo }}{{ $unidades->firstWhere('id', $producto->unidad_id)?->descripcion ?? '—' }}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- 2. PRECIOS Y COSTOS --}}
                                                            <div class="hidden peer-checked/verProd2:block space-y-4">
                                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                    <div>
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Moneda</label>
                                                                        <div class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                                                                            {{ $monedas->firstWhere('id', $producto->moneda_id)?->codigo ?? '—' }}
                                                                            - {{ $monedas->firstWhere('id', $producto->moneda_id)?->descripcion ?? '' }}
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Tipo de Afectación IGV</label>
                                                                        <div class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                                                                            {{ $tiposAfectacionIgv->firstWhere('id', $producto->tipo_afectacion_igv_id)?->nombre ?? '—' }}
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Precio Unitario</label>
                                                                        <div class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                                                                            {{ number_format($producto->precio_unitario ?? 0, 2) }}
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Costo Unitario</label>
                                                                        <div class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                                                                            {{ number_format($producto->costo_unitario ?? 0, 2) }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="md:col-span-2 flex items-center gap-6 mt-2">
                                                                        <div class="flex items-center gap-2">
                                                                            <i class="fa-solid {{ $producto->incluye_igv ? 'fa-circle-check text-green-600' : 'fa-circle-xmark text-slate-400' }}"></i>
                                                                            <span class="text-sm font-medium text-slate-700">Incluye IGV: {{ $producto->incluye_igv ? 'Sí' : 'No' }}</span>
                                                                        </div>
                                                                        <div class="flex items-center gap-2">
                                                                            <i class="fa-solid {{ $producto->incluye_isc ? 'fa-circle-check text-green-600' : 'fa-circle-xmark text-slate-400' }}"></i>
                                                                            <span class="text-sm font-medium text-slate-700">Incluye ISC: {{ $producto->incluye_isc ? 'Sí' : 'No' }}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- 3. CÓDIGOS E IMÁGENES --}}
                                                            <div class="hidden peer-checked/verProd3:block space-y-4">
                                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                    <div>
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Código Interno</label>
                                                                        <div class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">{{ $producto->codigo_interno ?? '—' }}</div>
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Código SUNAT</label>
                                                                        <div class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">{{ $producto->codigo_sunat ?? '—' }}</div>
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Código de Fabricante</label>
                                                                        <div class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">{{ $producto->codigo_fabricante ?? '—' }}</div>
                                                                    </div>
                                                                    <div class="flex flex-col justify-center">
                                                                        <label class="block text-sm font-medium text-slate-700 mb-2">Estado</label>
                                                                        @if($producto->activo)
                                                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20 w-max">
                                                                                <span class="relative flex h-2 w-2">
                                                                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 bg-emerald-400"></span>
                                                                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                                                                </span>
                                                                                Activo
                                                                            </span>
                                                                        @else
                                                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20 w-max">
                                                                                <span class="relative flex h-2 w-2">
                                                                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 bg-rose-400"></span>
                                                                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                                                                                </span>
                                                                                Inactivo
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2 border-t border-slate-100">
                                                                    <div class="grid grid-cols-2 gap-4">
                                                                        <div>
                                                                            <label class="block text-sm font-medium text-slate-700 mb-2">Imagen del Producto</label>
                                                                            <div class="flex items-center justify-center w-full h-44 border-2 border-dashed border-slate-300 rounded-lg bg-slate-50 overflow-hidden">
                                                                                @if($producto->imagen)
                                                                                    <img src="{{ asset('storage/'.$producto->imagen) }}" alt="Imagen del producto" class="w-full h-full object-cover">
                                                                                @else
                                                                                    <span class="text-sm text-slate-400">Sin imagen</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <label class="block text-sm font-medium text-slate-700 mb-2">Imagen QR</label>
                                                                            <div class="flex items-center justify-center w-full h-44 border-2 border-dashed border-slate-300 rounded-lg bg-slate-50 overflow-hidden">
                                                                                @if($producto->imagen_qr)
                                                                                    <img src="{{ asset('storage/'.$producto->imagen_qr) }}" alt="Código QR del producto" class="w-full h-full object-contain p-2">
                                                                                @else
                                                                                    <span class="text-sm text-slate-400">Sin QR</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium text-slate-700 mb-2">Código de Barras</label>
                                                                        <div class="rounded-md border border-slate-200 bg-slate-50 p-2.5 flex items-center justify-center gap-3 h-44">
                                                                            @if($producto->codigo_barras)
                                                                                <div class="bg-white p-1.5 rounded border border-slate-200 flex flex-col items-center justify-center w-full h-full">
                                                                                    <img src="{{ asset('storage/productos/barras/producto_'.$producto->id.'.svg') }}" alt="Código de barras" class="max-h-24 w-auto object-contain">
                                                                                    <span class="text-xs text-slate-400 mt-2">Número:</span>
                                                                                    <p class="text-sm font-semibold text-slate-700">{{ $producto->codigo_barras }}</p>
                                                                                </div>
                                                                            @else
                                                                                <p class="text-sm text-slate-500 py-3 px-2">No hay código de barras registrado.</p>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- 4. STOCK --}}
                                                            <div class="hidden peer-checked/verProd4:block space-y-4">
                                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                    <div>
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Almacén</label>
                                                                        <div class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                                                                            {{ $almacenes->firstWhere('id', $inventarios->firstWhere('producto_id', $producto->id)?->almacen_id)?->nombre ?? '—' }}
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Stock Mínimo</label>
                                                                        <div class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                                                                            {{ $inventarios->firstWhere('producto_id', $producto->id)?->stock_minimo ?? 0 }}
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Stock Inicial</label>
                                                                        <div class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                                                                            {{ $inventarios->firstWhere('producto_id', $producto->id)?->stock_inicial ?? 0 }}
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Stock Actual</label>
                                                                        <div class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                                                                            {{ $inventarios->firstWhere('producto_id', $producto->id)?->stock_actual ?? 0 }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- BOTÓN CERRAR --}}
                                                            <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-100">
                                                                <a href="{{ route('producto') }}"
                                                                    class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50">
                                                                    Cerrar
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- EDITAR --}}
                                                    <button type="button" onclick="document.getElementById('modalEditarProducto{{ $producto->id }}').classList.remove('hidden')"
                                                        class="w-full flex items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 text-left">
                                                        <i class="fa-solid fa-pen-to-square w-4"></i>
                                                        Editar
                                                    </button>                                                   
                                                    {{-- MODAL EDITAR PRODUCTO --}}
                                                    <div id="modalEditarProducto{{ $producto->id }}"class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
                                                        <div class="absolute inset-0 bg-black/10"
                                                            onclick="document.getElementById('modalEditarProducto{{ $producto->id }}').classList.add('hidden')">
                                                        </div>
                                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-4xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
                                                            <div class="flex items-center justify-between mb-4">
                                                                <h2 class="text-xl font-semibold text-slate-800 flex items-center gap-2">
                                                                    <i class="fa-solid fa-pen-to-square text-slate-600"></i>
                                                                    Editar Producto
                                                                </h2>
                                                                <button type="button" onclick="document.getElementById('modalEditarProducto{{ $producto->id }}').classList.add('hidden')"
                                                                    class="text-slate-400 hover:text-slate-600 text-lg"><i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </div>
                                                            {{-- FORMULARIO --}}
                                                            <form action="{{ route('producto.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="radio" name="tab_producto_{{ $producto->id }}" id="tabProd1_{{ $producto->id }}" class="peer/tabProd1 hidden" checked>
                                                                <input type="radio" name="tab_producto_{{ $producto->id }}" id="tabProd2_{{ $producto->id }}" class="peer/tabProd2 hidden">
                                                                <input type="radio" name="tab_producto_{{ $producto->id }}" id="tabProd3_{{ $producto->id }}" class="peer/tabProd3 hidden">
                                                                <input type="radio" name="tab_producto_{{ $producto->id }}" id="tabProd4_{{ $producto->id }}" class="peer/tabProd4 hidden">
                                                                <div class="flex overflow-x-auto border-b border-slate-200 mb-6 gap-4 sm:gap-6">
                                                                    <label for="tabProd1_{{ $producto->id }}" class="pb-3 text-sm font-semibold cursor-pointer whitespace-nowrap
                                                                        peer-checked/tabProd1:text-indigo-600 peer-checked/tabProd1:border-b-2 peer-checked/tabProd1:border-indigo-600 text-slate-500">
                                                                        <i class="fa-solid fa-box mr-2"></i>Información Básica
                                                                    </label>
                                                                    <label for="tabProd2_{{ $producto->id }}" class="pb-3 text-sm font-semibold cursor-pointer whitespace-nowrap
                                                                        peer-checked/tabProd2:text-indigo-600 peer-checked/tabProd2:border-b-2 peer-checked/tabProd2:border-indigo-600 text-slate-500">
                                                                        <i class="fa-solid fa-tags mr-2"></i>Precios y Costos
                                                                    </label>
                                                                    <label for="tabProd3_{{ $producto->id }}" class="pb-3 text-sm font-semibold cursor-pointer whitespace-nowrap
                                                                        peer-checked/tabProd3:text-indigo-600 peer-checked/tabProd3:border-b-2 peer-checked/tabProd3:border-indigo-600 text-slate-500">
                                                                        <i class="fa-solid fa-barcode mr-2"></i>Códigos e Imágenes
                                                                    </label>
                                                                    <label for="tabProd4_{{ $producto->id }}" class="pb-3 text-sm font-semibold cursor-pointer whitespace-nowrap
                                                                        peer-checked/tabProd4:text-indigo-600 peer-checked/tabProd4:border-b-2 peer-checked/tabProd4:border-indigo-600 text-slate-500">
                                                                        <i class="fa-solid fa-boxes-stacked mr-2"></i>Stock
                                                                    </label>
                                                                </div>
                                                                {{-- 1. INFORMACIÓN BÁSICA --}}
                                                                <div class="hidden peer-checked/tabProd1:block space-y-4">
                                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                        <div class="md:col-span-2">
                                                                            <label for="nombre_{{ $producto->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                                Nombre del Producto <span class="text-red-500">*</span></label>
                                                                            <input type="text" id="nombre_{{ $producto->id }}" name="nombre" maxlength="200" required value="{{ old('nombre', $producto->nombre) }}"
                                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                            @error('nombre')
                                                                                <small class="mt-1 block text-red-600">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="md:col-span-2">
                                                                            <label for="descripcion_{{ $producto->id }}" class="block text-sm font-medium text-slate-700 mb-1">Descripción</label>
                                                                            <textarea id="descripcion_{{ $producto->id }}" name="descripcion"rows="2"
                                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">{{ old('descripcion', $producto->descripcion) }}</textarea>
                                                                        </div>
                                                                        <div>
                                                                            <label for="modelo_{{ $producto->id }}"class="block text-sm font-medium text-slate-700 mb-1">Modelo</label>
                                                                            <input type="text" id="modelo_{{ $producto->id }}" name="modelo"  maxlength="150" value="{{ old('modelo', $producto->modelo) }}"
                                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                        </div>
                                                                        <div>
                                                                            <label for="categoria_id_{{ $producto->id }}" class="block text-sm font-medium text-slate-700 mb-1">Categoría <span class="text-red-500">*</span></label>
                                                                            <select id="categoria_id_{{ $producto->id }}" name="categoria_id" required
                                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                                <option value="">Seleccione categoría...</option>
                                                                                @foreach($categorias ?? [] as $categoria)
                                                                                    <option value="{{ $categoria->id }}"
                                                                                        {{ old('categoria_id', $producto->categoria_productos_id) == $categoria->id ? 'selected' : '' }}>
                                                                                        {{ $categoria->nombre }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('categoria_id')
                                                                                <small class="mt-1 block text-red-600">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div>
                                                                            <label for="marca_id_{{ $producto->id }}" class="block text-sm font-medium text-slate-700 mb-1"> Marca</label>
                                                                            <select id="marca_id_{{ $producto->id }}" name="marca_id"
                                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                                <option value="">Seleccione marca...</option>
                                                                                @foreach($marcas ?? [] as $marca)
                                                                                    <option value="{{ $marca->id }}"
                                                                                        {{ old('marca_id', $producto->marca_id) == $marca->id ? 'selected' : '' }}>{{ $marca->nombre }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('marca_id')
                                                                                <small class="mt-1 block text-red-600">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div>
                                                                            <label for="unidad_id_{{ $producto->id }}" class="block text-sm font-medium text-slate-700 mb-1">Unidad de Medida</label>
                                                                            <select id="unidad_id_{{ $producto->id }}" name="unidad_id"
                                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                                <option value="">Seleccione unidad...</option>
                                                                                @foreach($unidades ?? [] as $unidad)
                                                                                    <option value="{{ $unidad->id }}"
                                                                                        {{ old('unidad_id', $producto->unidad_id) == $unidad->id ? 'selected' : '' }}>
                                                                                        {{ $unidad->codigo }} {{ $unidad->descripcion }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('unidad_id')
                                                                                <small class="mt-1 block text-red-600">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{-- 2. PRECIOS Y COSTOS --}}
                                                                <div class="hidden peer-checked/tabProd2:block space-y-4">
                                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                        <div>
                                                                            <label for="moneda_id_{{ $producto->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                                Moneda <span class="text-red-500">*</span>
                                                                            </label>
                                                                            <select id="moneda_id_{{ $producto->id }}" name="moneda_id" required
                                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                                <option value="">Seleccione moneda...</option>
                                                                                @foreach($monedas ?? [] as $moneda)
                                                                                    <option value="{{ $moneda->id }}"
                                                                                        {{ old('moneda_id', $producto->moneda_id) == $moneda->id ? 'selected' : '' }}>
                                                                                        {{ $moneda->codigo }} - {{ $moneda->descripcion }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('moneda_id')
                                                                                <small class="mt-1 block text-red-600">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>

                                                                        <div>
                                                                            <label for="tipo_afectacion_igv_id_{{ $producto->id }}" class="block text-sm font-medium text-slate-700 mb-1">Tipo de Afectación IGV</label>
                                                                            <select id="tipo_afectacion_igv_id_{{ $producto->id }}" name="tipo_afectacion_igv_id"
                                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                                <option value="">Seleccione afectación...</option>
                                                                                @foreach($tiposAfectacionIgv ?? [] as $afectacion)
                                                                                    <option value="{{ $afectacion->id }}"
                                                                                        {{ old('tipo_afectacion_igv_id', $producto->tipo_afectacion_igv_id) == $afectacion->id ? 'selected' : '' }}>
                                                                                        {{ $afectacion->nombre }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('tipo_afectacion_igv_id')
                                                                                <small class="mt-1 block text-red-600">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div>
                                                                            <label for="precio_unitario_{{ $producto->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                                Precio Unitario <span class="text-red-500">*</span>
                                                                            </label>
                                                                            <input type="number" step="0.01" min="0"  id="precio_unitario_{{ $producto->id }}"
                                                                                name="precio_unitario" required value="{{ old('precio_unitario', $producto->precio_unitario) }}"
                                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                            @error('precio_unitario')
                                                                                <small class="mt-1 block text-red-600">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div>
                                                                            <label for="costo_unitario_{{ $producto->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                                Costo Unitario
                                                                            </label>
                                                                            <input type="number" step="0.01" min="0" id="costo_unitario_{{ $producto->id }}" name="costo_unitario" value="{{ old('costo_unitario', $producto->costo_unitario) }}"
                                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                            @error('costo_unitario')
                                                                                <small class="mt-1 block text-red-600">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="md:col-span-2 flex items-center gap-6 mt-2">
                                                                            <label class="inline-flex items-center cursor-pointer gap-2">
                                                                                <input type="hidden" name="incluye_igv" value="0">
                                                                                <input type="checkbox" name="incluye_igv" value="1" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                                                                                    {{ old('incluye_igv', $producto->incluye_igv) ? 'checked' : '' }}>
                                                                                <span class="text-sm font-medium text-slate-700">Incluye IGV</span>
                                                                            </label>
                                                                            <label class="inline-flex items-center cursor-pointer gap-2">
                                                                                <input type="hidden" name="incluye_isc" value="0">
                                                                                <input type="checkbox" name="incluye_isc" value="1" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                                                                                    {{ old('incluye_isc', $producto->incluye_isc) ? 'checked' : '' }}>
                                                                                <span class="text-sm font-medium text-slate-700">Incluye ISC</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- 3. CÓDIGOS E IMÁGENES --}}
                                                                <div class="hidden peer-checked/tabProd3:block space-y-4">
                                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                        <div>
                                                                            <label for="codigo_interno_{{ $producto->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                                Código Interno
                                                                            </label>
                                                                            <input type="text" id="codigo_interno_{{ $producto->id }}" name="codigo_interno" maxlength="50" value="{{ old('codigo_interno', $producto->codigo_interno) }}"
                                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                            @error('codigo_interno')
                                                                                <small class="mt-1 block text-red-600">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div>
                                                                            <label for="codigo_sunat_{{ $producto->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                                Código SUNAT
                                                                            </label>
                                                                            <input type="text" id="codigo_sunat_{{ $producto->id }}" name="codigo_sunat" maxlength="20" value="{{ old('codigo_sunat', $producto->codigo_sunat) }}"
                                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                            @error('codigo_sunat')
                                                                                <small class="mt-1 block text-red-600">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div>
                                                                            <label for="codigo_fabricante_{{ $producto->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                                Código de Fabricante
                                                                            </label>
                                                                            <input type="text" id="codigo_fabricante_{{ $producto->id }}" name="codigo_fabricante" maxlength="100" value="{{ old('codigo_fabricante', $producto->codigo_fabricante) }}"
                                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                            @error('codigo_fabricante')
                                                                                <small class="mt-1 block text-red-600">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="flex flex-col justify-center">
                                                                            <label class="block text-sm font-medium text-slate-700 mb-2">Estado</label>
                                                                            <label class="inline-flex items-center cursor-pointer gap-3 mt-1">
                                                                                <input type="hidden" name="activo" value="0">
                                                                                <input type="checkbox" name="activo" value="1" class="sr-only peer"
                                                                                    {{ old('activo', $producto->activo) == 1 ? 'checked' : '' }}>
                                                                                <span class="text-sm font-medium text-slate-600">
                                                                                    Inactivo
                                                                                </span>
                                                                                <div class="relative w-11 h-6 bg-slate-300 rounded-full
                                                                                    peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px]
                                                                                    after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5
                                                                                    after:transition-all peer-checked:bg-indigo-600" style="background-color: var(--active-pink);">
                                                                                </div>
                                                                                <span class="text-sm font-medium text-slate-800">
                                                                                    Activo
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2 border-t border-slate-100">
                                                                        <div>
                                                                            <label class="block text-sm font-medium text-slate-700 mb-1">Imagen del Producto</label>
                                                                            <label for="imagen_{{ $producto->id }}"
                                                                                class="flex flex-col items-center justify-center w-36 h-44 border-2 border-dashed border-slate-300 rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100 transition-all overflow-hidden relative">
                                                                                <div id="preview-container-imagen-{{ $producto->id }}"
                                                                                    class="flex flex-col items-center justify-center w-full h-full text-slate-400">
                                                                                    @if ($producto->imagen)
                                                                                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen actual del producto"class="w-full h-full object-cover">
                                                                                    @else
                                                                                        <span class="text-4xl font-light text-slate-300">+</span>
                                                                                        <span class="text-xs text-slate-400 mt-2">Subir imagen</span>
                                                                                    @endif
                                                                                </div>
                                                                                <button type="button" id="quitar-imagen-{{ $producto->id }}" onclick="quitarImagenProducto(event, {{ $producto->id }})"
                                                                                    class="{{ $producto->imagen ? '' : 'hidden' }} absolute top-1 right-1 w-6 h-6 bg-red-500 text-white rounded-full items-center justify-center text-sm font-bold hover:bg-red-600 z-10">
                                                                                    X
                                                                                </button>
                                                                                <input type="file" id="imagen_{{ $producto->id }}" name="imagen" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"class="hidden"onchange="mostrarImagenProducto(this, {{ $producto->id }})">
                                                                            </label>
                                                                            <p class="text-xs text-slate-500 mt-1">Selecciona una imagen PNG, JPG o WEBP.</p>
                                                                            @error('imagen')
                                                                                <small class="mt-1 block text-red-600">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div>
                                                                            <label class="block text-sm font-medium text-slate-700 mb-1">
                                                                                Código de Barras
                                                                            </label>
                                                                            <div class="rounded-md border border-slate-200 bg-slate-50 p-2.5 flex items-center gap-3">
                                                                                @if ($producto->codigo_barras)
                                                                                    <div class="bg-white p-1.5 rounded border border-slate-200 flex items-center justify-center">
                                                                                        <img src="{{ asset('storage/productos/barras/producto_' . $producto->id . '.svg') }}"alt="Código de barras del producto {{ $producto->nombre }}" class="h-16 w-auto object-contain">
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="text-xs text-slate-400 block">Número:</span><p class="text-sm font-semibold text-slate-700">{{ $producto->codigo_barras }}</p>
                                                                                    </div>
                                                                                @else
                                                                                    <p class="text-sm text-slate-500 py-3 px-2">
                                                                                        No hay código de barras registrado.
                                                                                    </p>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- 4. STOCK --}}
                                                                <div class="hidden peer-checked/tabProd4:block space-y-4">
                                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                        <div>
                                                                            <label for="almacen_id_{{ $producto->id }}"
                                                                                class="block text-sm font-medium text-slate-700 mb-1">
                                                                                Almacén <span class="text-red-500">*</span>
                                                                            </label>
                                                                            <select id="almacen_id_{{ $producto->id }}" name="almacen_id" required
                                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                                <option value="">Seleccione almacén...</option>
                                                                                @foreach($almacenes as $almacen)
                                                                                    <option value="{{ $almacen->id }}"
                                                                                        {{ old('almacen_id', $inventarios->firstWhere('producto_id', $producto->id)?->almacen_id) == $almacen->id ? 'selected' : '' }}>
                                                                                        {{ $almacen->nombre }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('almacen_id')
                                                                                <small class="mt-1 block text-red-600">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div>
                                                                            <label for="stock_minimo_{{ $producto->id }}"
                                                                                class="block text-sm font-medium text-slate-700 mb-1">Stock Mínimo</label>
                                                                            <input type="number" step="0.001" min="0" id="stock_minimo_{{ $producto->id }}" name="stock_minimo" value="{{ old('stock_minimo', $inventarios->firstWhere('producto_id', $producto->id)?->stock_minimo ?? 0) }}"
                                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                            @error('stock_minimo')
                                                                                <small class="mt-1 block text-red-600">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div>
                                                                            <label for="stock_inicial_{{ $producto->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                                Stock Inicial
                                                                            </label>
                                                                            <input type="number" step="0.001" min="0" id="stock_inicial_{{ $producto->id }}" name="stock_inicial"
                                                                                value="{{ old('stock_inicial', $inventarios->firstWhere('producto_id', $producto->id)?->stock_inicial ?? 0) }}"
                                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                            @error('stock_inicial')
                                                                                <small class="mt-1 block text-red-600">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div>
                                                                            <label for="stock_actual_{{ $producto->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                                Stock Actual
                                                                            </label>
                                                                            <input type="number" step="0.001" min="0" id="stock_actual_{{ $producto->id }}" name="stock_actual"
                                                                                value="{{ old('stock_actual', $inventarios->firstWhere('producto_id', $producto->id)?->stock_actual ?? 0) }}"
                                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                            @error('stock_actual')
                                                                                <small class="mt-1 block text-red-600">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- BOTONES --}}
                                                                <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-100">
                                                                    <button type="button" onclick="document.getElementById('modalEditarProducto{{ $producto->id }}').classList.add('hidden')"
                                                                        class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50">
                                                                        Cancelar
                                                                    </button>
                                                                    <button type="submit" class="px-5 py-2 rounded-md text-white text-sm font-medium bg-indigo-600 hover:bg-indigo-700"
                                                                        style="background-color: var(--active-pink);">
                                                                        <i class="fa-solid fa-floppy-disk mr-1"></i>
                                                                        Actualizar Producto
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    {{--ELIMINAR--}}
                                                    <button type="button" onclick="confirmarEliminar('{{ route('producto.destroy', $producto->id) }}')"
                                                        class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-black hover:bg-slate-50 text-left">
                                                        <i class="fa-solid fa-trash w-4 text-black"></i>
                                                        Eliminar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="10" class="py-8 text-center text-slate-500">
                                    <i class="fa-solid fa-box-open text-2xl mb-2 block"></i>
                                    No hay productos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>

    <div id="modalNuevoProducto" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
        <div class="absolute inset-0 bg-black/10"
            onclick="document.getElementById('modalNuevoProducto').classList.add('hidden')">
        </div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-4xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
            <!-- Cabecera del Modal -->
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-slate-800">
                    Nuevo Producto
                </h2>
                <button type="button" onclick="document.getElementById('modalNuevoProducto').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600 text-lg">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            
            <form action="{{ route('producto.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- INPUTS OCULTOS (RADIOS) PARA CONTROLAR LAS PESTAÑAS SIN JS -->
                <input type="radio" name="tab_group_producto" id="tabProd1" class="peer/tabProd1 hidden" checked>
                <input type="radio" name="tab_group_producto" id="tabProd2" class="peer/tabProd2 hidden">
                <input type="radio" name="tab_group_producto" id="tabProd3" class="peer/tabProd3 hidden">
                <input type="radio" name="tab_group_producto" id="tabProd4" class="peer/tabProd4 hidden">
                
                <!-- BOTONES / PESTAÑAS (TABS VISUALES) -->
                <div class="flex overflow-x-auto scrollbar-none border-b border-slate-200 mb-6 gap-4 sm:gap-6 pb-0.5">
                    <label for="tabProd1" class="pb-3 text-xs sm:text-sm font-semibold cursor-pointer transition-all whitespace-nowrap shrink-0
                        peer-checked/tabProd1:text-indigo-600 peer-checked/tabProd1:border-b-2 peer-checked/tabProd1:border-indigo-600
                        text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-box mr-1.5 sm:mr-2"></i>
                        Información Básica
                    </label>
                    <label for="tabProd2" class="pb-3 text-xs sm:text-sm font-semibold cursor-pointer transition-all whitespace-nowrap shrink-0
                        peer-checked/tabProd2:text-indigo-600 peer-checked/tabProd2:border-b-2 peer-checked/tabProd2:border-indigo-600
                        text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-tags mr-1.5 sm:mr-2"></i>
                        Precios y Costos
                    </label>
                    <label for="tabProd3" class="pb-3 text-xs sm:text-sm font-semibold cursor-pointer transition-all whitespace-nowrap shrink-0
                        peer-checked/tabProd3:text-indigo-600 peer-checked/tabProd3:border-b-2 peer-checked/tabProd3:border-indigo-600
                        text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-barcode mr-1.5 sm:mr-2"></i>
                        Códigos e Imágenes
                    </label>
                    <label for="tabProd4" class="pb-3 text-xs sm:text-sm font-semibold cursor-pointer transition-all whitespace-nowrap shrink-0
                        peer-checked/tabProd4:text-indigo-600 peer-checked/tabProd4:border-b-2 peer-checked/tabProd4:border-indigo-600
                        text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-boxes-stacked mr-1.5 sm:mr-2"></i>
                        Stock de Productos
                    </label>
                </div>
                
                <!-- 1. PESTAÑA: INFORMACIÓN BÁSICA -->
                <div class="hidden peer-checked/tabProd1:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="nombre" class="block text-sm font-medium text-slate-700 mb-1">
                                Nombre del Producto <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nombre" name="nombre" maxlength="200" required placeholder="Ej. Laptop Lenovo Core i5" value="{{ old('nombre') }}"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            @error('nombre')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="descripcion" class="block text-sm font-medium text-slate-700 mb-1">
                                Descripción
                            </label>
                            <textarea id="descripcion" name="descripcion" rows="2" placeholder="Detalles o especificaciones..."
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
                        </div>

                        <div>
                            <label for="modelo" class="block text-sm font-medium text-slate-700 mb-1">
                                Modelo
                            </label>
                            <input type="text" id="modelo" name="modelo" maxlength="150"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div>
                            <label for="categoria_id" class="block text-sm font-medium text-slate-700 mb-1">
                                Categoría <span class="text-red-500">*</span>
                            </label>
                            <select id="categoria_id" name="categoria_id" required  value="{{ old('categoria_id') }}"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccione categoría...</option>
                                @foreach($categorias ?? [] as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }} - {{ $categoria->slug  }}</option>
                                @endforeach
                            </select>
                            @error('categoria_id')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <label for="marca_id" class="block text-sm font-medium text-slate-700 mb-1">
                                Marca
                            </label>
                            <select id="marca_id" name="marca_id"  value="{{ old('marca_id') }}"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccione marca...</option>
                                @foreach($marcas ?? [] as $marca)
                                    <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                @endforeach
                            </select>
                            @error('marca_id')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <label for="unidad_id" class="block text-sm font-medium text-slate-700 mb-1">Unidad de Medida</label>
                            <select id="unidad_id" name="unidad_id" value="{{ old('unidad_id') }}"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccione unidad...</option>
                                @foreach($unidades ?? [] as $unidad)
                                    <option value="{{ $unidad->id }}">{{ $unidad->codigo ." ".$unidad->descripcion }}</option>
                                @endforeach
                            </select>
                            @error('unidad_id')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 2. PESTAÑA: PRECIOS Y COSTOS -->
                <div class="hidden peer-checked/tabProd2:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="moneda_id" class="block text-sm font-medium text-slate-700 mb-1">
                                Moneda <span class="text-red-500">*</span>
                            </label>
                            <select id="moneda_id" name="moneda_id" required value="{{ old('moneda_id') }}"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccione moneda...</option>
                                @foreach($monedas ?? [] as $moneda)
                                    <option value="{{ $moneda->id }}">{{ $moneda->codigo." - ".$moneda->descripcion }}</option>
                                @endforeach
                            </select>
                            @error('moneda_id')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <label for="tipo_afectacion_igv_id" class="block text-sm font-medium text-slate-700 mb-1">
                                Tipo de Afectación IGV
                            </label>
                            <select id="tipo_afectacion_igv_id" name="tipo_afectacion_igv_id" value="{{ old('tipo_afectacion_igv_id') }}"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccione afectación...</option>
                                @foreach($tiposAfectacionIgv ?? [] as $afectacion)
                                    <option value="{{ $afectacion->id }}">{{ $afectacion->nombre }}</option>
                                @endforeach
                            </select>
                            @error('tipo_afectacion_igv_id')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <label for="precio_unitario" class="block text-sm font-medium text-slate-700 mb-1">
                                Precio Unitario <span class="text-red-500">*</span>
                            </label>
                            <input type="number" step="0.01" id="precio_unitario" name="precio_unitario" required min="0" placeholder="0.00" value="{{ old('precio_unitario') }}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            @error('precio_unitario')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <label for="costo_unitario" class="block text-sm font-medium text-slate-700 mb-1">Costo Unitario</label>
                            <input type="number" step="0.01" id="costo_unitario" name="costo_unitario" min="0" placeholder="0.00" value="{{ old('costo_unitario') }}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            @error('costo_unitario')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="flex items-center gap-6 mt-2 md:col-span-2">
                            <label class="inline-flex items-center cursor-pointer gap-2">
                                <input type="hidden" name="incluye_igv" value="0">
                                <input type="checkbox" name="incluye_igv" value="1" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" checked>
                                <span class="text-sm font-medium text-slate-700">Incluye IGV</span>
                            </label>

                            <label class="inline-flex items-center cursor-pointer gap-2">
                                <input type="hidden" name="incluye_isc" value="0">
                                <input type="checkbox" name="incluye_isc" value="1" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="text-sm font-medium text-slate-700">Incluye ISC</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- 3. PESTAÑA: CÓDIGOS E IMÁGENES -->
                <div class="hidden peer-checked/tabProd3:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="codigo_interno" class="block text-sm font-medium text-slate-700 mb-1">Código Interno </label>
                            <input type="text" id="codigo_interno" name="codigo_interno" maxlength="50" value="{{ old('codigo_interno')}}"  
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            @error('codigo_interno')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label for="codigo_barras" class="block text-sm font-medium text-slate-700 mb-1">Código de Barras</label>
                            <input type="text" id="codigo_barras" name="codigo_barras" maxlength="100"  value="{{ old('codigo_barras')}}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            @error('codigo_barras')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <label for="codigo_sunat" class="block text-sm font-medium text-slate-700 mb-1">Código SUNAT</label>
                            <input type="text" id="codigo_sunat" name="codigo_sunat" maxlength="20" value="{{ old('codigo_sunat')}}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            @error('codigo_sunat')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <label for="codigo_fabricante" class="block text-sm font-medium text-slate-700 mb-1">Código de Fabricante</label>
                            <input type="text" id="codigo_fabricante" name="codigo_fabricante" maxlength="100" value="{{ old('codigo_fabricante')}}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            @error('codigo_fabricante')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Imagen del Producto</label>
                            <label for="imagen" class="flex flex-col items-center justify-center w-36 h-44 border-2 border-dashed border-slate-300 rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100 transition-all overflow-hidden relative">
                                <div id="preview-container-imagen"
                                    class="flex flex-col items-center justify-center w-full h-full text-slate-400">
                                    <span class="text-4xl font-light text-slate-300">+</span>
                                    <span class="text-xs text-slate-400 mt-2">Subir imagen</span>
                                </div>

                                <button type="button" id="quitar-imagen" onclick="quitarImagen(event)"
                                    class="hidden absolute top-1 right-1 w-6 h-6 bg-red-500 text-white rounded-full items-center justify-center text-sm font-bold hover:bg-red-600 z-10">
                                    x
                                </button>
                                <input type="file" id="imagen" name="imagen" accept="image/*" class="hidden" onchange="mostrarImagenProducto(this)">
                            </label>
                            <p class="text-xs text-slate-500 mt-1">Selecciona una imagen en formato PNG, JPG o WEBP.</p>

                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Estado</label>
                            <label class="inline-flex items-center cursor-pointer gap-3">
                                <input type="hidden" name="activo" value="0">
                                <input type="checkbox" name="activo" value="1" class="sr-only peer" checked>
                                <span class="text-sm font-medium text-slate-600">Inactivo</span>
                                <div class="relative w-11 h-6 bg-slate-300 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px]
                                    after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"
                                    style="background-color: var(--active-pink);">
                                </div>
                                <span class="text-sm font-medium text-slate-800">Activo</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- 4. PESTAÑA: Stock de productos -->
                <div class="hidden peer-checked/tabProd4:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="almacen_id" class="block text-sm font-medium text-slate-700 mb-1">
                                Almacén <span class="text-red-500">*</span>
                            </label>
                            <select id="almacen_id" name="almacen_id" required  value="{{ old('almacen_id')}}"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccione almacén...</option>
                                @foreach($almacenes ?? [] as $almacen)
                                    <option value="{{ $almacen->id }}">{{ $almacen->descripcion ?? $almacen->nombre }}</option>
                                @endforeach
                            </select>
                            @error('almacen_id')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label for="stock_minimo" class="block text-sm font-medium text-slate-700 mb-1"> Stock Mínimo</label>
                            <input type="number" step="0.001" id="stock_minimo" name="stock_minimo" value="0" min="0" value="{{ old('stock_minimo"')}}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            @error('stock_minimo"')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label for="stock_inicial" class="block text-sm font-medium text-slate-700 mb-1">Stock Inicial</label>
                            <input type="number" step="0.001" id="stock_inicial" name="stock_inicial" value="0" min="0" value="{{ old('stock_inicial')}}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            @error('stock_inicial"')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <label for="stock_actual" class="block text-sm font-medium text-slate-700 mb-1">Stock Actual</label>
                            <input type="number" step="0.001" id="stock_actual" name="stock_actual" value="0" min="0"  value="{{ old('stock_actual')}}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            @error('stock_actual"')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción Inferiores -->
                <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-100">
                    <button type="button"
                        onclick="document.getElementById('modalNuevoProducto').classList.add('hidden')"
                        class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-md text-white text-sm font-medium bg-indigo-600 hover:bg-indigo-700"
                        style="background-color: var(--active-pink);">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection


