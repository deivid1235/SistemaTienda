@extends('layouts.admin.app')
@section('title', 'Categoría de Productos')
@section('js')
@endsection
@section('content')

    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-solid fa-layer-group text-slate-600"></i>
        Listado de Categorías de Productos
    </h1>
        
    <div class="bg-white rounded-3xl shadow-md p-6">
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mb-4">
            <button type="button" onclick="document.getElementById('panelFiltros').classList.toggle('hidden')" 
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50" >
                <i class="fa-solid fa-filter"></i> Mostrar filtros 
            </button>
            <button type="button" onclick="document.getElementById('modalNuevoCategoriaProducto').classList.remove('hidden')"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 sm:py-2 rounded-md text-white text-sm font-semibold shrink-0 hover:opacity-90 transition-opacity"
                style="background-color: var(--active-pink);"><i class="fa-solid fa-circle-plus"></i>Nuevo
            </button>

        </div>

        <div class="overflow-x-auto mt-4">
            <div id="panelFiltros" class="{{ request()->filled('buscar') ? '' : 'hidden' }} mt-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <form action="{{ url('/admin/categoriaproducto') }}" method="GET">
                        <div class="flex flex-col sm:flex-row gap-3 items-center">
                            <div class="relative w-full sm:flex-1 sm:max-w-xl">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="buscador" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar categorías de productos..."
                                class="w-full pl-9 pr-4 py-2.5 sm:py-2 rounded-md border border-slate-200 bg-white text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            </div>
                            {{-- BOTONES --}}
                            <div class="flex gap-2 w-full sm:w-auto">
                                <button type="submit" class="px-4 py-2 rounded-md text-white text-sm font-semibold" style="background-color: var(--active-pink);">
                                    Buscar
                                </button>
                                <a href="{{ url('/admin/categoriaproducto') }}"class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-white">
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
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Categoría</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Categoría Padre</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Slug</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Descripción</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Orden</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Estado</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Fecha Registro</th>
                            <th class="whitespace-nowrap px-4 py-4 text-right font-bold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categorias as $index => $categoria)
                            <tr class="border-b border-slate-100">
                                <td class="py-2 px-4 text-slate-600">{{ $index + 1 }}</td>
                                <td class="py-2 px-4">
                                    @if($categoria->imagen)
                                        <img src="{{ asset('storage/' . $categoria->imagen) }}" alt="{{ $categoria->nombre }}" class="w-12 h-12 rounded-lg object-cover border border-slate-200">
                                    @else
                                        <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                                            <i class="fa-solid fa-image text-lg"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-2 px-4 text-black font-medium">
                                    <div class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md bg-indigo-50 border border-indigo-200">
                                        <span class="text-indigo-500 text-xs"><i class="fa-solid fa-layer-group"></i></span>
                                        <span class="text-xs font-semibold text-indigo-900">{{ $categoria->nombre }}</span>
                                    </div>
                                </td>
                                <td class="py-2 px-4 text-slate-600">{{ $categoria->padre->nombre ?? 'Categoría principal' }}</td>
                                <td class="py-2 px-4 text-slate-600">{{ $categoria->slug }}</td>
                                <td class="py-2 px-4 text-slate-600">{{ $categoria->descripcion ?: '-' }}</td>
                                <td class="py-2 px-4 text-slate-600">{{ $categoria->orden }}</td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                        {{ $categoria->estado ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20' : 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20' }}">
                                        <span class="w-1.5 h-1.5 rounded-full
                                            {{ $categoria->estado ? 'bg-emerald-500' : 'bg-rose-500' }}">
                                        </span>{{ $categoria->estado ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="py-2 px-4 text-slate-600 whitespace-nowrap">{{ $categoria->created_at?->format('d/m/Y') ?? '-' }}</td>
                                {{-- ACCIONES --}}
                                <td class="py-2 px-4">
                                    <div class="flex justify-end gap-2">
                                        {{-- BOTÓN EDITAR --}}
                                        <button type="button"
                                            onclick="document.getElementById('modalEditarCategoriaProducto{{ $categoria->id }}').classList.remove('hidden')" class="px-4 py-1.5 rounded-md text-white text-xs font-semibold" style="background-color: #64DD17;">
                                            Editar
                                        </button>
                                        {{-- MODAL EDITAR CATEGORÍA --}}
                                        <div id="modalEditarCategoriaProducto{{ $categoria->id }}"
                                            class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
                                            <div class="absolute inset-0 bg-black/10"
                                                onclick="document.getElementById('modalEditarCategoriaProducto{{ $categoria->id }}').classList.add('hidden')">
                                            </div>
                                            <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-4xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
                                                {{-- CABECERA --}}
                                                <div class="flex items-center justify-between mb-4">
                                                    <h2 class="text-xl font-semibold text-slate-800 flex items-center gap-2"><i class="fa-solid fa-folder-pen text-slate-600"></i>
                                                        Editar Categoría de Producto
                                                    </h2>
                                                    <button type="button" onclick="document.getElementById('modalEditarCategoriaProducto{{ $categoria->id }}').classList.add('hidden')"
                                                        class="text-slate-400 hover:text-slate-600 text-lg"><i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </div>
                                                <form action="{{ route('categoriaproducto.update', $categoria->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    {{-- PESTAÑAS --}}
                                                    <input type="radio" name="tab_categoria_{{ $categoria->id }}" id="cat_tab1_{{ $categoria->id }}" class="peer/tab1 hidden" checked>
                                                    <input type="radio" name="tab_categoria_{{ $categoria->id }}" id="cat_tab2_{{ $categoria->id }}" class="peer/tab2 hidden">
                                                    <input type="radio" name="tab_categoria_{{ $categoria->id }}" id="cat_tab3_{{ $categoria->id }}" class="peer/tab3 hidden">
                                                    <div class="flex flex-wrap border-b border-slate-200 mb-6 gap-4 sm:gap-6">
                                                        <label for="cat_tab1_{{ $categoria->id }}"
                                                            class="pb-3 text-sm font-semibold cursor-pointer transition-all peer-checked/tab1:text-indigo-600 peer-checked/tab1:border-b-2 peer-checked/tab1:border-indigo-600 text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                                                            <i class="fa-solid fa-folder-tree mr-2"></i>
                                                            Información Básica
                                                        </label>
                                                        <label for="cat_tab2_{{ $categoria->id }}"
                                                            class="pb-3 text-sm font-semibold cursor-pointer transition-all peer-checked/tab2:text-indigo-600 peer-checked/tab2:border-b-2 peer-checked/tab2:border-indigo-600 text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                                                            <i class="fa-solid fa-image mr-2"></i>
                                                            Imagen y SEO
                                                        </label>
                                                        <label for="cat_tab3_{{ $categoria->id }}"
                                                            class="pb-3 text-sm font-semibold cursor-pointer transition-all peer-checked/tab3:text-indigo-600 peer-checked/tab3:border-b-2 peer-checked/tab3:border-indigo-600 text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                                                            <i class="fa-solid fa-sliders mr-2"></i>
                                                            Configuración y Estado
                                                        </label>
                                                    </div>
                                                    {{-- 1. INFORMACIÓN BÁSICA --}}
                                                    <div class="hidden peer-checked/tab1:block space-y-4">
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                            <div class="md:col-span-2">
                                                                <label for="nombre_edit_{{ $categoria->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                    Nombre de la Categoría <span class="text-red-500">*</span>
                                                                </label>
                                                                <input type="text" id="nombre_edit_{{ $categoria->id }}" name="nombre" value="{{ old('nombre', $categoria->nombre) }}" maxlength="100" required
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                            </div>
                                                            <div>
                                                                <label for="slug_edit_{{ $categoria->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                    Slug <span class="text-red-500">*</span>
                                                                </label>
                                                                <input type="text" id="slug_edit_{{ $categoria->id }}" name="slug" value="{{ old('slug', $categoria->slug) }}"  maxlength="120"required
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                            </div>
                                                            <div>
                                                                <label for="padre_edit_{{ $categoria->id }}" class="block text-sm font-medium text-slate-700 mb-1">Categoría Padre</label>
                                                                <select id="padre_edit_{{ $categoria->id }}"
                                                                    name="categoria_padre_id"
                                                                    class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                    <option value="">Ninguna (Categoría Principal)</option>
                                                                    @foreach($categorias as $padre)
                                                                        @if($padre->id != $categoria->id)
                                                                            <option value="{{ $padre->id }}"
                                                                                {{ old('categoria_padre_id', $categoria->categoria_padre_id) == $padre->id ? 'selected' : '' }}>
                                                                                {{ $padre->nombre }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="md:col-span-2">
                                                                <label for="descripcion_edit_{{ $categoria->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                    Descripción
                                                                </label>
                                                                <textarea id="descripcion_edit_{{ $categoria->id }}" name="descripcion" rows="3"
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">{{ old('descripcion', $categoria->descripcion) }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- 2. PESTAÑA: IMAGEN DE LA CATEGORÍA -->
                                                    <div class="hidden peer-checked/tab2:block space-y-4">
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                            <div class="md:col-span-2">
                                                                <label class="block text-sm font-medium text-slate-700 mb-1">Imagen de la Categoría</label>
                                                                <label for="imagen_edit_{{ $categoria->id }}"
                                                                    class="flex flex-col items-center justify-center w-36 h-44 border-2 border-dashed border-slate-300 rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100 transition-all overflow-hidden relative">
                                                                    <div id="preview-container-imagen-edit-{{ $categoria->id }}"
                                                                        class="flex flex-col items-center justify-center w-full h-full text-slate-400">
                                                                        @if($categoria->imagen)
                                                                            <img src="{{ asset('storage/' . $categoria->imagen) }}" class="w-full h-full object-cover" alt="{{ $categoria->nombre }}">
                                                                        @else
                                                                            <span class="text-4xl font-light text-slate-300">+</span>
                                                                            <span class="text-xs text-slate-400 mt-2">Subir imagen</span>
                                                                        @endif
                                                                    </div>
                                                                    <button type="button" id="quitar-imagen-edit-{{ $categoria->id }}" onclick="quitarImagenEdicion(event, {{ $categoria->id }})"
                                                                        class="{{ $categoria->imagen ? 'flex' : 'hidden' }} absolute top-1 right-1 w-6 h-6 bg-red-500 text-white rounded-full items-center justify-center text-sm font-bold hover:bg-red-600 z-10">x
                                                                    </button>
                                                                    <input type="file" id="imagen_edit_{{ $categoria->id }}" name="imagen" accept="image/*" class="hidden" onchange="mostrarImagenCategoriaEdicion(this, {{ $categoria->id }})">
                                                                </label>
                                                                <p class="text-xs text-slate-500 mt-1">
                                                                    Selecciona una imagen en formato PNG, JPG o WEBP.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- 3. CONFIGURACIÓN Y ESTADO --}}
                                                    <div class="hidden peer-checked/tab3:block space-y-4">
                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                            <div>
                                                                <label for="orden_edit_{{ $categoria->id }}" class="block text-sm font-medium text-slate-700 mb-1">Orden de Visualización</label>
                                                                <input type="number" id="orden_edit_{{ $categoria->id }}" name="orden" value="{{ old('orden', $categoria->orden) }}" min="0" 
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                            </div>
                                                            <div class="md:col-span-2">
                                                                <label class="block text-sm font-medium text-slate-700 mb-2">Estado</label>
                                                                <label class="inline-flex items-center cursor-pointer gap-3">
                                                                    <input type="hidden" name="estado" value="0">
                                                                    <input type="checkbox" name="estado" value="1" class="sr-only peer"
                                                                        {{ old('estado', $categoria->estado) ? 'checked' : '' }}>
                                                                    <span class="text-sm font-medium text-slate-600">Inactivo</span>
                                                                    <div class="relative w-11 h-6 bg-slate-300 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"
                                                                        style="background-color: var(--active-pink);">
                                                                    </div>
                                                                    <span class="text-sm font-medium text-slate-800">Activo</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- BOTONES --}}
                                                    <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-100">
                                                        <button type="button" onclick="document.getElementById('modalEditarCategoriaProducto{{ $categoria->id }}').classList.add('hidden')"
                                                            class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50">
                                                            Cancelar
                                                        </button>
                                                        <button type="submit" class="px-5 py-2 rounded-md text-white text-sm font-medium"
                                                            style="background-color: var(--active-pink);">
                                                            <i class="fa-solid fa-floppy-disk mr-1"></i>
                                                            Actualizar Categoría
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        {{-- BOTÓN ELIMINAR --}}
                                        <button type="button" onclick="confirmarEliminar('{{ route('categoriaproducto.destroy', $categoria->id) }}')"
                                            class="px-4 py-1.5 rounded-md text-white text-xs font-semibold"
                                            style="background-color: #D50000;">
                                            Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="py-4 text-center text-slate-500">
                                    No hay categorías registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div id="modalNuevoCategoriaProducto" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
        <div class="absolute inset-0 bg-black/10"
            onclick="document.getElementById('modalNuevoCategoriaProducto').classList.add('hidden')">
        </div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-4xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
            <!-- Cabecera del Modal -->
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-slate-800">
                    Nueva Categoría de Producto
                </h2>
                <button type="button" onclick="document.getElementById('modalNuevoCategoriaProducto').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600 text-lg">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('categoriaproducto.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- INPUTS OCULTOS (RADIOS) PARA CONTROLAR LAS PESTAÑAS SIN JS -->
                <input type="radio" name="tab_group_cat" id="cat_tab1" class="peer/tab1 hidden" checked>
                <input type="radio" name="tab_group_cat" id="cat_tab2" class="peer/tab2 hidden">
                <input type="radio" name="tab_group_cat" id="cat_tab3" class="peer/tab3 hidden">

                <!-- BOTONES / PESTAÑAS (TABS VISUALES) -->
                <div class="flex border-b border-slate-200 mb-6 gap-6">
                    <label for="cat_tab1" class="pb-3 text-sm font-semibold cursor-pointer transition-all
                        peer-checked/tab1:text-indigo-600 peer-checked/tab1:border-b-2 peer-checked/tab1:border-indigo-600
                        text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-folder-tree mr-2"></i>
                        Información Básica
                    </label>
                    <label for="cat_tab2" class="pb-3 text-sm font-semibold cursor-pointer transition-all
                        peer-checked/tab2:text-indigo-600 peer-checked/tab2:border-b-2 peer-checked/tab2:border-indigo-600
                        text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-image mr-2"></i>
                        Imagen y SEO
                    </label>
                    <label for="cat_tab3" class="pb-3 text-sm font-semibold cursor-pointer transition-all
                        peer-checked/tab3:text-indigo-600 peer-checked/tab3:border-b-2 peer-checked/tab3:border-indigo-600
                        text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-sliders mr-2"></i>
                        Configuración y Estado
                    </label>
                </div>
                
                <!-- 1. PESTAÑA: INFORMACIÓN BÁSICA -->
                <div class="hidden peer-checked/tab1:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="nombre" class="block text-sm font-medium text-slate-700 mb-1">
                                Nombre de la Categoría <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nombre" name="nombre" maxlength="100" required placeholder="Ej. Electrónica"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div>
                            <label for="slug" class="block text-sm font-medium text-slate-700 mb-1">
                                Slug <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="slug" name="slug" maxlength="120" required placeholder="ej. electronica"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div>
                            <label for="categoria_padre_id" class="block text-sm font-medium text-slate-700 mb-1">
                                Categoría Padre
                            </label>
                            <select id="categoria_padre_id"
                                name="categoria_padre_id"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">

                                <option value="">Ninguna (Categoría Principal)</option>

                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                        {{ old('categoria_padre_id') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label for="descripcion" class="block text-sm font-medium text-slate-700 mb-1">
                                Descripción
                            </label>
                            <textarea id="descripcion" name="descripcion" rows="3" placeholder="Breve descripción de la categoría..."
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
                        </div>
                    </div>
                </div>

                <!-- 2. PESTAÑA: IMAGEN Y SEO -->
                <div class="hidden peer-checked/tab2:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-1">Imagen de la Categoría</label>
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
                                <input type="file" id="imagen" name="imagen" accept="image/*" class="hidden" onchange="mostrarImagenCategoria(this)">
                            </label>
                            <p class="text-xs text-slate-500 mt-1">Selecciona una imagen en formato PNG, JPG o WEBP.</p>
                        </div>
                    </div>
                </div>

                <!-- 3. PESTAÑA: CONFIGURACIÓN Y ESTADO -->
                <div class="hidden peer-checked/tab3:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="orden" class="block text-sm font-medium text-slate-700 mb-1">
                                Orden de Visualización
                            </label>
                            <input type="number" id="orden" name="orden" value="0" min="0"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div class="md:col-span-2 flex items-center pt-2">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Estado</label>
                                <label class="inline-flex items-center cursor-pointer gap-3">
                                    <input type="hidden" name="estado" value="0">
                                    <input type="checkbox" name="estado" value="1" class="sr-only peer" checked>
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
                </div>

                <!-- Botones de Acción Inferiores -->
                <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-100">
                    <button type="button" onclick="document.getElementById('modalNuevoCategoriaProducto').classList.add('hidden')"
                        class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-md text-white text-sm font-medium bg-indigo-600 hover:bg-indigo-700"  style="background-color: var(--active-pink);">
                        Guardar Categoría
                    </button>
                </div>
            </form>
        </div>
    </div>

    

@endsection


