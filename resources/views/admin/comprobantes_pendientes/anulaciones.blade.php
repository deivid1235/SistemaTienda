@extends('layouts.admin.app')
@section('title', 'Anulaciones')
@section('content')
    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-regular fa-circle-question text-slate-600"></i>
        Anulaciones
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
            <button type="button" onclick="abrirModalAnulacion()"
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 sm:py-2 rounded-md text-white text-sm font-semibold shrink-0 hover:opacity-90 transition-opacity"
                style="background-color: var(--active-pink);">
                <i class="fa-solid fa-magnifying-glass"></i>Consultar documentos
            </button>
        </div>

        {{-- FILTROS --}}
        <div id="panelFiltros"
            class="{{ request()->filled('fecha') || request()->filled('estado') ? '' : 'hidden' }} mt-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
            <form action="{{ route('comprobantes.anulaciones') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 items-end">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Fecha del comprobante</label>
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
                        <a href="{{ route('comprobantes.anulaciones') }}"
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
                        <th class="whitespace-nowrap px-4 py-4 font-bold">F. Emisión</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">F. Comprobante</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Identificador</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Ticket</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Estado</th>
                        <th class="whitespace-nowrap px-4 py-4 font-bold">Descargas</th>
                        <th class="whitespace-nowrap px-4 py-4 text-right font-bold">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anulaciones as $anulacion)
                        <tr class="border-b border-slate-100">
                            <td class="py-4 px-4 text-slate-600 whitespace-nowrap">{{ $anulacion->fecha_emision->format('d-m-Y') }}</td>
                            <td class="py-4 px-4 text-slate-600 whitespace-nowrap">{{ $anulacion->fecha_comprobante->format('d-m-Y') }}</td>
                            <td class="py-4 px-4">
                                <div class="text-slate-700">{{ $anulacion->identificador }}</div>
                                <div class="text-xs text-slate-500 mt-1">
                                    {{ $anulacion->cantidad_comprobantes }} {{ $anulacion->cantidad_comprobantes == 1 ? 'comprobante' : 'comprobantes' }}
                                    · {{ \Illuminate\Support\Str::limit($anulacion->motivo, 40) }}
                                </div>
                            </td>
                            <td class="py-4 px-4 text-slate-600">{{ $anulacion->ticket ?? '-' }}</td>
                            <td class="py-4 px-4">
                                @php
                                    $clasesEstado = match ($anulacion->estado) {
                                        'aceptado'  => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
                                        'rechazado' => 'bg-rose-50 text-rose-700 ring-rose-600/20',
                                        default     => 'bg-amber-50 text-amber-700 ring-amber-600/20',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold ring-1 ring-inset {{ $clasesEstado }}">
                                    {{ ucfirst($anulacion->estado) }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                @if ($anulacion->estado === 'aceptado')
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
                                    @if ($anulacion->estado === 'pendiente')
                                        <form action="{{ route('comprobantes.anulaciones.consultar', $anulacion->id) }}" method="POST"
                                            onsubmit="return confirm('¿Desea consultar el ticket {{ $anulacion->ticket }}?')">
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
                                No hay anulaciones registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINACIÓN --}}
        <div class="flex items-center justify-between mt-4 text-sm text-slate-600">
            <span>Total {{ $anulaciones->total() }}</span>
            <div>{{ $anulaciones->links() }}</div>
        </div>
    </div>

    {{-- ================= MODAL: CONSULTAR DOCUMENTOS ================= --}}
    <div id="modalAnulacion" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
        <div class="absolute inset-0 bg-black/10" onclick="cerrarModalAnulacion()"></div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-3xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-xl font-semibold text-slate-800">Consultar documentos a anular</h2>
                <button type="button" onclick="cerrarModalAnulacion()" class="text-slate-400 hover:text-slate-600 text-lg">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-end gap-3">
                <div class="w-full sm:w-72">
                    <label for="fechaBusquedaAnul" class="block text-sm font-medium text-slate-700 mb-1">Fecha de emisión de comprobantes</label>
                    <input type="date" id="fechaBusquedaAnul" value="{{ now()->toDateString() }}"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>
                <button type="button" onclick="buscarDocumentos()"
                    class="px-4 py-2 rounded-md text-white text-sm font-semibold hover:opacity-90"
                    style="background-color: var(--active-pink);">
                    Buscar documentos
                </button>
            </div>

            {{-- Mensaje de resultado --}}
            <p id="mensajeBusquedaAnul" class="hidden mt-4 text-sm"></p>

            {{-- Formulario con los resultados --}}
            <form action="{{ route('comprobantes.anulaciones.store') }}" method="POST" id="formAnulacion" class="hidden mt-4">
                @csrf
                <input type="hidden" name="fecha_comprobante" id="fechaComprobanteForm">

                <div class="max-h-64 overflow-y-auto border border-slate-200 rounded-lg">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="bg-slate-100 text-slate-700">
                                <th class="px-3 py-2 w-10">
                                    <input type="checkbox" id="marcarTodos" onchange="marcarTodosDocumentos(this.checked)"
                                        class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                                </th>
                                <th class="px-3 py-2 font-bold">Comprobante</th>
                                <th class="px-3 py-2 font-bold">Cliente</th>
                                <th class="px-3 py-2 text-right font-bold">Total</th>
                            </tr>
                        </thead>
                        <tbody id="cuerpoResultadosAnul"></tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <label for="motivoAnulacion" class="block text-sm font-medium text-slate-700 mb-1">
                        Motivo de la anulación <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="motivoAnulacion" name="motivo" maxlength="255" required
                        placeholder="Ej. Error en los datos del cliente"
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                </div>

                <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-slate-100">
                    <button type="button" onclick="cerrarModalAnulacion()"
                        class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-5 py-2 rounded-md text-white text-sm font-medium"
                        style="background-color: var(--active-pink);">
                        <i class="fa-solid fa-ban mr-1"></i>
                        Generar comunicación de baja
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const urlBuscarDocumentos = @json(route('comprobantes.anulaciones.buscar'));

        function abrirModalAnulacion() {
            document.getElementById('modalAnulacion').classList.remove('hidden');
        }

        function cerrarModalAnulacion() {
            document.getElementById('modalAnulacion').classList.add('hidden');
            limpiarResultadosAnul();
        }

        function limpiarResultadosAnul() {
            document.getElementById('mensajeBusquedaAnul').classList.add('hidden');
            document.getElementById('formAnulacion').classList.add('hidden');
            document.getElementById('cuerpoResultadosAnul').innerHTML = '';
            document.getElementById('marcarTodos').checked = false;
        }

        function mostrarMensajeAnul(texto, esError) {
            const msg = document.getElementById('mensajeBusquedaAnul');
            msg.textContent = texto;
            msg.className = 'mt-4 text-sm ' + (esError ? 'text-rose-600' : 'text-slate-600');
        }

        function crearCeldaAnul(texto, clases) {
            const td = document.createElement('td');
            td.className = clases;
            td.textContent = texto;
            return td;
        }

        function marcarTodosDocumentos(marcado) {
            document.querySelectorAll('#cuerpoResultadosAnul input[type="checkbox"]').forEach(function (cb) {
                cb.checked = marcado;
            });
        }

        async function buscarDocumentos() {
            const fecha = document.getElementById('fechaBusquedaAnul').value;
            limpiarResultadosAnul();

            if (!fecha) {
                mostrarMensajeAnul('Seleccione una fecha de emisión.', true);
                return;
            }

            try {
                const respuesta = await fetch(urlBuscarDocumentos + '?fecha=' + encodeURIComponent(fecha), {
                    headers: { 'Accept': 'application/json' }
                });

                if (!respuesta.ok) {
                    mostrarMensajeAnul('No se pudo realizar la búsqueda. Verifique la fecha.', true);
                    return;
                }

                const data = await respuesta.json();

                if (data.cantidad === 0) {
                    mostrarMensajeAnul('No hay comprobantes enviados disponibles para anular en esta fecha.', true);
                    return;
                }

                const cuerpo = document.getElementById('cuerpoResultadosAnul');
                data.comprobantes.forEach(function (c) {
                    const fila = document.createElement('tr');
                    fila.className = 'border-t border-slate-100';

                    const celdaCheck = document.createElement('td');
                    celdaCheck.className = 'px-3 py-2';
                    const check = document.createElement('input');
                    check.type = 'checkbox';
                    check.name = 'comprobante_ids[]';
                    check.value = c.id;
                    check.className = 'rounded border-slate-300 text-indigo-600 focus:ring-indigo-500';
                    celdaCheck.appendChild(check);

                    const celdaNumero = document.createElement('td');
                    celdaNumero.className = 'px-3 py-2 text-slate-700';
                    celdaNumero.textContent = c.numero;
                    const tipo = document.createElement('div');
                    tipo.className = 'text-xs text-slate-500 mt-1';
                    tipo.textContent = c.tipo;
                    celdaNumero.appendChild(tipo);

                    fila.appendChild(celdaCheck);
                    fila.appendChild(celdaNumero);
                    fila.appendChild(crearCeldaAnul(c.cliente, 'px-3 py-2 text-slate-700'));
                    fila.appendChild(crearCeldaAnul(c.total, 'px-3 py-2 text-right text-slate-700'));
                    cuerpo.appendChild(fila);
                });

                document.getElementById('fechaComprobanteForm').value = fecha;
                document.getElementById('formAnulacion').classList.remove('hidden');
            } catch (error) {
                mostrarMensajeAnul('Ocurrió un error al buscar los documentos.', true);
            }
        }
    </script>
@endsection
