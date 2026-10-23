@extends('layouts.admin.app')
@section('title', 'Configuración - Atributos')
@section('js')
@endsection
@section('content')

    <div class="flex items-center gap-2 text-sm mb-4">
        <a href="{{ route('configuracion') }}"
        class="text-slate-400 hover:text-slate-700 flex items-center gap-1">
            <i class="fa-solid fa-house"></i>Dashboard</a>
        <span class="text-slate-400">/</span>
        <span class="text-slate-700 font-semibold flex items-center gap-1">
            <i class="fa-solid fa-gear"></i>Configuración
        </span>
    </div>
    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-solid fa-file-invoice-dollar text-slate-600"></i>
        Listado de Tipos de Afectación del IGV
    </h1>
        

    <div class="bg-white rounded-3xl shadow-md p-6">
        <div class="flex justify-end">
            <button type="button"
                onclick="document.getElementById('modalNuevoTipoAfectacionIgv').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-[#0407e2] hover:bg-[#0305b8] text-white text-sm font-semibold"
                style="background-color: var(--active-pink);" >
                <i class="fa-solid fa-circle-plus"></i>
                Nuevo
            </button>
        </div>
        
        <div class="overflow-x-auto mt-4">
             <table class="w-full min-w-[1000px] table-auto border-collapse text-left text-xs sm:text-sm">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-100 text-left text-sm text-slate-700">
                        <th class="whitespace-nowrap px-4 py-4 font-bold w-16">#</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Código</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Descripción</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Estado</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tiposAfectacionIgv as $index => $tipoAfectacionIgv)
                        <tr class="border-b border-slate-100">
                            <td class="whitespace-nowrap px-4 py-4 text-slate-600">{{ $index + 1 }}</td>
                            <td class="whitespace-nowrap px-4 py-4 text-black font-medium">{{ $tipoAfectacionIgv->codigo }}</td>
                            <td class="whitespace-nowrap px-4 py-4 text-black font-medium">{{ $tipoAfectacionIgv->nombre }}</td>
                            <td class="whitespace-nowrap px-4 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                    {{ $tipoAfectacionIgv->activo ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20' : 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20' }}">
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75
                                            {{ $tipoAfectacionIgv->activo ? 'bg-emerald-400' : 'bg-rose-400' }}"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2
                                            {{ $tipoAfectacionIgv->activo ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                    </span>
                                    {{ $tipoAfectacionIgv->activo ? 'Sí' : 'No' }}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex justify-end gap-2">
                                    {{-- EDITAR --}}
                                    <button type="button" onclick="document.getElementById('modalEditarTipoAfectacionIgv{{ $tipoAfectacionIgv->id }}').classList.remove('hidden')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold"
                                        style="background-color: #64DD17;">
                                        Editar
                                    </button>
                                    {{-- Modal Editar Tipo de Afectación del IGV --}}
                                    <div id="modalEditarTipoAfectacionIgv{{ $tipoAfectacionIgv->id }}" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
                                        <div class="absolute inset-0 bg-black/10"
                                            onclick="document.getElementById('modalEditarTipoAfectacionIgv{{ $tipoAfectacionIgv->id }}').classList.add('hidden')">
                                        </div>
                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
                                            <div class="flex items-center justify-between mb-6">
                                                <h2 class="text-lg font-semibold text-slate-800">
                                                    <i class="fa-solid fa-file-invoice-dollar text-slate-600"></i>Editar Tipo de Afectación del IGV
                                                </h2>
                                                <button type="button" onclick="document.getElementById('modalEditarTipoAfectacionIgv{{ $tipoAfectacionIgv->id }}').classList.add('hidden')"
                                                    class="text-slate-400 hover:text-slate-600">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('configuracion.tipoafectacionigv.update', $tipoAfectacionIgv->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    <div>
                                                        <label for="codigo_tipo_igv{{ $tipoAfectacionIgv->id }}" class="block text-sm font-medium text-black mb-1">
                                                            Código SUNAT
                                                        </label>
                                                        <input type="text" id="codigo_tipo_igv{{ $tipoAfectacionIgv->id }}" name="codigo" value="{{ $tipoAfectacionIgv->codigo }}" required
                                                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>
                                                    {{-- Nombre --}}
                                                    <div>
                                                        <label for="nombre_tipo_igv{{ $tipoAfectacionIgv->id }}" class="block text-sm font-medium text-black mb-1"> Nombre</label>
                                                        <input type="text" id="nombre_tipo_igv{{ $tipoAfectacionIgv->id }}" name="nombre" value="{{ $tipoAfectacionIgv->nombre }}" maxlength="100" required
                                                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>
                                                    {{-- Descripción --}}
                                                    <div>
                                                        <label for="descripcion_tipo_igv{{ $tipoAfectacionIgv->id }}" class="block text-sm font-medium text-black mb-1">Descripción</label>
                                                        <textarea  id="descripcion_tipo_igv{{ $tipoAfectacionIgv->id }}" name="descripcion" rows="2" placeholder="Descripción adicional (opcional)"
                                                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">{{ $tipoAfectacionIgv->descripcion }}</textarea>
                                                    </div>
                                                    {{-- Estado --}}
                                                    <div class="mt-4">
                                                        <label class="block text-sm font-medium text-black mb-2">Estado</label>
                                                        <label class="inline-flex items-center cursor-pointer gap-3">
                                                            <input type="hidden" name="estado" value="0">
                                                            <input type="checkbox" name="estado" value="1" class="sr-only peer"
                                                                {{ $tipoAfectacionIgv->activo ? 'checked' : '' }}>

                                                            <span class="text-sm font-medium text-slate-700">No</span>

                                                            <div class="relative w-11 h-6 bg-slate-300 rounded-full peer
                                                                peer-checked:after:translate-x-full after:content-['']
                                                                after:absolute after:top-[2px] after:left-[2px]
                                                                after:bg-white after:border-slate-300 after:border
                                                                after:rounded-full after:h-5 after:w-5 after:transition-all
                                                                peer-checked:bg-[#269ad5]">
                                                            </div>

                                                            <span class="text-sm font-medium text-black">Sí</span>
                                                        </label>
                                                    </div>

                                                </div>

                                                {{-- Botones --}}
                                                <div class="flex justify-end gap-3 mt-8">
                                                    <button type="button"
                                                        onclick="document.getElementById('modalEditarTipoAfectacionIgv{{ $tipoAfectacionIgv->id }}').classList.add('hidden')"
                                                        class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                                                        Cancelar
                                                    </button>

                                                    <button type="submit"
                                                        class="px-4 py-2 rounded-md text-white text-sm font-semibold"
                                                        style="background-color: var(--active-pink);">
                                                        <i class="fa-solid fa-floppy-disk mr-1"></i>
                                                        Actualizar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- ELIMINAR --}}
                                    <button type="button" onclick="confirmarEliminar('{{ route('configuracion.tipoafectacionigv.destroy', $tipoAfectacionIgv->id) }}')"
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
                                No hay tipos de afectación del IGV registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="modalNuevoTipoAfectacionIgv" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
        <div class="absolute inset-0 bg-black/10"
            onclick="document.getElementById('modalNuevoTipoAfectacionIgv').classList.add('hidden')">
        </div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-slate-800">
                    <i class="fa-solid fa-file-invoice-dollar text-slate-600"></i>
                    Nuevo Tipo de Afectación del IGV
                </h2>
                <button type="button"
                    onclick="document.getElementById('modalNuevoTipoAfectacionIgv').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('configuracion.tipoafectacionigv.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="codigo_tipo_igv" class="block text-sm font-medium text-black mb-1">Código SUNAT</label>
                        <input type="text" id="codigo_tipo_igv" name="codigo"placeholder="Ej. 10" required
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                    {{-- Nombre --}}
                    <div>
                        <label for="nombre_tipo_igv" class="block text-sm font-medium text-black mb-1">Nombre</label>
                        <input type="text" id="nombre_tipo_igv" name="nombre" maxlength="100" placeholder="Ej. Gravado - Operación onerosa" required
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                    {{-- Descripción --}}
                    <div>
                        <label for="descripcion_tipo_igv" class="block text-sm font-medium text-black mb-1">Descripción</label>
                        <textarea id="descripcion_tipo_igv" name="descripcion" rows="2"placeholder="Descripción adicional (opcional)"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
                    </div>
                    {{-- Estado --}}
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-black mb-2">Estado</label>
                        <label class="inline-flex items-center cursor-pointer gap-3">
                            <input type="hidden" name="estado" value="0">
                            <input type="checkbox" name="estado" value="1"class="sr-only peer" checked>
                            <span class="text-sm font-medium text-slate-700">No</span>
                            <div class="relative w-11 h-6 bg-slate-300 rounded-full peer
                                peer-checked:after:translate-x-full after:content-['']
                                after:absolute after:top-[2px] after:left-[2px]
                                after:bg-white after:border-slate-300 after:border
                                after:rounded-full after:h-5 after:w-5 after:transition-all
                                peer-checked:bg-[#269ad5]">
                            </div>
                            <span class="text-sm font-medium text-black">Sí</span>
                        </label>
                    </div>
                </div>
                {{-- Botones --}}
                <div class="flex justify-end gap-3 mt-8">
                    <button type="button"  onclick="document.getElementById('modalNuevoTipoAfectacionIgv').classList.add('hidden')"
                        class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-md text-white text-sm font-semibold"
                        style="background-color: var(--active-pink);">
                        <i class="fa-solid fa-floppy-disk mr-1"></i>
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>


@endsection


