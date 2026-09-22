@extends('layouts.admin.app')

@section('title', 'Configuración')
@section('js')
@endsection

@section('content')

@if(session('error'))
    <div class="flex justify-center mb-4">
        <div class="px-4 py-2 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm max-w-md text-center">
            {{ session('error') }}
        </div>
    </div>
@endif

<div class="grid grid-cols-12 gap-4 w-full">
    <div class="col-span-12 md:col-span-4 bg-white rounded-2xl shadow-md overflow-hidden">

        <div class="bg-blue-50 px-3 py-1">
            <h2 class="text-blue-900 font-bold text-base">General</h2>
        </div>

        <div class="px-6 py-6">
            <ul class="space-y-4 list-disc list-inside marker:text-slate-800">
                <li><a href="{{ route('configuracion.banco') }}" class="text-gray-800 text-sm hover:underline">Listado de bancos</a></li>
                <li><a href="{{ route('configuracion.cuentabancaria') }}" class="text-gray-800 text-sm hover:underline">Listado de cuentas bancarias</a></li>
                <li><a href="{{ route('configuracion.moneda') }}" class="text-gray-800 text-sm hover:underline">Lista de monedas</a></li>
                <li><a href="{{ route('configuracion.tarjeta') }}" class="text-gray-800 text-sm hover:underline">Listado de tarjetas</a></li>
                <li><a href="{{ route('configuracion.plataforma') }}" class="text-gray-800 text-sm hover:underline">Plataformas</a></li>
            </ul>
        </div>

    </div>

    <div class="col-span-12 md:col-span-4 bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-blue-50 px-3 py-1">
            <h2 class="text-blue-900 font-bold text-base">Empresa</h2>
        </div>
        <div class="px-6 py-6">
            <ul class="space-y-4 list-disc list-inside marker:text-slate-800">
                <li><a href="{{ route('configuracion.compania') }}" class="text-gray-800 text-sm hover:underline">Empresa</a></li>
                <li><a href="#" class="text-gray-800 text-sm hover:underline">Giro de negocio</a></li>
                <li><a href="#" id="open-styles-2" class="text-gray-800 text-sm hover:underline">Estilos y temas</a></li>
                <li><a href="#" class="text-gray-800 text-sm hover:underline">Avanzado</a></li>
                <li><a href="#" class="text-gray-800 text-sm hover:underline">Generador de link de pago</a></li>
                <li><a href="#" class="text-gray-800 text-sm hover:underline">Tienda Virtual/Restaurante</a></li> 
            </ul>
        </div>
    </div>


    <div class="col-span-12 md:col-span-4 bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-blue-50 px-3 py-1">
            <h2 class="text-blue-900 font-bold text-base">SUNAT</h2>
        </div>
        <div class="px-6 py-6">
            <ul class="space-y-4 list-disc list-inside marker:text-slate-800">
                <li><a href="{{ route('configuracion.atributo') }}" class="text-gray-800 text-sm hover:underline">Listado de Atributos</a></li>
                <li><a href="{{ route('configuracion.detraccion') }}" class="text-gray-800 text-sm hover:underline">Listado de tipos de detracciones</a></li>
                <li><a href="{{ route('configuracion.unidad') }}" class="text-gray-800 text-sm hover:underline">Listado de unidades</a></li>
                <li><a href="{{ route('configuracion.traslado') }}" class="text-gray-800 text-sm hover:underline">Tipos de motivos de transferencias</a></li>
            </ul>
        </div>
    </div>

    <div class="col-span-12 md:col-span-4 bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-blue-50 px-3 py-1">
            <h2 class="text-blue-900 font-bold text-base">Ingresos/Egresos</h2>
        </div>
        <div class="px-6 py-6">
            <ul class="space-y-4 list-disc list-inside marker:text-slate-800">
                <li><a href="{{ route('configuracion.metodopago') }}" class="text-gray-800 text-sm hover:underline">Métodos de pago - ingreso / gastos</a></li>
                <li><a href="{{ route('configuracion.motivogasto') }}" class="text-gray-800 text-sm hover:underline">Motivos de ingresos / Gastos</a></li>
               <!--<li><a href="#" class="text-gray-800 text-sm hover:underline">Listado de métodos de pago</a></li> -->
                <li><a href="{{ route('configuracion.tipocomprobante') }}" class="text-gray-800 text-sm hover:underline">Tipos de comprobantes INGRESOS Y GASTOS</a></li>
            </ul>
        </div>
    </div>
    <div class="col-span-12 md:col-span-4 bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-blue-50 px-3 py-1">
            <h2 class="text-blue-900 font-bold text-base">Plantillas PDF</h2>
        </div>
        <div class="px-6 py-6">
            <ul class="space-y-4 list-disc list-inside marker:text-slate-800">
                <li><a href="#" class="text-gray-800 text-sm hover:underline">PDF</a></li>
                <li><a href="#" class="text-gray-800 text-sm hover:underline">PDF - Ticket</a></li>
                <li><a href="#" class="text-gray-800 text-sm hover:underline">Pre Impresos</a></li>
            </ul>
        </div>
    </div>
    <div class="col-span-12 md:col-span-4 bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-blue-50 px-3 py-1">
            <h2 class="text-blue-900 font-bold text-base">Avanzado</h2>
        </div>
        <div class="px-6 py-6">
            <ul class="space-y-4 list-disc list-inside marker:text-slate-800">
                <li><a href="#" class="text-gray-800 text-sm hover:underline">Tareas programadas</a></li>
                <li><a href="#" class="text-gray-800 text-sm hover:underline">Numeración de facturación</a></li>
                <li><a href="#" class="text-gray-800 text-sm hover:underline">Avanzado - Contable</a></li> 
                <li><a href="#" class="text-gray-800 text-sm hover:underline">Inventarios</a></li> 
                <li><a href="#" class="text-gray-800 text-sm hover:underline">Nota de ventas</a></li> 
            </ul>
        </div>
    </div>

    <div class="col-span-12 md:col-span-4 bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-blue-50 px-3 py-1">
            <h2 class="text-blue-900 font-bold text-base">Visual</h2>
        </div>
        <div class="px-6 py-6">
            <ul class="space-y-4 list-disc list-inside marker:text-slate-800">
                <li><a href="{{ route('configuracion.login') }}" class="text-gray-800 text-sm hover:underline">Login</a></li>
            </ul>
        </div>
    </div>

    <div class="col-span-12 md:col-span-4 bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-blue-50 px-3 py-1">
            <h2 class="text-blue-900 font-bold text-base">Comisiones</h2>
        </div>
        <div class="px-6 py-6">
            <ul class="space-y-4 list-disc list-inside marker:text-slate-800">
                <li><a href="#" class="text-gray-800 text-sm hover:underline">Vendedores</a></li>
                <li><a href="#" class="text-gray-800 text-sm hover:underline">Productos</a></li>
                <li><a href="#" class="text-gray-800 text-sm hover:underline">Cuentas pendientes</a></li>
            </ul>
        </div>
    </div>



<!-- Estilos y temas -->

@php
    $estiloFormulario = $estiloEditar ?? $estiloActivo ?? null;
@endphp
<div id="backdrop" class="fixed inset-0 hidden z-40"></div>
<div id="styles-panel" data-editando="{{ isset($estiloEditar) ? '1' : '0' }}"
    class="fixed top-16 right-0 h-[calc(100vh-4rem)] w-80 bg-white shadow-2xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out flex flex-col">
    <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200 bg-white flex-shrink-0">
        <h2 class="text-base font-bold text-gray-800">
            Estilos y temas
        </h2>
        <button id="close-styles" type="button"
            class="text-gray-400 hover:text-gray-700 text-xl font-bold p-1">
            &times;
        </button>
    </div>

    <div class="p-6 overflow-y-auto flex-1 space-y-6">
        <form action="{{ isset($estiloEditar) ? route('configuracion.estilo.update', $estiloEditar->id) : route('configuracion.estilo.store') }}" method="POST">
            @csrf
            @if(isset($estiloEditar))
                @method('PUT')
            @endif
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <div class="relative flex items-center">
                        <span class="absolute left-3 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </span>
                        <input
                            type="text" name="nombre" value="{{ old('nombre', $estiloFormulario->nombre ?? '') }}"
                            placeholder="Ej. Azul principal" class="w-full border border-gray-300 rounded-lg pl-9 pr-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#0407e2]"required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Color
                    </label>
                    <div class="flex items-center gap-3">
                        <div class="relative flex items-center">
                            <span class="absolute left-2.5 text-gray-400 pointer-events-none z-10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
                                    </path>
                                </svg>
                            </span>
                            <input type="color" id="color_picker"  value="{{ old('color', $estiloFormulario->color ?? '#0407e2') }}"  class="w-12 h-10 border border-gray-300 rounded cursor-pointer p-1 bg-white">
                        </div>
                        <input type="text" name="color" id="color_hex" value="{{ old('color', $estiloFormulario->color ?? '#0407e2') }}"
                            maxlength="7" placeholder="#0407e2" class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm uppercase focus:outline-none focus:ring-2 focus:ring-[#0407e2]" required>
                    </div>

                    <span class="text-xs text-gray-500 mt-1 block">
                        Selecciona un color o escribe su código hexadecimal.
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Modo</label>
                    <label class="inline-flex items-center cursor-pointer gap-3">
                        <input type="hidden" name="modo" value="claro">
                        <input type="checkbox" name="modo"  value="oscuro" class="sr-only peer"
                            {{ old('modo', $estiloFormulario->modo ?? 'claro') === 'oscuro' ? 'checked' : '' }}>
                        <span class="text-sm font-medium text-slate-400 peer-checked:text-slate-400 peer-not-checked:text-[#0407e2] peer-not-checked:font-semibold">
                            Claro
                        </span>
                        <div class="relative w-11 h-6 bg-slate-300 rounded-full peer peer-checked:after:translate-x-full
                            after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                            after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0407e2]">
                        </div>
                        <span class="text-sm font-medium text-slate-400 peer-checked:text-[#0407e2] peer-checked:font-semibold">
                            Oscuro
                        </span>
                    </label>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Menú lateral</label>
                    <label class="inline-flex items-center cursor-pointer gap-3">
                        <input type="hidden" name="menu_lateral" value="expandido">
                        <input type="checkbox" name="menu_lateral" value="colapsado" class="sr-only peer"
                            {{ old('menu_lateral', $estiloFormulario->menu_lateral ?? 'expandido') === 'colapsado' ? 'checked' : '' }}>
                        <span class="text-sm font-medium text-slate-400 peer-checked:text-slate-400 peer-not-checked:text-[#0407e2] peer-not-checked:font-semibold">
                            Expandido
                        </span>
                        <div class="relative w-11 h-6 bg-slate-300 rounded-full peer peer-checked:after:translate-x-full
                            after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                            after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0407e2]">
                        </div>
                        <span class="text-sm font-medium text-slate-400 peer-checked:text-[#0407e2] peer-checked:font-semibold">
                            Colapsado
                        </span>
                    </label>
                </div>
                <button type="submit" class="w-full text-white py-2.5 rounded-lg text-sm font-medium transition-colors shadow-sm"style="background-color: #0407e2;">
                    {{ isset($estiloEditar) ? 'Actualizar estilo' : 'Guardar estilo' }}
                </button>
                @if(isset($estiloEditar))
                    <a
                        href="{{ route('configuracion') }}"
                        class="block w-full text-center border border-gray-300 text-gray-600 hover:bg-gray-50 py-2.5 rounded-lg text-sm font-medium">
                        Cancelar
                    </a>
                @endif
            </div>
        </form>
        <div class="border-t border-gray-200 pt-4">
            <h3 class="text-sm font-semibold text-gray-800 mb-3"> Mis estilos</h3>
            <div class="space-y-2">
                @forelse($estilos as $estilo)
                    <div class="border rounded-lg p-2.5 flex items-center justify-between gap-2
                        {{ $estilo->estado === 'ACTIVO' ? 'border-[#0407e2] bg-blue-50/50' : 'border-gray-200 bg-white' }}">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <span class="w-7 h-7 rounded-full border border-gray-300 flex-shrink-0" style="background-color: {{ $estilo->color }};">
                            </span>
                            <div class="min-w-0">
                                <div class="flex items-center gap-1.5">
                                    <p class="text-xs font-semibold text-gray-800 truncate"> {{ $estilo->nombre }}</p>
                                    @if($estilo->estado === 'ACTIVO')
                                        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-[#0407e2] text-white">
                                            Activo
                                        </span>
                                    @endif
                                </div>
                                <p class="text-[11px] text-gray-400 font-mono">
                                    {{ $estilo->color }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-1.5 flex-shrink-0">
                            @if($estilo->estado !== 'ACTIVO')
                                <form
                                    action="{{ route('configuracion.estilo.activar', $estilo->id) }}"method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="border border-[#0407e2] text-[#0407e2] hover:bg-[#0407e2] hover:text-white px-2 py-1 rounded text-xs font-medium transition-colors">
                                        Seleccionar
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('configuracion.estilo.editar', $estilo->id) }}" class="border border-gray-300 text-gray-600 hover:bg-gray-100 px-2 py-1 rounded text-xs font-medium">
                                Editar
                            </a>
                            <button type="button"
                                onclick="confirmarEliminar('{{ route('configuracion.estilo.eliminar', $estilo->id) }}')"
                                class="px-2 py-1 rounded text-white text-[10px] font-medium"
                                style="background-color: #D50000;">
                                Eliminar
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4">
                        <p class="text-xs text-gray-500">
                            No tienes estilos guardados.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
</div>


@endsection