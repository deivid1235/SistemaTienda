@extends('layouts.admin.app')
@section('title', 'Resúmenes')
@section('content')
    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-regular fa-circle-question text-slate-600"></i>
        Resúmenes
    </h1>

    {{-- ERRORES --}}
    @if ($errors->any())
        <div class="mb-4 flex items-center gap-2 bg-rose-50 border border-rose-100 text-rose-600 text-sm font-medium px-4 py-2.5 rounded-lg">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-md p-6">
        {{-- BARRA SUPERIOR --}}
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mb-4">
            <button type="button" onclick="document.getElementById('panelFiltros').classList.toggle('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                <i class="fa-solid fa-filter"></i> Mostrar filtros
            </button>
            <button type="button" onclick="abrirModalResumen()"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 sm:py-2 rounded-md text-white text-sm font-semibold shrink-0 hover:opacity-90 transition-opacity"
                style="background-color: var(--active-pink);">
                <i class="fa-solid fa-circle-plus"></i>Nuevo
            </button>
        </div>

        {{-- FILTROS --}}
        <div id="panelFiltros"
            class="{{ request()->filled('fecha') || request()->filled('estado') ? '' : 'hidden' }} mt-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
            <form action="{{ route('comprobantes.resumenes') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 items-end">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Fecha de referencia</label>
                        <input type="date" name="fecha" value="{{ request('fecha') }}"
                            class="w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Estado</label>
                        <select name="estado"
                            class="w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="">Todos</option>
                            <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="aceptado" {{ request('estado') == 'aceptado' ? 'selected' : '' }}>Aceptado</option>
                            <option value="rechazado" {{ request('estado') == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 rounded-md text-white text-sm font-semibold" style="background-color: var(--active-pink);">
                            Buscar
                        </button>
                        <a href="{{ route('comprobantes.resumenes') }}"
                            class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-white">
                            Limpiar
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <br>

        {{-- TABLA --}}
        <div class="w-full overflow-x-auto">
            <table class="w-full min-w-[900px] table-auto border-collapse text-left text-xs sm:text-sm">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-100 text-left text-sm text-slate-700">
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Fecha Emisión</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Fecha Referencia</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Identificador</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Estado</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Ticket</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Descargas</th>
                        <th class="whitespace-nowrap px-4 py-4 text-right font-bold">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($resumenes as $resumen)
                        <tr class="border-b border-slate-100">
                            <td class="py-4 px-4 text-slate-600 whitespace-nowrap">{{ $resumen->fecha_emision->format('d-m-Y') }}</td>
                            <td class="py-4 px-4 text-slate-600 whitespace-nowrap">{{ $resumen->fecha_referencia->format('d-m-Y') }}</td>
                            <td class="py-4 px-4">
                                <div class="text-slate-700">{{ $resumen->identificador }}</div>
                                <div class="text-xs text-slate-500 mt-1">
                                    {{ $resumen->cantidad_comprobantes }} {{ $resumen->cantidad_comprobantes == 1 ? 'boleta' : 'boletas' }}
                                    · S/ {{ number_format($resumen->total, 2) }}
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                @php
                                    $clasesEstado = match ($resumen->estado) {
                                        'aceptado'  => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
                                        'rechazado' => 'bg-rose-50 text-rose-700 ring-rose-600/20',
                                        default     => 'bg-amber-50 text-amber-700 ring-amber-600/20',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold ring-1 ring-inset {{ $clasesEstado }}">
                                    {{ ucfirst($resumen->estado) }}
                                </span>
                            </td>
                            <td class="py-4 px-4 text-slate-600">{{ $resumen->ticket ?? '-' }}</td>
                            <td class="py-4 px-4">
                                @if ($resumen->estado === 'aceptado')
                                    {{-- Las descargas reales se conectarán con el servicio de SUNAT --}}
                                    <div class="flex gap-2">
                                        <button type="button" disabled title="XML (disponible al conectar SUNAT)"
                                            class="px-2 py-1 rounded-md border border-slate-200 text-slate-400 text-xs font-semibold cursor-not-allowed">
                                            <i class="fa-solid fa-file-code mr-1"></i>XML
                                        </button>
                                        <button type="button" disabled title="CDR (disponible al conectar SUNAT)"
                                            class="px-2 py-1 rounded-md border border-slate-200 text-slate-400 text-xs font-semibold cursor-not-allowed">
                                            <i class="fa-solid fa-file-zipper mr-1"></i>CDR
                                        </button>
                                    </div>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex justify-end">
                                    @if ($resumen->estado === 'pendiente')
                                        <form action="{{ route('comprobantes.resumenes.consultar', $resumen->id) }}" method="POST"
                                            onsubmit="return confirm('¿Desea consultar el ticket {{ $resumen->ticket }}?')">
                                            @csrf
                                            <button type="submit" title="Consultar ticket"
                                                class="flex items-center justify-center w-9 h-9 rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-100 hover:text-slate-900 transition-colors">
                                                <i class="fa-solid fa-rotate"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-slate-400">-</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-500">
                                <i class="fa-regular fa-circle-question text-2xl mb-2 block"></i>
                                No hay resúmenes registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINACIÓN --}}
        <div class="flex items-center justify-between mt-4 text-sm text-slate-600">
            <span>Total {{ $resumenes->total() }}</span>
            <div>{{ $resumenes->links() }}</div>
        </div>
    </div>

    {{-- ================= MODAL: REGISTRAR RESUMEN ================= --}}
    <div id="modalResumen" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
        <div class="absolute inset-0 bg-black/10" onclick="cerrarModalResumen()"></div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-3xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-xl font-semibold text-slate-800">Registrar Resumen</h2>
                <button type="button" onclick="cerrarModalResumen()" class="text-slate-400 hover:text-slate-600 text-lg">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-end gap-3">
                <div class="w-full sm:w-72">
                    <label for="fechaBusqueda" class="block text-sm font-medium text-slate-700 mb-1">Fecha de emisión de comprobantes</label>
                    <input type="date" id="fechaBusqueda" value="{{ now()->toDateString() }}"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>
                <button type="button" onclick="buscarComprobantes()"
                    class="px-4 py-2 rounded-md text-white text-sm font-semibold hover:opacity-90"
                    style="background-color: var(--active-pink);">
                    Buscar comprobantes
                </button>
            </div>

            {{-- Mensaje de resultado --}}
            <p id="mensajeBusqueda" class="hidden mt-4 text-sm"></p>

            {{-- Resultados --}}
            <div id="resultadosBusqueda" class="hidden mt-4">
                <div class="max-h-64 overflow-y-auto border border-slate-200 rounded-lg">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="bg-slate-100 text-slate-700">
                                <th class="px-3 py-2 font-bold">Comprobante</th>
                                <th class="px-3 py-2 font-bold">Cliente</th>
                                <th class="px-3 py-2 font-bold">Documento</th>
                                <th class="px-3 py-2 text-right font-bold">Total</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpoResultados"></tbody>
                    </table>
                </div>
                <p id="totalResultados" class="mt-2 text-sm text-slate-600 text-right"></p>
            </div>

            <form action="{{ route('comprobantes.resumenes.store') }}" method="POST" class="mt-6">
                @csrf
                <input type="hidden" name="fecha_referencia" id="fechaReferenciaForm">
                <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                    <button type="button" onclick="cerrarModalResumen()"
                        class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit" id="btnGenerarResumen"
                        class="hidden px-5 py-2 rounded-md text-white text-sm font-medium"
                        style="background-color: var(--active-pink);">
                        <i class="fa-solid fa-file-circle-check mr-1"></i>
                        Generar resumen
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const urlBuscarComprobantes = @json(route('comprobantes.resumenes.buscar'));

        function abrirModalResumen() {
            document.getElementById('modalResumen').classList.remove('hidden');
        }

        function cerrarModalResumen() {
            document.getElementById('modalResumen').classList.add('hidden');
            limpiarResultados();
        }

        function limpiarResultados() {
            document.getElementById('mensajeBusqueda').classList.add('hidden');
            document.getElementById('resultadosBusqueda').classList.add('hidden');
            document.getElementById('btnGenerarResumen').classList.add('hidden');
            document.getElementById('cuerpoResultados').innerHTML = '';
        }

        function mostrarMensaje(texto, esError) {
            const msg = document.getElementById('mensajeBusqueda');
            msg.textContent = texto;
            msg.className = 'mt-4 text-sm ' + (esError ? 'text-rose-600' : 'text-slate-600');
        }

        function crearCelda(texto, clases) {
            const td = document.createElement('td');
            td.className = clases;
            td.textContent = texto;
            return td;
        }

        async function buscarComprobantes() {
            const fecha = document.getElementById('fechaBusqueda').value;
            limpiarResultados();

            if (!fecha) {
                mostrarMensaje('Seleccione una fecha de emisión.', true);
                return;
            }

            try {
                const respuesta = await fetch(urlBuscarComprobantes + '?fecha=' + encodeURIComponent(fecha), {
                    headers: { 'Accept': 'application/json' }
                });

                if (!respuesta.ok) {
                    mostrarMensaje('No se pudo realizar la búsqueda. Verifique la fecha.', true);
                    return;
                }

                const data = await respuesta.json();

                if (data.cantidad === 0) {
                    mostrarMensaje('No hay boletas pendientes de envío para esta fecha.', true);
                    return;
                }

                const cuerpo = document.getElementById('cuerpoResultados');
                data.comprobantes.forEach(function (c) {
                    const fila = document.createElement('tr');
                    fila.className = 'border-t border-slate-100';
                    fila.appendChild(crearCelda(c.numero, 'px-3 py-2 text-slate-700'));
                    fila.appendChild(crearCelda(c.cliente, 'px-3 py-2 text-slate-700'));
                    fila.appendChild(crearCelda(c.documento, 'px-3 py-2 text-slate-600'));
                    fila.appendChild(crearCelda(c.total, 'px-3 py-2 text-right text-slate-700'));
                    cuerpo.appendChild(fila);
                });

                document.getElementById('totalResultados').textContent =
                    data.cantidad + (data.cantidad === 1 ? ' boleta' : ' boletas') + ' · Total S/ ' + data.total;
                document.getElementById('resultadosBusqueda').classList.remove('hidden');
                document.getElementById('fechaReferenciaForm').value = fecha;
                document.getElementById('btnGenerarResumen').classList.remove('hidden');
            } catch (error) {
                mostrarMensaje('Ocurrió un error al buscar los comprobantes.', true);
            }
        }
    </script>
@endsection
