@extends('layouts.admin.app')
@section('title', 'Tipo de cliente ')
@section('js')
@endsection
@section('content')
    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-solid fa-user-tag text-slate-600"></i>
        Listado de Tipos de Clientes
    </h1>

    <div class="bg-white rounded-3xl shadow-md p-6">
        <div class="flex justify-end">
            <button type="button" onclick="document.getElementById('modalNuevoTipoCliente').classList.remove('hidden')"
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
                        <th class="py-2 text-left">Nombre</th>
                        <th class="py-2 text-left">Estado</th>
                        <th class="py-2 text-left">Fecha</th>
                        <th class="font-semibold text-right">Acciones</th>
                    </tr>
                </thead>
               
                <tbody>
                    @forelse($tipoClientes as $index => $tipoCliente)
                        <tr class="border-b border-slate-100">
                            <td class="py-2 text-slate-600">{{ $index + 1 }}</td>
                            <td class="py-2 text-black font-medium">
                                <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md bg-sky-50 border border-sky-200">
                                    <span class="text-sky-500 text-xs">
                                        <i class="fa-solid fa-user-tag"></i>
                                    </span>
                                    <span class="text-xs font-semibold text-sky-900">
                                        {{ $tipoCliente->nombre }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                    {{ $tipoCliente->estado ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20' : 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20' }}">
                                    <span class="w-1.5 h-1.5 rounded-full
                                        {{ $tipoCliente->estado ? 'bg-emerald-500' : 'bg-rose-500' }}">
                                    </span>
                                    {{ $tipoCliente->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="py-2 text-slate-600">{{ $tipoCliente->created_at->format('d/m/Y') }}</td>
                            <td class="py-2">
                                <div class="flex justify-end gap-2">
                                    {{-- EDITAR --}}
                                    <button type="button" onclick="document.getElementById('modalEditarTipoCliente{{ $tipoCliente->id }}').classList.remove('hidden')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold" style="background-color: #64DD17;">
                                        Editar
                                    </button>
                                    {{-- MODAL EDITAR --}}
                                    <div id="modalEditarTipoCliente{{ $tipoCliente->id }}" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
                                        <div class="absolute inset-0 bg-black/10"
                                            onclick="document.getElementById('modalEditarTipoCliente{{ $tipoCliente->id }}').classList.add('hidden')">
                                        </div>
                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
                                            <div class="flex items-center justify-between mb-6">
                                                <h2 class="text-lg font-semibold text-slate-800">
                                                    <i class="fa-solid fa-tags text-slate-600"></i>
                                                    Editar Tipo de Cliente
                                                </h2>
                                                <button type="button" onclick="document.getElementById('modalEditarTipoCliente{{ $tipoCliente->id }}').classList.add('hidden')"
                                                    class="text-slate-400 hover:text-slate-600">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('tipocliente.update', $tipoCliente->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="flex flex-col gap-4">
                                                    {{-- Nombre --}}
                                                    <div class="w-full">
                                                        <label for="nombre_tipo_cliente{{ $tipoCliente->id }}"
                                                            class="block text-sm font-medium text-black mb-1">
                                                            Nombre
                                                        </label>
                                                        <input type="text"  id="nombre_tipo_cliente{{ $tipoCliente->id }}"
                                                            name="nombre" value="{{ old('nombre', $tipoCliente->nombre) }}"
                                                            maxlength="100" required
                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                                                            placeholder="Ej. Corporativo, Minorista...">
                                                    </div>
                                                </div>

                                                {{-- Estado (Booleano) --}}
                                                <div class="mt-4">
                                                    <label class="block text-sm font-medium text-black mb-2">
                                                        Estado
                                                    </label>
                                                    <label class="inline-flex items-center cursor-pointer gap-3">
                                                        <input type="hidden" name="estado" value="0">
                                                        <input type="checkbox" name="estado" value="1" class="sr-only peer" {{ $tipoCliente->estado ? 'checked' : '' }}>
                                                        <span class="text-sm font-medium text-slate-700">Inactivo</span>
                                                        <div class="relative w-11 h-6 bg-slate-300 rounded-full peer
                                                            peer-checked:after:translate-x-full after:content-['']
                                                            after:absolute after:top-[2px] after:left-[2px] after:bg-white
                                                            after:border-slate-300 after:border after:rounded-full after:h-5
                                                            after:w-5 after:transition-all peer-checked:bg-[#269ad5]">
                                                        </div>
                                                        <span class="text-sm font-medium text-[#000000]">
                                                            Activo
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="flex justify-end gap-3 mt-8">
                                                    <button type="button"
                                                        onclick="document.getElementById('modalEditarTipoCliente{{ $tipoCliente->id }}').classList.add('hidden')"
                                                        class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                                                        Cancelar
                                                    </button>
                                                    <button type="submit"
                                                        class="px-4 py-2 rounded-md text-white text-sm font-semibold"
                                                        style="background-color: var(--active-pink);">
                                                        Actualizar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- ELIMINAR --}}
                                    <button type="button" onclick="confirmarEliminar('{{ route('tipocliente.destroy', $tipoCliente->id) }}')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold"
                                        style="background-color: #D50000;">
                                        Eliminar
                                    </button>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-slate-500">
                                No hay tipos de clientes registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

    <div id="modalNuevoTipoCliente" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
        <div class="absolute inset-0 bg-black/10"
            onclick="document.getElementById('modalNuevoTipoCliente').classList.add('hidden')">
        </div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-slate-800">
                    <i class="fa-solid fa-tags text-slate-600"></i>
                    Nuevo Tipo de Cliente
                </h2>
                <button type="button"
                    onclick="document.getElementById('modalNuevoTipoCliente').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('tipocliente.store') }}" method="POST">
                @csrf
                <div class="flex flex-col gap-4">
                    {{-- Nombre del Tipo de Cliente --}}
                    <div class="w-full">
                        <label for="nombre_tipo_cliente" class="block text-sm font-medium text-black mb-1">
                            Nombre
                        </label>
                        <input type="text" id="nombre_tipo_cliente" name="nombre" maxlength="100" required
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        placeholder="Ej. Corporativo, Minorista...">
                    </div>
                </div>
                {{-- Estado (Booleano) --}}
                <div class="mt-4">
                    <label class="block text-sm font-medium text-black mb-2">
                        Estado
                    </label>
                    <label class="inline-flex items-center cursor-pointer gap-3">
                        <input type="hidden" name="estado" value="0">
                        <input type="checkbox" name="estado" value="1" class="sr-only peer" checked>
                        <span class="text-sm font-medium text-slate-700">Inactivo</span>
                        <div class="relative w-11 h-6 bg-slate-300 rounded-full peer
                            peer-checked:after:translate-x-full after:content-['']
                            after:absolute after:top-[2px] after:left-[2px] after:bg-white
                            after:border-slate-300 after:border after:rounded-full after:h-5
                            after:w-5 after:transition-all peer-checked:bg-[#269ad5]">
                        </div>
                        <span class="text-sm font-medium text-[#000000]">
                            Activo
                        </span>
                    </label>
                </div>

                <div class="flex justify-end gap-3 mt-8">
                    <button type="button"
                        onclick="document.getElementById('modalNuevoTipoCliente').classList.add('hidden')"
                        class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-md text-white text-sm font-semibold"
                    style="background-color: var(--active-pink);">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection


