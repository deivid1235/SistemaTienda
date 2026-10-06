@extends('layouts.admin.app')
@section('title', 'Configuración - Traslados')
@section('js')
@endsection
@section('content')

    <div class="flex items-center gap-2 text-sm mb-4">
        <a href="{{ route('configuracion.menu') }}"
        class="text-slate-400 hover:text-slate-700 flex items-center gap-1">
            <i class="fa-solid fa-house"></i>Dashboard</a>
        <span class="text-slate-400">/</span>
        <span class="text-slate-700 font-semibold flex items-center gap-1">
            <i class="fa-solid fa-gear"></i>Configuración
        </span>
    </div>

    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-solid fa-file-lines"></i>
        Listado de Tipos de documentos
    </h1>
        
    <div class="bg-white rounded-3xl shadow-md p-6">
        <div class="flex justify-end">
            <button type="button"
                onclick="document.getElementById('modalNuevoTipoDocumento').classList.remove('hidden')"
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
                        <th class="font-semibold">Descuenta stock</th>
                        <th class="font-semibold text-right">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($tipoDocumentos as $index => $tipoDocumento)
                        <tr class="border-b border-slate-100">
                            <td class="py-2 text-slate-600">{{ $index + 1 }}</td>
                            <td class="py-2 text-blue-800 font-medium">{{ $tipoDocumento->codigo }}</td>
                            <td class="py-2 text-slate-700">{{ $tipoDocumento->nombre }}</td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                    {{ $tipoDocumento->estado === 'ACTIVO' ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20'
                                        : 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20' }}">
                                    <span class="w-1.5 h-1.5 rounded-full
                                        {{ $tipoDocumento->estado === 'ACTIVO' ? 'bg-emerald-500' : 'bg-rose-500' }}">
                                    </span> {{ $tipoDocumento->estado }}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex justify-end gap-2">
                                    {{-- EDITAR --}}
                                    <button type="button" onclick="document.getElementById('modalEditarTipoDocumento{{ $tipoDocumento->id }}').classList.remove('hidden')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold" style="background-color: #64DD17;">
                                        Editar
                                    </button>
                                    {{-- MODAL EDITAR --}}
                                    <div id="modalEditarTipoDocumento{{ $tipoDocumento->id }}" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
                                        <div class="absolute inset-0 bg-black/10" onclick="document.getElementById('modalEditarTipoDocumento{{ $tipoDocumento->id }}').classList.add('hidden')">
                                        </div>
                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
                                            <div class="flex items-center justify-between mb-6">
                                                <h2 class="text-lg font-semibold text-slate-800">
                                                    <i class="fa-solid fa-file-lines text-slate-600"></i>
                                                    Editar Tipo de documento
                                                </h2>
                                                <button type="button" onclick="document.getElementById('modalEditarTipoDocumento{{ $tipoDocumento->id }}').classList.add('hidden')"
                                                    class="text-slate-400 hover:text-slate-600">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('configuracion.tipodocumento.update', $tipoDocumento->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                                    {{-- Código --}}
                                                    <div class="md:col-span-3">
                                                        <label for="codigo{{ $tipoDocumento->id }}" class="block text-sm font-medium text-black mb-1">Código</label>
                                                        <input type="text" id="codigo{{ $tipoDocumento->id }}" name="codigo" value="{{ $tipoDocumento->codigo }}" maxlength="10" required
                                                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>

                                                    {{-- Nombre --}}
                                                    <div class="md:col-span-9">
                                                        <label for="nombre{{ $tipoDocumento->id }}"class="block text-sm font-medium text-black mb-1">Nombre</label>
                                                        <input type="text" id="nombre{{ $tipoDocumento->id }}" name="nombre" value="{{ $tipoDocumento->nombre }}" maxlength="150" required
                                                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                                    {{-- Estado --}}
                                                    <div class="md:col-span-4">
                                                        <label class="block text-sm font-medium text-black mb-2">Estado</label>
                                                        <label class="inline-flex items-center cursor-pointer gap-3">
                                                            <input type="hidden" name="estado" value="INACTIVO">
                                                            <input type="checkbox" name="estado" value="ACTIVO" class="sr-only peer"
                                                                {{ $tipoDocumento->estado === 'ACTIVO' ? 'checked' : '' }}>
                                                            <span class="text-sm font-medium text-slate-700">
                                                                Inactivo
                                                            </span>
                                                            <div class="relative w-11 h-6 bg-slate-300 rounded-full
                                                                peer peer-checked:after:translate-x-full  after:content-[''] after:absolute
                                                                after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300
                                                                after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#269ad5]">
                                                            </div>
                                                            <span class="text-sm font-medium text-[#000000]">
                                                                Activo
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="flex justify-end gap-3 mt-8">
                                                    <button type="button" onclick="document.getElementById('modalEditarTipoDocumento{{ $tipoDocumento->id }}').classList.add('hidden')"
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
                                    <button type="button"
                                        onclick="confirmarEliminar('{{ route('configuracion.tipodocumento.destroy', $tipoDocumento->id) }}')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold"
                                        style="background-color: #D50000;">
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-slate-500">
                                No hay tipos de documentos registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

    <div id="modalNuevoTipoDocumento" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
        <div class="absolute inset-0 bg-black/10"onclick="document.getElementById('modalNuevoTipoDocumento').classList.add('hidden')"></div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-slate-800"><i class="fa-solid fa-circle-plus"></i>Nuevo Tipo de documento</h2>
                <button type="button" onclick="document.getElementById('modalNuevoTipoDocumento').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('configuracion.tipodocumento.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    {{-- Código --}}
                    <div class="md:col-span-3">
                        <label for="codigo" class="block text-sm font-medium text-black mb-1"> Código</label>
                        <input type="text" id="codigo" name="codigo" maxlength="10" required placeholder="01"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                    {{-- Nombre --}}
                    <div class="md:col-span-9">
                        <label for="nombre" class="block text-sm font-medium text-black mb-1">  Nombre</label>
                        <input type="text" id="nombre" name="nombre" maxlength="150" required placeholder="Ej. FACTURA ELECTRÓNICA"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                </div>
                <br>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    {{-- Estado --}}
                    <div class="md:col-span-4">
                        <label class="block text-sm font-medium text-black mb-2">Estado</label>
                        <label class="inline-flex items-center cursor-pointer gap-3">
                            <input type="hidden" name="estado" value="INACTIVO">
                            <input type="checkbox" name="estado" value="ACTIVO" class="sr-only peer" checked>
                            <span class="text-sm font-medium text-slate-700">
                                Inactivo
                            </span>
                            <div class="relative w-11 h-6 bg-slate-300 rounded-full
                                peer peer-checked:after:translate-x-full  after:content-[''] after:absolute
                                after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300
                                after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#269ad5]">
                            </div>
                            <span class="text-sm font-medium text-[#000000]">Activo</span>
                        </label>
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-8">
                    <button type="button" onclick="document.getElementById('modalNuevoTipoDocumento').classList.add('hidden')"
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
@endsection


