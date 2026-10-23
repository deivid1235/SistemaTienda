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
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Tipo Doc.</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Número</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Nombre / Razón Social</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Nombre Comercial</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Tipo Cliente</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Teléfono</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Fecha Registro</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Estado</th>
                            <th class="whitespace-nowrap px-4 py-4 text-right font-bold">Acciones</th>
                        </tr>
                    </thead>
                  
                    
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
                        <input type="text" id="nombre" name="nombre" maxlength="200" required placeholder="Ej. Laptop Lenovo Core i5"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
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
                        <select id="categoria_id" name="categoria_id" required
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="">Seleccione categoría...</option>
                            @foreach($categorias ?? [] as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="marca_id" class="block text-sm font-medium text-slate-700 mb-1">
                            Marca
                        </label>
                        <select id="marca_id" name="marca_id"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="">Seleccione marca...</option>
                            @foreach($marcas ?? [] as $marca)
                                <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="unidad_id" class="block text-sm font-medium text-slate-700 mb-1">
                            Unidad de Medida
                        </label>
                        <select id="unidad_id" name="unidad_id"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="">Seleccione unidad...</option>
                            @foreach($unidades ?? [] as $unidad)
                                <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                            @endforeach
                        </select>
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
                        <select id="moneda_id" name="moneda_id" required
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="">Seleccione moneda...</option>
                            @foreach($monedas ?? [] as $moneda)
                                <option value="{{ $moneda->id }}">{{ $moneda->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="tipo_afectacion_igv_id" class="block text-sm font-medium text-slate-700 mb-1">
                            Tipo de Afectación IGV
                        </label>
                        <select id="tipo_afectacion_igv_id" name="tipo_afectacion_igv_id"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="">Seleccione afectación...</option>
                            @foreach($tiposAfectacionIgv ?? [] as $afectacion)
                                <option value="{{ $afectacion->id }}">{{ $afectacion->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="precio_unitario" class="block text-sm font-medium text-slate-700 mb-1">
                            Precio Unitario <span class="text-red-500">*</span>
                        </label>
                        <input type="number" step="0.01" id="precio_unitario" name="precio_unitario" required min="0" placeholder="0.00"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>

                    <div>
                        <label for="costo_unitario" class="block text-sm font-medium text-slate-700 mb-1">
                            Costo Unitario
                        </label>
                        <input type="number" step="0.01" id="costo_unitario" name="costo_unitario" min="0" placeholder="0.00"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
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
                        <label for="codigo_interno" class="block text-sm font-medium text-slate-700 mb-1">
                            Código Interno
                        </label>
                        <input type="text" id="codigo_interno" name="codigo_interno" maxlength="50"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>

                    <div>
                        <label for="codigo_barras" class="block text-sm font-medium text-slate-700 mb-1">
                            Código de Barras
                        </label>
                        <input type="text" id="codigo_barras" name="codigo_barras" maxlength="100"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>

                    <div>
                        <label for="codigo_sunat" class="block text-sm font-medium text-slate-700 mb-1">
                            Código SUNAT
                        </label>
                        <input type="text" id="codigo_sunat" name="codigo_sunat" maxlength="20"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>

                    <div>
                        <label for="codigo_fabricante" class="block text-sm font-medium text-slate-700 mb-1">
                            Código de Fabricante
                        </label>
                        <input type="text" id="codigo_fabricante" name="codigo_fabricante" maxlength="100"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
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
                        <select id="almacen_id" name="almacen_id" required
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="">Seleccione almacén...</option>
                            @foreach($almacenes ?? [] as $almacen)
                                <option value="{{ $almacen->id }}">{{ $almacen->descripcion ?? $almacen->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="stock_minimo" class="block text-sm font-medium text-slate-700 mb-1">
                            Stock Mínimo
                        </label>
                        <input type="number" step="0.001" id="stock_minimo" name="stock_minimo" value="0" min="0"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                    <div>
                        <label for="stock_inicial" class="block text-sm font-medium text-slate-700 mb-1">
                            Stock Inicial
                        </label>
                        <input type="number" step="0.001" id="stock_inicial" name="stock_inicial" value="0" min="0"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                    <div>
                        <label for="stock_actual" class="block text-sm font-medium text-slate-700 mb-1">
                            Stock Actual
                        </label>
                        <input type="number" step="0.001" id="stock_actual" name="stock_actual" value="0" min="0"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
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


