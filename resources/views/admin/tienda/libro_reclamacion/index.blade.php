@extends('layouts.admin.app')
@section('title', 'Libro de reclamacion')
@section('js')
@endsection
@section('content')
    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-solid fa-book-open text-slate-600"></i>
        Libro de Reclamaciones
    </h1>
        
    <div class="bg-white rounded-3xl shadow-md p-6">
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mb-4">
            <button type="button" onclick="document.getElementById('panelFiltros').classList.toggle('hidden')" 
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50" >
                <i class="fa-solid fa-filter"></i> Mostrar filtros 
            </button>
            <button type="button" onclick="window.location.reload()"   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 sm:py-2 rounded-md text-white text-sm font-semibold hover:opacity-90 transition-opacity"
                style="background-color: var(--active-pink);">
                <i class="fa-solid fa-rotate"></i>
                Actualizar
            </button>
        </div>

        <div class="overflow-x-auto mt-4">
            <div id="panelFiltros" class="{{ request()->filled('buscar') ? '' : 'hidden' }} mt-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <form action="{{ url('/admin/tienda/libro-reclamacion') }}" method="GET">
                        <div class="flex flex-col sm:flex-row gap-3 items-center">
                            <div class="relative w-full sm:flex-1 sm:max-w-xl">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="buscador" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar libro de reclamacion..."
                                class="w-full pl-9 pr-4 py-2.5 sm:py-2 rounded-md border border-slate-200 bg-white text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            </div>
                            {{-- BOTONES --}}
                            <div class="flex gap-2 w-full sm:w-auto">
                                <button type="submit" class="px-4 py-2 rounded-md text-white text-sm font-semibold" style="background-color: var(--active-pink);">
                                    Buscar
                                </button>
                                <a href="{{ url('/admin/tienda/libro-reclamacion') }}"class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-white">
                                    Limpiar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            <div class="w-full overflow-x-auto">
                <table class="w-full min-w-[1000px] table-auto border-collapse text-left text-xs sm:text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-100 text-left text-sm text-slate-700">
                            <th class="w-16 whitespace-nowrap px-4 py-4 font-bold">#</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">N.º Documento</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Nombre del Cliente</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Tipo</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Motivo</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Servicio Contratado</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Fecha Registro</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Estado</th>
                            <th class="whitespace-nowrap px-4 py-4 text-right font-bold">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reclamos as $index => $reclamo)
                            <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                <td class="py-4 px-4 text-slate-600">{{ $index + 1 }}</td>
                                <td class="py-4 px-4 text-slate-600">{{ $reclamo->numero_documento ?? '-' }}</td>
                                <td class="py-4 px-4 text-black font-medium">
                                    <div class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md bg-indigo-50 border border-indigo-200">
                                        <span class="text-indigo-500 text-xs">
                                            <i class="fa-solid fa-user"></i>
                                        </span>
                                        <span class="text-xs font-semibold text-indigo-900">
                                            {{ trim(($reclamo->primer_nombre ?? '') . ' ' . ($reclamo->segundo_nombre ?? '')) ?: '-' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                        {{ strtolower($reclamo->tipo_reclamo ?? '') === 'reclamo'
                                            ? 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20'
                                            : 'bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/20' }}">
                                        {{ ucfirst($reclamo->tipo_reclamo ?? '-') }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-slate-600">{{ $reclamo->motivo ?? '-' }}</td>
                                <td class="py-4 px-4 text-slate-600">{{ $reclamo->servicio_contratado ?? '-' }}</td>
                                <td class="py-4 px-4 text-slate-600">{{ $reclamo->created_at ? $reclamo->created_at->format('d/m/Y') : '-' }}</td>
                                <td class="py-4 px-4">
                                    @php
                                        $estado = strtolower($reclamo->estado ?? 'pendiente');
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                        {{ $estado === 'atendido'
                                            ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20'
                                            : ($estado === 'en proceso' ? 'bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/20'
                                                : 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20') }}">
                                        <span class="h-2 w-2 rounded-full
                                            {{ $estado === 'atendido' ? 'bg-emerald-500' : ($estado === 'en proceso' ? 'bg-amber-500' : 'bg-rose-500') }}">
                                        </span>
                                        {{ ucfirst($reclamo->estado ?? 'Pendiente') }}
                                    </span>
                                </td>
                                {{-- ACCIONES --}}
                                <td class="py-4 px-4 relative">
                                    <div class="flex justify-end">
                                        <div class="relative">
                                            <input type="checkbox" id="menuReclamo{{ $reclamo->id }}" class="peer hidden">
                                            <label for="menuReclamo{{ $reclamo->id }}" class="flex items-center justify-center w-9 h-9 rounded-lg cursor-pointer text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-colors border border-slate-300">
                                                <i class="fa-solid fa-ellipsis-vertical text-lg"></i>
                                            </label>
                                            <div class="hidden peer-checked:block absolute right-0 bottom-full mb-2 w-48 h-24 overflow-y-scroll overscroll-contain bg-white rounded-md  shadow-xl border border-slate-200 z-[99999]">
                                                <div class="py-1">
                                                    {{-- VER DETALLE --}}
                                                    <button type="button" onclick=" const modal = document.getElementById('modalVerReclamo{{ $reclamo->id }}');
                                                        modal.classList.remove('hidden'); modal.classList.add('flex'); "
                                                        class="w-full flex items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 text-left">
                                                        <i class="fa-solid fa-eye w-4 text-black"></i>
                                                        Ver detalle
                                                    </button>
                                                    <div id="modalVerReclamo{{ $reclamo->id }}"
                                                        class="hidden fixed inset-0 z-[99999] items-center justify-center p-3 sm:p-5">
                                                        <div class="absolute inset-0 bg-black/10"
                                                            onclick=" const modal = document.getElementById('modalVerReclamo{{ $reclamo->id }}'); modal.classList.add('hidden'); modal.classList.remove('flex');">
                                                        </div>
                                                        <div class="relative z-10 bg-white w-full max-w-5xl h-[90vh] mx-auto rounded-2xl shadow-2xl flex flex-col overflow-hidden">
                                                            <div class="shrink-0 flex items-center justify-between px-4 sm:px-6 py-4 border-b border-slate-200 bg-white">
                                                                <div>
                                                                    <h2 class="text-base sm:text-lg font-bold text-slate-800">
                                                                        <i class="fa-solid fa-file-pdf text-red-600 mr-2"></i>
                                                                        Hoja de reclamación
                                                                    </h2>
                                                                    <p class="text-sm text-slate-500">Reclamo N° {{ $reclamo->id }}</p>
                                                                </div>

                                                                <!-- CERRAR -->
                                                                <button type="button" onclick=" const modal = document.getElementById('modalVerReclamo{{ $reclamo->id }}'); modal.classList.add('hidden');modal.classList.remove('flex');"
                                                                    class="w-10 h-10 shrink-0 flex items-center justify-center rounded-xl bg-slate-100 hover:bg-red-100 text-slate-600 hover:text-red-600 transition">
                                                                    <i class="fa-solid fa-xmark text-xl"></i>
                                                                </button>
                                                            </div>
                                                            <!-- PDF -->
                                                            <div class="flex-1 min-h-0 overflow-hidden bg-slate-200">
                                                                <iframe src="{{ route('admin.libro-reclamacion.visualizar', $reclamo->id) }}"
                                                                    class="w-full h-full border-0 block" title="Visualizar hoja de reclamación">
                                                                </iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- RESPONDER --}}
                                                    <button type="button"
                                                        onclick="document.getElementById('modalResponderReclamo{{ $reclamo->id }}').classList.remove('hidden')"
                                                        class="w-full flex items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 text-left">
                                                        <i class="fa-solid fa-reply w-4 text-black"></i>
                                                        Responder
                                                    </button>
                                                    <div id="modalResponderReclamo{{ $reclamo->id }}" class="fixed inset-0 z-[99999] hidden items-center justify-center p-4">
                                                        <div class="absolute inset-0 bg-black/10" onclick=" const modal = document.getElementById('modalResponderReclamo{{ $reclamo->id }}');  modal.classList.add('hidden'); modal.classList.remove('flex');">
                                                        </div>
                                                        <div class="relative bg-white w-full max-w-lg mx-auto rounded-2xl shadow-2xl border border-slate-100 overflow-hidden">
                                                            <div class="flex items-center justify-between px-6 py-5 border-b border-slate-100 bg-slate-50/50">
                                                                <div>
                                                                    <h2 class="text-lg font-bold text-slate-800">Responder reclamo</h2>
                                                                    <p class="text-sm text-slate-500 mt-0.5">Envía una respuesta al correo del cliente.</p>
                                                                </div>
                                                                <button type="button" onclick=" const modal = document.getElementById('modalResponderReclamo{{ $reclamo->id }}');
                                                                        modal.classList.add('hidden'); modal.classList.remove('flex');"
                                                                    class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-100 hover:bg-red-100 text-slate-500 hover:text-red-600 transition cursor-pointer">
                                                                    <i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('admin.libro-reclamacion.responder', $reclamo->id) }}"
                                                                method="POST" class="p-6">
                                                                @csrf
                                                                <div class="mb-5">
                                                                    <label class="block text-sm font-semibold text-slate-700 mb-2">Correo del cliente</label>
                                                                    <div class="relative">
                                                                        <i class="fa-solid fa-envelope absolute left-3.5 top-3.5 text-slate-400"></i>
                                                                        <input type="email" value="{{ $reclamo->correo }}"  readonly
                                                                        class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-600 outline-none">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-6">
                                                                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                                                                        Mensaje de respuesta
                                                                    </label>
                                                                    <textarea name="mensaje" rows="6" required placeholder="Escribe aquí la respuesta al reclamo del cliente..."
                                                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm text-slate-700 outline-none focus:border-slate-400 focus:ring-2 focus:ring-slate-100 resize-none transition"></textarea>
                                                                </div>

                                                                <!-- Botones -->
                                                                <div class="flex justify-end gap-3 pt-2">
                                                                    <button type="button" onclick=" const modal = document.getElementById('modalResponderReclamo{{ $reclamo->id }}'); 
                                                                        modal.classList.add('hidden'); modal.classList.remove('flex');"
                                                                        class="px-5 py-2.5 rounded-xl border border-slate-200 bg-white text-sm font-semibold text-slate-600 hover:bg-slate-100 hover:text-slate-800 transition cursor-pointer">
                                                                        Cancelar
                                                                    </button>
                                                                    <button type="submit" style="background-color: var(--active-pink);"
                                                                        class="px-5 py-2.5 rounded-xl text-white text-sm font-semibold shadow-sm hover:opacity-90 active:opacity-80 transition cursor-pointer flex items-center">
                                                                        <i class="fa-solid fa-paper-plane mr-2"></i>
                                                                        Enviar respuesta
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <a href="{{ route('admin.libro-reclamacion.pdf', $reclamo->id) }}" target="_blank" class="w-full flex items-center gap-3 px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 text-left">
                                                        <i class="fa-solid fa-file-pdf w-4 text-red-600"></i>
                                                        Descargar Hoja de Reclamación
                                                    </a>
                                                    <button type="button" onclick="confirmarEliminar('{{ route('admin.libro_reclamacion.destroy', $reclamo->id) }}')"
                                                        class="w-full flex items-center gap-3 px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 text-left">
                                                        <i class="fa-solid fa-trash w-4"></i>
                                                        Eliminar
                                                    </button>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="py-8 text-center text-slate-500">
                                    <i class="fa-solid fa-inbox text-3xl mb-2 block text-slate-300"></i>
                                    No hay reclamos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    




@endsection


