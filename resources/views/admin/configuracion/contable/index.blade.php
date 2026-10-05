@extends('layouts.admin.app')
@section('title', 'Cuentas contables (Ventas)')
@section('js')
@endsection

@section('content')
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
            <i class="fa-solid fa-book"></i>Avanzado - Contable
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

    <form action="{{ route('configuracion.contable.store') }}" method="POST">
        @csrf
        <div class="bg-white rounded-lg shadow-sm border border-slate-100 overflow-hidden">
            <div class="px-6 py-4 flex justify-between items-center" style="background-color: var(--active-pink);">
                <h1 class="flex items-center gap-2 text-base font-semibold text-white">
                    <i class="fa-solid fa-book"></i>
                    Cuentas contables (Ventas)
                </h1>
            </div>

            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Total Soles</label>
                        <input type="text" name="venta_total_soles" maxlength="20"
                            value="{{ old('venta_total_soles', $cuenta->venta_total_soles ?? '') }}"
                            class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">IGV Soles</label>
                        <input type="text" name="venta_igv_soles" maxlength="20"
                            value="{{ old('venta_igv_soles', $cuenta->venta_igv_soles ?? '') }}"
                            class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Subtotal Soles</label>
                        <input type="text" name="venta_subtotal_soles" maxlength="20"
                            value="{{ old('venta_subtotal_soles', $cuenta->venta_subtotal_soles ?? '') }}"
                            class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]" required>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Total Dólares</label>
                        <input type="text" name="venta_total_dolares" maxlength="20"
                            value="{{ old('venta_total_dolares', $cuenta->venta_total_dolares ?? '') }}"
                            class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">IGV Dólares</label>
                        <input type="text" name="venta_igv_dolares" maxlength="20"
                            value="{{ old('venta_igv_dolares', $cuenta->venta_igv_dolares ?? '') }}"
                            class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Subtotal Dólares</label>
                        <input type="text" name="venta_subtotal_dolares" maxlength="20"
                            value="{{ old('venta_subtotal_dolares', $cuenta->venta_subtotal_dolares ?? '') }}"
                            class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]" required>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="text-white px-6 py-2 rounded-md font-medium transition hover:opacity-90" style="background-color: var(--active-pink);">
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
