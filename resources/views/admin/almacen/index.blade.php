@extends('layouts.admin.app')
@section('title', 'Almacenes')
@section('js')
@endsection
@section('content')

    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-solid fa-warehouse text-slate-600"></i>
        Listado de almacenes
    </h1>
        
    <div class="bg-white rounded-3xl shadow-md p-6">
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mb-4">
            <button type="button" onclick="document.getElementById('panelFiltros').classList.toggle('hidden')" 
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50" >
                <i class="fa-solid fa-filter"></i> Mostrar filtros 
            </button>
            <button type="button" onclick="document.getElementById('modalNuevoAlmacen').classList.remove('hidden')"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 sm:py-2 rounded-md text-white text-sm font-semibold shrink-0 hover:opacity-90 transition-opacity"
                style="background-color: var(--active-pink);"><i class="fa-solid fa-circle-plus"></i>Nuevo
            </button>

        </div>

        <div class="overflow-x-auto mt-4">
            <div id="panelFiltros" class="{{ request()->filled('buscar') ? '' : 'hidden' }} mt-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <form action="{{ url('/admin/almacen') }}" method="GET">
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
                                <a href="{{ url('/admin/almacen') }}"class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-white">
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
                     
                </table>
            </div>
        </div>

    </div>

    <div id="modalNuevoAlmacen" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
        <div class="absolute inset-0 bg-black/10"
            onclick="document.getElementById('modalNuevoAlmacen').classList.add('hidden')">
        </div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-4xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-slate-800"><i class="fa-solid fa-warehouse text-slate-600 mr-2"></i>Nuevo Almacén</h2>
                <button type="button" onclick="document.getElementById('modalNuevoAlmacen').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600 text-lg"><i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('almacen.store') }}" method="POST">
                @csrf
                <input type="radio" name="tab_group_almacen" id="almacen_tab1"class="peer/tab1 hidden" checked>
                <input type="radio" name="tab_group_almacen" id="almacen_tab2"class="peer/tab2 hidden">
                <input type="radio" name="tab_group_almacen" id="almacen_tab3"class="peer/tab3 hidden">
                <div class="flex flex-wrap border-b border-slate-200 mb-6 gap-6">
                    <label for="almacen_tab1"
                        class="pb-3 text-sm font-semibold cursor-pointer transition-all peer-checked/tab1:text-indigo-600 peer-checked/tab1:border-b-2 
                        peer-checked/tab1:border-indigo-600 text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-warehouse mr-2"></i>
                        Información Básica
                    </label>
                    <label for="almacen_tab2"
                        class="pb-3 text-sm font-semibold cursor-pointer transition-allpeer-checked/tab2:text-indigo-600 peer-checked/tab2:border-b-2
                        peer-checked/tab2:border-indigo-600 text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-link mr-2"></i>
                        Relaciones
                    </label>
                    <label for="almacen_tab3"
                        class="pb-3 text-sm font-semibold cursor-pointer transition-allpeer-checked/tab3:text-indigo-600 peer-checked/tab3:border-b-2
                        peer-checked/tab3:border-indigo-600 text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-sliders mr-2"></i>
                        Configuración y Estado
                    </label>
                </div>
                <!-- 1. INFORMACIÓN BÁSICA -->
                <div class="hidden peer-checked/tab1:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="codigo" class="block text-sm font-medium text-slate-700 mb-1">
                                Código <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="codigo" name="codigo"  maxlength="20" required placeholder="Ej. ALM-001"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div>
                            <label for="nombre" class="block text-sm font-medium text-slate-700 mb-1">
                                Nombre del almacén <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nombre" name="nombre" maxlength="100" required placeholder="Ej. Almacén principal"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                        <div class="md:col-span-2">
                            <label for="descripcion" class="block text-sm font-medium text-slate-700 mb-1">
                                Descripción
                            </label>
                            <textarea id="descripcion" name="descripcion" rows="3" placeholder="Descripción del almacén..."
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
                        </div>
                    </div>
                </div>
                <!-- 2. RELACIONES -->
                <div class="hidden peer-checked/tab2:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="sucursal_id" class="block text-sm font-medium text-slate-700 mb-1">
                                Sucursal <span class="text-red-500">*</span>
                            </label>
                            <select id="sucursal_id" name="sucursal_id" required class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccione una sucursal</option>
                                @foreach ($sucursales as $sucursal)
                                    <option value="{{ $sucursal->id }}">
                                        {{ $sucursal->descripcion}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- SERIE -->
                        <div>
                            <label for="serie_id" class="block text-sm font-medium text-slate-700 mb-1">
                                Serie <span class="text-red-500">*</span>
                            </label>
                            <select id="serie_id" name="serie_id" required class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccione una serie</option>
                                @foreach ($series as $serie)
                                    <option value="{{ $serie->id }}">
                                        {{ $serie->serie }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- RESPONSABLE -->
                        <div class="md:col-span-2">
                            <label for="responsable_id" class="block text-sm font-medium text-slate-700 mb-1">Responsable <span class="text-red-500">*</span></label>
                            <select id="responsable_id" name="responsable_id" required
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccione un responsable</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">
                                        {{ $usuario->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- 3. CONFIGURACIÓN Y ESTADO -->
                <div class="hidden peer-checked/tab3:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2 flex items-center pt-2">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Estado</label>
                                <label class="inline-flex items-center cursor-pointer gap-3">
                                    <input type="hidden" name="estado" value="0">
                                    <input type="checkbox" name="estado" value="1"class="sr-only peer" checked>
                                    <span class="text-sm font-medium text-slate-600">Inactivo</span>
                                    <div class="relative w-11 h-6 bg-slate-300 rounded-full after:content-[''] after:absolute after:top-[2px]
                                        after:left-[2px] after:bg-white after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full
                                        peer-checked:bg-indigo-600" style="background-color: var(--active-pink);">
                                    </div>
                                    <span class="text-sm font-medium text-slate-800">Activo</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BOTONES -->
                <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-100">
                    <button type="button" onclick="document.getElementById('modalNuevoAlmacen').classList.add('hidden')"
                        class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-md text-white text-sm font-medium bg-indigo-600 hover:bg-indigo-700"
                        style="background-color: var(--active-pink);">
                        <i class="fa-solid fa-floppy-disk mr-1"></i>
                        Guardar Almacén
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection


