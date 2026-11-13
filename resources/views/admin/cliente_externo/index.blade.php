@extends('layouts.admin.app')
@section('title', 'Clientes Externos')
@section('js')
@endsection
@section('content')

    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-solid fa-users text-slate-600"></i>
        Listado de clientes externos
    </h1>
        
    <div class="bg-white rounded-3xl shadow-md p-6">
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 mb-4">
            <button type="button" onclick="document.getElementById('panelFiltros').classList.toggle('hidden')" 
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50" >
                <i class="fa-solid fa-filter"></i> Mostrar filtros 
            </button>
        </div>
        <div class="overflow-x-auto mt-4">
            <div id="panelFiltros" class="{{ request()->filled('buscar') ? '' : 'hidden' }} mt-4 p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <form action="{{ url('/admin/cliente-externo') }}" method="GET">
                        <div class="flex flex-col sm:flex-row gap-3 items-center">
                            <div class="relative w-full sm:flex-1 sm:max-w-xl">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="buscador" name="buscar" value="{{ request('buscar') }}" placeholder="Buscar cliente externo ..."
                                class="w-full pl-9 pr-4 py-2.5 sm:py-2 rounded-md border border-slate-200 bg-white text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                            </div>
                            {{-- BOTONES --}}
                            <div class="flex gap-2 w-full sm:w-auto">
                                <button type="submit" class="px-4 py-2 rounded-md text-white text-sm font-semibold" style="background-color: var(--active-pink);">
                                    Buscar
                                </button>
                                <a href="{{ url('/admin/cliente-externo') }}"class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-white">
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
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Cliente</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Tipo Documento</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">N° Documento</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Celular</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Términos</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Declaración Jurada</th>
                            <th class="whitespace-nowrap px-4 py-4 font-bold">Fecha Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clientesExternos as $index => $cliente)
                            <tr class="border-b border-slate-100">
                                <td class="py-4 px-4 text-slate-600">{{ $index + 1 }}</td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                                            <i class="fa-solid fa-user"></i></div>
                                        <div>
                                            <p class="text-sm font-semibold text-slate-800">{{ $cliente->nombre }} {{ $cliente->apellido }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-slate-600"> {{ $cliente->tipo_documento }}</td>
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md bg-indigo-50 border border-indigo-200">
                                        <i class="fa-solid fa-id-card text-indigo-500 text-xs"></i>
                                        <span class="text-xs font-semibold text-indigo-900">
                                            {{ $cliente->numero_documento }}
                                        </span>
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-slate-600 whitespace-nowrap">
                                    <i class="fa-solid fa-phone text-slate-400 mr-1"></i>{{ $cliente->celular }}
                                </td>
                               <td class="py-4 px-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                        {{ $cliente->acepta_terminos ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 
                                                {{ $cliente->acepta_terminos ? 'bg-emerald-400' : 'bg-rose-400' }}"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 
                                                {{ $cliente->acepta_terminos ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                        </span>

                                        {{ $cliente->acepta_terminos ? 'Aceptados' : 'No aceptados' }}
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                        {{ $cliente->declaracion_jurada ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 
                                                {{ $cliente->declaracion_jurada ? 'bg-emerald-400' : 'bg-rose-400' }}"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 
                                                {{ $cliente->declaracion_jurada ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                        </span>
                                        {{ $cliente->declaracion_jurada ? 'Aceptada' : 'No aceptada' }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-slate-600 whitespace-nowrap"> {{ $cliente->created_at?->format('d/m/Y') ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-4 text-center text-slate-500">
                                    No hay clientes externos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


