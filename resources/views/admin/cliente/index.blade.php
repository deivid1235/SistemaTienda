@extends('layouts.admin.app')
@section('title', 'Cliente')
@section('js')
@endsection
@section('content')

    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-solid fa-users text-slate-600"></i>
        Listado de Clientes
    </h1>
        
    <div class="bg-white rounded-3xl shadow-md p-6">
        <div class="flex justify-end">
            <button type="button"
                onclick="document.getElementById('modalNuevoCliente').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-[#0407e2] hover:bg-[#0305b8] text-white text-sm font-semibold"
                 style="background-color: var(--active-pink);" >
                <i class="fa-solid fa-circle-plus"></i>
                Nuevo
            </button>
        </div>
        
        <div class="overflow-x-auto mt-4">
            <table class="w-full min-w-[700px] text-left text-sm">
                <thead>
                    <tr class="border-b border-slate-200 text-black">
                        <th class="font-semibold w-16">#</th>
                        <th class="font-semibold">Tipo Doc.</th>
                        <th class="font-semibold">Número</th>
                        <th class="font-semibold">Nombre / Razón Social</th>
                        <th class="font-semibold">Nombre Comercial</th>
                        <th class="font-semibold">Tipo Cliente</th>
                        <th class="font-semibold">Teléfono</th>
                        <th class="font-semibold">Fecha Registro</th>
                        <th class="font-semibold">Estado</th>
                        <th class="font-semibold text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clientes as $index => $cliente)
                        <tr class="border-b border-slate-100">
                            <td class="py-2 text-slate-600">{{ $index + 1 }}</td>
                            <td class="py-2 text-slate-600">{{ $cliente->tipo_documento }}</td>
                            <td class="py-2 text-slate-600">{{ $cliente->numero_documento }}</td>
                            <td class="py-2 text-black font-medium">
                                <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md bg-indigo-50 border border-indigo-200">
                                    <span class="text-indigo-500 text-xs"><i class="fa-solid fa-user"></i>
                                    </span><span class="text-xs font-semibold text-indigo-900">{{ $cliente->nombre }}</span>
                                </div>
                            </td>
                            <td class="py-2 text-slate-600">{{ $cliente->nombre_comercial ?? '-' }}</td>
                            <td class="py-2 text-slate-600">{{ $cliente->tipoCliente->nombre ?? '-' }}</td>
                            <td class="py-2 text-slate-600">{{ $cliente->telefono ?? '-' }}</td>
                            <td class="py-2 text-slate-600">{{ $cliente->created_at->format('d/m/Y') }}</td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                    {{ $cliente->estado ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20' : 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20' }}">
                                    <span class="w-1.5 h-1.5 rounded-full
                                        {{ $cliente->estado ? 'bg-emerald-500' : 'bg-rose-500' }}">
                                    </span>
                                    {{ $cliente->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex justify-end gap-2">
                                    {{-- EDITAR --}}
                                    <button type="button" onclick="document.getElementById('modalEditarCliente{{ $cliente->id }}').classList.remove('hidden')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold" style="background-color: #64DD17;">
                                        Editar
                                    </button>

                                    {{-- MODAL EDITAR CLIENTE (Unico por cada ID) --}}
                                    <div id="modalEditarCliente{{ $cliente->id }}" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
                                        <div class="absolute inset-0 bg-black/10"
                                            onclick="document.getElementById('modalEditarCliente{{ $cliente->id }}').classList.add('hidden')">
                                        </div>
                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-4xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
                                            <!-- Cabecera del Modal -->
                                            <div class="flex items-center justify-between mb-4">
                                                <h2 class="text-xl font-semibold text-slate-800 flex items-center gap-2">
                                                    <i class="fa-solid fa-user-pen text-slate-600"></i>
                                                    Editar Cliente
                                                </h2>
                                                <button type="button" onclick="document.getElementById('modalEditarCliente{{ $cliente->id }}').classList.add('hidden')"
                                                    class="text-slate-400 hover:text-slate-600 text-lg">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>

                                            <form action="{{ route('cliente.update', $cliente->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <!-- INPUTS OCULTOS (RADIOS) PARA CONTROLAR LAS PESTAÑAS SIN JS -->
                                                <input type="radio" name="tab_group_{{ $cliente->id }}" id="tab1_{{ $cliente->id }}" class="peer/tab1 hidden" checked>
                                                <input type="radio" name="tab_group_{{ $cliente->id }}" id="tab2_{{ $cliente->id }}" class="peer/tab2 hidden">
                                                <input type="radio" name="tab_group_{{ $cliente->id }}" id="tab3_{{ $cliente->id }}" class="peer/tab3 hidden">

                                                <!-- BOTONES / PESTAÑAS (TABS VISUALES) -->
                                                <div class="flex border-b border-slate-200 mb-6 gap-6">
                                                    <label for="tab1_{{ $cliente->id }}" class="pb-3 text-sm font-semibold cursor-pointer transition-all
                                                        peer-checked/tab1:text-indigo-600 peer-checked/tab1:border-b-2 peer-checked/tab1:border-indigo-600
                                                        text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                                                        <i class="fa-solid fa-user mr-2"></i>
                                                        Datos de Cliente
                                                    </label>
                                                    <label for="tab2_{{ $cliente->id }}" class="pb-3 text-sm font-semibold cursor-pointer transition-all
                                                        peer-checked/tab2:text-indigo-600 peer-checked/tab2:border-b-2 peer-checked/tab2:border-indigo-600
                                                        text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                                                        <i class="fa-solid fa-location-dot mr-2"></i>
                                                        Dirección
                                                    </label>
                                                    <label for="tab3_{{ $cliente->id }}" class="pb-3 text-sm font-semibold cursor-pointer transition-all
                                                        peer-checked/tab3:text-indigo-600 peer-checked/tab3:border-b-2 peer-checked/tab3:border-indigo-600
                                                        text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                                                        <i class="fa-solid fa-circle-info mr-2"></i>
                                                        Otros Datos
                                                    </label>
                                                </div>
                                                
                                                <!-- 1. PESTAÑA: DATOS DE CLIENTE -->
                                                <div class="hidden peer-checked/tab1:block space-y-4">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label for="tipo_documento{{ $cliente->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                Tipo Doc. Identidad <span class="text-red-500">*</span>
                                                            </label>
                                                            <select id="tipo_documento{{ $cliente->id }}" name="tipo_documento" required
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                <option value="">Seleccione...</option>
                                                                <option value="RUC" {{ old('tipo_documento', $cliente->tipo_documento) == 'RUC' ? 'selected' : '' }}>RUC</option>
                                                                <option value="DNI" {{ old('tipo_documento', $cliente->tipo_documento) == 'DNI' ? 'selected' : '' }}>DNI</option>
                                                                <option value="PASAPORTE" {{ old('tipo_documento', $cliente->tipo_documento) == 'PASAPORTE' ? 'selected' : '' }}>Pasaporte</option>
                                                            </select>
                                                        </div>

                                                        <div>
                                                            <label for="numero_documento{{ $cliente->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                Número <span class="text-red-500">*</span>
                                                            </label>
                                                            <div class="flex gap-2">
                                                                <input type="text" id="numero_documento{{ $cliente->id }}" name="numero_documento" value="{{ old('numero_documento', $cliente->numero_documento) }}" maxlength="30" required
                                                                    class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                <button type="button"
                                                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center gap-1.5 shrink-0"
                                                                    style="background-color: var(--active-pink);">
                                                                    <i class="fa-solid fa-magnifying-glass"></i> SUNAT
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label for="nombre{{ $cliente->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                Nombre / Razón Social <span class="text-red-500">*</span>
                                                            </label>
                                                            <input type="text" id="nombre{{ $cliente->id }}" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" maxlength="100" required
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                        </div>

                                                        <div>
                                                            <label for="nombre_comercial{{ $cliente->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                Nombre Comercial
                                                            </label>
                                                            <input type="text" id="nombre_comercial{{ $cliente->id }}" name="nombre_comercial" value="{{ old('nombre_comercial', $cliente->nombre_comercial) }}" maxlength="30"
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                        </div>

                                                        <div>
                                                            <label for="codigo_interno{{ $cliente->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                Código interno
                                                            </label>
                                                            <input type="text" id="codigo_interno{{ $cliente->id }}" name="codigo_interno" value="{{ old('codigo_interno', $cliente->codigo_interno) }}" maxlength="50"
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                        </div>

                                                        <div>
                                                            <label for="nacionalidad{{ $cliente->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                Nacionalidad
                                                            </label>
                                                            <select id="nacionalidad{{ $cliente->id }}" name="nacionalidad"
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                <option value="PERU" {{ old('nacionalidad', $cliente->nacionalidad) == 'PERU' ? 'selected' : '' }}>PERU</option>
                                                                <option value="OTRO" {{ old('nacionalidad', $cliente->nacionalidad) == 'OTRO' ? 'selected' : '' }}>OTRO</option>
                                                            </select>
                                                        </div>

                                                        <div>
                                                            <label for="tipo_cliente_id{{ $cliente->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                Tipo de cliente
                                                            </label>
                                                            <select id="tipo_cliente_id{{ $cliente->id }}" name="tipo_cliente_id" required
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                                <option value="">Seleccionar</option>
                                                                @foreach($tipoClientes as $tc)
                                                                    <option value="{{ $tc->id }}" {{ old('tipo_cliente_id', $cliente->tipo_cliente_id) == $tc->id ? 'selected' : '' }}>
                                                                        {{ $tc->nombre }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div>
                                                            <label for="codigo_barra{{ $cliente->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                Código de barra
                                                            </label>
                                                            <input type="text" id="codigo_barra{{ $cliente->id }}" name="codigo_barra" value="{{ old('codigo_barra', $cliente->codigo_barra) }}" maxlength="100"
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                        </div>
                                                        
                                                        <div>
                                                            <label for="dias_credito{{ $cliente->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                Días de crédito
                                                            </label>
                                                            <input type="number" id="dias_credito{{ $cliente->id }}" name="dias_credito" value="{{ old('dias_credito', $cliente->dias_credito) }}" min="0"
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 2. PESTAÑA: DIRECCIÓN -->
                                                <div class="hidden peer-checked/tab2:block space-y-4">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div class="md:col-span-2">
                                                            <label for="direccion{{ $cliente->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                Dirección completa
                                                            </label>
                                                            <input type="text" id="direccion{{ $cliente->id }}" name="direccion" value="{{ old('direccion', $cliente->direccion) }}" maxlength="255"
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                        </div>

                                                        <div>
                                                            <label for="pais{{ $cliente->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                País
                                                            </label>
                                                            <input type="text" id="pais{{ $cliente->id }}" name="pais" value="{{ old('pais', $cliente->pais) }}" maxlength="100"
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                        </div>

                                                        <div>
                                                            <label for="codigo_sucursal{{ $cliente->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                Código de Sucursal
                                                            </label>
                                                            <input type="text" id="codigo_sucursal{{ $cliente->id }}" name="codigo_sucursal" value="{{ old('codigo_sucursal', $cliente->codigo_sucursal) }}" maxlength="50"
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 3. PESTAÑA: OTROS DATOS -->
                                                <div class="hidden peer-checked/tab3:block space-y-4">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div>
                                                            <label for="telefono{{ $cliente->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                Teléfono
                                                            </label>
                                                            <input type="text" id="telefono{{ $cliente->id }}" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" maxlength="30"
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                        </div>

                                                        <div>
                                                            <label for="correo_electronico{{ $cliente->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                Correo Electrónico
                                                            </label>
                                                            <input type="email" id="correo_electronico{{ $cliente->id }}" name="correo_electronico" value="{{ old('correo_electronico', $cliente->correo_electronico) }}" maxlength="150"
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                        </div>

                                                        <div>
                                                            <label for="sitio_web{{ $cliente->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                Sitio Web
                                                            </label>
                                                            <input type="text" id="sitio_web{{ $cliente->id }}" name="sitio_web" value="{{ old('sitio_web', $cliente->sitio_web) }}" maxlength="255"
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                        </div>

                                                        <div class="md:col-span-2">
                                                            <label for="observaciones{{ $cliente->id }}" class="block text-sm font-medium text-slate-700 mb-1">
                                                                Observaciones
                                                            </label>
                                                            <textarea id="observaciones{{ $cliente->id }}" name="observaciones" rows="3"
                                                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">{{ old('observaciones', $cliente->observaciones) }}</textarea>
                                                        </div>

                                                        <div class="md:col-span-2">
                                                            <label class="block text-sm font-medium text-slate-700 mb-2">Estado</label>
                                                            <label class="inline-flex items-center cursor-pointer gap-3">
                                                                <input type="hidden" name="estado" value="0">
                                                                <input type="checkbox" name="estado" value="1" class="sr-only peer" {{ $cliente->estado ? 'checked' : '' }}>
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

                                                <!-- Botones de Acción Inferiores -->
                                                <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-100">
                                                    <button type="button"
                                                        onclick="document.getElementById('modalEditarCliente{{ $cliente->id }}').classList.add('hidden')"
                                                        class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50">
                                                        Cancelar
                                                    </button>
                                                    <button type="submit" class="px-5 py-2 rounded-md text-white text-sm font-medium bg-indigo-600 hover:bg-indigo-700"
                                                        style="background-color: var(--active-pink);">
                                                        Actualizar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- ELIMINAR --}}
                                    <button type="button" onclick="confirmarEliminar('{{ route('cliente.destroy', $cliente->id) }}')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold"
                                        style="background-color: #D50000;">
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center text-slate-500">
                                No hay clientes registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                
            </table>
        </div>

    </div>

    <div id="modalNuevoCliente" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
        <div class="absolute inset-0 bg-black/10"
            onclick="document.getElementById('modalNuevoCliente').classList.add('hidden')">
        </div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-4xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
            <!-- Cabecera del Modal -->
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-slate-800">
                    Nuevo Cliente
                </h2>
                <button type="button" onclick="document.getElementById('modalNuevoCliente').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600 text-lg">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('cliente.store') }}" method="POST">
                @csrf
                <!-- INPUTS OCULTOS (RADIOS) PARA CONTROLAR LAS PESTAÑAS SIN JS -->
                <input type="radio" name="tab_group" id="tab1" class="peer/tab1 hidden" checked>
                <input type="radio" name="tab_group" id="tab2" class="peer/tab2 hidden">
                <input type="radio" name="tab_group" id="tab3" class="peer/tab3 hidden">
                <!-- BOTONES / PESTAÑAS (TABS VISUALES) -->
                <div class="flex border-b border-slate-200 mb-6 gap-6">
                    <label for="tab1" class="pb-3 text-sm font-semibold cursor-pointer transition-all
                        peer-checked/tab1:text-indigo-600 peer-checked/tab1:border-b-2 peer-checked/tab1:border-indigo-600
                        text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-user mr-2"></i>
                        Datos de Cliente
                    </label>
                    <label for="tab2" class="pb-3 text-sm font-semibold cursor-pointer transition-all
                        peer-checked/tab2:text-indigo-600 peer-checked/tab2:border-b-2 peer-checked/tab2:border-indigo-600
                        text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-location-dot mr-2"></i>
                        Dirección
                    </label>
                    <label for="tab3" class="pb-3 text-sm font-semibold cursor-pointer transition-all
                        peer-checked/tab3:text-indigo-600 peer-checked/tab3:border-b-2 peer-checked/tab3:border-indigo-600
                        text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-circle-info mr-2"></i>
                        Otros Datos
                    </label>
                </div>
                
                <!-- 1. PESTAÑA: DATOS DE CLIENTE -->
                <div class="hidden peer-checked/tab1:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="tipo_documento" class="block text-sm font-medium text-slate-700 mb-1">
                                Tipo Doc. Identidad <span class="text-red-500">*</span>
                            </label>
                            <select id="tipo_documento" name="tipo_documento" required
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccione...</option>
                                <option value="RUC">RUC</option>
                                <option value="DNI">DNI</option>
                                <option value="PASAPORTE">Pasaporte</option>
                            </select>
                        </div>

                        <div>
                            <label for="numero_documento" class="block text-sm font-medium text-slate-700 mb-1">
                                Número <span class="text-red-500">*</span>
                            </label>
                            <div class="flex gap-2">
                                <input type="text" id="numero_documento" name="numero_documento" maxlength="30" required placeholder=""
                                    class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <button type="button" id="btnConsultarDocumento"
                                    data-url="{{ route('cliente.consulta.documento') }}" onclick="consultarDocumento()"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center gap-1.5 shrink-0"
                                    style="background-color: var(--active-pink);">
                                    <i class="fa-solid fa-magnifying-glass"></i> SUNAT
                                </button>
                            </div>
                        </div>

                        <div>
                            <label for="nombre" class="block text-sm font-medium text-slate-700 mb-1">
                                Nombre / Razón Social <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nombre" name="nombre" maxlength="100" required
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div>
                            <label for="nombre_comercial" class="block text-sm font-medium text-slate-700 mb-1">
                                Nombre Comercial
                            </label>
                            <input type="text" id="nombre_comercial" name="nombre_comercial" maxlength="30" placeholder=""
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div>
                            <label for="codigo_interno" class="block text-sm font-medium text-slate-700 mb-1">
                                Código interno
                            </label>
                            <input type="text" id="codigo_interno" name="codigo_interno" maxlength="50" placeholder=""
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div>
                            <label for="nacionalidad" class="block text-sm font-medium text-slate-700 mb-1">
                                Nacionalidad
                            </label>
                            <select id="nacionalidad" name="nacionalidad"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="PERU">PERU</option>
                                <option value="OTRO">OTRO</option>
                            </select>
                        </div>

                        <div>
                            <label for="tipo_cliente_id" class="block text-sm font-medium text-slate-700 mb-1">
                                Tipo de cliente
                            </label>
                            <select id="tipo_cliente_id" name="tipo_cliente_id" required
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccionar</option>
                                @foreach($tipoClientes as $tc)
                                    <option value="{{ $tc->id }}">{{ $tc->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="codigo_barra" class="block text-sm font-medium text-slate-700 mb-1">
                                Código de barra
                            </label>
                            <input type="text" id="codigo_barra" name="codigo_barra" maxlength="100" placeholder=""
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                        
                        <div>
                            <label for="dias_credito" class="block text-sm font-medium text-slate-700 mb-1">
                                Días de crédito
                            </label>
                            <input type="number" id="dias_credito" name="dias_credito" value="0" min="0"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                    </div>
                </div>

                <!-- 2. PESTAÑA: DIRECCIÓN -->
                <div class="hidden peer-checked/tab2:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="direccion" class="block text-sm font-medium text-slate-700 mb-1">
                                Dirección completa
                            </label>
                            <input type="text" id="direccion" name="direccion" maxlength="255" placeholder="Ej. Av. Principal 123"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div>
                            <label for="pais" class="block text-sm font-medium text-slate-700 mb-1">
                                País
                            </label>
                            <input type="text" id="pais" name="pais" value="Perú" maxlength="100"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div>
                            <label for="codigo_sucursal" class="block text-sm font-medium text-slate-700 mb-1">
                                Código de Sucursal
                            </label>
                            <input type="text" id="codigo_sucursal" name="codigo_sucursal" maxlength="50"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                    </div>
                </div>

                <!-- 3. PESTAÑA: OTROS DATOS -->
                <div class="hidden peer-checked/tab3:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="telefono" class="block text-sm font-medium text-slate-700 mb-1">
                                Teléfono
                            </label>
                            <input type="text" id="telefono" name="telefono" maxlength="30"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div>
                            <label for="correo_electronico" class="block text-sm font-medium text-slate-700 mb-1">
                                Correo Electrónico
                            </label>
                            <input type="email" id="correo_electronico" name="correo_electronico" maxlength="150"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div>
                            <label for="sitio_web" class="block text-sm font-medium text-slate-700 mb-1">
                                Sitio Web
                            </label>
                            <input type="text" id="sitio_web" name="sitio_web" maxlength="255"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div class="md:col-span-2">
                            <label for="observaciones" class="block text-sm font-medium text-slate-700 mb-1">
                                Observaciones
                            </label>
                            <textarea id="observaciones" name="observaciones" rows="3"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Estado</label>
                            <label class="inline-flex items-center cursor-pointer gap-3">
                                <input type="hidden" name="estado" value="0">
                                <input type="checkbox" name="estado" value="1" class="sr-only peer" checked>
                                <span class="text-sm font-medium text-slate-600">Inactivo</span>
                                <div class="relative w-11 h-6 bg-slate-300 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px]
                                    after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"
                                    style="background-color: var(--active-pink);" >
                                </div>
                                <span class="text-sm font-medium text-slate-800">Activo</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción Inferiores -->
                <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-100">
                    <button type="button"
                        onclick="document.getElementById('modalNuevoCliente').classList.add('hidden')"
                        class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-md text-white text-sm font-medium bg-indigo-600 hover:bg-indigo-700"
                    style="background-color: var(--active-pink);" >
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection


