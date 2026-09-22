@extends('layouts.admin.app')
@section('title', 'Motivos de gastos - Motivos de ingresos')
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
        <i class="fa-solid fa-file-invoice-dollar text-slate-600"></i>
        Motivos de gastos 
    </h1>

    <div class="bg-white rounded-3xl shadow-md p-6">
        <div class="flex justify-end mb-4">
            <button type="button"
                onclick="document.getElementById('modalNuevoMotivoGasto').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-[#0407e2] hover:bg-[#0305b8] text-white text-sm font-semibold"
                style="background-color: var(--active-pink);">
                <i class="fa-solid fa-circle-plus"></i>
                Nuevo
            </button>
        </div>

        {{-- Tabla de motivos de gasto --}}
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-base font-semibold text-slate-700 flex items-center gap-2">
                <i class="fa-solid fa-file-invoice-dollar text-slate-600"></i>
                Motivos de gastos
            </h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full min-w-[750px] text-left text-sm">
                <thead>
                    <tr class="border-b border-slate-200 text-black">
                        <th class="font-semibold w-16">#</th>
                        <th class="font-semibold">Descripción</th>
                        <th class="font-semibold">Estado</th>
                        <th class="font-semibold text-right">Acciones</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse($motivosGasto as $index => $motivo)
                        <tr class="border-b border-slate-100">
                            <td class="py-2 text-slate-600">{{ $index + 1 }}</td>
                            <td class="py-2 text-black font-medium"> {{ $motivo->descripcion }}</td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                    {{ $motivo->estado === 'ACTIVO' 
                                        ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20' 
                                        : 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $motivo->estado === 'ACTIVO' ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                    {{ $motivo->estado }}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex justify-end gap-2">
                                    <button type="button" onclick="document.getElementById('modalEditarMotivoGasto{{ $motivo->id }}').classList.remove('hidden')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold" style="background-color: #64DD17;">
                                        Editar
                                    </button>
                                    
                                    {{-- MODAL EDITAR --}}
                                    <div id="modalEditarMotivoGasto{{ $motivo->id }}"
                                        class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-24">
                                        <div class="absolute inset-0 bg-black/10"
                                            onclick="document.getElementById('modalEditarMotivoGasto{{ $motivo->id }}').classList.add('hidden')">
                                        </div>
                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-4 p-6">
                                            <div class="flex items-center justify-between mb-6">
                                                <h2 class="text-lg font-semibold text-slate-800"><i class="fa-solid fa-file-invoice-dollar text-slate-600"></i>
                                                    Editar Motivo de Gasto
                                                </h2>
                                                <button type="button"
                                                    onclick="document.getElementById('modalEditarMotivoGasto{{ $motivo->id }}').classList.add('hidden')"
                                                    class="text-slate-400 hover:text-slate-600">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>

                                            <form action="{{ route('configuracion.motivogasto.update', $motivo->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end">
                                                    <div>
                                                        <label for="descripcion{{ $motivo->id }}" class="block text-sm font-medium text-black mb-1">
                                                            Descripción
                                                        </label>
                                                        <input type="text" id="descripcion{{ $motivo->id }}"
                                                            name="descripcion" value="{{ $motivo->descripcion }}" maxlength="150"
                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-black mb-2">
                                                            Estado
                                                        </label>
                                                        <label class="inline-flex items-center cursor-pointer gap-3">
                                                            <input type="hidden" name="estado" value="INACTIVO">
                                                            <input type="checkbox" name="estado" value="ACTIVO" class="sr-only peer"
                                                            {{ $motivo->estado === 'ACTIVO' ? 'checked' : '' }}>
                                                            <span class="text-sm font-medium text-slate-700">
                                                                Inactivo
                                                            </span>
                                                            <div class="relative w-11 h-6 bg-slate-300 rounded-full peer
                                                                peer-checked:after:translate-x-full after:content-['']
                                                                after:absolute after:top-[2px]
                                                                after:left-[2px] after:bg-white
                                                                after:border-slate-300 after:border
                                                                after:rounded-full after:h-5
                                                                after:w-5 after:transition-all peer-checked:bg-[#269ad5]">
                                                            </div>
                                                            <span class="text-sm font-medium text-black">
                                                                Activo
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="flex justify-end gap-3 mt-8">
                                                    <button type="button"
                                                        onclick="document.getElementById('modalEditarMotivoGasto{{ $motivo->id }}').classList.add('hidden')"
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

                                    {{-- ELIMINAR --}}
                                    <button type="button"
                                        onclick="confirmarEliminar('{{ route('configuracion.motivogasto.destroy', $motivo->id) }}')"
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
                                No hay motivos de gasto registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
   
    <!-- MODAL NUEVO -->
    <div id="modalNuevoMotivoGasto"
        class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-24">
        <div class="absolute inset-0 bg-black/10" onclick="document.getElementById('modalNuevoMotivoGasto').classList.add('hidden')">
        </div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-4 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-slate-800">
                    <i class="fa-solid fa-file-invoice-dollar text-slate-600"></i>
                    Nuevo Motivo de Gasto
                </h2>
                <button type="button"
                    onclick="document.getElementById('modalNuevoMotivoGasto').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('configuracion.motivogasto.store') }}"
                method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end">
                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-black mb-1">Descripción</label>
                        <input type="text" id="descripcion" name="descripcion" maxlength="150"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-black mb-2">Estado</label>
                        <label class="inline-flex items-center cursor-pointer gap-3">
                            <input type="hidden" name="estado" value="INACTIVO">
                            <input type="checkbox" name="estado" value="ACTIVO" class="sr-only peer" checked>
                            <span class="text-sm font-medium text-slate-700">
                                Inactivo
                            </span>
                            <div class="relative w-11 h-6 bg-slate-300 rounded-full peer
                                peer-checked:after:translate-x-full after:content-['']
                                after:absolute after:top-[2px] after:left-[2px]
                                after:bg-white after:border-slate-300
                                after:border after:rounded-full
                                after:h-5 after:w-5
                                after:transition-all peer-checked:bg-[#269ad5]">
                            </div>
                            <span class="text-sm font-medium text-black">
                                Activo
                            </span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-8">
                    <button type="button"
                        onclick="document.getElementById('modalNuevoMotivoGasto').classList.add('hidden')"
                        class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit" 
                        class="px-4 py-2 rounded-md bg-[#0407e2] hover:bg-[#0305b8] text-white text-sm font-semibold"
                        style="background-color: var(--active-pink);">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MOTIVO DE INGRESOS -->
    <br>
    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-solid fa-money-bill-trend-up text-slate-600"></i>
        Motivos de ingresos
    </h1>

   <div class="bg-white rounded-3xl shadow-md p-6">
        <div class="flex justify-end mb-4">
            <button type="button"
                onclick="document.getElementById('modalNuevoMotivoIngreso').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-[#0407e2] hover:bg-[#0305b8] text-white text-sm font-semibold"
                style="background-color: var(--active-pink);">
                <i class="fa-solid fa-circle-plus"></i>
                Nuevo
            </button>
        </div>

        {{-- Tabla de motivos de gasto --}}
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-base font-semibold text-slate-700 flex items-center gap-2">
                <i class="fa-solid fa-file-invoice-dollar text-slate-600"></i>
                Motivos de gastos
            </h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full min-w-[750px] text-left text-sm">
                <thead>
                    <tr class="border-b border-slate-200 text-black">
                        <th class="font-semibold w-16">#</th>
                        <th class="font-semibold">Descripción</th>
                        <th class="font-semibold">Estado</th>
                        <th class="font-semibold text-right">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($motivosIngreso as $index => $motivoIngreso)
                        <tr class="border-b border-slate-100">
                            <td class="py-2 text-slate-600">{{ $index + 1 }}</td>
                            <td class="py-2 text-black font-medium">{{ $motivoIngreso->descripcion }}</td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                    {{ $motivoIngreso->estado === 'ACTIVO'
                                        ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20'
                                        : 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20' }}">
                                    <span class="w-1.5 h-1.5 rounded-full
                                        {{ $motivoIngreso->estado === 'ACTIVO' ? 'bg-emerald-500' : 'bg-rose-500' }}">
                                    </span>
                                    {{ $motivoIngreso->estado }}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex justify-end gap-2">
                                    <button type="button" onclick="document.getElementById('modalEditarMotivoIngreso{{ $motivoIngreso->id }}').classList.remove('hidden')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold" style="background-color: #64DD17;">
                                        Editar
                                    </button>
                                    <div id="modalEditarMotivoIngreso{{ $motivoIngreso->id }}"
                                        class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-24">
                                        <div class="absolute inset-0 bg-black/10"
                                            onclick="document.getElementById('modalEditarMotivoIngreso{{ $motivoIngreso->id }}').classList.add('hidden')">
                                        </div>
                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-4 p-6">
                                            <div class="flex items-center justify-between mb-6">
                                                <h2 class="text-lg font-semibold text-slate-800">
                                                    <i class="fa-solid fa-money-bill-trend-up text-slate-600"></i>
                                                    Editar Motivo de Ingreso
                                                </h2>
                                                <button type="button"
                                                    onclick="document.getElementById('modalEditarMotivoIngreso{{ $motivoIngreso->id }}').classList.add('hidden')"
                                                    class="text-slate-400 hover:text-slate-600">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('configuracion.motivoingreso.update', $motivoIngreso->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end">
                                                    <div>
                                                        <label for="descripcionIngreso{{ $motivoIngreso->id }}" class="block text-sm font-medium text-black mb-1">
                                                            Descripción
                                                        </label>
                                                        <input type="text" id="descripcionIngreso{{ $motivoIngreso->id }}" name="descripcion"
                                                            value="{{ $motivoIngreso->descripcion }}" maxlength="150"
                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-black mb-2">Estado</label>
                                                        <label class="inline-flex items-center cursor-pointer gap-3">
                                                            <input type="hidden" name="estado" value="INACTIVO">
                                                            <input type="checkbox" name="estado" value="ACTIVO" class="sr-only peer"
                                                            {{ $motivoIngreso->estado === 'ACTIVO' ? 'checked' : '' }}>
                                                            <span class="text-sm font-medium text-slate-700">
                                                                Inactivo
                                                            </span>
                                                            <div class="relative w-11 h-6 bg-slate-300 rounded-full peer
                                                                peer-checked:after:translate-x-full after:content-['']
                                                                after:absolute after:top-[2px]
                                                                after:left-[2px] after:bg-white
                                                                after:border-slate-300 after:border
                                                                after:rounded-full after:h-5
                                                                after:w-5 after:transition-all peer-checked:bg-[#269ad5]">
                                                            </div>
                                                            <span class="text-sm font-medium text-black">
                                                                Activo
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="flex justify-end gap-3 mt-8">
                                                    <button type="button" onclick="document.getElementById('modalEditarMotivoIngreso{{ $motivoIngreso->id }}').classList.add('hidden')"
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
                                    <button type="button" onclick="confirmarEliminar('{{ route('configuracion.motivoingreso.destroy', $motivoIngreso->id) }}')"
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
                                No hay motivos de ingreso registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

     <!-- MODAL NUEVO -->
    <div id="modalNuevoMotivoIngreso" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-24">
        <div class="absolute inset-0 bg-black/10" onclick="document.getElementById('modalNuevoMotivoIngreso').classList.add('hidden')">
        </div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-4 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-slate-800">
                    <i class="fa-solid fa-money-bill-trend-up text-slate-600"></i>
                    Nuevo Motivo de ingreso
                </h2>
                <button type="button"
                    onclick="document.getElementById('modalNuevoMotivoIngreso').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('configuracion.motivoingreso.store') }}"
                method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end">
                    <div>
                        <label for="descripcion" class="block text-sm font-medium text-black mb-1">Descripción</label>
                        <input type="text" id="descripcion" name="descripcion" maxlength="150"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-black mb-2">Estado</label>
                        <label class="inline-flex items-center cursor-pointer gap-3">
                            <input type="hidden" name="estado" value="INACTIVO">
                            <input type="checkbox" name="estado" value="ACTIVO" class="sr-only peer" checked>
                            <span class="text-sm font-medium text-slate-700">
                                Inactivo
                            </span>
                            <div class="relative w-11 h-6 bg-slate-300 rounded-full peer
                                peer-checked:after:translate-x-full after:content-['']
                                after:absolute after:top-[2px] after:left-[2px]
                                after:bg-white after:border-slate-300
                                after:border after:rounded-full
                                after:h-5 after:w-5
                                after:transition-all peer-checked:bg-[#269ad5]">
                            </div>
                            <span class="text-sm font-medium text-black">
                                Activo
                            </span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-8">
                    <button type="button"
                        onclick="document.getElementById('modalNuevoMotivoIngreso').classList.add('hidden')"
                        class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit" 
                        class="px-4 py-2 rounded-md bg-[#0407e2] hover:bg-[#0305b8] text-white text-sm font-semibold"
                        style="background-color: var(--active-pink);">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>


@endsection