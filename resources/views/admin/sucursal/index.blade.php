@extends('layouts.admin.app')
@section('title', 'Sucursal')
@section('js')
@endsection
@section('content')

    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-solid fa-building text-slate-600"></i>
        Listado de sucursales
    </h1>
        
    <div class="bg-white rounded-3xl shadow-md p-6">
         <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mb-4">
            <button type="button" onclick="document.getElementById('panelFiltros').classList.toggle('hidden')" 
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50" >
                <i class="fa-solid fa-filter"></i> Mostrar filtros 
            </button>

            <button type="button" onclick="document.getElementById('modalNuevoSucursal').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-[#0407e2] hover:bg-[#0305b8] text-white text-sm font-semibold"
                 style="background-color: var(--active-pink);" >
                <i class="fa-solid fa-circle-plus"></i>
                Nuevo
            </button>
        </div>
        
        <div class="overflow-x-auto mt-4">

            <div id="panelFiltros" class="{{ request()->filled('buscar') ? '' : 'hidden' }} mt-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <form action="{{ url('/admin/sucursal') }}" method="GET">
                        <div class="flex flex-col sm:flex-row gap-3 items-center">
                            <div class="relative w-full sm:flex-1 sm:max-w-xl">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="buscador" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar vendedor..."
                                class="w-full pl-9 pr-4 py-2.5 sm:py-2 rounded-md border border-slate-200 bg-white text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            </div>
                            {{-- BOTONES --}}
                            <div class="flex gap-2 w-full sm:w-auto">
                                <button type="submit" class="px-4 py-2 rounded-md text-white text-sm font-semibold" style="background-color: var(--active-pink);">
                                    Buscar
                                </button>
                                <a href="{{ url('/admin/sucursal') }}"class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-white">
                                    Limpiar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="w-full overflow-x-auto">
                <table class="w-full min-w-[1000px] table-auto border-collapse text-left text-xs sm:text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-100 text-left text-sm text-slate-700">
                            <th class="w-16 whitespace-nowrap px-4 py-4 font-bold">#</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Código</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Descripción</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Departamento</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Provincia</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Distrito</th>
                            <th class="whitespace-nowrap px-4 py-4 text-center font-bold">Estado</th>
                            <th class="whitespace-nowrap px-4 py-4 text-right font-bold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sucursals as $index => $sucursal)
                            <tr class="border-b border-slate-100">
                                <td class="px-3 py-3 align-middle text-slate-600">{{ $index + 1 }}</td>
                                <td class="px-3 py-3 align-middle text-slate-600">{{ $sucursal->codigo_sucursal }}</td>
                                <td class="px-3 py-3 align-middle text-slate-600">
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/20">
                                        <svg class="w-3 h-3 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21" />
                                        </svg>
                                        {{ $sucursal->descripcion }}
                                    </div>
                                </td>
                                <td class="px-3 py-3 align-middle text-slate-600">{{ $sucursal->departamento }}</td>
                                <td class="px-3 py-3 align-middle text-slate-600">{{ $sucursal->provincia }}</td>
                                <td class="px-3 py-3 align-middle text-slate-600">{{ $sucursal->distrito }}</td>
                                <td class="px-3 py-3 align-middle text-center">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                        {{ $sucursal->estado === 'ACTIVO' ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20': 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20' }}">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75
                                                {{ $sucursal->estado === 'ACTIVO' ? 'bg-emerald-400' : 'bg-rose-400' }}"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2
                                                {{ $sucursal->estado === 'ACTIVO' ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                        </span>
                                        {{ $sucursal->estado }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 align-middle relative">
                                    <div class="flex justify-end">
                                        <div class="relative">
                                            <input type="checkbox" id="menuSucursal{{ $sucursal->id }}" class="peer hidden">

                                            <label for="menuSucursal{{ $sucursal->id }}"
                                                class="flex items-center justify-center w-9 h-9 rounded-lg cursor-pointer text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-colors border border-slate-300">
                                                <i class="fa-solid fa-ellipsis-vertical text-lg"></i>
                                            </label>

                                            <div class="hidden peer-checked:block absolute right-0 bottom-full mb-2 w-48 h-24 overflow-y-scroll overscroll-contain bg-white rounded-md shadow-xl border border-slate-200 z-[99999]">
                                                <div class="py-1">
                                                    {{-- VER --}}
                                                    <button type="button" onclick="document.getElementById('modalVerSucursal{{ $sucursal->id }}').classList.remove('hidden')"
                                                        class="w-full flex items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 text-left">
                                                        <i class="fa-solid fa-eye w-4 text-black"></i>
                                                        Ver
                                                    </button>
                                                    {{-- MODAL VER SUCURSAL --}}
                                                    <div id="modalVerSucursal{{ $sucursal->id }}"class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
                                                        <div class="absolute inset-0 bg-black/10"onclick="document.getElementById('modalVerSucursal{{ $sucursal->id }}').classList.add('hidden')"></div>
                                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
                                                            <div class="flex items-center justify-between mb-6">
                                                                <h2 class="text-lg font-semibold text-slate-800">
                                                                    <i class="fa-solid fa-building text-slate-600 mr-2"></i>
                                                                    Ver Sucursal
                                                                </h2>
                                                                <button type="button" onclick="document.getElementById('modalVerSucursal{{ $sucursal->id }}').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </div>
                                                            <input type="radio" name="tabs_ver_sucursal_{{ $sucursal->id }}" id="ver_sucursal_tab1_{{ $sucursal->id }}" class="peer/tab1 hidden" checked>
                                                            <input type="radio" name="tabs_ver_sucursal_{{ $sucursal->id }}" id="ver_sucursal_tab2_{{ $sucursal->id }}" class="peer/tab2 hidden">
                                                            <input type="radio" name="tabs_ver_sucursal_{{ $sucursal->id }}" id="ver_sucursal_tab3_{{ $sucursal->id }}"class="peer/tab3 hidden">
                                                            {{-- MENÚ SUPERIOR --}}
                                                            <div class="flex flex-wrap gap-6 border-b border-slate-200 mb-6">
                                                                <label for="ver_sucursal_tab1_{{ $sucursal->id }}"
                                                                    class="cursor-pointer pb-3 text-sm font-semibold text-slate-500 border-b-2 border-transparent peer-checked/tab1:text-indigo-600 peer-checked/tab1:border-indigo-600"><i class="fa-solid fa-building mr-2"></i>
                                                                    Información general
                                                                </label>
                                                                <label for="ver_sucursal_tab2_{{ $sucursal->id }}"class="cursor-pointer pb-3 text-sm font-semibold text-slate-500 border-b-2 border-transparent peer-checked/tab2:text-indigo-600 peer-checked/tab2:border-indigo-600">
                                                                    <i class="fa-solid fa-location-dot mr-2"></i>
                                                                    Ubicación y direcciones
                                                                </label>
                                                                <label for="ver_sucursal_tab3_{{ $sucursal->id }}" class="cursor-pointer pb-3 text-sm font-semibold text-slate-500 border-b-2 border-transparent peer-checked/tab3:text-indigo-600 peer-checked/tab3:border-indigo-600">
                                                                    <i class="fa-solid fa-address-card mr-2"></i>
                                                                    Contacto y configuración
                                                                </label>
                                                            </div>
                                                            @php
                                                                $claseLectura = 'w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 cursor-default focus:outline-none focus:ring-0';
                                                            @endphp
                                                            <div class="hidden peer-checked/tab1:block space-y-4">
                                                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                                                    <div class="md:col-span-3"><label class="block text-sm font-medium text-black mb-1">Código de sucursal</label>
                                                                        <input type="text"value="{{ $sucursal->codigo_sucursal }}"class="{{ $claseLectura }}" readonly>
                                                                    </div>
                                                                    <div class="md:col-span-5">
                                                                        <label class="block text-sm font-medium text-black mb-1"> Descripción</label>
                                                                        <input type="text" value="{{ $sucursal->descripcion }}"class="{{ $claseLectura }}" readonly>
                                                                    </div>
                                                                    <div class="md:col-span-4">
                                                                        <label class="block text-sm font-medium text-black mb-1">País</label>
                                                                        <input type="text" value="{{ $sucursal->pais }}"class="{{ $claseLectura }}" readonly>
                                                                    </div>
                                                                    <div class="md:col-span-12">
                                                                        <label class="block text-sm font-medium text-black mb-1">Cliente</label>
                                                                        <input type="text" value="{{ $sucursal->cliente ? $sucursal->cliente->codigo_interno . ' - ' . $sucursal->cliente->nombre . ' ' . $sucursal->cliente->apellidos : 'Sin cliente asignado' }}" class="{{ $claseLectura }}" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- PESTAÑA 2: UBICACIÓN Y DIRECCIONES --}}
                                                            <div class="hidden peer-checked/tab2:block space-y-4">
                                                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                                                    <div class="md:col-span-4">
                                                                        <label class="block text-sm font-medium text-black mb-1"> Departamento</label>
                                                                        <input type="text" value="{{ $sucursal->departamento }}" class="{{ $claseLectura }}" readonly>
                                                                    </div>
                                                                    <div class="md:col-span-4">
                                                                        <label class="block text-sm font-medium text-black mb-1">Provincia</label>
                                                                        <input type="text" value="{{ $sucursal->provincia }}"class="{{ $claseLectura }}" readonly>
                                                                    </div>
                                                                    <div class="md:col-span-4">
                                                                        <label class="block text-sm font-medium text-black mb-1">Distrito</label>
                                                                        <input type="text"value="{{ $sucursal->distrito }}"class="{{ $claseLectura }}" readonly>
                                                                    </div>
                                                                    <div class="md:col-span-6">
                                                                        <label class="block text-sm font-medium text-black mb-1">Dirección Fiscal</label>
                                                                        <input type="text"value="{{ $sucursal->direccion_fiscal }}"class="{{ $claseLectura }}" readonly>
                                                                    </div>
                                                                    <div class="md:col-span-6">
                                                                        <label class="block text-sm font-medium text-black mb-1">
                                                                            Dirección Comercial</label>
                                                                        <input type="text" value="{{ $sucursal->direccion_comercial }}" class="{{ $claseLectura }}" readonly>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- PESTAÑA 3: CONTACTO Y CONFIGURACIÓN --}}
                                                            <div class="hidden peer-checked/tab3:block space-y-4">
                                                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                                                    <div class="md:col-span-4">
                                                                        <label class="block text-sm font-medium text-black mb-1">Teléfono</label>
                                                                        <input type="text" value="{{ $sucursal->telefono }}"class="{{ $claseLectura }}" readonly>
                                                                    </div>
                                                                    <div class="md:col-span-4">
                                                                        <label class="block text-sm font-medium text-black mb-1">Correo de Contacto</label>
                                                                        <input type="text" value="{{ $sucursal->correo_contacto }}"class="{{ $claseLectura }}" readonly>
                                                                    </div>
                                                                    <div class="md:col-span-4">
                                                                        <label class="block text-sm font-medium text-black mb-1">Dirección Web</label>
                                                                        <input type="text"value="{{ $sucursal->direccion_web }}"class="{{ $claseLectura }}" readonly>
                                                                    </div>
                                                                    <div class="md:col-span-6">
                                                                        <label class="block text-sm font-medium text-black mb-1">Información Adicional</label>
                                                                        <textarea rows="2" class="{{ $claseLectura }} resize-none" readonly>{{ $sucursal->informacion_adicional }}</textarea>
                                                                    </div>
                                                                    <div class="md:col-span-6">
                                                                        <label class="block text-sm font-medium text-black mb-2"> Estado</label>
                                                                        <div class="flex items-center gap-3">
                                                                            <span class="text-sm font-medium text-slate-500">No</span>
                                                                            <div class="relative w-11 h-6 rounded-full
                                                                                {{ $sucursal->estado === 'ACTIVO' ? 'bg-[#269ad5]' : 'bg-slate-300' }}">
                                                                                <div class="absolute top-[2px] left-[2px] bg-white border border-slate-300 rounded-full h-5 w-5 transition-all
                                                                                    {{ $sucursal->estado === 'ACTIVO' ? 'translate-x-5' : '' }}">
                                                                                </div>
                                                                            </div>
                                                                            <span class="text-sm font-medium text-black"> Sí </span>
                                                                            <span class="ml-2 px-2 py-1 rounded-full text-xs font-semibold
                                                                                {{ $sucursal->estado === 'ACTIVO' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                                                {{ $sucursal->estado }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- BOTÓN CERRAR --}}
                                                            <div class="flex justify-end mt-8 pt-4 border-t border-slate-100">
                                                                <button type="button" onclick="document.getElementById('modalVerSucursal{{ $sucursal->id }}').classList.add('hidden')"
                                                                    class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                                                                    <i class="fa-solid fa-xmark mr-1"></i>
                                                                    Cerrar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- EDITAR --}}
                                                    <button type="button" onclick="document.getElementById('modalEditarSucursal{{ $sucursal->id }}').classList.remove('hidden')"
                                                        class="w-full flex items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 text-left">
                                                        <i class="fa-solid fa-pen-to-square w-4 text-black"></i>
                                                        Editar
                                                    </button>
                                                    {{-- MODAL EDITAR --}}
                                                    <div id="modalEditarSucursal{{ $sucursal->id }}"class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
                                                        <div class="absolute inset-0 bg-black/10"onclick="document.getElementById('modalEditarSucursal{{ $sucursal->id }}').classList.add('hidden')"></div>
                                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
                                                            <div class="flex items-center justify-between mb-6">
                                                                <h2 class="text-lg font-semibold text-slate-800">
                                                                    <i class="fa-solid fa-building text-slate-600"></i>Editar Sucursal</h2>
                                                                <button type="button" onclick="document.getElementById('modalEditarSucursal{{ $sucursal->id }}').classList.add('hidden')"
                                                                    class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('sucursal.update', $sucursal->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <!-- RADIOS DE LAS PESTAÑAS -->
                                                                <input type="radio" name="tabs_sucursal_{{ $sucursal->id }}" id="sucursal_tab1_{{ $sucursal->id }}"class="peer/tab1 hidden" checked>
                                                                <input type="radio" name="tabs_sucursal_{{ $sucursal->id }}"id="sucursal_tab2_{{ $sucursal->id }}"class="peer/tab2 hidden">
                                                                <input type="radio" name="tabs_sucursal_{{ $sucursal->id }}" id="sucursal_tab3_{{ $sucursal->id }}"class="peer/tab3 hidden">
                                                                <!-- MENÚ SUPERIOR -->
                                                                <div class="flex flex-wrap gap-6 border-b border-slate-200 mb-6">
                                                                    <label for="sucursal_tab1_{{ $sucursal->id }}" class="cursor-pointer pb-3 text-sm font-semibold text-slate-500 border-b-2 border-transparent
                                                                        peer-checked/tab1:text-indigo-600 peer-checked/tab1:border-indigo-600"><i class="fa-solid fa-building mr-2"></i>
                                                                        Información general
                                                                    </label>
                                                                    <label for="sucursal_tab2_{{ $sucursal->id }}" class="cursor-pointer pb-3 text-sm font-semibold text-slate-500 border-b-2 border-transparent
                                                                        peer-checked/tab2:text-indigo-600 peer-checked/tab2:border-indigo-600"><i class="fa-solid fa-location-dot mr-2"></i>
                                                                        Ubicación y direcciones
                                                                    </label>
                                                                    <label for="sucursal_tab3_{{ $sucursal->id }}" class="cursor-pointer pb-3 text-sm font-semibold text-slate-500 border-b-2 border-transparent
                                                                        peer-checked/tab3:text-indigo-600 peer-checked/tab3:border-indigo-600"><i class="fa-solid fa-address-card mr-2"></i>
                                                                        Contacto y configuración
                                                                    </label>
                                                                </div>
                                                                <!-- PESTAÑA 1: INFORMACIÓN GENERAL -->
                                                                <div class="hidden peer-checked/tab1:block space-y-4">
                                                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                                                        <div class="md:col-span-3">
                                                                            <label for="codigo_sucursal{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1"> Código de sucursal</label>
                                                                            <input type="text" id="codigo_sucursal{{ $sucursal->id }}" name="codigo_sucursal"  value="{{ $sucursal->codigo_sucursal }}" maxlength="20" required
                                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                        </div>
                                                                        <!-- Descripción -->
                                                                        <div class="md:col-span-5">
                                                                            <label for="descripcion{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1"> Descripción</label>
                                                                            <input type="text" id="descripcion{{ $sucursal->id }}" name="descripcion" value="{{ $sucursal->descripcion }}" maxlength="150" required
                                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                        </div>
                                                                        <!-- País -->
                                                                        <div class="md:col-span-4">
                                                                            <label for="pais{{ $sucursal->id }}"  class="block text-sm font-medium text-black mb-1">País</label>
                                                                            <input type="text" id="pais{{ $sucursal->id }}" name="pais" value="{{ $sucursal->pais }}" maxlength="100" required class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                        </div>
                                                                        <!-- Cliente -->
                                                                        <div class="md:col-span-12">
                                                                            <label for="cliente_id{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1">Cliente</label>
                                                                            <select id="cliente_id{{ $sucursal->id }}" name="cliente_id"
                                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                                <option value="">Seleccione un cliente</option>
                                                                                @foreach ($clientes as $cliente)
                                                                                    <option value="{{ $cliente->id }}"
                                                                                        {{ $sucursal->cliente_id == $cliente->id ? 'selected' : '' }}>
                                                                                        {{ $cliente->codigo_interno }} -
                                                                                        {{ $cliente->nombre }} {{ $cliente->apellidos }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- PESTAÑA 2: UBICACIÓN Y DIRECCIONES -->
                                                                <div class="hidden peer-checked/tab2:block space-y-4">
                                                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                                                        <div class="md:col-span-4">
                                                                            <label for="departamento{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1">Departamento</label>
                                                                            <select id="departamento{{ $sucursal->id }}" name="departamento"
                                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                                <option value="{{ $sucursal->departamento }}">
                                                                                    {{ $sucursal->departamento }}
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <!-- Provincia -->
                                                                        <div class="md:col-span-4">
                                                                            <label for="provincia{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1">Provincia</label>
                                                                            <select id="provincia{{ $sucursal->id }}"name="provincia"
                                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                                <option value="{{ $sucursal->provincia }}">
                                                                                    {{ $sucursal->provincia }}
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <!-- Distrito -->
                                                                        <div class="md:col-span-4">
                                                                            <label for="distrito{{ $sucursal->id }}"class="block text-sm font-medium text-black mb-1">Distrito</label>
                                                                            <select id="distrito{{ $sucursal->id }}" name="distrito" class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                                <option value="{{ $sucursal->distrito }}">
                                                                                    {{ $sucursal->distrito }}
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <!-- Dirección Fiscal -->
                                                                        <div class="md:col-span-6">
                                                                            <label for="direccion_fiscal{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1">Dirección Fiscal</label>
                                                                            <input type="text" id="direccion_fiscal{{ $sucursal->id }}" name="direccion_fiscal" value="{{ $sucursal->direccion_fiscal }}" maxlength="255" required
                                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                        </div>
                                                                        <!-- Dirección Comercial -->
                                                                        <div class="md:col-span-6">
                                                                            <label for="direccion_comercial{{ $sucursal->id }}"  class="block text-sm font-medium text-black mb-1">Dirección Comercial</label>
                                                                            <input type="text" id="direccion_comercial{{ $sucursal->id }}" name="direccion_comercial" value="{{ $sucursal->direccion_comercial }}" maxlength="255"
                                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- PESTAÑA 3: CONTACTO Y CONFIGURACIÓN -->
                                                                <div class="hidden peer-checked/tab3:block space-y-4">
                                                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                                                        <div class="md:col-span-4">
                                                                            <label for="telefono{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1">Teléfono</label>
                                                                            <input type="text" id="telefono{{ $sucursal->id }}" name="telefono" value="{{ $sucursal->telefono }}" maxlength="30"
                                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                        </div>
                                                                        <!-- Correo -->
                                                                        <div class="md:col-span-4">
                                                                            <label for="correo_contacto{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1"> Correo de Contacto</label>
                                                                            <input type="email" id="correo_contacto{{ $sucursal->id }}" name="correo_contacto" value="{{ $sucursal->correo_contacto }}"maxlength="150"
                                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                        </div>
                                                                        <!-- Dirección Web -->
                                                                        <div class="md:col-span-4">
                                                                            <label for="direccion_web{{ $sucursal->id }}"class="block text-sm font-medium text-black mb-1">Dirección Web</label>
                                                                            <input type="text" id="direccion_web{{ $sucursal->id }}" name="direccion_web" value="{{ $sucursal->direccion_web }}" maxlength="255"
                                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                        </div>
                                                                        <!-- Información Adicional -->
                                                                        <div class="md:col-span-6">
                                                                            <label for="informacion_adicional{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1"> Información Adicional</label>
                                                                            <textarea id="informacion_adicional{{ $sucursal->id }}" name="informacion_adicional" rows="2"
                                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">{{ $sucursal->informacion_adicional }}</textarea>
                                                                        </div>
                                                                        <!-- Estado -->
                                                                        <div class="md:col-span-6">
                                                                            <label class="block text-sm font-medium text-black mb-2">Estado</label>
                                                                            <label class="inline-flex items-center cursor-pointer gap-3">
                                                                                <input type="hidden" name="estado" value="INACTIVO">
                                                                                <input type="checkbox"  name="estado" value="ACTIVO" class="sr-only peer"{{ $sucursal->estado === 'ACTIVO' ? 'checked' : '' }}>
                                                                                <span class="text-sm font-medium text-slate-700"> No</span>
                                                                                <div class="relative w-11 h-6 bg-slate-300 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                                                                    after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-allpeer-checked:bg-[#269ad5]">
                                                                                </div>
                                                                                <span class="text-sm font-medium text-black">
                                                                                    Sí
                                                                                </span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- BOTONES -->
                                                                <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-100">
                                                                    <button type="button" onclick="document.getElementById('modalEditarSucursal{{ $sucursal->id }}').classList.add('hidden')"
                                                                        class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                                                                        Cancelar
                                                                    </button>
                                                                    <button type="submit" class="px-4 py-2 rounded-md bg-[#0407e2] hover:bg-[#0305b8] text-white text-sm font-semibold"
                                                                        style="background-color: var(--active-pink);">
                                                                        Actualizar
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    {{-- ELIMINAR --}}
                                                    <button type="button" onclick="confirmarEliminar('{{ route('sucursal.destroy', $sucursal->id) }}')"
                                                        class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-black hover:bg-slate-50 text-left">
                                                        <i class="fa-solid fa-trash w-4 text-black"></i>
                                                        Eliminar
                                                    </button>
                                                    {{-- Serie--}}
                                                    <button type="button" onclick="document.getElementById('modalNuevaSerie').classList.remove('hidden')"
                                                        class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-black hover:bg-slate-50 text-left">
                                                        <i class="fa-solid fa-circle-plus"></i>
                                                        Serie
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-4 align-middle text-center text-slate-600">
                                    No hay sucursales registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div id="modalNuevoSucursal" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
        <div class="absolute inset-0 bg-black/10"onclick="document.getElementById('modalNuevoSucursal').classList.add('hidden')"></div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
            <!-- CABECERA -->
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-slate-800"><i class="fa-solid fa-building text-slate-600"></i>Nueva sucursal</h2>
                <button type="button"
                    onclick="document.getElementById('modalNuevoSucursal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('sucursal.store') }}" method="POST">
                @csrf
                <input type="radio" name="tabs_sucursal" id="sucursal_tab1" class="peer/tab1 hidden" checked>
                <input type="radio" name="tabs_sucursal" id="sucursal_tab2"class="peer/tab2 hidden">
                <input type="radio" name="tabs_sucursal" id="sucursal_tab3"class="peer/tab3 hidden">
                <div class="flex flex-wrap gap-6 border-b border-slate-200 mb-6">
                    <label for="sucursal_tab1" class="cursor-pointer pb-3 text-sm font-semibold text-slate-500 border-b-2 border-transparent peer-checked/tab1:text-indigo-600 peer-checked/tab1:border-indigo-600">
                        <i class="fa-solid fa-building mr-2"></i>
                        Información general
                    </label>
                    <label for="sucursal_tab2" class="cursor-pointer pb-3 text-sm font-semibold text-slate-500 border-b-2 border-transparent peer-checked/tab2:text-indigo-600 peer-checked/tab2:border-indigo-600">
                        <i class="fa-solid fa-location-dot mr-2"></i>
                        Ubicación y direcciones
                    </label>
                    <label for="sucursal_tab3" class="cursor-pointer pb-3 text-sm font-semibold text-slate-500 border-b-2 border-transparent peer-checked/tab3:text-indigo-600 peer-checked/tab3:border-indigo-600">
                        <i class="fa-solid fa-address-card mr-2"></i>
                        Contacto y configuración
                    </label>
                </div>

                <!-- PESTAÑA 1: INFORMACIÓN GENERAL -->
                <div class="hidden peer-checked/tab1:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <!-- Código de Sucursal -->
                        <div class="md:col-span-3">
                            <label for="codigo_sucursal" class="block text-sm font-medium text-black mb-1">
                                Código de sucursal
                            </label>
                            <input type="text" id="codigo_sucursal" name="codigo_sucursal" maxlength="20" required placeholder="001"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                        <!-- Descripción -->
                        <div class="md:col-span-5">
                            <label for="descripcion" class="block text-sm font-medium text-black mb-1">
                                Descripción
                            </label>
                            <input type="text" id="descripcion" name="descripcion" maxlength="150" required placeholder="Ej. Sucursal Principal"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                        <!-- País -->
                        <div class="md:col-span-4">
                            <label for="pais" class="block text-sm font-medium text-black mb-1">País</label>
                            <input type="text" id="pais" name="pais" maxlength="100" placeholder="Ej. Perú"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                        <!-- Cliente -->
                        <div class="md:col-span-12">
                            <label for="cliente_id" class="block text-sm font-medium text-black mb-1">Cliente</label>
                            <select id="cliente_id" name="cliente_id" class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccione un cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">
                                        {{ $cliente->codigo_interno }} -
                                        {{ $cliente->nombre }} {{ $cliente->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <!-- PESTAÑA 2: UBICACIÓN Y DIRECCIONES -->
                <div class="hidden peer-checked/tab2:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <!-- Departamento -->
                        <div class="md:col-span-4">
                            <label for="departamento" class="block text-sm font-medium text-black mb-1"> Departamento</label>
                            <select id="departamento" name="departamento" data-url="{{ route('ubigeo.departamentos') }}"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccione departamento</option>
                            </select>
                        </div>
                        <!-- Provincia -->
                        <div class="md:col-span-4">
                            <label for="provincia" class="block text-sm font-medium text-black mb-1">Provincia</label>
                            <select id="provincia" name="provincia" data-url="{{ url('/ubigeo/provincias') }}"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400" disabled>
                                <option value="">Seleccione provincia</option>
                            </select>
                        </div>
                        <!-- Distrito -->
                        <div class="md:col-span-4">
                            <label for="distrito" class="block text-sm font-medium text-black mb-1">Distrito</label>
                            <select id="distrito" name="distrito" data-url="{{ url('/ubigeo/distritos') }}"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400" disabled>
                                <option value="">Seleccione distrito</option>
                            </select>
                        </div>
                        <!-- Dirección Fiscal -->
                        <div class="md:col-span-6">
                            <label for="direccion_fiscal" class="block text-sm font-medium text-black mb-1">Dirección Fiscal</label>
                            <input type="text" id="direccion_fiscal" name="direccion_fiscal" maxlength="255" placeholder="Ej. Av. Principal 123"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                        <!-- Dirección Comercial -->
                        <div class="md:col-span-6">
                            <label for="direccion_comercial" class="block text-sm font-medium text-black mb-1"> Dirección Comercial</label>
                            <input type="text" id="direccion_comercial" name="direccion_comercial" maxlength="255" placeholder="Ej. Jr. Comercio 456" class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                    </div>
                </div>

                <!-- PESTAÑA 3: CONTACTO Y CONFIGURACIÓN -->
                <div class="hidden peer-checked/tab3:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <div class="md:col-span-4">
                            <label for="telefono"class="block text-sm font-medium text-black mb-1">Teléfono</label>
                            <input type="text" id="telefono" name="telefono" maxlength="30" placeholder="Ej. 999999999" class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                        <!-- Correo de Contacto -->
                        <div class="md:col-span-4">
                            <label for="correo_contacto" class="block text-sm font-medium text-black mb-1">Correo de Contacto</label>
                            <input type="email" id="correo_contacto" name="correo_contacto" maxlength="150" placeholder="Ej. contacto@empresa.com"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                        <!-- Dirección Web -->
                        <div class="md:col-span-4">
                            <label for="direccion_web" class="block text-sm font-medium text-black mb-1">Dirección Web</label>
                            <input type="text" id="direccion_web" name="direccion_web" maxlength="255" placeholder="Ej. https://empresa.com"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                        <!-- Información Adicional -->
                        <div class="md:col-span-8">
                            <label for="informacion_adicional" class="block text-sm font-medium text-black mb-1">Información Adicional</label>
                            <textarea id="informacion_adicional" name="informacion_adicional" rows="2" placeholder="Detalles adicionales..."
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
                        </div>
                        <!-- Estado -->
                        <div class="md:col-span-4">
                            <label class="block text-sm font-medium text-black mb-2">Estado</label>
                            <label class="inline-flex items-center cursor-pointer gap-3">
                                <input type="hidden" name="estado" value="INACTIVO">
                                <input type="checkbox" name="estado"value="ACTIVO" class="sr-only peer" checked>
                                <span class="text-sm font-medium text-slate-700">No </span>
                                <div class="relative w-11 h-6 bg-slate-300 rounded-full peer peer-checked:after:translate-x-full
                                    after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300
                                    after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#269ad5]">
                                </div>
                                <span class="text-sm font-medium text-black">Sí</span>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- BOTONES -->
                <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-100">
                    <button type="button" onclick="document.getElementById('modalNuevoSucursal').classList.add('hidden')"
                        class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-md bg-[#0407e2] hover:bg-[#0305b8] text-white text-sm font-semibold"
                        style="background-color: var(--active-pink);">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="modalNuevaSerie" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-16 overflow-y-auto">
        <div class="absolute inset-0 bg-black/10" onclick="document.getElementById('modalNuevaSerie').classList.add('hidden')"></div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-6xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-slate-800">
                    <i class="fa-solid fa-layer-group text-slate-600"></i>
                    Series
                </h2>
                <button type="button" onclick="document.getElementById('modalNuevaSerie').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            {{-- TABLA DE SERIES REGISTRADAS --}}
            <div class="mb-8">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-sm font-semibold text-slate-700"><i class="fa-solid fa-list mr-1"></i>Series registradas</h3>
                    <span class="text-xs text-slate-500">Total: {{ $series->count() }}</span>
                </div>
                <div class="overflow-x-auto border border-slate-200 rounded-lg">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-slate-600">#</th>
                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Código</th>
                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Tipo de documento</th>
                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Sucursal</th>
                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Serie</th>
                                <th class="px-4 py-3 text-center font-semibold text-slate-600">Contingencia</th>
                                <th class="px-4 py-3 text-center font-semibold text-slate-600">Estado</th>
                                <th class="px-4 py-3 text-center font-semibold text-slate-600">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($series as $serie)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-4 py-3 text-slate-600">{{ $serie->id }}</td>
                                    <td class="px-4 py-3 text-slate-600">{{ $serie->tipoDocumento->codigo ?? '-' }}</td>
                                    <td class="px-4 py-3 text-slate-700">{{ $serie->tipoDocumento->nombre ?? '-' }}</td>
                                    <td class="px-4 py-3 text-slate-700">{{ $serie->sucursal->codigo_sucursal ?? '-' }} - {{ $serie->sucursal->descripcion ?? '-' }}</td>
                                    <td class="px-4 py-3 font-semibold text-slate-800">{{ $serie->serie }}</td>
                                    <td class="px-4 py-3 text-center">
                                        @if($serie->contingencia === 'SI')
                                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">Sí</span>
                                        @else
                                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">No</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($serie->estado === 'ACTIVO')
                                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Activo</span>
                                        @else
                                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Inactivo</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <button type="button"
                                                onclick="document.getElementById('modalEditarSerie{{ $serie->id }}').classList.remove('hidden')"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-md text-blue-600 hover:bg-blue-50">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" onclick="confirmarEliminar('{{ route('configuracion.serie.destroy', $serie->id) }}')"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-md text-red-600 hover:bg-red-50">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>

                                    @foreach($series as $serie)
                                        <div id="modalEditarSerie{{ $serie->id }}" class="hidden fixed inset-0 z-[999999] flex items-start justify-center pt-16 overflow-y-auto">
                                            <div class="absolute inset-0 bg-black/10" onclick="document.getElementById('modalEditarSerie{{ $serie->id }}').classList.add('hidden')"></div>
                                            <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-6xl mx-3 sm:mx-4 p-4 sm:p-6">
                                                <div class="flex items-center justify-between mb-6">
                                                    <h2 class="text-lg font-semibold text-slate-800">
                                                        <i class="fa-solid fa-pen-to-square text-slate-600"></i>Editar Serie
                                                    </h2>
                                                    <button type="button" onclick="document.getElementById('modalEditarSerie{{ $serie->id }}').classList.add('hidden')"
                                                        class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </div>
                                                <form action="{{ route('configuracion.serie.update', $serie->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                                        <div class="md:col-span-3">
                                                            <label class="block text-sm font-medium text-black mb-1">Tipo de documento</label>
                                                            <select name="tipo_documento_id"class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm"required>
                                                                @foreach($tipoDocumentos as $tipoDocumento)
                                                                    <option value="{{ $tipoDocumento->id }}"{{ $serie->tipo_documento_id == $tipoDocumento->id ? 'selected' : '' }}>
                                                                        {{ $tipoDocumento->codigo }} - {{ $tipoDocumento->nombre }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="md:col-span-3">
                                                            <label class="block text-sm font-medium text-black mb-1">Sucursal</label>
                                                            <select name="sucursal_id"class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm"required>
                                                                @foreach($sucursals as $sucursal)
                                                                    <option value="{{ $sucursal->id }}"
                                                                        {{ $serie->sucursal_id == $sucursal->id ? 'selected' : '' }}>
                                                                        {{ $sucursal->codigo_sucursal }} - {{ $sucursal->descripcion }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="md:col-span-2">
                                                            <label class="block text-sm font-medium text-black mb-1">
                                                                Serie
                                                            </label>
                                                            <input type="text" name="serie" value="{{ $serie->serie }}" maxlength="10" class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm" required>
                                                        </div>
                                                       {{-- CONTINGENCIA --}}
                                                        <div class="md:col-span-2">
                                                            <label class="block text-sm font-medium text-black mb-1">Contingencia</label>
                                                            <label class="inline-flex items-center cursor-pointer gap-3">
                                                                <input type="hidden"name="contingencia"value="NO">
                                                                <span class="text-sm text-slate-700">No</span>
                                                                <input type="checkbox"id="contingencia" name="contingencia" value="SI" class="sr-only peer"
                                                                    {{ old('contingencia', $serie->contingencia ?? 'NO') == 'SI' ? 'checked' : '' }}>
                                                                <div class="relative w-11 h-6 bg-slate-300 rounded-full
                                                                    peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white
                                                                    after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5  after:transition-all peer-checked:bg-[#269ad5]">
                                                                </div>
                                                                <span class="text-sm text-black">Sí</span>
                                                            </label>
                                                        </div>
                                                        {{-- ESTADO --}}
                                                        <div class="md:col-span-2">
                                                            <label class="block text-sm font-medium text-black mb-1">Estado</label>
                                                            <label class="inline-flex items-center cursor-pointer gap-3">
                                                                <input type="hidden" name="estado" value="INACTIVO">
                                                                <span class="text-sm text-slate-700">No</span>
                                                                <input type="checkbox" id="estado" name="estado" value="ACTIVO" class="sr-only peer" {{ old('estado', $serie->estado ?? 'ACTIVO') == 'ACTIVO' ? 'checked' : '' }}>
                                                                <div class="relative w-11 h-6 bg-slate-300 rounded-full
                                                                    peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white
                                                                    after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5  after:transition-all peer-checked:bg-[#269ad5]">
                                                                </div>
                                                                <span class="text-sm text-black"> Sí</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="flex justify-end gap-3 mt-6">
                                                        <button type="button"
                                                                onclick="document.getElementById('modalEditarSerie{{ $serie->id }}').classList.add('hidden')"
                                                                class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                                                            Cancelar
                                                        </button>

                                                        <button type="submit"
                                                                class="inline-flex items-center gap-2 px-5 py-2 rounded-md text-white text-sm font-semibold"
                                                                style="background-color: var(--active-pink);">
                                                            <i class="fa-solid fa-floppy-disk"></i>
                                                            Actualizar
                                                        </button>

                                                    </div>

                                                </form>

                                            </div>

                                        </div>
                                    @endforeach

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-sm text-slate-500">
                                        No hay series registradas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- SEPARADOR --}}
            <div class="border-t border-slate-200 pt-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-semibold text-slate-700"><i class="fa-solid fa-plus-circle mr-1"></i>Agregar nueva serie</h3>
                </div>
                <form action="{{ route('configuracion.serie.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                        {{-- TIPO DOCUMENTO --}}
                        <div class="md:col-span-3">
                            <label for="tipo_documento_id" class="block text-sm font-medium text-black mb-1"> Tipo de documento</label>
                            <select id="tipo_documento_id" name="tipo_documento_id" class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                                <option value="">
                                    Seleccione una opcion  
                                </option>
                                @foreach($tipoDocumentos as $tipoDocumento)
                                    <option value="{{ $tipoDocumento->id }}">{{ $tipoDocumento->codigo }} - {{ $tipoDocumento->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- SUCURSAL --}}
                        <div class="md:col-span-3">
                            <label for="sucursal_id" class="block text-sm font-medium text-black mb-1">Sucursal</label>
                            <select id="sucursal_id" name="sucursal_id" class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                                <option value="">Seleccione una opcion</option>
                                @foreach($sucursals as $sucursal)
                                    <option value="{{ $sucursal->id }}">{{ $sucursal->codigo_sucursal }} - {{ $sucursal->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- SERIE --}}
                        <div class="md:col-span-2">
                            <label for="serie" class="block text-sm font-medium text-black mb-1"> Serie </label>
                            <input type="text" id="serie" name="serie" maxlength="10" placeholder="Ej. F001" class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                            required>
                        </div>
                        {{-- CONTINGENCIA --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-black mb-1">Contingencia</label>
                            <label class="inline-flex items-center cursor-pointer gap-3">
                                <input type="hidden"name="contingencia" value="NO"><span class="text-sm text-slate-700">No</span>
                                <input type="checkbox" name="contingencia" value="SI" class="sr-only peer">
                                <div class="relative w-11 h-6 bg-slate-300 rounded-full
                                    peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px]
                                    after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full
                                    after:h-5 after:w-5 after:transition-all peer-checked:bg-[#269ad5]">
                                </div>
                                <span class="text-sm text-black"> Sí</span>
                            </label>
                        </div>

                        {{-- ESTADO --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-black mb-1">Estado</label>
                            <label class="inline-flex items-center cursor-pointer gap-3">
                                <input type="hidden" name="estado" value="INACTIVO"><span class="text-sm text-slate-700">No</span>
                                <input type="checkbox"name="estado"value="ACTIVO" class="sr-only peer"checked>
                                <div class="relative w-11 h-6 bg-slate-300 rounded-full
                                    peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px]
                                    after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full
                                    after:h-5 after:w-5 after:transition-all peer-checked:bg-[#269ad5]">
                                </div>
                                <span class="text-sm text-black"> Sí</span>
                            </label>
                        </div>
                        {{-- GUARDAR --}}
                        <div class="md:col-span-12 flex justify-end gap-3 mt-2">
                            <button type="button"onclick="document.getElementById('modalNuevaSerie').classList.add('hidden')"
                                class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                                Cancelar
                            </button>
                            <button type="submit"class="inline-flex items-center gap-2 px-5 py-2 rounded-md bg-[#0407e2] hover:bg-[#0305b8] text-white text-sm font-semibold"
                                style="background-color: var(--active-pink);">
                                <i class="fa-solid fa-floppy-disk"></i>
                                Guardar
                            </button>
                        </div> 
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


