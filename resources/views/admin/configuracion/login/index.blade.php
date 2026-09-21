@extends('layouts.admin.app')
@section('title', 'Configuración - Login')
@section('js')
@endsection
@section('content')
<div class="flex items-center gap-2 text-sm mb-4">
    <a href="{{ route('configuracion') }}"
        class="text-slate-400 hover:text-slate-700 flex items-center gap-1">
        <i class="fa-solid fa-house"></i>
        Dashboard
    </a>
    <span class="text-slate-400">/</span>
    <span class="text-slate-700 font-semibold flex items-center gap-1">
        <i class="fa-solid fa-gear"></i>
        Configuración
    </span>
</div>
<h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4"><i class="fa-solid fa-user"></i>
    Personalización de login
</h1>
<div class="bg-white rounded-2xl shadow p-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <div>
            <div id="zonaSeleccionImagen"
                class="relative border-2 border-dashed border-slate-300 rounded-xl bg-slate-50 hover:border-[#0407e2] transition h-64 flex items-center justify-center overflow-hidden cursor-pointer">
                @if(isset($imagenes) && $imagenes->count() > 0)
                    <img id="imagenPrevia" src="{{ asset($imagenes->first()->imagen) }}" alt="Vista previa"class="absolute inset-0 w-full h-full object-contain p-2 bg-white">
                    <div id="contenidoImagen" class="hidden text-center">
                        <div class="flex justify-center mb-3">
                            <div class="bg-white rounded-full p-5 shadow-md">
                                <i class="fa-solid fa-images text-3xl"
                                    style="color:#0407e2;"></i>
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-slate-600">
                            Imágenes del carrusel
                        </p>
                        <p class="text-xs text-slate-400 mt-1">
                            Haz clic aquí para seleccionar imágenes
                        </p>
                    </div>
                @else
                    <div id="contenidoImagen" class="text-center">
                        <div class="flex justify-center mb-3">
                            <div class="bg-white rounded-full p-5 shadow-md"><i class="fa-solid fa-images text-3xl" style="color:#0407e2;"></i></div>
                        </div>
                        <p class="text-sm font-semibold text-slate-600">Imágenes del carrusel</p>
                        <p class="text-xs text-slate-400 mt-1">Haz clic aquí para seleccionar imágenes</p>
                    </div>
                    <img id="imagenPrevia" src=""  alt="Vista previa"class="hidden absolute inset-0 w-full h-full object-contain p-2 bg-white">
                @endif
                <button type="button" id="anteriorImagen"
                    class="hidden absolute left-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/90 shadow-md items-center justify-center text-slate-600 hover:bg-white z-10">
                    <i class="fa-solid fa-chevron-left text-sm"></i>
                </button>
                <button type="button" id="siguienteImagen"
                    class="hidden absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/90 shadow-md items-center justify-center text-slate-600 hover:bg-white z-10">
                    <i class="fa-solid fa-chevron-right text-sm"></i>
                </button>
                <div id="contadorImagenes"
                    class="hidden absolute bottom-2 left-1/2 -translate-x-1/2 bg-black/60 text-white text-xs px-3 py-1 rounded-full z-10">
                </div>
            </div>
            <p class="text-xs text-blue-600 mt-2">
                Se recomienda una imagen de 747 x 547px con fondo transparente en formato PNG o SVG.
            </p>
            @if(isset($imagenes) && $imagenes->count() > 0)
                <div class="mt-4">
                    <p class="text-xs font-semibold text-slate-600 mb-2">Imágenes cargadas</p>
                    <div class="flex items-start gap-2 overflow-x-auto pb-2 w-full">
                        @foreach($imagenes as $imagen)
                            <div class="flex-shrink-0">
                                <div class="relative w-20 h-14 rounded-md overflow-hidden border border-slate-200 bg-slate-100">
                                    <img src="{{ asset($imagen->imagen) }}" alt="Imagen {{ $imagen->id }}"class="w-full h-full object-cover">
                                </div>
                                <div class="flex justify-center gap-1 mt-1">
                                    <form action="{{ route('configuracion.login.imagenes.update', $imagen->id) }}"
                                        method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <label class="cursor-pointer flex items-center justify-center w-7 h-6 rounded bg-blue-50 text-blue-600 hover:bg-blue-100" title="Cambiar imagen">
                                            <i class="fa-solid fa-pen text-[10px]"></i>
                                            <input type="file" name="imagen" accept="image/png,image/jpeg,image/jpg,image/svg+xml"  class="hidden" onchange="this.form.submit();">
                                        </label>
                                    </form>
                                    <button type="button" onclick="confirmarEliminar('{{ route('configuracion.login.imagenes.destroy', $imagen->id) }}')"
                                        class="flex items-center justify-center w-7 h-6 rounded bg-red-50 text-red-600 hover:bg-red-100"
                                        title="Eliminar imagen"> <i class="fa-solid fa-trash text-[10px]"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="mt-4 text-center border border-dashed border-slate-300 rounded-lg py-4">
                    <i class="fa-solid fa-images text-xl text-slate-300"></i>
                    <p class="text-xs text-slate-500 mt-1">
                        No hay imágenes cargadas.
                    </p>
                </div>
            @endif

            <button type="button" id="botonGuardarImagen" disabled
                onclick="document.getElementById('formImagenes').submit();"
                class="mt-3 block w-full text-center border font-semibold text-sm py-2.5 rounded-lg cursor-pointer text-white transition
                    bg-[#0407e2] border-[#0407e2] disabled:bg-slate-300 disabled:border-slate-300 disabled:text-slate-500 disabled:cursor-not-allowed disabled:opacity-100">
                <i class="fa-solid fa-floppy-disk mr-1"></i>
                Guardar imágenes
            </button>

            <form action="{{ route('configuracion.login.imagenes.store') }}"  method="POST" enctype="multipart/form-data" id="formImagenes">
                @csrf
                <input type="file" id="imagenesCarrusel" name="imagenes[]" multiple accept="image/png,image/jpeg,image/jpg,image/svg+xml" class="hidden">
            </form>
        </div>
        <div class="lg:col-span-2">
            <form action="{{ route('configuracion.login.update') }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">
                                Posición del formulario
                            </label>
                            <select name="posicion_formulario"
                                class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#0407e2]">
                                <option value="DERECHA"{{ ($login->posicion_formulario ?? 'DERECHA') == 'DERECHA' ? 'selected' : '' }}>Derecha</option>
                                <option value="IZQUIERDA" {{ ($login->posicion_formulario ?? '') == 'IZQUIERDA' ? 'selected' : '' }}> Izquierda</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-between">
                            <label class="text-sm font-medium text-slate-700">
                                Mostrar logo en el formulario
                            </label>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="mostrar_logo" value="0">
                                <input type="checkbox" name="mostrar_logo" value="1" class="sr-only peer" {{ ($login->mostrar_logo ?? true) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-slate-200 rounded-full peer peer-checked:bg-[#0407e2] transition-colors">
                                </div>
                                <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-5">
                                </div>
                            </label>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">
                                Posición del logo de la empresa
                            </label>
                            <select name="posicion_logo"
                                class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#0407e2]">
                                <option value="SUPERIOR_IZQUIERDA"
                                    {{ ($login->posicion_logo ?? 'SUPERIOR_IZQUIERDA') == 'SUPERIOR_IZQUIERDA' ? 'selected' : '' }}>
                                    Superior izquierda
                                </option>
                                <option value="SUPERIOR_CENTRO"
                                    {{ ($login->posicion_logo ?? '') == 'SUPERIOR_CENTRO' ? 'selected' : '' }}>
                                    Superior centro
                                </option>
                                <option value="SUPERIOR_DERECHA"
                                    {{ ($login->posicion_logo ?? '') == 'SUPERIOR_DERECHA' ? 'selected' : '' }}>
                                    Superior derecha
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Facebook</label>
                            <div class="flex items-center gap-3">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="mostrar_facebook" value="0">
                                    <input type="checkbox" name="mostrar_facebook" value="1" class="sr-only peer"
                                    {{ ($login->mostrar_facebook ?? false) ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 rounded-full peer peer-checked:bg-[#0407e2] transition-colors"></div>
                                    <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                                </label>
                                <input type="text" name="facebook" value="{{ $login->facebook ?? '' }}" placeholder="https://facebook.com/tu-usuario"
                                class="flex-1 border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#0407e2]">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Twitter</label>
                            <div class="flex items-center gap-3">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="mostrar_twitter" value="0">
                                    <input type="checkbox"
                                        name="mostrar_twitter"
                                        value="1"
                                        class="sr-only peer"
                                        {{ ($login->mostrar_twitter ?? false) ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 rounded-full peer peer-checked:bg-[#0407e2] transition-colors"></div>
                                    <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                                </label>
                                <input type="text" name="twitter" value="{{ $login->twitter ?? '' }}" placeholder="https://twitter.com/tu-usuario"
                                class="flex-1 border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#0407e2]">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Instagram</label>
                            <div class="flex items-center gap-3">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="mostrar_instagram" value="0">
                                    <input type="checkbox" name="mostrar_instagram" value="1" class="sr-only peer" {{ ($login->mostrar_instagram ?? false) ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 rounded-full peer peer-checked:bg-[#0407e2] transition-colors"></div>
                                    <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                                </label>
                                <input type="text" name="instagram" value="{{ $login->instagram ?? '' }}" placeholder="https://instagram.com/tu-usuario"
                                class="flex-1 border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#0407e2]">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">LinkedIn</label>
                            <div class="flex items-center gap-3">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="mostrar_linkedin" value="0">
                                    <input type="checkbox" name="mostrar_linkedin" value="1" class="sr-only peer" {{ ($login->mostrar_linkedin ?? false) ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 rounded-full peer peer-checked:bg-[#0407e2] transition-colors"></div>
                                    <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                                </label>
                                <input type="text" name="linkedin" value="{{ $login->linkedin ?? '' }}" placeholder="https://linkedin.com/in/tu-usuario"
                                class="flex-1 border border-slate-300 rounded-lg px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#0407e2]">
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full bg-[#0407e2] text-white text-sm font-semibold py-2.5 rounded-lg hover:opacity-90 transition">
                            GUARDAR
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    const zonaSeleccionImagen = document.getElementById('zonaSeleccionImagen');
    const inputImagenes = document.getElementById('imagenesCarrusel');
    const imagenPrevia = document.getElementById('imagenPrevia');
    const contenidoImagen = document.getElementById('contenidoImagen');
    const botonGuardarImagen = document.getElementById('botonGuardarImagen');
    const anteriorImagen = document.getElementById('anteriorImagen');
    const siguienteImagen = document.getElementById('siguienteImagen');
    const contadorImagenes = document.getElementById('contadorImagenes');
    let archivosSeleccionados = [];
    let indiceActual = 0;
    zonaSeleccionImagen.addEventListener('click', function(e) {
        if (
            e.target.closest('#anteriorImagen') ||
            e.target.closest('#siguienteImagen')
        ) {
            return;
        }
        inputImagenes.click();
    });
    inputImagenes.addEventListener('change', function() {
        const nuevosArchivos = Array.from(this.files);
        if (nuevosArchivos.length === 0) {
            return;
        }
        archivosSeleccionados = nuevosArchivos;
        indiceActual = 0;
        mostrarImagen();
        botonGuardarImagen.disabled = false;
    });
    function mostrarImagen() {
        if (archivosSeleccionados.length === 0) {
            return;
        }
        const archivo = archivosSeleccionados[indiceActual];
        const lector = new FileReader();
        lector.onload = function(e) {
            imagenPrevia.src = e.target.result;
            imagenPrevia.classList.remove('hidden');
            contenidoImagen.classList.add('hidden');
            contadorImagenes.textContent =
                (indiceActual + 1) + ' / ' + archivosSeleccionados.length;
            if (archivosSeleccionados.length > 1) {
                contadorImagenes.classList.remove('hidden');
                anteriorImagen.classList.remove('hidden');
                anteriorImagen.classList.add('flex');
                siguienteImagen.classList.remove('hidden');
                siguienteImagen.classList.add('flex');
            } else {
                contadorImagenes.classList.add('hidden');
                anteriorImagen.classList.add('hidden');
                siguienteImagen.classList.add('hidden');
            }
        };
        lector.readAsDataURL(archivo);
    }
    anteriorImagen.addEventListener('click', function(e) {
        e.stopPropagation();
        if (indiceActual > 0) {
            indiceActual--;
            mostrarImagen();
        }
    });

    siguienteImagen.addEventListener('click', function(e) {
        e.stopPropagation();
        if (indiceActual < archivosSeleccionados.length - 1) {
            indiceActual++;
            mostrarImagen();
        }
    });
</script>

@endsection