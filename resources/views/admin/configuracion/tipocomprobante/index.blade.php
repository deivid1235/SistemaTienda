@extends('layouts.admin.app')
@section('title', 'Tipos de comprobantes  INGRESOS Y GASTOS')
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
        <i class="fa-solid fa-file-invoice text-slate-600"></i>
        Tipo de comprobante Ingreso
    </h1>

    <div class="bg-white rounded-3xl shadow-md p-6">
        <div class="flex justify-end mb-4">
            <button type="button"
                onclick="document.getElementById('modalNuevoComprobanteIngreso').classList.remove('hidden')"
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
                Tipo de comprobante Ingreso
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
                    @forelse($comprobantesIngreso as $index => $comprobanteIngreso)
                        <tr class="border-b border-slate-100">
                            <td class="py-2 text-slate-600">{{ $index + 1 }}</td>
                            <td class="py-2 text-black font-medium">
                                {{ $comprobanteIngreso->descripcion }}
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                    {{ $comprobanteIngreso->estado === 'ACTIVO'
                                        ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20'
                                        : 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20' }}">
                                    <span class="w-1.5 h-1.5 rounded-full
                                        {{ $comprobanteIngreso->estado === 'ACTIVO' ? 'bg-emerald-500' : 'bg-rose-500' }}">
                                    </span>
                                    {{ $comprobanteIngreso->estado }}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex justify-end gap-2">
                                    <button type="button"
                                        onclick="document.getElementById('modalEditarComprobanteIngreso{{ $comprobanteIngreso->id }}').classList.remove('hidden')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold"
                                        style="background-color: #64DD17;">
                                        Editar
                                    </button>
                                    <div id="modalEditarComprobanteIngreso{{ $comprobanteIngreso->id }}"
                                        class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-24">
                                        <div class="absolute inset-0 bg-black/10"
                                            onclick="document.getElementById('modalEditarComprobanteIngreso{{ $comprobanteIngreso->id }}').classList.add('hidden')">
                                        </div>
                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-4 p-6">
                                            <div class="flex items-center justify-between mb-6">
                                                <h2 class="text-lg font-semibold text-slate-800">
                                                    <i class="fa-solid fa-file-invoice text-slate-600"></i>
                                                    Editar Tipo de Comprobante de Ingreso
                                                </h2>
                                                <button type="button"
                                                    onclick="document.getElementById('modalEditarComprobanteIngreso{{ $comprobanteIngreso->id }}').classList.add('hidden')"
                                                    class="text-slate-400 hover:text-slate-600">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>

                                            <form action="{{ route('configuracion.comprobanteingreso.update', $comprobanteIngreso->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end">
                                                    <div>
                                                        <label for="descripcionComprobanteIngreso{{ $comprobanteIngreso->id }}" class="block text-sm font-medium text-black mb-1">
                                                            Descripción
                                                        </label>
                                                        <input type="text" id="descripcionComprobanteIngreso{{ $comprobanteIngreso->id }}" name="descripcion"
                                                            value="{{ $comprobanteIngreso->descripcion }}" maxlength="150"
                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-black mb-2">Estado</label>
                                                        <label class="inline-flex items-center cursor-pointer gap-3">
                                                            <input type="hidden" name="estado"  value="INACTIVO">
                                                            <input type="checkbox" name="estado" value="ACTIVO" class="sr-only peer"
                                                                {{ $comprobanteIngreso->estado === 'ACTIVO' ? 'checked' : '' }}>
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
                                                    <button type="button" onclick="document.getElementById('modalEditarComprobanteIngreso{{ $comprobanteIngreso->id }}').classList.add('hidden')"
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
                                    <button type="button" onclick="confirmarEliminar('{{ route('configuracion.comprobanteingreso.destroy', $comprobanteIngreso->id) }}')"
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
                                No hay tipos de comprobantes de ingreso registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
   
    <!-- MODAL NUEVO -->
    <div id="modalNuevoComprobanteIngreso"
        class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-24">
        <div class="absolute inset-0 bg-black/10" onclick="document.getElementById('modalNuevoComprobanteIngreso').classList.add('hidden')">
        </div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-4 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-slate-800">
                    <i class="fa-solid fa-file-invoice-dollar text-slate-600"></i>
                    Nuevo Tipo de comprobante Ingreso
                </h2>
                <button type="button" onclick="document.getElementById('modalNuevoComprobanteIngreso').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('configuracion.comprobanteingreso.store') }}"
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
                        onclick="document.getElementById('modalNuevoComprobanteIngreso').classList.add('hidden')"
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

    <br>
    <!-- TIPO DE COMPROBANTE DE GASTO -->
    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-solid fa-file-invoice-dollar text-slate-600"></i>
        Tipo de comprobante gasto
    </h1>

    <div class="bg-white rounded-3xl shadow-md p-6">
        <div class="flex justify-end mb-4">
            <button type="button"
                onclick="document.getElementById('modalNuevoComprobanteGasto').classList.remove('hidden')"
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
                Tipo de comprobante Ingreso
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
                    @forelse($comprobantesGasto as $index => $comprobanteGasto)
                        <tr class="border-b border-slate-100">
                            <td class="py-2 text-slate-600">{{ $index + 1 }}</td>
                            <td class="py-2 text-black font-medium">{{ $comprobanteGasto->descripcion }}</td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                    {{ $comprobanteGasto->estado === 'ACTIVO'
                                        ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20'
                                        : 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20' }}">
                                    <span class="w-1.5 h-1.5 rounded-full
                                        {{ $comprobanteGasto->estado === 'ACTIVO' ? 'bg-emerald-500' : 'bg-rose-500' }}">
                                    </span>
                                    {{ $comprobanteGasto->estado }}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex justify-end gap-2">
                                    <button type="button" onclick="document.getElementById('modalEditarComprobanteGasto{{ $comprobanteGasto->id }}').classList.remove('hidden')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold" style="background-color: #64DD17;">
                                        Editar
                                    </button>
                                    <div id="modalEditarComprobanteGasto{{ $comprobanteGasto->id }}" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-24">
                                        <div class="absolute inset-0 bg-black/10"
                                            onclick="document.getElementById('modalEditarComprobanteGasto{{ $comprobanteGasto->id }}').classList.add('hidden')">
                                        </div>
                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-4 p-6">
                                            <div class="flex items-center justify-between mb-6">
                                                <h2 class="text-lg font-semibold text-slate-800">
                                                    <i class="fa-solid fa-file-invoice-dollar text-slate-600"></i>
                                                    Editar Tipo de Comprobante de Gasto
                                                </h2>
                                                <button type="button" onclick="document.getElementById('modalEditarComprobanteGasto{{ $comprobanteGasto->id }}').classList.add('hidden')"
                                                    class="text-slate-400 hover:text-slate-600">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('configuracion.comprobantegasto.update', $comprobanteGasto->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end">
                                                    <div>
                                                        <label for="descripcionComprobanteGasto{{ $comprobanteGasto->id }}" class="block text-sm font-medium text-black mb-1">
                                                            Descripción
                                                        </label>
                                                        <input type="text" id="descripcionComprobanteGasto{{ $comprobanteGasto->id }}" name="descripcion"
                                                        value="{{ $comprobanteGasto->descripcion }}" maxlength="150"
                                                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-medium text-black mb-2">Estado</label>
                                                        <label class="inline-flex items-center cursor-pointer gap-3">
                                                            <input type="hidden" name="estado" value="INACTIVO">
                                                            <input type="checkbox" name="estado" value="ACTIVO" class="sr-only peer"
                                                            {{ $comprobanteGasto->estado === 'ACTIVO' ? 'checked' : '' }}>
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
                                                        onclick="document.getElementById('modalEditarComprobanteGasto{{ $comprobanteGasto->id }}').classList.add('hidden')"
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
                                    <button type="button" onclick="confirmarEliminar('{{ route('configuracion.comprobantegasto.destroy', $comprobanteGasto->id) }}')"
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
                                No hay tipos de comprobantes de gasto registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL NUEVO -->
    <div id="modalNuevoComprobanteGasto"
        class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-24">
        <div class="absolute inset-0 bg-black/10" onclick="document.getElementById('modalNuevoComprobanteGasto').classList.add('hidden')">
        </div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-4 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-slate-800">
                    <i class="fa-solid fa-file-invoice-dollar text-slate-600"></i>
                    Nuevo Tipo de comprobante Gasto
                </h2>
                <button type="button" onclick="document.getElementById('modalNuevoComprobanteGasto').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('configuracion.comprobantegasto.store') }}"
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
                        onclick="document.getElementById('modalNuevoComprobanteGasto').classList.add('hidden')"
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