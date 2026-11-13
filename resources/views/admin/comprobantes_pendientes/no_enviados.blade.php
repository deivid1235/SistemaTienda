@extends('layouts.admin.app')
@section('title', 'Comprobantes no enviados')
@section('content')
    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-regular fa-circle-question text-slate-600"></i>
        Comprobantes enviados/por enviar OSE/SUNAT
    </h1>

    <div class="bg-white rounded-3xl shadow-md p-6">
        {{-- BARRA SUPERIOR --}}
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mb-4">
            <button type="button" onclick="document.getElementById('panelFiltros').classList.toggle('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                <i class="fa-solid fa-filter"></i> Mostrar filtros
            </button>
        </div>

        {{-- FILTROS --}}
        <div id="panelFiltros"
            class="{{ request()->filled('buscar') || request()->filled('tipo') || request()->filled('fecha') ? '' : 'hidden' }} mt-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
            <form action="{{ route('comprobantes.no_enviados') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-3 items-end">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Buscar</label>
                        <input type="text" name="buscar" value="{{ request('buscar') }}" placeholder="Cliente, documento, serie o número..."
                            class="w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tipo</label>
                        <select name="tipo"
                            class="w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="">Todos</option>
                            <option value="01" {{ request('tipo') == '01' ? 'selected' : '' }}>Factura electrónica</option>
                            <option value="03" {{ request('tipo') == '03' ? 'selected' : '' }}>Boleta de venta electrónica</option>
                            <option value="07" {{ request('tipo') == '07' ? 'selected' : '' }}>Nota de crédito</option>
                            <option value="08" {{ request('tipo') == '08' ? 'selected' : '' }}>Nota de débito</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Fecha de emisión</label>
                        <input type="date" name="fecha" value="{{ request('fecha') }}"
                            class="w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                </div>
                <div class="flex gap-2 mt-3">
                    <button type="submit" class="px-4 py-2 rounded-md text-white text-sm font-semibold" style="background-color: var(--active-pink);">
                        Buscar
                    </button>
                    <a href="{{ route('comprobantes.no_enviados') }}"
                        class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-white">
                        Limpiar
                    </a>
                </div>
            </form>
        </div>

        <br>

        {{-- TABLA --}}
        <div class="w-full overflow-x-auto">
            <table class="w-full min-w-[900px] table-auto border-collapse text-left text-xs sm:text-sm">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-100 text-left text-sm text-slate-700">
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Entorno</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Usuario</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">F. Emisión</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Cliente</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Comprobante</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Días para enviar/Detalle</th>
                        <th class="whitespace-nowrap px-4 py-4 text-right font-bold">Enviar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comprobantes as $comprobante)
                        <tr class="border-b border-slate-100">
                            <td class="py-4 px-4 text-slate-600">{{ $comprobante->entorno }}</td>
                            <td class="py-4 px-4 text-slate-600">{{ $comprobante->usuario->name ?? '-' }}</td>
                            <td class="py-4 px-4 text-slate-600 whitespace-nowrap">{{ $comprobante->fecha_emision->format('d-m-Y') }}</td>
                            <td class="py-4 px-4">
                                <div class="text-slate-700">{{ $comprobante->cliente_nombre }}</div>
                                <div class="text-xs text-slate-500 mt-1">{{ $comprobante->cliente_documento ?? '-' }}</div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-slate-700">{{ $comprobante->numero_completo }}</div>
                                <div class="text-xs text-slate-500 mt-1">{{ $comprobante->tipo_nombre }}</div>
                            </td>
                            <td class="py-4 px-4">
                                @if ($comprobante->plazo_vencido)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-rose-50 text-rose-600 ring-1 ring-inset ring-rose-600/20">
                                        El plazo de envío caducó
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                                        Quedan {{ $comprobante->dias_restantes }} {{ $comprobante->dias_restantes == 1 ? 'día' : 'días' }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex justify-end">
                                    <form action="{{ route('comprobantes.no_enviados.enviar', $comprobante->id) }}" method="POST"
                                        onsubmit="return confirm('¿Desea enviar el comprobante {{ $comprobante->numero_completo }} a SUNAT?')">
                                        @csrf
                                        <button type="submit" title="Enviar"
                                            class="flex items-center justify-center w-9 h-9 rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-colors">
                                            <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-500">
                                <i class="fa-regular fa-circle-question text-2xl mb-2 block"></i>
                                No hay comprobantes pendientes de envío.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINACIÓN --}}
        <div class="flex items-center justify-between mt-4 text-sm text-slate-600">
            <span>Total {{ $comprobantes->total() }}</span>
            <div>{{ $comprobantes->links() }}</div>
        </div>
    </div>
@endsection
