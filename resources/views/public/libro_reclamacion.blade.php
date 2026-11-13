@extends('public.app')

@section('content')
<section class="bg-slate-50/50 py-6 sm:py-10 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-3 mb-2">
                <div class="inline-flex items-center justify-center w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-blue-50 border border-blue-200/70 shadow-xs shrink-0">
                    <svg class="w-6 h-6 sm:w-7 sm:h-7 text-[#000000]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-black text-slate-900 tracking-tight">LIBRO DE RECLAMACIONES</h1>
            </div>
            <p class="text-xs sm:text-sm text-slate-500 font-medium">Conforme a lo establecido en el Código de Protección y Defensa del Consumidor (Ley N° 29571).</p>
        </div>

        <div class="bg-white border border-blue-300/90 rounded-3xl p-6 sm:p-10 shadow-xl shadow-blue-900/5 relative overflow-hidden">
            <form action="{{ route('libro.reclamacion.store') }}" method="POST" class="space-y-8 relative z-10">
                @csrf
                <input type="hidden" name="clientes_id" value="{{ auth()->id() }}">
                
                <div class="space-y-5">
                    <h3 class="text-base sm:text-lg font-black text-[#000000] uppercase tracking-wide border-b border-slate-100 pb-3 flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-[#000000]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>1. Identificación del Consumidor</span>
                    </h3>

                   <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Tipo de Documento *</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-400">
                                    <i class="fa-solid fa-id-card"></i>
                                </span>
                                <select name="tipo_documento" required class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm sm:text-base text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all">
                                    <option value="">Seleccione</option>
                                    <option value="DNI">DNI</option>
                                    <option value="CE">Carnet de Extranjería (CE)</option>
                                    <option value="RUC">RUC</option>
                                    <option value="Pasaporte">Pasaporte</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">N° de Documento *</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-400">
                                    <i class="fa-solid fa-hashtag"></i>
                                </span>
                                <input type="text" name="numero_documento" required placeholder="Número" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm sm:text-base text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Correo Electrónico *</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-400">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <input type="email" name="correo" required placeholder="ejemplo@correo.com" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm sm:text-base text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Teléfono / Celular *</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-400">
                                    <i class="fa-solid fa-phone"></i>
                                </span>
                                <input type="tel" name="telefono" required placeholder="987654321" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm sm:text-base text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Primer Nombre *</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-400">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <input type="text" name="primer_nombre" required placeholder="Primer nombre" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm sm:text-base text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Segundo Nombre (Opcional)</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-400">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <input type="text" name="segundo_nombre" placeholder="Segundo nombre" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm sm:text-base text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Primer Apellido *</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-400">
                                    <i class="fa-solid fa-user-tag"></i>
                                </span>
                                <input type="text" name="primer_apellido" required placeholder="Primer apellido" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm sm:text-base text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Segundo Apellido *</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-400">
                                    <i class="fa-solid fa-user-tag"></i>
                                </span>
                                <input type="text" name="segundo_apellido" required placeholder="Segundo apellido" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm sm:text-base text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all">
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                        <div class="md:col-span-2">
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Dirección de Domicilio *</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-400">
                                    <i class="fa-solid fa-location-dot"></i>
                                </span>
                                <input type="text" name="direccion" required placeholder="Av. / Calle / Mz. Lote" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm sm:text-base text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all">
                            </div>
                        </div>
                        <div class="grid grid-cols-3 md:col-span-2 gap-3">
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Departamento *</label>
                                <div class="relative flex items-center">
                                    <span class="absolute left-3 text-slate-400 text-xs">
                                        <i class="fa-solid fa-map"></i>
                                    </span>
                                    <input type="text" name="departamento" required placeholder="Dep." class="w-full pl-9 pr-2.5 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Provincia *</label>
                                <div class="relative flex items-center">
                                    <span class="absolute left-3 text-slate-400 text-xs">
                                        <i class="fa-solid fa-map-location-dot"></i>
                                    </span>
                                    <input type="text" name="provincia" required placeholder="Prov." class="w-full pl-9 pr-2.5 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Distrito *</label>
                                <div class="relative flex items-center">
                                    <span class="absolute left-3 text-slate-400 text-xs">
                                        <i class="fa-solid fa-location-crosshairs"></i>
                                    </span>
                                    <input type="text" name="distrito" required placeholder="Dist." class="w-full pl-9 pr-2.5 py-3 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-5 pt-6 border-t border-slate-100">
                    <h3 class="text-base sm:text-lg font-black text-[#000000] uppercase tracking-wide border-b border-slate-100 pb-3 flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-[#000000]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <span>2. Identificación del Bien Contratado</span>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                        <div class="md:col-span-2">
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Servicio / Producto Contratado *</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-400">
                                    <i class="fa-solid fa-box"></i>
                                </span>
                                <input type="text" name="servicio_contratado" required placeholder="Ej. Zapatillas I-RUN / Calzado Deportivo" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm sm:text-base text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">N° de Orden / Boleta (Opcional)</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-400">
                                    <i class="fa-solid fa-receipt"></i>
                                </span>
                                <input type="text" name="numero_orden" placeholder="Ej. #ORD-12345" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm sm:text-base text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Monto Reclamado (S/.) (Opcional)</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-400">
                                    <i class="fa-solid fa-coins"></i>
                                </span>
                                <input type="number" step="0.01" name="monto_reclamado" placeholder="0.00" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm sm:text-base text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all">
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Identificación del Servicio / Modelo (Opcional)</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-slate-400">
                                <i class="fa-solid fa-tag"></i>
                            </span>
                            <input type="text" name="identificacion_servicio" placeholder="Código SKU o Modelo específico" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm sm:text-base text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all">
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN 3: DETALLE DE LA RECLAMACIÓN -->
                <div class="space-y-5 pt-6 border-t border-slate-100">
                    <h3 class="text-base sm:text-lg font-black text-[#000000] uppercase tracking-wide border-b border-slate-100 pb-3 flex items-center gap-2.5">
                        <svg class="w-5 h-5 text-[#000000]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span>3. Detalle de la Reclamación</span>
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 items-center">
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-2">Tipo de Reclamación *</label>
                            <div class="flex items-center gap-6">
                                <label class="inline-flex items-center gap-2.5 cursor-pointer text-sm font-bold text-slate-800">
                                    <input type="radio" name="tipo_reclamo" value="Reclamo" required class="w-4 h-4 text-[#0407e2] focus:ring-[#0407e2]">
                                    <span>Reclamo</span>
                                </label>
                                <label class="inline-flex items-center gap-2.5 cursor-pointer text-sm font-bold text-slate-800">
                                    <input type="radio" name="tipo_reclamo" value="Queja" required class="w-4 h-4 text-[#0407e2] focus:ring-[#0407e2]">
                                    <span>Queja</span>
                                </label>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Motivo del Reclamo/Queja *</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-400">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                </span>
                                <input type="text" name="motivo" required placeholder="Resumen del inconveniente" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm sm:text-base text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all">
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Detalle de la Solicitud / Hechos *</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-slate-400">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </span>
                                <textarea name="detalle_solicitud" rows="4" required placeholder="Explique de forma clara lo sucedido..." class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm sm:text-base text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all"></textarea>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-bold text-slate-700 mb-1.5">Pedido Concreto *</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3.5 text-slate-400">
                                    <i class="fa-solid fa-bullseye"></i>
                                </span>
                                <textarea name="pedido_concreto" rows="4" required placeholder="¿Qué solución específica espera de parte de la empresa?" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm sm:text-base text-slate-800 font-medium outline-none focus:border-[#0407e2] focus:bg-white transition-all"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-100 space-y-6">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" name="acepto_politicas" value="1" checked required class="mt-1 w-4 h-4 text-[#0407e2] rounded focus:ring-[#0407e2]">
                        <span class="text-xs sm:text-sm text-slate-600 leading-relaxed font-medium">
                            Acepto las políticas de tratamiento de datos personales y declaro que la información consignada en la presente hoja de reclamación es verídica.
                        </span>
                    </label>

                    <div class="flex justify-end">
                        <button type="submit" class="w-full md:w-auto px-6 py-3 bg-black hover:bg-neutral-800 text-white font-bold text-xs sm:text-sm rounded-xl transition-all shadow-md hover:shadow-lg active:scale-95 flex items-center justify-center gap-2 uppercase tracking-wider">
                            <span>Enviar Hoja de Reclamación</span>
                            <svg class="w-4 h-4 stroke-current" fill="none" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3 21l18-9L3 3l3 9zm0 0h7.5"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection