@extends('layouts.admin.app')
@section('title', 'Configuración - Login')
@section('js')
@endsection
@section('content')

    <div class="flex items-center gap-2 text-sm mb-4">
        <a href="{{ route('configuracion.index') }}"
        class="text-slate-400 hover:text-slate-700 flex items-center gap-1">
            <i class="fa-solid fa-house"></i>Dashboard</a>
        <span class="text-slate-400">/</span>
        <span class="text-slate-700 font-semibold flex items-center gap-1">
            <i class="fa-solid fa-gear"></i>Configuración
        </span>
    </div>
    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-solid fa-user"></i>
        Personalización de login
    </h1>

    <form action="{{ route('configuracion.login.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white rounded-2xl shadow p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div>
                    <div id="contenedorPreview"
                        class="relative border-2 border-dashed border-slate-300 rounded-xl bg-slate-50 hover:border-[#0407e2] transition cursor-pointer
                            h-64 flex items-center justify-center overflow-hidden"
                        onclick="document.getElementById('imagenFondo').click()">
                        <div id="iconoSubir" class="text-center">
                            <div class="flex justify-center mb-3">
                                <div class="bg-white rounded-full p-5 shadow-md">
                                    <i class="fa-solid fa-cloud-arrow-up text-3xl"style="color: #0407e2;"></i>
                                </div>
                            </div>
                            <p class="text-sm font-semibold text-slate-600">
                                Subir imagen
                            </p>
                            <p class="text-xs text-slate-400 mt-1"> PNG o SVG</p>
                        </div>
                        <img id="previewImagen" src="" alt="Vista previa" class="hidden w-full h-full object-cover">
                    </div>
                    <p class="text-xs text-blue-600 mt-2">
                        Se recomienda una imagen de 747 x 547px con fondo transparente
                        en formato PNG o SVG.
                    </p>
                    <label
                        class="mt-3 block w-full text-center border font-semibold text-sm py-2.5 rounded-lg cursor-pointer text-white transition"
                        style="background-color: #0407e2; border-color: #0407e2;">
                        <i class="fa-solid fa-upload mr-1"></i>
                        Cambiar imagen de fondo
                        <input type="file"  id="imagenFondo" name="imagen_fondo" class="hidden" accept="image/png, image/svg+xml" onchange="mostrarVistaPrevia(event)" multiple>
                    </label>
                </div>

                <script>
                    function mostrarVistaPrevia(event) {
                        const archivo = event.target.files[0];
                        if (archivo) {
                            const lector = new FileReader();
                            lector.onload = function(e) {
                                document.getElementById('iconoSubir').classList.add('hidden');
                                const preview = document.getElementById('previewImagen');
                                preview.src = e.target.result;
                                preview.classList.remove('hidden');
                            };
                            lector.readAsDataURL(archivo);
                        }
                    }
                </script>

                {{-- Columna 2: Posición del formulario / logo --}}
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Posición del formulario</label>
                        <select name="posicion_formulario"
                                class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="derecha">Derecha</option>
                            <option value="izquierda">Izquierda</option>
                            <option value="centro">Centro</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium text-slate-700">Mostrar logo en el formulario</label>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="mostrar_logo" class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-200 rounded-full peer peer-checked:bg-indigo-700 transition-colors"></div>
                            <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Posición del logo de la empresa</label>
                        <select name="posicion_logo"
                                class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="superior-izquierda">Superior izquierda</option>
                            <option value="superior-derecha">Superior derecha</option>
                            <option value="inferior-izquierda">Inferior izquierda</option>
                            <option value="inferior-derecha">Inferior derecha</option>
                        </select>
                    </div>
                </div>

                {{-- Columna 3: Redes sociales --}}
                <div class="space-y-5">
                    <div class="flex items-center justify-between">
                        <label class="text-sm font-medium text-slate-700">Mostrar botones de redes sociales</label>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="mostrar_redes" class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-200 rounded-full peer peer-checked:bg-indigo-700 transition-colors"></div>
                            <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                        </label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Facebook</label>
                        <input type="text" name="facebook"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Twitter</label>
                        <input type="text" name="twitter"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Instagram</label>
                        <input type="text" name="instagram"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Linkedin</label>
                        <input type="text" name="linkedin"
                               class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <button type="submit" style="background-color:#0407e2;"class="w-full text-white text-sm font-semibold py-2.5 rounded-lg hover:opacity-90 transition">
                        GUARDAR
                    </button>
                </div>

            </div>
        </div>
    </form>

@endsection