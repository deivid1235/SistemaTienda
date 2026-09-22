@extends('layouts.admin.app')
@section('title', 'Plataformas')
@section('js')
@endsection
@section('content')
    <div class="flex items-center gap-2 text-sm mb-4">
        <a href="{{ route('configuracion') }}"
           class="text-slate-400 hover:text-slate-700 flex items-center gap-1">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>
        <span class="text-slate-400">/</span>
        <span class="text-slate-700 font-semibold flex items-center gap-1">
            <i class="fa-solid fa-gear"></i>
            Configuración
        </span>
    </div>

    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-solid fa-layer-group text-slate-600"></i>
        Listado de plataformas
    </h1>


    <div class="bg-white rounded-3xl shadow-md p-4 sm:p-6">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[700px] text-left text-sm">
                <thead>
                    <tr class="border-b border-slate-200 text-black">
                        <th class="py-2 font-semibold w-16">#</th>
                        <th class="py-2 font-semibold">Nombre</th>
                        <th class="py-2 font-semibold">Estado</th>
                        <th class="py-2 font-semibold text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($plataformas as $index => $plataforma)
                        <tr class="border-b border-slate-100">
                            <td class="py-2 text-slate-600">{{ $index + 1 }}</td>
                            <td class="py-2 text-black font-medium">{{ $plataforma->nombre }}</td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                    {{ $plataforma->estado === 'Si' || $plataforma->estado === 'Sí' 
                                        ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20' 
                                        : 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20' }}"> 
                                    <!-- Punto indicador -->
                                    <span class="w-1.5 h-1.5 rounded-full {{ $plataforma->estado === 'Si' || $plataforma->estado === 'Sí' ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                    
                                    {{ $plataforma->estado }}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex justify-end gap-2 whitespace-nowrap">
                                    <button type="button"
                                        onclick="document.getElementById('modalEditarPlataforma{{ $plataforma->id }}').classList.remove('hidden')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold"
                                        style="background-color: #64DD17;">
                                        Editar
                                    </button>

                                    {{-- MODAL EDITAR --}}
                                    <div id="modalEditarPlataforma{{ $plataforma->id }}"
                                        class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
                                        <div class="absolute inset-0 bg-black/10"
                                            onclick="document.getElementById('modalEditarPlataforma{{ $plataforma->id }}').classList.add('hidden')">
                                        </div>
                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
                                            <div class="flex items-center justify-between mb-6">
                                                <h2 class="text-lg font-semibold text-slate-800">
                                                    <i class="fa-solid fa-layer-group text-slate-600"></i>
                                                    Editar Plataforma
                                                </h2>
                                                <button type="button"
                                                    onclick="document.getElementById('modalEditarPlataforma{{ $plataforma->id }}').classList.add('hidden')"
                                                    class="text-slate-400 hover:text-slate-600">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('configuracion.plataforma.update', $plataforma->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="flex flex-col md:flex-row gap-4">
                                                    {{-- Nombre --}}
                                                    <div class="flex-1">
                                                        <label for="nombre{{ $plataforma->id }}"class="block text-sm font-medium text-black mb-1">
                                                            Nombre
                                                        </label>
                                                        <input type="text" id="nombre{{ $plataforma->id }}" name="nombre" value="{{ $plataforma->nombre }}"
                                                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>
                                                    {{-- Estado --}}
                                                    <div class="flex-1">
                                                        <label class="block text-sm font-medium text-black mb-2">
                                                            Activo
                                                        </label>
                                                        <label class="inline-flex items-center cursor-pointer gap-3">
                                                            <input type="hidden" name="estado" value="No">
                                                            <input type="checkbox" name="estado" value="Si"
                                                                class="sr-only peer"
                                                                {{ $plataforma->estado == 'Si' ? 'checked' : '' }}>
                                                            <span class="text-sm font-medium text-slate-700">
                                                                No
                                                            </span>
                                                            <div class="relative w-11 h-6 bg-slate-300 rounded-full
                                                                peer peer-checked:after:translate-x-full
                                                                after:content-['']
                                                                after:absolute after:top-[2px]
                                                                after:left-[2px]
                                                                after:bg-white
                                                                after:border-slate-300
                                                                after:border
                                                                after:rounded-full
                                                                after:h-5
                                                                after:w-5
                                                                after:transition-all
                                                                peer-checked:bg-[#269ad5]">
                                                            </div>
                                                            <span class="text-sm font-medium text-[#000000]">
                                                                Sí
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="flex justify-end gap-3 mt-8">
                                                    <button type="button"
                                                        onclick="document.getElementById('modalEditarPlataforma{{ $plataforma->id }}').classList.add('hidden')"
                                                        class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                                                        Cancelar
                                                    </button>
                                                    <button type="submit" class="px-4 py-2 rounded-md bg-[#0407e2] hover:bg-[#0305b8] text-white text-sm font-semibold"
                                                    style="background-color: var(--active-pink);" >
                                                        Actualizar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <button type="button"
                                        onclick="confirmarEliminar('{{ route('configuracion.plataforma.destroy', $plataforma->id) }}')"
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
                                No hay plataformas registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <button type="button"
            onclick="document.getElementById('modalNuevoPlataforma').classList.remove('hidden')"
            class="mt-6 inline-flex items-center gap-2 px-4 py-2 rounded-md bg-[#0407e2] hover:bg-[#0305b8] text-white text-sm font-semibold"
            style="background-color: var(--active-pink);" >
            <i class="fa-solid fa-circle-plus"></i>
            Nuevo
        </button>

    </div>

    <div id="modalNuevoPlataforma" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
        <div class="absolute inset-0 bg-black/10"
            onclick="document.getElementById('modalNuevoPlataforma').classList.add('hidden')">
        </div>
        <!-- MODIFICADO: Cambiado de max-w-2xl a max-w-3xl para que tenga el mismo tamaño ancho -->
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-slate-800">
                    <i class="fa-solid fa-layer-group text-slate-600"></i>
                    Nueva Plataforma
                </h2>
                <button type="button" onclick="document.getElementById('modalNuevoPlataforma').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('configuracion.plataforma.store') }}" method="POST">
                @csrf
                
                <!-- Contenedor en una sola fila (Grid de 2 columnas) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end">
                    <!-- Nombre -->
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-black mb-1">
                            Nombre
                        </label>
                        <input type="text" id="nombre" name="nombre" class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                    
                    <!-- Estado -->
                    <div>
                        <label class="block text-sm font-medium text-black mb-2">
                            Activo
                        </label>
                        <label class="inline-flex items-center cursor-pointer gap-3.5">
                            <input type="hidden" name="estado" value="No">
                            <input type="checkbox" name="estado" value="Si" class="sr-only peer" checked>
                            <span class="text-sm font-medium text-slate-700 mr-0.5">
                                No
                            </span>
                            <div class="relative w-11 h-6 bg-slate-300 rounded-full
                                peer peer-checked:after:translate-x-full
                                after:content-['']
                                after:absolute after:top-[2px]
                                after:left-[2px]
                                after:bg-white
                                after:border-slate-300
                                after:border
                                after:rounded-full
                                after:h-5
                                after:w-5
                                after:transition-all
                                peer-checked:bg-[#269ad5]">
                            </div>
                            <span class="text-sm font-medium text-black ml-0.5">
                                Sí
                            </span>
                        </label>
                    </div>
                </div>

                <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 mt-8">
                    <button type="button"
                        onclick="document.getElementById('modalNuevoPlataforma').classList.add('hidden')"
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



