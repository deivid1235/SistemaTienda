@extends('layouts.admin.app')
@section('title', 'Compañía o Empresa')

@section('js')
@endsection

@section('content')
    <div class="flex items-center gap-2 text-sm mb-4">
        <a href="{{ route('configuracion.index') }}" class="text-slate-400 hover:text-slate-700 flex items-center gap-1">
            <i class="fa-solid fa-house"></i>Dashboard
        </a>
        <span class="text-slate-400">/</span>
        <span class="text-slate-700 font-semibold flex items-center gap-1">
            <i class="fa-solid fa-gear"></i>Configuración
        </span>
    </div>

    <!-- Formulario Principal -->
    <form action="{{ route('configuracion.compania.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="columns-1 lg:columns-2 gap-6 space-y-6 mb-8 [&>div]:break-inside-avoid">
            <!-- TARJETA 1: Datos de la Empresa -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-100 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="px-6 py-4 flex justify-between items-center" style="background-color: #0407e2;">
                        <h1 class="flex items-center gap-2 text-base font-semibold text-white">
                            <i class="fa-solid fa-building"></i>
                            Datos de la Empresa
                        </h1>
                        <div class="flex items-center gap-2">
                            <span class="text-white text-sm font-medium"> RUC:</span>
                            <input type="text" name="ruc" maxlength="11" value="{{ old('ruc', $compania->ruc ?? '') }}" placeholder="Ingrese RUC"
                                class="w-36 text-sm text-slate-700 bg-white border-0 rounded-md px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-white"
                            required>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Nombre <span class="text-red-500">*</span></label>
                                <input type="text" name="nombre" value="{{ old('nombre', $compania->nombre ?? '') }}" class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]" required>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Nombre comercial <span class="text-red-500">*</span></label>
                                <input type="text" name="nombre_comercial" value="{{ old('nombre_comercial', $compania->nombre_comercial ?? '') }}" class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]" required>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Logo (modo claro)</label>
                                <div class="flex gap-2">
                                    <div class="flex flex-grow">
                                        <input type="text" readonly value="{{ $compania->logo ?? 'Ningún archivo cargado' }}" class="w-full text-sm border border-slate-300 rounded-l-md px-3 py-2 bg-slate-50 text-slate-500">
                                        <label class="cursor-pointer text-white px-4 py-2 rounded-r-md flex items-center justify-center transition hover:opacity-90" style="background-color: #0407e2;">
                                            <i class="fa-solid fa-cloud-arrow-up"></i>
                                            <input type="file" name="logo" class="hidden">
                                        </label>
                                    </div>
                                    <button type="button" class="border border-red-200 bg-red-50 text-red-500 hover:bg-red-100 px-3 py-2 rounded-md flex items-center justify-center transition">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </div>
                                <p class="text-[11px] text-slate-400 mt-1">Se recomienda resoluciones 700x300</p>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Logo (modo oscuro)</label>
                                <div class="flex">
                                    <input type="text" readonly value="{{ $compania->logo_oscuro ?? 'Ningún archivo cargado' }}" class="w-full text-sm border border-slate-300 rounded-l-md px-3 py-2 bg-slate-50 text-slate-500">
                                    <label class="cursor-pointer text-white px-4 py-2 rounded-r-md flex items-center justify-center transition hover:opacity-90" style="background-color: #0407e2;">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                        <input type="file" name="logo_oscuro" class="hidden">
                                    </label>
                                </div>
                                <p class="text-[11px] text-slate-400 mt-1">Se recomienda resoluciones 700x300</p>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Nº Cuenta de detracción</label>
                                <input type="text" name="cuenta_detraccion" value="{{ old('cuenta_detraccion', $compania->cuenta_detraccion ?? '') }}" class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Rúbrica (Firma digital)</label>
                                <div class="flex">
                                    <input type="text" readonly value="{{ $compania->rubrica ?? 'Ningún archivo cargado' }}" class="w-full text-sm border border-slate-300 rounded-l-md px-3 py-2 bg-slate-50 text-slate-500">
                                    <label class="cursor-pointer text-white px-4 py-2 rounded-r-md flex items-center justify-center transition hover:opacity-90" style="background-color: #0407e2;">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                        <input type="file" name="rubrica" class="hidden">
                                    </label>
                                </div>
                                <p class="text-[11px] text-slate-400 mt-1">Se recomienda resoluciones 700x300</p>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Favicon (icono web)</label>
                                <div class="flex">
                                    <input type="text" readonly value="{{ $compania->favicon ?? 'Ningún archivo cargado' }}" class="w-full text-sm border border-slate-300 rounded-l-md px-3 py-2 bg-slate-50 text-slate-500">
                                    <label class="cursor-pointer text-white px-4 py-2 rounded-r-md flex items-center justify-center transition hover:opacity-90" style="background-color: #0407e2;">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                        <input type="file" name="favicon" class="hidden">
                                    </label>
                                </div>
                                <p class="text-[11px] text-slate-400 mt-1">Se recomienda una imagen con fondo transparente y cuadrada en PNG</p>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Título (nombre web)</label>
                                <input type="text" name="titulo_web" value="{{ old('titulo_web', $compania->titulo_web ?? 'Facturación Electrónica') }}" class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]">
                                <p class="text-[11px] text-slate-400 mt-1">Requiere recargar la página</p>
                            </div>
                            <div class="md:col-span-2 border-t border-slate-100 pt-6 mt-2">
                                <h2 class="text-sm font-semibold text-slate-700 mb-4">Entorno del sistema y Logo APP</h2>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Logo APP</label>
                                        <div class="flex">
                                            <input type="text" readonly value="{{ $compania->logo_app ?? 'Ningún archivo cargado' }}" class="w-full text-sm border border-slate-300 rounded-l-md px-3 py-2 bg-slate-50 text-slate-500">
                                            <label class="cursor-pointer text-white px-4 py-2 rounded-r-md flex items-center justify-center transition hover:opacity-90" style="background-color: #0407e2;">
                                                <i class="fa-solid fa-cloud-arrow-up"></i>
                                                <input type="file" name="logo_app" class="hidden">
                                            </label>
                                        </div>
                                        <p class="text-[11px] text-slate-400 mt-1">Se recomienda color blanco</p>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">SOAP Tipo</label>
                                        <select name="soap_tipo" class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]">
                                            <option value="demo" {{ old('soap_tipo', $compania->soap_tipo ?? '') == 'demo' ? 'selected' : '' }}>Demo</option>
                                            <option value="produccion" {{ old('soap_tipo', $compania->soap_tipo ?? '') == 'produccion' ? 'selected' : '' }}>Producción</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">SOAP Envío</label>
                                        <select name="soap_envio" class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 bg-white focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]">
                                            <option value="sunat" {{ old('soap_envio', $compania->soap_envio ?? '') == 'sunat' ? 'selected' : '' }}>Sunat</option>
                                            <option value="ose" {{ old('soap_envio', $compania->soap_envio ?? '') == 'ose' ? 'selected' : '' }}>OSE</option>
                                            <option value="osesendfact" {{ old('soap_envio', $compania->soap_envio ?? '') == 'osesendfact' ? 'selected' : '' }}>OSESendFact</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="p-6 pt-0 flex justify-end">
                    <button type="submit" class="text-white px-6 py-2 rounded-md font-medium transition hover:opacity-90" style="background-color: #0407e2;">
                        Guardar
                    </button>
                </div>
            </div>

           <!-- TARJETA 2: Consulta integrada de CPE - Validador de documentos -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-100 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="px-6 py-4 flex justify-between items-center" style="background-color: #0407e2;">
                        <h1 class="flex items-center gap-2 text-base font-semibold text-white">
                            <i class="fa-solid fa-circle-info"></i>
                            Consulta integrada de CPE - Validador de documentos
                        </h1>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Client ID</label>
                                <input type="text" name="cpe_client_id" value="{{ old('cpe_client_id', $compania->cpe_client_id ?? '') }}" class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Client Secret (Clave)</label>
                                <input type="text" name="cpe_client_secret" value="{{ old('cpe_client_secret', $compania->cpe_client_secret ?? '') }}" class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 pt-0 flex justify-end">
                    <button type="submit" class="text-white px-6 py-2 rounded-md font-medium transition hover:opacity-90" style="background-color: #0407e2;">
                        Guardar
                    </button>
                </div>
            </div>

            <!-- TARJETA 3: Guías electrónicas -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-100 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="px-6 py-4 flex justify-between items-center" style="background-color: #0407e2;">
                        <h1 class="flex items-center gap-2 text-base font-semibold text-white">
                            <i class="fa-solid fa-file-invoice"></i>
                            Guías electrónicas
                        </h1>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <h3 class="text-sm font-semibold text-slate-700 pb-2 border-b border-slate-100">Usuario Secundario Sunat</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">SOAP Usuario</label>
                                <input type="text" name="guias_soap_usuario" value="{{ old('guias_soap_usuario', $compania->guias_soap_usuario ?? '') }}" class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]">
                                <p class="text-[11px] text-slate-400 mt-1">RUC + Usuario. Ejemplo: 01234567890ELUSUARIO</p>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">SOAP Password</label>
                                <input type="password" name="guias_soap_password" value="{{ old('guias_soap_password', $compania->guias_soap_password ?? '') }}" class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Client ID</label>
                                <input type="text" name="guias_client_id" value="{{ old('guias_client_id', $compania->guias_client_id ?? '') }}" class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Client Secret (Clave)</label>
                                <input type="text" name="guias_client_secret" value="{{ old('guias_client_secret', $compania->guias_client_secret ?? '') }}" class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 pt-0 flex justify-end">
                    <button type="submit" class="text-white px-6 py-2 rounded-md font-medium transition hover:opacity-90" style="background-color: #0407e2;">
                        Guardar
                    </button>
                </div>
            </div>

            <!-- TARJETA 4: SIRE -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-100 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="px-6 py-4 flex justify-between items-center" style="background-color: #0407e2;">
                        <h1 class="flex items-center gap-2 text-base font-semibold text-white">
                            <i class="fa-solid fa-file-shield"></i>
                            SIRE
                        </h1>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Client ID</label>
                                <input type="text" name="sire_client_id" value="{{ old('sire_client_id', $compania->sire_client_id ?? '') }}" class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Client Secret (clave)</label>
                                <input type="text" name="sire_client_secret" value="{{ old('sire_client_secret', $compania->sire_client_secret ?? '') }}" class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">Usuario</label>
                                <input type="text" name="sire_usuario" value="{{ old('sire_usuario', $compania->sire_usuario ?? '') }}" class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1">
                                    Contraseña
                                </label>
                                <input type="password" name="sire_password" value="{{ old('sire_password', $compania->sire_password ?? '') }}"
                                class="w-full text-sm border border-slate-300 rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-[#0407e2] focus:border-[#0407e2]">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 pt-0 flex justify-start">
                    <button type="submit" class="text-white px-6 py-2 rounded-md font-medium transition hover:opacity-90" style="background-color: #0407e2;">
                        Guardar
                    </button>
                </div>
            </div>


           <!-- TARJETA 5: Envío de mensajes a través de QR Api -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-100 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="px-6 py-4 flex justify-between items-center" style="background-color: #0407e2;">
                        <h1 class="flex items-center gap-2 text-base font-semibold text-white">
                            <i class="fa-solid fa-qrcode"></i>
                            Envio de mensajes a través de QR Api
                        </h1>
                    </div>

                    <div class="p-6 space-y-6">
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Deshabilitado esta función tiene dos formas de enviar sus comprobantes, a través de Chat Buho o el Servicio de WhatsApp Web
                        </p>

                        <!-- Toggle Switch No / Sí -->
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-semibold text-slate-600">No</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox"  name="qr_api_habilitado"  value="1"  class="sr-only peer"{{ old('qr_api_habilitado', $compania->qr_api ?? false) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0407e2]">
                                </div>
                            </label>
                            <span class="text-xs font-semibold text-slate-600">Sí</span>
                        </div>
                    </div>
                </div>
                <!-- Botón Guardar -->
                <div class="p-6 pt-0 flex justify-start">
                    <button type="submit" class="text-white px-6 py-2 rounded-md font-medium transition hover:opacity-90" style="background-color: #0407e2;">
                        Guardar
                    </button>
                </div>
            </div>


            <!-- TARJETA 6: Configuración de pagos -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-100 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="px-6 py-4 flex justify-between items-center" style="background-color: #0407e2;">
                        <h1 class="flex items-center gap-2 text-base font-semibold text-white">
                            <i class="fa-solid fa-credit-card"></i>
                            Configuración de pagos
                        </h1>
                        <i class="fa-solid fa-chevron-up text-white text-sm"></i>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Pestañas (Tabs) -->
                        <div class="flex border-b border-slate-200 gap-6">
                            <button type="button" class="pb-3 text-sm font-semibold border-b-2 text-[#0407e2] border-[#0407e2] transition">
                                Yape
                            </button>
                            <button type="button" class="pb-3 text-sm font-medium text-slate-400 hover:text-slate-600 transition">
                                Mercado Pago
                            </button>
                        </div>

                        <!-- Habilitar Switch -->
                        <div class="space-y-2">
                            <label class="block text-xs font-semibold text-slate-600 uppercase">
                                Habilitar
                            </label>
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-semibold text-slate-600">No</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input  type="checkbox" name="pago_yape_habilitado"  value="1" class="sr-only peer"{{ old('pago_yape_habilitado', $compania->yape_habilitado ?? false) ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0407e2]">
                                    </div>
                                </label>
                                <span class="text-xs font-semibold text-slate-600">Sí</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- Botón Guardar -->
                <div class="p-6 pt-0 flex justify-end">
                    <button type="submit" class="text-white px-6 py-2 rounded-md font-medium transition hover:opacity-90" style="background-color: #0407e2;">
                        Guardar
                    </button>
                </div>
            </div>

            <!-- TARJETA 7: Certificado Qz Tray -->
            <div class="bg-white rounded-lg shadow-sm border border-slate-100 overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="px-6 py-4 flex justify-between items-center" style="background-color: #0407e2;">
                        <h1 class="flex items-center gap-2 text-base font-semibold text-white">
                            <i class="fa-solid fa-certificate"></i>
                            Certificado Qz Tray
                        </h1>
                    </div>
                    <div class="p-6 space-y-6">
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Se tiene que ingresar los dos archivos generados en los certificados de Qz Tray (<span class="font-semibold text-slate-700">Es importante que se coloque los dos certificados</span>)
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1 text-center">
                                    Digital Certificate
                                </label>
                                <div class="flex">
                                    <input type="text"  readonly  value="{{ $compania->digital_certificate_qztray ?? 'Ningún archivo cargado' }}" class="w-full text-sm border border-slate-300 rounded-l-md px-3 py-2 bg-slate-50 text-slate-500">
                                    <label 
                                        class="cursor-pointer text-white px-4 py-2 rounded-r-md flex items-center justify-center transition hover:opacity-90" style="background-color: #0407e2;">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                        <input  type="file"  name="digital_certificate_qztray"  class="hidden">
                                    </label>
                                </div>
                            </div>

                            <!-- Private Key -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-600 uppercase mb-1 text-center">
                                    Private Key
                                </label>
                                <div class="flex">
                                    <input type="text" readonly  value="{{ $compania->private_certificate_qztray ?? 'Ningún archivo cargado' }}" 
                                        class="w-full text-sm border border-slate-300 rounded-l-md px-3 py-2 bg-slate-50 text-slate-500">
                                    <label  class="cursor-pointer text-white px-4 py-2 rounded-r-md flex items-center justify-center transition hover:opacity-90" 
                                        style="background-color: #0407e2;">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                        <input  type="file" name="private_certificate_qztray" class="hidden">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Botón Guardar -->
                <div class="p-6 pt-0 flex justify-end">
                    <button type="submit" class="text-white px-6 py-2 rounded-md font-medium transition hover:opacity-90" style="background-color: #0407e2;">
                        Guardar
                    </button>
                </div>
            </div>

            <!-- TARJETA 8: Servicio PSE -->
<div class="bg-white rounded-lg shadow-sm border border-slate-100 overflow-hidden flex flex-col justify-between">
    <div>
        <div class="px-6 py-4 flex justify-between items-center" style="background-color: #0407e2;">
            <h1 class="flex items-center gap-2 text-base font-semibold text-white">
                <i class="fa-solid fa-server"></i>
                Servicio PSE
                <i class="fa-solid fa-circle-info text-xs ml-1"></i>
            </h1>
        </div>

        <div class="p-6 space-y-6">
            <!-- Habilitar Switch -->
            <div class="space-y-2">
                <label class="block text-xs font-semibold text-slate-600 uppercase">Habilitar</label>
                <div class="flex items-center gap-3">
                    <span class="text-xs font-semibold text-slate-600">No</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="servicio_pse_habilitado" value="1" class="sr-only peer" {{ old('servicio_pse_habilitado', $compania->pse_habilitado ?? false) ? 'checked' : '' }} >
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0407e2]"></div>
                    </label>
                    <span class="text-xs font-semibold text-slate-600">Sí</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Botón Guardar -->
    <div class="p-6 pt-0 flex justify-end">
        <button type="submit" class="text-white px-6 py-2 rounded-md font-medium transition hover:opacity-90" style="background-color: #0407e2;">
            Guardar
        </button>
    </div>
</div>

        </div>
    </form>
@endsection