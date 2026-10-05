@extends('layouts.admin.app')

@section('title', 'Comisiones por vendedor')

@section('js')
@endsection

@section('content')

    @php
        $hayFiltros = request()->filled('vendedor') || request()->filled('tipo');
    @endphp

    <div class="flex items-center gap-2 text-sm mb-4">
        <a href="{{ route('configuracion') }}" class="text-slate-400 hover:text-slate-700 flex items-center gap-1">
            <i class="fa-solid fa-house"></i>Dashboard
        </a>
        <span class="text-slate-400">/</span>
        <a href="{{ route('configuracion') }}" class="text-slate-400 hover:text-slate-700 flex items-center gap-1">
            <i class="fa-solid fa-gear"></i>Configuración
        </a>
        <span class="text-slate-400">/</span>
        <span class="text-slate-700 font-semibold flex items-center gap-1">
            <i class="fa-solid fa-percent"></i>Comisiones por vendedor
        </span>
    </div>

    @if ($errors->any())
        <div class="mb-4 px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-solid fa-percent text-slate-600"></i>
        Comisiones por vendedor
    </h1>

    <div class="bg-white rounded-3xl shadow-md p-6">

        <div class="flex items-center justify-between">
            <button type="button"
                onclick="document.getElementById('panelFiltros').classList.toggle('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                <i class="fa-solid fa-filter"></i>
                Mostrar filtros
            </button>

            <button type="button"
                onclick="document.getElementById('modalNuevaComision').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md text-white text-sm font-semibold"
                style="background-color: var(--active-pink);">
                <i class="fa-solid fa-circle-plus"></i>
                Nuevo
            </button>
        </div>

        {{-- FILTROS --}}
        <div id="panelFiltros" class="{{ $hayFiltros ? '' : 'hidden' }} mt-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
            <form action="{{ route('configuracion.vendedor') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    <div>
                        <label for="filtro_vendedor" class="block text-sm font-medium text-black mb-1">Vendedor</label>
                        <input type="text" id="filtro_vendedor" name="vendedor" value="{{ request('vendedor') }}" placeholder="Buscar por nombre"
                            class="w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                    <div>
                        <label for="filtro_tipo" class="block text-sm font-medium text-black mb-1">Tipo comisión</label>
                        <select id="filtro_tipo" name="tipo"
                            class="w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="">Todos</option>
                            <option value="monto" {{ request('tipo') === 'monto' ? 'selected' : '' }}>Monto</option>
                            <option value="porcentaje" {{ request('tipo') === 'porcentaje' ? 'selected' : '' }}>Porcentaje</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 rounded-md text-white text-sm font-semibold" style="background-color: var(--active-pink);">
                            Filtrar
                        </button>
                        <a href="{{ route('configuracion.vendedor') }}" class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-white">
                            Limpiar
                        </a>
                    </div>
                </div>
            </form>
        </div>

        {{-- TABLA --}}
        <div class="overflow-x-auto mt-4">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-slate-200 text-black">
                        <th class="font-semibold w-16">#</th>
                        <th class="font-semibold">Vendedor</th>
                        <th class="font-semibold">Tipo</th>
                        <th class="font-semibold">Comisión</th>
                        <th class="font-semibold text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comisiones as $index => $comision)
                        <tr class="border-b border-slate-100">
                            <td class="py-2 text-slate-600">{{ $comisiones->firstItem() + $index }}</td>
                            <td class="py-2 text-black font-medium">{{ $comision->vendedor->name ?? '-' }}</td>
                            <td class="py-2 text-slate-600">{{ $comision->tipo === 'monto' ? 'Monto' : 'Porcentaje' }}</td>
                            <td class="py-2 text-slate-600">
                                @if($comision->tipo === 'monto')
                                    S/ {{ number_format($comision->valor, 2) }}
                                @else
                                    {{ number_format($comision->valor, 2) }} %
                                @endif
                            </td>
                            <td class="py-2">
                                <div class="flex justify-end gap-2">
                                    <button type="button"
                                        onclick="document.getElementById('modalEditarComision{{ $comision->id }}').classList.remove('hidden')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold"
                                        style="background-color: #64DD17;">
                                        Editar
                                    </button>

                                    {{-- MODAL EDITAR --}}
                                    <div id="modalEditarComision{{ $comision->id }}"
                                        class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-24">
                                        <div class="absolute inset-0 bg-black/10"
                                            onclick="document.getElementById('modalEditarComision{{ $comision->id }}').classList.add('hidden')">
                                        </div>
                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4 p-6">
                                            <div class="flex items-center justify-between mb-6">
                                                <h2 class="text-lg font-semibold text-slate-800">
                                                    <i class="fa-solid fa-percent text-slate-600"></i>
                                                    Editar comisión
                                                </h2>
                                                <button type="button"
                                                    onclick="document.getElementById('modalEditarComision{{ $comision->id }}').classList.add('hidden')"
                                                    class="text-slate-400 hover:text-slate-600">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>

                                            <form action="{{ route('configuracion.vendedor.update', $comision->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                    <div>
                                                        <label class="block text-sm font-medium text-black mb-1">Vendedor</label>
                                                        <input type="text" value="{{ $comision->vendedor->name ?? '-' }}" readonly
                                                            class="w-full rounded-md border border-slate-200 bg-slate-100 px-3 py-2 text-sm text-slate-500">
                                                    </div>
                                                    <div>
                                                        <label for="tipo{{ $comision->id }}" class="block text-sm font-medium text-black mb-1">Tipo comisión</label>
                                                        <select id="tipo{{ $comision->id }}" name="tipo" required
                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                            <option value="monto" {{ $comision->tipo === 'monto' ? 'selected' : '' }}>Monto</option>
                                                            <option value="porcentaje" {{ $comision->tipo === 'porcentaje' ? 'selected' : '' }}>Porcentaje</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label for="valor{{ $comision->id }}" class="block text-sm font-medium text-black mb-1">Monto</label>
                                                        <input type="number" id="valor{{ $comision->id }}" name="valor" step="0.01" min="0" required
                                                            value="{{ $comision->valor }}"
                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                                    </div>
                                                </div>
                                                <div class="flex justify-end gap-3 mt-8">
                                                    <button type="button"
                                                        onclick="document.getElementById('modalEditarComision{{ $comision->id }}').classList.add('hidden')"
                                                        class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                                                        Cancelar
                                                    </button>
                                                    <button type="submit" class="px-4 py-2 rounded-md text-white text-sm font-semibold"
                                                        style="background-color: var(--active-pink);">
                                                        Actualizar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <button type="button"
                                        onclick="confirmarEliminar('{{ route('configuracion.vendedor.destroy', $comision->id) }}')"
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
                                No hay comisiones registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- TOTAL Y PAGINACIÓN --}}
        <div class="mt-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-slate-600">
            <span>Total {{ $comisiones->total() }}</span>
            <div>{{ $comisiones->links() }}</div>
        </div>

    </div>

    {{-- MODAL NUEVO --}}
    <div id="modalNuevaComision" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-24">
        <div class="absolute inset-0 bg-black/10"
            onclick="document.getElementById('modalNuevaComision').classList.add('hidden')"></div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-2xl mx-4 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-slate-800">
                    <i class="fa-solid fa-percent text-slate-600"></i>
                    Registrar comisión
                </h2>
                <button type="button"
                    onclick="document.getElementById('modalNuevaComision').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form action="{{ route('configuracion.vendedor.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-black mb-1">Vendedor</label>
                        <select id="user_id" name="user_id" required
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="">Seleccionar</option>
                            @foreach($disponibles as $usuario)
                                <option value="{{ $usuario->id }}" {{ old('user_id') == $usuario->id ? 'selected' : '' }}>
                                    {{ $usuario->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="tipo" class="block text-sm font-medium text-black mb-1">Tipo comisión</label>
                        <select id="tipo" name="tipo" required
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            <option value="monto" {{ old('tipo', 'monto') === 'monto' ? 'selected' : '' }}>Monto</option>
                            <option value="porcentaje" {{ old('tipo') === 'porcentaje' ? 'selected' : '' }}>Porcentaje</option>
                        </select>
                    </div>
                    <div>
                        <label for="valor" class="block text-sm font-medium text-black mb-1">Monto</label>
                        <input type="number" id="valor" name="valor" step="0.01" min="0" required value="{{ old('valor', 0) }}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-8">
                    <button type="button"
                        onclick="document.getElementById('modalNuevaComision').classList.add('hidden')"
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
