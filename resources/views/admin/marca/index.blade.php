@extends('layouts.admin.app')
@section('title', 'Marcas de Productos')
@section('js')
@endsection
@section('content')

    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-solid fa-tags text-slate-600"></i>
        Listado de marcas de productos
    </h1>
        
    <div class="bg-white rounded-3xl shadow-md p-6">
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mb-4">
            <button type="button" onclick="document.getElementById('panelFiltros').classList.toggle('hidden')" 
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50" >
                <i class="fa-solid fa-filter"></i> Mostrar filtros 
            </button>
            <button type="button" onclick="document.getElementById('modalNuevoMarca').classList.remove('hidden')"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 sm:py-2 rounded-md text-white text-sm font-semibold shrink-0 hover:opacity-90 transition-opacity"
                style="background-color: var(--active-pink);"><i class="fa-solid fa-circle-plus"></i>Nuevo
            </button>

        </div>
        <div class="overflow-x-auto mt-4">
            <div id="panelFiltros" class="{{ request()->filled('buscar') ? '' : 'hidden' }} mt-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <form action="{{ url('/admin/marca') }}" method="GET">
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
                                <a href="{{ url('/admin/marca') }}"class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-white">
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
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Logo</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Marca</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Descripción</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Estado</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Fecha Registro</th>
                            <th class="whitespace-nowrap px-3 py-4 text-center font-bold w-44">Acciones</th>                     
                        </tr>
                    </thead>
                    
                    <tbody>
                        @forelse($marcas as $index => $marca)
                            <tr class="border-b border-slate-100">
                                <td class="py-4 px-4 text-slate-600">{{ $index + 1 }}</td>
                                <td class="py-4 px-4">
                                    @if($marca->logo)
                                        <img src="{{ asset('storage/' . $marca->logo) }}"
                                            alt="{{ $marca->nombre }}"
                                            class="w-12 h-12 rounded-lg object-contain border border-slate-200 bg-white p-1">
                                    @else
                                        <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                                            <i class="fa-solid fa-image text-lg"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-black font-medium">
                                    <div class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md bg-indigo-50 border border-indigo-200">
                                        <span class="text-indigo-500 text-xs">
                                            <i class="fa-solid fa-tags"></i>
                                        </span><span class="text-xs font-semibold text-indigo-900">{{ $marca->nombre }}</span>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-slate-600">{{ $marca->descripcion ?: '-' }}</td>
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $marca->estado ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20' : 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20' }}">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75
                                                {{ $marca->estado ? 'bg-emerald-400' : 'bg-rose-400' }}"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2
                                                {{ $marca->estado ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                        </span>
                                        {{ $marca->estado ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-slate-600 whitespace-nowrap">{{ $marca->created_at?->format('d/m/Y') ?? '-' }}</td>
                                 {{-- ACCIONES: MENÚ DE TRES PUNTITOS --}}
                                <td class="py-4 px-4 relative">
                                    <div class="flex justify-end">
                                        <div class="relative">
                                            <input type="checkbox" id="menuMarca{{ $marca->id }}"  class="peer hidden">
                                            <label for="menuMarca{{ $marca->id }}"
                                                class="flex items-center justify-center w-9 h-9 rounded-lg cursor-pointer text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-colors border border-slate-300"><i class="fa-solid fa-ellipsis-vertical text-lg"></i>
                                            </label>
                                            <div class="hidden peer-checked:block absolute right-0 bottom-full mb-2 w-48 h-24 overflow-y-scroll overscroll-contain bg-white rounded-md  shadow-xl border border-slate-200 z-[99999]">
                                                <div class="py-1">
                                                   {{-- VER USUARIO --}}
                                                    <button type="button" onclick="document.getElementById('modalVerMarca{{ $marca->id }}').classList.remove('hidden')"
                                                        class="w-full flex items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 text-left">
                                                        <i class="fa-solid fa-eye w-4 text-black"></i></i>Ver
                                                    </button>
                                                    {{-- MODAL VER MARCA --}}
                                                    <div id="modalVerMarca{{ $marca->id }}" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
                                                        <div class="absolute inset-0 bg-black/10"
                                                            onclick="document.getElementById('modalVerMarca{{ $marca->id }}').classList.add('hidden')">
                                                        </div>
                                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-4xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
                                                            <div class="flex items-center justify-between mb-4">
                                                                <h2 class="text-xl font-semibold text-slate-800 flex items-center gap-2">
                                                                    <i class="fa-solid fa-tags text-slate-600"></i>
                                                                    Ver Marca
                                                                </h2>
                                                                <button type="button"
                                                                    onclick="document.getElementById('modalVerMarca{{ $marca->id }}').classList.add('hidden')"
                                                                    class="text-slate-400 hover:text-slate-600 text-lg">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </div>
                                                            <input type="radio" name="tab_ver_marca_{{ $marca->id }}"id="marca_ver_tab1_{{ $marca->id }}" class="peer/vtab1 hidden" checked>
                                                            <input type="radio" name="tab_ver_marca_{{ $marca->id }}"id="marca_ver_tab2_{{ $marca->id }}" class="peer/vtab2 hidden">
                                                            <input type="radio" name="tab_ver_marca_{{ $marca->id }}"id="marca_ver_tab3_{{ $marca->id }}" class="peer/vtab3 hidden">
                                                            {{-- BOTONES DE PESTAÑAS --}}
                                                            <div class="flex flex-wrap border-b border-slate-200 mb-6 gap-4 sm:gap-6">
                                                                <label for="marca_ver_tab1_{{ $marca->id }}" class="pb-3 text-sm font-semibold cursor-pointer transition-all peer-checked/vtab1:text-indigo-600 peer-checked/vtab1:border-b-2 peer-checked/vtab1:border-indigo-600 text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                                                                    <i class="fa-solid fa-tag mr-2"></i>
                                                                    Información Básica
                                                                </label>
                                                                <label for="marca_ver_tab2_{{ $marca->id }}" class="pb-3 text-sm font-semibold cursor-pointer transition-all peer-checked/vtab2:text-indigo-600 peer-checked/vtab2:border-b-2 peer-checked/vtab2:border-indigo-600 text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                                                                    <i class="fa-solid fa-image mr-2"></i>
                                                                    Logo de la Marca
                                                                </label>
                                                                <label for="marca_ver_tab3_{{ $marca->id }}" class="pb-3 text-sm font-semibold cursor-pointer transition-all peer-checked/vtab3:text-indigo-600 peer-checked/vtab3:border-b-2 peer-checked/vtab3:border-indigo-600 text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                                                                    <i class="fa-solid fa-sliders mr-2"></i>
                                                                    Estado
                                                                </label>
                                                            </div>
                                                            {{-- 1. INFORMACIÓN BÁSICA --}}
                                                            <div class="hidden peer-checked/vtab1:block space-y-4">
                                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                    <div class="md:col-span-2">
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1"> Nombre de la Marca</label>
                                                                        <input type="text" readonly value="{{ $marca->nombre ?? '-' }}" class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-0">
                                                                    </div>
                                                                    <div class="md:col-span-2">
                                                                        <label class="block text-sm font-medium text-slate-700 mb-1">Descripción</label>
                                                                        <textarea readonly rows="3" placeholder="Sin descripción"
                                                                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-0">{{ $marca->descripcion ?? '' }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- 2. LOGO DE LA MARCA --}}
                                                            <div class="hidden peer-checked/vtab2:block space-y-4">
                                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                    <div class="md:col-span-2">
                                                                        <label class="block text-sm font-medium text-slate-700 mb-2">
                                                                            Logo de la Marca
                                                                        </label>
                                                                        <div class="flex items-center justify-center w-36 h-36 border-2 border-dashed border-slate-300 rounded-lg bg-slate-50 overflow-hidden">
                                                                            @if($marca->logo)
                                                                                <img src="{{ asset('storage/' . $marca->logo) }}" class="w-full h-full object-contain p-2"alt="{{ $marca->nombre }}">
                                                                            @else
                                                                                <div class="flex flex-col items-center justify-center text-slate-400">
                                                                                    <i class="fa-solid fa-image text-3xl text-slate-300"></i>
                                                                                    <span class="text-xs text-slate-400 mt-2">Sin logo</span>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- 3. ESTADO --}}
                                                            <div class="hidden peer-checked/vtab3:block space-y-4">
                                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                    <div class="md:col-span-2">
                                                                        <label class="block text-sm font-medium text-slate-700 mb-2">
                                                                            Estado de la Marca
                                                                        </label>
                                                                        <div class="mt-2">
                                                                            <span class="inline-flex items-center gap-2 px-3 py-2 rounded-full text-sm font-semibold
                                                                                {{ $marca->estado ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                                                                <span class="w-2 h-2 rounded-full
                                                                                    {{ $marca->estado ? 'bg-emerald-500' : 'bg-rose-500' }}">
                                                                                </span>{{ $marca->estado ? 'Activo' : 'Inactivo' }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- BOTÓN CERRAR --}}
                                                            <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-100">
                                                                <button type="button" onclick="document.getElementById('modalVerMarca{{ $marca->id }}').classList.add('hidden')"
                                                                    class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50">
                                                                    Cerrar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- EDITAR --}}
                                                    <button type="button" onclick="document.getElementById('modalEditarMarca{{ $marca->id }}').classList.remove('hidden')"
                                                        class="w-full flex items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 text-left">
                                                        <i class="fa-solid fa-pen-to-square w-4 text-black"></i>
                                                        Editar
                                                    </button>
                                                    <!-- MODAL EDITAR MARCA -->
                                                    <div id="modalEditarMarca{{ $marca->id }}" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
                                                        <div class="absolute inset-0 bg-black/10" onclick="document.getElementById('modalEditarMarca{{ $marca->id }}').classList.add('hidden')"></div>
                                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-4xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
                                                            <div class="flex items-center justify-between mb-4">
                                                                <h2 class="text-xl font-semibold text-slate-800 flex items-center gap-2"><i class="fa-solid fa-tags text-slate-600"></i>Editar Marca</h2>
                                                                <button type="button" onclick="document.getElementById('modalEditarMarca{{ $marca->id }}').classList.add('hidden')"
                                                                    class="text-slate-400 hover:text-slate-600 text-lg">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </div>
                                                            <!-- FORMULARIO -->
                                                            <form action="{{ route('marcas.update', $marca->id) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="radio" name="tab_marca_{{ $marca->id }}" id="marca_tab1_{{ $marca->id }}"  class="peer/tab1 hidden" checked>
                                                                <input type="radio"  name="tab_marca_{{ $marca->id }}"  id="marca_tab2_{{ $marca->id }}" class="peer/tab2 hidden">
                                                                <input type="radio" name="tab_marca_{{ $marca->id }}" id="marca_tab3_{{ $marca->id }}" class="peer/tab3 hidden">
                                                                <!-- BOTONES DE PESTAÑAS -->
                                                                <div class="flex flex-wrap border-b border-slate-200 mb-6 gap-4 sm:gap-6">
                                                                    <label for="marca_tab1_{{ $marca->id }}" class="pb-3 text-sm font-semibold cursor-pointer transition-all
                                                                        peer-checked/tab1:text-indigo-600 peer-checked/tab1:border-b-2 peer-checked/tab1:border-indigo-600 text-slate-500
                                                                        hover:text-slate-800 border-b-2 border-transparent"> <i class="fa-solid fa-tag mr-2"></i>
                                                                        Información Básica
                                                                    </label>
                                                                    <label for="marca_tab2_{{ $marca->id }}" class="pb-3 text-sm font-semibold cursor-pointer transition-all
                                                                        peer-checked/tab2:text-indigo-600 peer-checked/tab2:border-b-2 peer-checked/tab2:border-indigo-600 text-slate-500
                                                                        hover:text-slate-800 border-b-2 border-transparent"> <i class="fa-solid fa-image mr-2"></i>
                                                                        Logo de la Marca
                                                                    </label>
                                                                    <label for="marca_tab3_{{ $marca->id }}"
                                                                        class="pb-3 text-sm font-semibold cursor-pointer transition-all peer-checked/tab3:text-indigo-600 peer-checked/tab3:border-b-2
                                                                        peer-checked/tab3:border-indigo-600 text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                                                                        <i class="fa-solid fa-sliders mr-2"></i>
                                                                        Estado
                                                                    </label>
                                                                </div>
                                                                <!-- 1. INFORMACIÓN BÁSICA -->
                                                                <div class="hidden peer-checked/tab1:block space-y-4">
                                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                        <div class="md:col-span-2">
                                                                            <label for="nombre_marca_edit_{{ $marca->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                                Nombre de la Marca
                                                                                <span class="text-red-500">*</span>
                                                                            </label>
                                                                            <input type="text" id="nombre_marca_edit_{{ $marca->id }}" name="nombre" value="{{ old('nombre', $marca->nombre) }}" maxlength="100" required
                                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                        </div>
                                                                        <div class="md:col-span-2">
                                                                            <label for="descripcion_marca_edit_{{ $marca->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                                Descripción
                                                                            </label>
                                                                            <textarea id="descripcion_marca_edit_{{ $marca->id }}"  name="descripcion" rows="3" placeholder="Información adicional sobre la marca..."
                                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">{{ old('descripcion', $marca->descripcion) }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- 2. LOGO DE LA MARCA -->
                                                                <div class="hidden peer-checked/tab2:block space-y-4">
                                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                        <div class="md:col-span-2">
                                                                            <label class="block text-sm font-medium text-slate-700 mb-1">Logo de la Marca</label>
                                                                            <label for="logo_marca_edit_{{ $marca->id }}"
                                                                                class="flex flex-col items-center justify-center w-36 h-36 border-2 border-dashed border-slate-300 rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100 transition-all overflow-hidden relative">
                                                                                <div id="preview-container-logo-marca-edit-{{ $marca->id }}"
                                                                                    class="flex flex-col items-center justify-center w-full h-full text-slate-400">
                                                                                    @if($marca->logo)
                                                                                        <img src="{{ asset('storage/' . $marca->logo) }}"
                                                                                            class="w-full h-full object-contain p-2" alt="{{ $marca->nombre }}">
                                                                                    @else
                                                                                        <i class="fa-solid fa-image text-3xl text-slate-300"></i>
                                                                                        <span class="text-xs text-slate-400 mt-2">
                                                                                            Subir logo
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                                <button type="button" id="quitar-logo-marca-edit-{{ $marca->id }}" onclick="quitarLogoMarcaEdicion(event, {{ $marca->id }})"
                                                                                    class="{{ $marca->logo ? 'flex' : 'hidden' }} absolute top-1 right-1 w-6 h-6 bg-red-500 text-white rounded-full items-center justify-center text-sm font-bold hover:bg-red-600 z-10">
                                                                                    x
                                                                                </button>
                                                                                <input type="file" id="logo_marca_edit_{{ $marca->id }}" name="logo" accept="image/jpeg,image/png,image/webp" class="hidden" onchange="mostrarLogoMarcaEdicion(this, {{ $marca->id }})">
                                                                            </label>
                                                                            <p class="text-xs text-slate-500 mt-1">
                                                                                Selecciona un logo PNG, JPG o WEBP. Máximo 2 MB.
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- 3. ESTADO -->
                                                                <div class="hidden peer-checked/tab3:block space-y-4">
                                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                        <div class="md:col-span-2">
                                                                            <label class="block text-sm font-medium text-slate-700 mb-2">Estado de la Marca</label>
                                                                            <label class="inline-flex items-center cursor-pointer gap-3">
                                                                                <input type="hidden" name="estado" value="0">
                                                                                <input type="checkbox" name="estado" value="1" class="sr-only peer"
                                                                                    {{ old('estado', $marca->estado) ? 'checked' : '' }}>
                                                                                <span class="text-sm font-medium text-slate-600">Inactivo</span>
                                                                                <div class="relative w-11 h-6 bg-slate-300 rounded-full peer peer-checked:after:translate-x-full
                                                                                    after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300
                                                                                    after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"
                                                                                    style="background-color: var(--active-pink);">
                                                                                </div>
                                                                                <span class="text-sm font-medium text-slate-800">Activo</span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- BOTONES -->
                                                                <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-100">
                                                                    <button type="button" onclick="document.getElementById('modalEditarMarca{{ $marca->id }}').classList.add('hidden')"
                                                                        class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50">
                                                                        Cancelar
                                                                    </button>
                                                                    <button type="submit" class="px-5 py-2 rounded-md text-white text-sm font-medium" style="background-color: var(--active-pink);">
                                                                        <i class="fa-solid fa-floppy-disk mr-1"></i>
                                                                        Actualizar Marca
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    {{--ELIMINAR--}}
                                                    <button type="button" onclick="confirmarEliminar('{{ route('marcas.destroy', $marca->id) }}')"
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
                                <td colspan="7" class="py-4 text-center text-slate-500">
                                    No hay marcas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <!-- MODAL: NUEVA MARCA -->
    <div id="modalNuevoMarca" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
        <div class="absolute inset-0 bg-black/10"
            onclick="document.getElementById('modalNuevoMarca').classList.add('hidden')">
        </div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-4xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-slate-800"> Nueva Marca</h2>
                <button type="button" onclick="document.getElementById('modalNuevoMarca').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600 text-lg">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('marcas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- RADIOS PARA LAS PESTAÑAS -->
                <input type="radio" name="tab_group_marca" id="marca_tab1"  class="peer/tab1 hidden" checked>
                <input type="radio" name="tab_group_marca" id="marca_tab2" class="peer/tab2 hidden">
                <input type="radio" name="tab_group_marca" id="marca_tab3" class="peer/tab3 hidden">
                <!-- PESTAÑAS -->
                <div class="flex flex-wrap border-b border-slate-200 mb-6 gap-6">
                    <label for="marca_tab1" class="pb-3 text-sm font-semibold cursor-pointer transition-all peer-checked/tab1:text-indigo-600 peer-checked/tab1:border-b-2
                        peer-checked/tab1:border-indigo-600 text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-tag mr-2"></i>Información Básica
                    </label>
                    <label for="marca_tab2"
                        class="pb-3 text-sm font-semibold cursor-pointer transition-all peer-checked/tab2:text-indigo-600 peer-checked/tab2:border-b-2
                        peer-checked/tab2:border-indigo-600 text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-image mr-2"></i>Logo de la Marca
                    </label>
                    <label for="marca_tab3"
                        class="pb-3 text-sm font-semibold cursor-pointer transition-all peer-checked/tab3:text-indigo-600 peer-checked/tab3:border-b-2
                        peer-checked/tab3:border-indigo-600 text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-sliders mr-2"></i> Estado
                    </label>
                </div>
                <!-- 1. INFORMACIÓN BÁSICA -->
                <div class="hidden peer-checked/tab1:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="nombre_marca" class="block text-sm font-medium text-slate-700 mb-1">Nombre de la Marca <span class="text-red-500">*</span></label>
                            <input type="text" id="nombre_marca" name="nombre"  maxlength="100" required placeholder="Ej. Samsung, Nike, Adidas..."
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div class="md:col-span-2">
                            <label for="descripcion_marca" class="block text-sm font-medium text-slate-700 mb-1">
                                Descripción
                            </label>
                            <textarea id="descripcion_marca" name="descripcion" rows="3" placeholder="Información adicional sobre la marca..."
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
                        </div>
                    </div>
                </div>

                <!-- 2. LOGO DE LA MARCA -->
                <div class="hidden peer-checked/tab2:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-1">Logo de la Marca</label>
                            <label for="logo_marca" class="flex flex-col items-center justify-center w-36 h-36 border-2 border-dashed border-slate-300 rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100 transition-all overflow-hidden relative">
                                <div id="preview-container-logo-marca"
                                    class="flex flex-col items-center justify-center w-full h-full text-slate-400">
                                    <i class="fa-solid fa-image text-3xl text-slate-300"></i>
                                    <span class="text-xs text-slate-400 mt-2">Subir logo</span>
                                </div>
                                <button type="button" id="quitar-logo-marca" onclick="quitarLogoMarca(event)"
                                    class="hidden absolute top-1 right-1 w-6 h-6 bg-red-500 text-white rounded-full items-center justify-center text-sm font-bold hover:bg-red-600 z-10">x
                                </button>
                                <input type="file" id="logo_marca" name="logo" accept="image/jpeg,image/png,image/webp" class="hidden" onchange="mostrarLogoMarca(this)">
                            </label>
                            <p class="text-xs text-slate-500 mt-1">
                                Formatos permitidos: PNG, JPG o WEBP. Máximo 2 MB.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- 3. ESTADO -->
                <div class="hidden peer-checked/tab3:block space-y-4">
                    <div class="flex items-center pt-2">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Estado de la Marca</label>
                            <label class="inline-flex items-center cursor-pointer gap-3">
                                <input type="hidden" name="estado" value="0">
                                <input type="checkbox" name="estado" value="1" class="sr-only peer" checked>
                                <span class="text-sm font-medium text-slate-600"> Inactivo</span>
                                <div class="relative w-11 h-6 bg-slate-300 rounded-full
                                    peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px]
                                    after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5
                                    after:transition-all peer-checked:bg-indigo-600" style="background-color: var(--active-pink);">
                                </div>
                                <span class="text-sm font-medium text-slate-800">Activo</span>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- BOTONES -->
                <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-100">
                    <button type="button" onclick="document.getElementById('modalNuevoMarca').classList.add('hidden')"
                        class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-md text-white text-sm font-medium bg-indigo-600 hover:bg-indigo-700"
                        style="background-color: var(--active-pink);">
                        Guardar Marca
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection


