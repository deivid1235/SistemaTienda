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
        <div class="flex justify-end">
            <button type="button"
                onclick="document.getElementById('modalNuevoSucursal').classList.remove('hidden')"
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
                        <th class="font-semibold">Código</th>
                        <th class="font-semibold">Descripción</th>
                        <th class="font-semibold">Departamento</th>
                        <th class="font-semibold">Provincia</th>
                        <th class="font-semibold">Distrito</th>
                        <th class="font-semibold">Estado</th>
                        <th class="font-semibold text-right">Acciones</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse($sucursals as $index => $sucursal)
                        <tr class="border-b border-slate-100">
                            <td class="py-2 text-slate-600">{{ $index + 1 }}</td>
                            <td class="py-2 text-blue-800 font-medium">{{ $sucursal->codigo_sucursal }}</td>
                           <td class="py-2 text-slate-700">
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/20">
                                    <svg class="w-3 h-3 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21" />
                                    </svg>
                                    {{ $sucursal->descripcion }}
                                </div>
                            </td>
                            <td class="py-2 text-slate-700">{{ $sucursal->departamento }}</td>
                            <td class="py-2 text-slate-700"> {{ $sucursal->provincia }}</td>
                            <td class="py-2 text-slate-700">{{ $sucursal->distrito }}</td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                    {{ $sucursal->estado === 'ACTIVO'
                                        ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20'
                                        : 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20' }}">
                                    <span class="w-1.5 h-1.5 rounded-full
                                        {{ $sucursal->estado === 'ACTIVO'
                                            ? 'bg-emerald-500'
                                            : 'bg-rose-500' }}">
                                    </span>{{ $sucursal->estado }}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex justify-end gap-2">
                                    <button type="button" onclick="document.getElementById('modalEditarSucursal{{ $sucursal->id }}').classList.remove('hidden')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold"
                                        style="background-color: #64DD17;">
                                        Editar
                                    </button>
                                    {{-- MODAL EDITAR --}}
                                    <div id="modalEditarSucursal{{ $sucursal->id }}"
                                        class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
                                        <div class="absolute inset-0 bg-black/10"
                                            onclick="document.getElementById('modalEditarSucursal{{ $sucursal->id }}').classList.add('hidden')">
                                        </div>
                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
                                            <div class="flex items-center justify-between mb-6">
                                                <h2 class="text-lg font-semibold text-slate-800">
                                                    <i class="fa-solid fa-building text-slate-600"></i>
                                                    Editar Sucursal
                                                </h2>
                                                <button type="button" onclick="document.getElementById('modalEditarSucursal{{ $sucursal->id }}').classList.add('hidden')"
                                                    class="text-slate-400 hover:text-slate-600">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('sucursal.update', $sucursal->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                                    <div class="md:col-span-3">
                                                        <label for="codigo_sucursal{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1">
                                                            Código de sucursal
                                                        </label>
                                                        <input type="text" id="codigo_sucursal{{ $sucursal->id }}" name="codigo_sucursal"
                                                            value="{{ $sucursal->codigo_sucursal }}" maxlength="20" required
                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>
                                                    <div class="md:col-span-5">
                                                        <label for="descripcion{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1">
                                                            Descripción
                                                        </label>
                                                        <input type="text" id="descripcion{{ $sucursal->id }}" name="descripcion" value="{{ $sucursal->descripcion }}" maxlength="150" required
                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>

                                                    <div class="md:col-span-4">
                                                        <label for="pais{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1">
                                                            País
                                                        </label>
                                                        <input type="text" id="pais{{ $sucursal->id }}" name="pais" value="{{ $sucursal->pais }}" maxlength="100" required
                                                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4">
                                                    <div class="md:col-span-4">
                                                        <label for="departamento{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1">
                                                            Departamento
                                                        </label>
                                                        <select id="departamento{{ $sucursal->id }}" name="departamento"
                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                            <option value="{{ $sucursal->departamento }}">
                                                                {{ $sucursal->departamento }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="md:col-span-4">
                                                        <label for="provincia{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1">
                                                            Provincia
                                                        </label>
                                                        <select id="provincia{{ $sucursal->id }}" name="provincia"
                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                            <option value="{{ $sucursal->provincia }}">
                                                                {{ $sucursal->provincia }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="md:col-span-4">
                                                        <label for="distrito{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1">
                                                            Distrito
                                                        </label>
                                                        <select id="distrito{{ $sucursal->id }}" name="distrito"
                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                            <option value="{{ $sucursal->distrito }}">
                                                                {{ $sucursal->distrito }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4">
                                                    <div class="md:col-span-6">
                                                        <label for="direccion_fiscal{{ $sucursal->id }}"
                                                            class="block text-sm font-medium text-black mb-1">
                                                            Dirección Fiscal
                                                        </label>
                                                        <input type="text"  id="direccion_fiscal{{ $sucursal->id }}"
                                                            name="direccion_fiscal" value="{{ $sucursal->direccion_fiscal }}" maxlength="255" required
                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>
                                                    <div class="md:col-span-6">
                                                        <label for="direccion_comercial{{ $sucursal->id }}"
                                                            class="block text-sm font-medium text-black mb-1">
                                                            Dirección Comercial
                                                        </label>
                                                        <input type="text" id="direccion_comercial{{ $sucursal->id }}" name="direccion_comercial" value="{{ $sucursal->direccion_comercial }}" maxlength="255"
                                                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>

                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4">
                                                    <div class="md:col-span-4">
                                                        <label for="telefono{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1">
                                                            Teléfono
                                                        </label>
                                                        <input type="text" id="telefono{{ $sucursal->id }}" name="telefono" value="{{ $sucursal->telefono }}" maxlength="30"
                                                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>

                                                    <div class="md:col-span-4">
                                                        <label for="correo_contacto{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1">
                                                            Correo de Contacto
                                                        </label>
                                                        <input type="email" id="correo_contacto{{ $sucursal->id }}" name="correo_contacto" value="{{ $sucursal->correo_contacto }}" maxlength="150"
                                                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>

                                                    <div class="md:col-span-4">
                                                        <label for="direccion_web{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1">
                                                            Dirección Web
                                                        </label>
                                                        <input type="text" id="direccion_web{{ $sucursal->id }}" name="direccion_web" value="{{ $sucursal->direccion_web }}" maxlength="255"
                                                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>

                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4">

                                                    <div class="md:col-span-12">
                                                        <label for="informacion_adicional{{ $sucursal->id }}" class="block text-sm font-medium text-black mb-1">
                                                            Información Adicional
                                                        </label>
                                                        <textarea id="informacion_adicional{{ $sucursal->id }}" name="informacion_adicional"rows="2"
                                                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">{{ $sucursal->informacion_adicional }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4">
                                                    <div class="md:col-span-4">
                                                        <label class="block text-sm font-medium text-black mb-2">
                                                            Estado
                                                        </label>
                                                        <label class="inline-flex items-center cursor-pointer gap-3">
                                                            <input type="hidden" name="estado" value="INACTIVO">
                                                            <input type="checkbox" name="estado" value="ACTIVO"class="sr-only peer"
                                                                {{ $sucursal->estado === 'ACTIVO' ? 'checked' : '' }}>
                                                            <span class="text-sm font-medium text-slate-700">
                                                                No
                                                            </span>
                                                            <div class="relative w-11 h-6 bg-slate-300 rounded-full
                                                                peer peer-checked:after:translate-x-full
                                                                after:content-[''] after:absolute
                                                                after:top-[2px] after:left-[2px]
                                                                after:bg-white after:border-slate-300
                                                                after:border after:rounded-full
                                                                after:h-5 after:w-5 after:transition-all peer-checked:bg-[#269ad5]">
                                                            </div>
                                                            <span class="text-sm font-medium text-black">
                                                                Sí
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="flex justify-end gap-3 mt-8">
                                                    <button type="button"
                                                        onclick="document.getElementById('modalEditarSucursal{{ $sucursal->id }}').classList.add('hidden')"
                                                        class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                                                        Cancelar
                                                    </button>
                                                    <button type="submit"
                                                        class="px-4 py-2 rounded-md bg-[#0407e2] hover:bg-[#0305b8] text-white text-sm font-semibold"
                                                        style="background-color: var(--active-pink);">
                                                        Actualizar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <button type="button" onclick="confirmarEliminar('{{ route('sucursal.destroy', $sucursal->id) }}')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold"
                                        style="background-color: #D50000;">
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-4 text-center text-slate-500">
                                No hay sucursales registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <div id="modalNuevoSucursal"
        class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
        <div class="absolute inset-0 bg-black/10"
            onclick="document.getElementById('modalNuevoSucursal').classList.add('hidden')">
        </div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-slate-800">
                    <i class="fa-solid fa-building text-slate-600"></i>
                    Nueva sucursal
                </h2>
                <button type="button" onclick="document.getElementById('modalNuevoSucursal').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('sucursal.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    {{-- Código de Sucursal --}}
                    <div class="md:col-span-3">
                        <label for="codigo_sucursal" class="block text-sm font-medium text-black mb-1">
                            Código de sucursal
                        </label>
                        <input type="text" id="codigo_sucursal" name="codigo_sucursal" maxlength="20" required placeholder="001"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>

                    {{-- Descripción --}}
                    <div class="md:col-span-5">
                        <label for="descripcion" class="block text-sm font-medium text-black mb-1">
                            Descripción
                        </label>
                        <input type="text" id="descripcion" name="descripcion" maxlength="150" required placeholder="Ej. Sucursal Principal"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>

                    {{-- País --}}
                    <div class="md:col-span-4">
                        <label for="pais" class="block text-sm font-medium text-black mb-1">
                            País
                        </label>
                        <input type="text" id="pais" name="pais" maxlength="100" placeholder="Ej. Perú"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4">
                    <div class="md:col-span-4">
                        <label for="departamento" class="block text-sm font-medium text-black mb-1">
                            Departamento
                        </label>
                        <select id="departamento" name="departamento" data-url="{{ route('ubigeo.departamentos') }}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="">Seleccione departamento</option>
                        </select>
                    </div>
                    <div class="md:col-span-4">
                        <label for="provincia" class="block text-sm font-medium text-black mb-1">
                            Provincia
                        </label>
                        <select id="provincia" name="provincia" data-url="{{ url('/ubigeo/provincias') }}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                            disabled>
                            <option value="">Seleccione provincia</option>
                        </select>
                    </div>

                    <div class="md:col-span-4">
                        <label for="distrito" class="block text-sm font-medium text-black mb-1">
                            Distrito
                        </label>
                        <select id="distrito" name="distrito" data-url="{{ url('/ubigeo/distritos') }}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                            disabled>
                            <option value="">Seleccione distrito</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4">
                    {{-- Dirección Fiscal --}}
                    <div class="md:col-span-6">
                        <label for="direccion_fiscal" class="block text-sm font-medium text-black mb-1">
                            Dirección Fiscal
                        </label>
                        <input type="text" id="direccion_fiscal" name="direccion_fiscal" maxlength="255" placeholder="Ej. Av. Principal 123"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>

                    {{-- Dirección Comercial --}}
                    <div class="md:col-span-6">
                        <label for="direccion_comercial" class="block text-sm font-medium text-black mb-1">
                            Dirección Comercial
                        </label>
                        <input type="text" id="direccion_comercial" name="direccion_comercial" maxlength="255" placeholder="Ej. Jr. Comercio 456"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4">
                    {{-- Teléfono --}}
                    <div class="md:col-span-4">
                        <label for="telefono" class="block text-sm font-medium text-black mb-1">
                            Teléfono
                        </label>
                        <input type="text" id="telefono" name="telefono" maxlength="30" placeholder="Ej. 999999999"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>

                    {{-- Correo de Contacto --}}
                    <div class="md:col-span-4">
                        <label for="correo_contacto" class="block text-sm font-medium text-black mb-1">
                            Correo de Contacto
                        </label>
                        <input type="email" id="correo_contacto" name="correo_contacto" maxlength="150" placeholder="Ej. contacto@empresa.com"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>

                    {{-- Dirección Web --}}
                    <div class="md:col-span-4">
                        <label for="direccion_web" class="block text-sm font-medium text-black mb-1">
                            Dirección Web
                        </label>
                        <input type="text" id="direccion_web" name="direccion_web" maxlength="255" placeholder="Ej. https://empresa.com"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4">
                    {{-- Información Adicional --}}
                    <div class="md:col-span-12">
                        <label for="informacion_adicional" class="block text-sm font-medium text-black mb-1">
                            Información Adicional
                        </label>
                        <textarea id="informacion_adicional" name="informacion_adicional" rows="2" placeholder="Detalles adicionales..."
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
                    </div>
                </div>
                
               <div class="md:col-span-4">
                    <label class="block text-sm font-medium text-black mb-2"> Estado</label>
                    <label class="inline-flex items-center cursor-pointer gap-3">
                        <input type="hidden" name="estado" value="INACTIVO">
                        <input type="checkbox" name="estado" value="ACTIVO" class="sr-only peer"checked>
                        <span class="text-sm font-medium text-slate-700">
                            No
                        </span>
                        <div class="relative w-11 h-6 bg-slate-300 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px]
                            after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#269ad5]">
                        </div>
                        <span class="text-sm font-medium text-black">
                            Sí
                        </span>
                    </label>
                </div>

                {{-- Botones --}}
                <div class="flex justify-end gap-3 mt-8">
                    <button type="button"
                        onclick="document.getElementById('modalNuevoSucursal').classList.add('hidden')"
                        class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-md bg-[#0407e2] hover:bg-[#0305b8] text-white text-sm font-semibold"
                       style="background-color: var(--active-pink);" >
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection


