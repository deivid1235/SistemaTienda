@extends('layouts.admin.app')
@section('title', 'Configuración - Traslados')
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
        <i class="fa-solid fa-truck"></i>
        Listado de traslados
    </h1>
        

    <div class="bg-white rounded-3xl shadow-md p-6">
        <div class="flex justify-end">
            <button type="button"
                onclick="document.getElementById('modalNuevoTraslado').classList.remove('hidden')"
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
                    @forelse($traslados as $index => $traslado)
                        <tr class="border-b border-slate-100">
                            <td class="py-2 text-slate-600">{{ $index + 1 }}</td>
                            <td class="py-2 text-blue-800 font-medium">{{ $traslado->codigo }}</td>
                            <td class="py-2 text-slate-700">{{ $traslado->descripcion }}</td>
                            <td class="py-2">
                                @if($traslado->descuenta_stock === 'SI')
                                    <span class="text-green-600 font-semibold">
                                        Sí
                                    </span>
                                @else
                                    <span class="text-red-600 font-semibold">
                                        No
                                    </span>
                                @endif
                            </td>
                            <td class="py-2">
                                <div class="flex justify-end gap-2">
                                    <button type="button"
                                        onclick="document.getElementById('modalEditarTraslado{{ $traslado->id }}').classList.remove('hidden')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold"
                                        style="background-color: #64DD17;">
                                        Editar
                                    </button>

                                    {{-- MODAL EDITAR --}}
                                    <div id="modalEditarTraslado{{ $traslado->id }}"
                                        class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
                                        <div class="absolute inset-0 bg-black/10"
                                            onclick="document.getElementById('modalEditarTraslado{{ $traslado->id }}').classList.add('hidden')">
                                        </div>
                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
                                            <div class="flex items-center justify-between mb-6">
                                                <h2 class="text-lg font-semibold text-slate-800">
                                                    <i class="fa-solid fa-right-left text-slate-600"></i>
                                                    Editar Traslado
                                                </h2>
                                                <button type="button"
                                                    onclick="document.getElementById('modalEditarTraslado{{ $traslado->id }}').classList.add('hidden')"
                                                    class="text-slate-400 hover:text-slate-600">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('configuracion.traslado.update', $traslado->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                                    <div class="md:col-span-3">
                                                        <label for="codigo{{ $traslado->id }}"
                                                            class="block text-sm font-medium text-black mb-1">
                                                            Código
                                                        </label>
                                                        <input type="text" id="codigo{{ $traslado->id }}" name="codigo" value="{{ $traslado->codigo }}"  maxlength="20" required
                                                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>
                                                    {{-- Descripción --}}
                                                    <div class="md:col-span-5">
                                                        <label for="descripcion{{ $traslado->id }}"
                                                            class="block text-sm font-medium text-black mb-1">
                                                            Descripción
                                                        </label>
                                                        <input type="text" id="descripcion{{ $traslado->id }}"  name="descripcion" value="{{ $traslado->descripcion }}" maxlength="100" required
                                                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>
                                                    {{-- Descuenta stock --}}
                                                    <div class="md:col-span-4">
                                                        <label class="block text-sm font-medium text-black mb-2">
                                                            Descuenta stock
                                                        </label>
                                                        <label class="inline-flex items-center cursor-pointer gap-3">
                                                            <input type="hidden" name="descuenta_stock" value="NO">
                                                            <input type="checkbox" name="descuenta_stock" value="SI" class="sr-only peer" {{ $traslado->descuenta_stock === 'SI' ? 'checked' : '' }}>
                                                            <span class="text-sm font-medium text-slate-700">
                                                                No
                                                            </span>
                                                            <div class="relative w-11 h-6 bg-slate-300 rounded-full
                                                                peer
                                                                peer-checked:after:translate-x-full
                                                                after:content-['']
                                                                after:absolute
                                                                after:top-[2px]
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
                                                        onclick="document.getElementById('modalEditarTraslado{{ $traslado->id }}').classList.add('hidden')"
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
                                        onclick="confirmarEliminar('{{ route('configuracion.traslado.destroy', $traslado->id) }}')"
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
                                No hay traslados registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="modalNuevoTraslado"
        class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
        <div class="absolute inset-0 bg-black/10"
            onclick="document.getElementById('modalNuevoTraslado').classList.add('hidden')">
        </div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-slate-800">
                    <i class="fa-solid fa-circle-plus"></i>
                    Nuevo Traslado
                </h2>
                <button type="button"
                    onclick="document.getElementById('modalNuevoTraslado').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('configuracion.traslado.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-3">
                        <label for="codigo" class="block text-sm font-medium text-black mb-1">
                            Código
                        </label>
                        <input type="text" id="codigo" name="codigo" maxlength="20" required placeholder="TR001"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>

                    {{-- Descripción --}}
                    <div class="md:col-span-5">
                        <label for="descripcion" class="block text-sm font-medium text-black mb-1">
                            Descripción
                        </label>
                        <input type="text" id="descripcion" name="descripcion" maxlength="100" required placeholder="Ej. Traslado entre almacenes"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                    {{-- Descuenta stock --}}
                    <div class="md:col-span-4">
                        <label class="block text-sm font-medium text-black mb-2">
                            Descuenta stock
                        </label>
                        <label class="inline-flex items-center cursor-pointer gap-3">
                            <input type="hidden" name="descuenta_stock" value="NO">
                            <input type="checkbox" name="descuenta_stock" value="SI" class="sr-only peer">
                            <span class="text-sm font-medium text-slate-700">
                                No
                            </span>
                            <div class="relative w-11 h-6 bg-slate-300 rounded-full
                                peer
                                peer-checked:after:translate-x-full
                                after:content-['']
                                after:absolute
                                after:top-[2px]
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
                        onclick="document.getElementById('modalNuevoTraslado').classList.add('hidden')"
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


