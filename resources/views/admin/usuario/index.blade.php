@extends('layouts.admin.app')
@section('title', 'Usuario')
@section('js')
@endsection
@section('content')

    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
       <i class="fa-solid fa-user-gear"></i>
        Listado de Usuarios
    </h1>
        
    <div class="bg-white rounded-3xl shadow-md p-6">
        <div class="flex justify-end">
            <button type="button"
                onclick="document.getElementById('modalNuevoUsuario').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-[#0407e2] hover:bg-[#0305b8] text-white text-sm font-semibold"
                 style="background-color: var(--active-pink);" >
                <i class="fa-solid fa-circle-plus"></i>
                Nuevo
            </button>
        </div>
        
        <div class="overflow-x-auto mt-4">
            <table class="w-full min-w-[700px] text-left text-sm">
                <thead>
                    <tr class="border-b border-slate-200 text-black">
                        <th class="font-semibold w-16">#</th>
                        <th class="font-semibold">Foto</th>
                        <th class="font-semibold">Tipo Doc.</th>
                        <th class="font-semibold">Número</th>
                        <th class="font-semibold">Nombre / Apellidos</th>
                        <th class="font-semibold">Correo Laboral</th>
                        <th class="font-semibold">Sucursal</th>
                        <th class="font-semibold">Rol</th>
                        <th class="font-semibold">Serie</th>
                        <th class="font-semibold">Estado</th>
                        <th class="font-semibold">Fecha Registro</th>
                        <th class="font-semibold text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $index => $usuario)
                        <tr class="border-b border-slate-100">
                            <td class="py-2 text-slate-600">{{ $index + 1 }}</td>
                            <td class="py-2">
                                @if($usuario->foto)
                                    <img src="{{ asset($usuario->foto) }}" class="w-9 h-9 rounded-full object-cover border border-slate-200">
                                @else
                                    <div class="w-9 h-9 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center">
                                        <i class="fa-solid fa-user text-slate-400 text-sm"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-2 text-slate-600">{{ $usuario->tipo_documento }}</td>
                            <td class="py-2 text-slate-600">{{ $usuario->numero }}</td>
                            <td class="py-2 text-black font-medium">
                                <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md bg-indigo-50 border border-indigo-200">
                                    <span class="text-indigo-500 text-xs">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    <span class="text-xs font-semibold text-indigo-900">{{ $usuario->nombre }} {{ $usuario->apellidos }}</span>
                                </div>
                            </td>
                            <td class="py-2 text-slate-600">{{ $usuario->user->email ?? '-' }}</td>
                            <td class="py-2 text-slate-600">{{ $usuario->sucursal->descripcion ?? '-' }}</td>
                            <td class="py-2 text-slate-600">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-medium bg-orange-100 text-orange-800">
                                    {{ $usuario->rol->name ?? '-' }}
                                </span>
                            </td>
                            <td class="py-2 text-slate-600">{{ $usuario->serie->tipoDocumento->nombre ?? '-' }}
                                @if($usuario->serie)- {{ $usuario->serie->serie }}@endif
                            </td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                    {{ $usuario->estado ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20' : 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $usuario->estado ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                                    {{ $usuario->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="py-2 text-slate-600">{{ $usuario->created_at->format('d/m/Y') }}</td>
                            <td class="py-2">
                                <div class="flex justify-end gap-2">
                                    <button type="button" onclick="document.getElementById('modalEditarUsuario{{ $usuario->id }}').classList.remove('hidden')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold" style="background-color: #64DD17;">
                                        Editar
                                    </button>

                                    <div id="modalEditarUsuario{{ $usuario->id }}" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">

    <div class="absolute inset-0 bg-black/10"
        onclick="document.getElementById('modalEditarUsuario{{ $usuario->id }}').classList.add('hidden')">
    </div>

    <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-4xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">

        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-slate-800">
                Editar Usuario
            </h2>

            <button type="button"
                onclick="document.getElementById('modalEditarUsuario{{ $usuario->id }}').classList.add('hidden')"
                class="text-slate-400 hover:text-slate-600 text-lg">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form action="{{ route('usuario.update', $usuario->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <input type="radio" name="tab_edit_{{ $usuario->id }}" id="tab_edit_usuario1_{{ $usuario->id }}" class="peer/edit1 hidden" checked>
            <input type="radio" name="tab_edit_{{ $usuario->id }}" id="tab_edit_usuario2_{{ $usuario->id }}" class="peer/edit2 hidden">
            <input type="radio" name="tab_edit_{{ $usuario->id }}" id="tab_edit_usuario3_{{ $usuario->id }}" class="peer/edit3 hidden">
            <input type="radio" name="tab_edit_{{ $usuario->id }}" id="tab_edit_usuario4_{{ $usuario->id }}" class="peer/edit4 hidden">

            <div class="flex border-b border-slate-200 mb-6 gap-6">

                <label for="tab_edit_usuario1_{{ $usuario->id }}"
                    class="pb-3 text-sm font-semibold cursor-pointer transition-all
                    peer-checked/edit1:text-indigo-600
                    peer-checked/edit1:border-b-2
                    peer-checked/edit1:border-indigo-600
                    text-slate-500 hover:text-slate-800 border-b-2 border-transparent">

                    <i class="fa-solid fa-user mr-2"></i>
                    Datos Personales
                </label>

                <label for="tab_edit_usuario2_{{ $usuario->id }}"
                    class="pb-3 text-sm font-semibold cursor-pointer transition-all
                    peer-checked/edit2:text-indigo-600
                    peer-checked/edit2:border-b-2
                    peer-checked/edit2:border-indigo-600
                    text-slate-500 hover:text-slate-800 border-b-2 border-transparent">

                    <i class="fa-solid fa-briefcase mr-2"></i>
                    Laboral y Roles
                </label>

                <label for="tab_edit_usuario3_{{ $usuario->id }}"
                    class="pb-3 text-sm font-semibold cursor-pointer transition-all
                    peer-checked/edit3:text-indigo-600
                    peer-checked/edit3:border-b-2
                    peer-checked/edit3:border-indigo-600
                    text-slate-500 hover:text-slate-800 border-b-2 border-transparent">

                    <i class="fa-solid fa-image mr-2"></i>
                    Foto y Seguridad
                </label>

                <label for="tab_edit_usuario4_{{ $usuario->id }}"
                    class="pb-3 text-sm font-semibold cursor-pointer transition-all
                    peer-checked/edit4:text-indigo-600
                    peer-checked/edit4:border-b-2
                    peer-checked/edit4:border-indigo-600
                    text-slate-500 hover:text-slate-800 border-b-2 border-transparent">

                    <i class="fa-solid fa-key mr-2"></i>
                    Acceso y Permisos
                </label>

            </div>

            {{-- DATOS PERSONALES --}}

            <div class="hidden peer-checked/edit1:block space-y-4">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Tipo Doc. Identidad <span class="text-red-500">*</span>
                        </label>

                        <select name="tipo_documento" required
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">

                            <option value="">Seleccione...</option>

                            <option value="DNI" {{ $usuario->tipo_documento == 'DNI' ? 'selected' : '' }}>
                                DNI
                            </option>

                            <option value="CE" {{ $usuario->tipo_documento == 'CE' ? 'selected' : '' }}>
                                CE
                            </option>

                            <option value="Pasaporte" {{ $usuario->tipo_documento == 'Pasaporte' ? 'selected' : '' }}>
                                Pasaporte
                            </option>

                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Número de Documento <span class="text-red-500">*</span>
                        </label>

                        <input type="text"
                            name="numero"
                            maxlength="30"
                            required
                            value="{{ $usuario->numero }}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Nombres <span class="text-red-500">*</span>
                        </label>

                        <input type="text"
                            name="nombre"
                            maxlength="100"
                            required
                            value="{{ $usuario->nombre }}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Apellidos <span class="text-red-500">*</span>
                        </label>

                        <input type="text"
                            name="apellidos"
                            maxlength="100"
                            required
                            value="{{ $usuario->apellidos }}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Fecha de Nacimiento
                        </label>

                        <input type="date"
                            name="fecha_nacimiento"
                            value="{{ $usuario->fecha_nacimiento }}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Celular
                        </label>

                        <input type="text"
                            name="celular"
                            maxlength="9"
                            minlength="9"
                            pattern="[0-9]{9}"
                            inputmode="numeric"
                            value="{{ $usuario->celular }}"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Correo Personal
                        </label>

                        <input type="email"
                            name="correo_personal"
                            maxlength="150"
                            value="{{ $usuario->correo_personal }}"
                            pattern="^[^@\s]+@[^@\s]+\.[^@\s]+$"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Dirección Completa
                        </label>

                        <input type="text"
                            name="direccion"
                            maxlength="255"
                            value="{{ $usuario->direccion }}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                    </div>

                </div>

            </div>

            {{-- LABORAL Y ROLES --}}

            <div class="hidden peer-checked/edit2:block space-y-4">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Sucursal <span class="text-red-500">*</span>
                        </label>

                        <select name="sucursal_id" required
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">

                            <option value="">Seleccione...</option>

                            @foreach($sucursales as $sucursal)
                                <option value="{{ $sucursal->id }}"
                                    {{ $usuario->sucursal_id == $sucursal->id ? 'selected' : '' }}>
                                    {{ $sucursal->descripcion }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Rol <span class="text-red-500">*</span>
                        </label>

                        <select name="rol_id" required
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">

                            <option value="">Seleccione...</option>

                            @foreach($roles as $rol)
                                <option value="{{ $rol->id }}"
                                    {{ $usuario->rol_id == $rol->id ? 'selected' : '' }}>
                                    {{ $rol->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Serie <span class="text-red-500">*</span>
                        </label>

                        <select name="serie_id" required
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">

                            <option value="">Seleccione...</option>

                            @foreach($series as $serie)
                                <option value="{{ $serie->id }}"
                                    {{ $usuario->serie_id == $serie->id ? 'selected' : '' }}>
                                    {{ $serie->tipoDocumento->nombre ?? '' }} - {{ $serie->serie }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Tipo Doc. Identidad <span class="text-red-500">*</span>
                        </label>

                        <select name="tipo_documento_id" required
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">

                            <option value="">Seleccione...</option>

                            @foreach($tipoDocumentos as $td)
                                <option value="{{ $td->id }}"
                                    {{ $usuario->tipo_documento_id == $td->id ? 'selected' : '' }}>
                                    {{ $td->nombre }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Fecha de Contratación
                        </label>

                        <input type="date"
                            name="fecha_contratacion"
                            value="{{ $usuario->fecha_contratacion }}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Fecha de Vencimiento de Contrato
                        </label>

                        <input type="date"
                            name="fecha_vencimiento_contrato"
                            value="{{ $usuario->fecha_vencimiento_contrato }}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                    </div>

                </div>

            </div>

            {{-- FOTO Y ESTADO --}}

            <div class="hidden peer-checked/edit3:block space-y-4">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Foto
                        </label>

                        <label for="foto_edit_{{ $usuario->id }}"
                            class="flex flex-col items-center justify-center w-36 h-44 border-2 border-dashed border-slate-300 rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100 transition-all overflow-hidden relative">

                            <div id="preview-container-edit-{{ $usuario->id }}"
                                class="flex flex-col items-center justify-center w-full h-full text-slate-400">

                                @if($usuario->foto)
                                    <img src="{{ asset($usuario->foto) }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <span class="text-4xl font-light text-slate-300">x</span>
                                @endif

                            </div>

                            <button type="button"
                                onclick="quitarFotoEditar(event, '{{ $usuario->id }}')"
                                class="absolute top-1 right-1 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-sm font-bold hover:bg-red-600 z-10">
                                x
                            </button>

                            <input type="file"
                                id="foto_edit_{{ $usuario->id }}"
                                name="foto"
                                accept="image/*"
                                class="hidden"
                                onchange="mostrarFotoEditar(this, '{{ $usuario->id }}')">

                        </label>
                    </div>

                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Estado
                        </label>

                        <label class="inline-flex items-center cursor-pointer gap-3 mt-1">

                            <input type="hidden"
                                name="estado"
                                value="0">

                            <input type="checkbox"
                                name="estado"
                                value="1"
                                class="sr-only peer"
                                {{ $usuario->estado ? 'checked' : '' }}>

                            <span class="text-sm font-medium text-slate-600">
                                Inactivo
                            </span>

                            <div class="relative w-11 h-6 bg-slate-300 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px]
                                after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"
                                style="background-color: var(--active-pink);">
                            </div>

                            <span class="text-sm font-medium text-slate-800">
                                Activo
                            </span>

                        </label>

                    </div>

                </div>

            </div>

            {{-- ACCESO Y PERMISOS --}}

            <div class="hidden peer-checked/edit4:block space-y-4">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Correo Laboral <span class="text-red-500">*</span>
                        </label>

                        <input type="email"
                            name="correo_laboral"
                            maxlength="150"
                            required
                            value="{{ $usuario->user->email ?? '' }}"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Nueva Contraseña
                        </label>

                        <input type="password"
                            name="password"
                            maxlength="100"
                            placeholder="Dejar vacío para conservar la actual"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700">
                    </div>

                </div>

                <div class="mt-6">

                    <h3 class="text-sm font-semibold text-slate-800 mb-3">
                        Permisos Módulos
                    </h3>

                    <div class="max-h-[300px] overflow-y-auto pr-2 border border-slate-200 rounded-lg bg-white p-3 space-y-3">

                        @php
                            $permisosUsuario = $usuario->user
                                ? $usuario->user->permissions->pluck('id')->toArray()
                                : [];
                        @endphp

                        @foreach ($permisos as $modulo => $grupoPermisos)

                            @php
                                $todosMarcados = collect($grupoPermisos)
                                    ->every(fn($permiso) => in_array($permiso->id, $permisosUsuario));
                            @endphp

                            <div class="space-y-1 permission-group">

                                <div class="flex items-center gap-2 py-1.5 px-2 hover:bg-slate-50 rounded-md transition-colors">

                                    <button type="button"
                                        onclick="toggleSubpermisos(this)"
                                        class="p-1 focus:outline-none cursor-pointer">

                                        <svg class="w-3.5 h-3.5 text-slate-500 transform transition-transform duration-200 rotate-90"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 5l7 7-7 7">
                                            </path>

                                        </svg>

                                    </button>

                                    <label class="flex items-center gap-2 cursor-pointer select-none">

                                        <input type="checkbox"
                                            class="modulo-checkbox w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500"
                                            onchange="togglePermisosModulo(this)"
                                            {{ $todosMarcados ? 'checked' : '' }}>

                                        <span class="text-xs font-bold text-slate-700">
                                            {{ $modulo }}
                                        </span>

                                    </label>

                                </div>

                                <div class="pl-6 space-y-1 border-l border-slate-100 ml-3 subpermisos-container">

                                    @foreach ($grupoPermisos as $permiso)

                                        <label class="flex items-center gap-2.5 py-1 px-2 hover:bg-slate-50 rounded-md cursor-pointer transition-colors">

                                            <input type="checkbox"
                                                name="permisos[]"
                                                value="{{ $permiso->id }}"
                                                class="permiso-checkbox w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500"
                                                onchange="actualizarModulo(this)"
                                                {{ in_array($permiso->id, $permisosUsuario) ? 'checked' : '' }}>

                                            <span class="text-xs text-slate-600">
                                                {{ $permiso->name }}
                                            </span>

                                        </label>

                                    @endforeach

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

            <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-100">

                <button type="button"
                    onclick="document.getElementById('modalEditarUsuario{{ $usuario->id }}').classList.add('hidden')"
                    class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50">
                    Cancelar
                </button>

                <button type="submit"
                    class="px-5 py-2 rounded-md text-white text-sm font-medium hover:bg-indigo-700"
                    style="background-color: var(--active-pink);">
                    Actualizar
                </button>

            </div>

        </form>

    </div>
</div>

                                    <button type="button"
                                        onclick="confirmarEliminar('{{ route('usuario.destroy', $usuario->id) }}')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold"
                                        style="background-color: #D50000;">
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="py-4 text-center text-slate-500">
                                No hay usuarios registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

    <div id="modalNuevoUsuario" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
        <div class="absolute inset-0 bg-black/10"
            onclick="document.getElementById('modalNuevoUsuario').classList.add('hidden')">
        </div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-4xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
            <!-- Cabecera del Modal -->
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-semibold text-slate-800">
                    Nuevo Usuario
                </h2>
                <button type="button" onclick="document.getElementById('modalNuevoUsuario').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600 text-lg">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- INPUTS OCULTOS (RADIOS) PARA CONTROLAR LAS PESTAÑAS SIN JS -->
                <input type="radio" name="tab_group" id="tab_usuario1" class="peer/tab1 hidden" checked>
                <input type="radio" name="tab_group" id="tab_usuario2" class="peer/tab2 hidden">
                <input type="radio" name="tab_group" id="tab_usuario3" class="peer/tab3 hidden">
                <input type="radio" name="tab_group" id="tab_usuario4" class="peer/tab4 hidden">
                
                <!-- BOTONES / PESTAÑAS (TABS VISUALES) -->
                <div class="flex border-b border-slate-200 mb-6 gap-6">
                    <label for="tab_usuario1" class="pb-3 text-sm font-semibold cursor-pointer transition-all
                        peer-checked/tab1:text-indigo-600 peer-checked/tab1:border-b-2 peer-checked/tab1:border-indigo-600
                        text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-user mr-2"></i>
                        Datos Personales
                    </label>
                    <label for="tab_usuario2" class="pb-3 text-sm font-semibold cursor-pointer transition-all
                        peer-checked/tab2:text-indigo-600 peer-checked/tab2:border-b-2 peer-checked/tab2:border-indigo-600
                        text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-briefcase mr-2"></i>
                        Laboral y Roles
                    </label>
                    <label for="tab_usuario3" class="pb-3 text-sm font-semibold cursor-pointer transition-all
                        peer-checked/tab3:text-indigo-600 peer-checked/tab3:border-b-2 peer-checked/tab3:border-indigo-600
                        text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-image mr-2"></i>
                        Foto y Seguridad
                    </label>
                    <label for="tab_usuario4" class="pb-3 text-sm font-semibold cursor-pointer transition-all
                        peer-checked/tab4:text-indigo-600 peer-checked/tab4:border-b-2 peer-checked/tab4:border-indigo-600
                        text-slate-500 hover:text-slate-800 border-b-2 border-transparent">
                        <i class="fa-solid fa-key mr-2"></i>
                        Acceso y Permisos
                    </label>
                </div>
                
                <!-- 1. PESTAÑA: DATOS PERSONALES -->
                <div class="hidden peer-checked/tab1:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="tipo_documento" class="block text-sm font-medium text-slate-700 mb-1">Tipo Doc. Identidad <span class="text-red-500">*</span></label>
                            <select id="tipo_documento" name="tipo_documento" required
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccione...</option>
                                <option value="DNI">DNI</option>
                                <option value="CE">CE</option>
                                <option value="Pasaporte">Pasaporte</option>
                            </select>
                        </div>

                        <div>
                            <label for="numero" class="block text-sm font-medium text-slate-700 mb-1">
                                Número de Documento <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="numero" name="numero" maxlength="30" required placeholder=""
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div>
                            <label for="nombre" class="block text-sm font-medium text-slate-700 mb-1">
                                Nombres <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nombre" name="nombre" maxlength="100" required
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div>
                            <label for="apellidos" class="block text-sm font-medium text-slate-700 mb-1">
                                Apellidos <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="apellidos" name="apellidos" maxlength="100" required
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div>
                            <label for="fecha_nacimiento" class="block text-sm font-medium text-slate-700 mb-1">
                                Fecha de Nacimiento
                            </label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                       <div>
                            <label for="celular" class="block text-sm font-medium text-slate-700 mb-1">Celular</label>
                            <input type="text" id="celular" name="celular" maxlength="9" minlength="9" pattern="[0-9]{9}" inputmode="numeric" required
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                            placeholder="Ingrese 9 dígitos"  oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>

                        <div class="md:col-span-2">
                            <label for="correo_personal" class="block text-sm font-medium text-slate-700 mb-1">Correo Personal</label>
                            <input type="email" id="correo_personal"  name="correo_personal" maxlength="150"
                            pattern="^[^@\s]+@[^@\s]+\.[^@\s]+$" title="Ingrese un correo válido, por ejemplo: ejemplo@correo.com"
                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label for="direccion" class="block text-sm font-medium text-slate-700 mb-1">
                                Dirección Completa
                            </label>
                            <input type="text" id="direccion" name="direccion" maxlength="255" placeholder="Ej. Jr. Los Pinos 456"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                    </div>
                </div>

                <!-- 2. PESTAÑA: LABORAL Y ROLES -->
                <div class="hidden peer-checked/tab2:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="sucursal_id" class="block text-sm font-medium text-slate-700 mb-1">
                                Sucursal <span class="text-red-500">*</span>
                            </label>
                            <select id="sucursal_id" name="sucursal_id" required
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccione...</option>
                                @foreach($sucursales as $sucursal)
                                    <option value="{{ $sucursal->id }}">{{ $sucursal->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="rol_id" class="block text-sm font-medium text-slate-700 mb-1">
                                Rol <span class="text-red-500">*</span>
                            </label>
                            <select id="rol_id" name="rol_id" required
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccione...</option>
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="serie_id" class="block text-sm font-medium text-slate-700 mb-1">
                                Serie <span class="text-red-500">*</span>
                            </label>
                            <select id="serie_id" name="serie_id" required
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccione...</option>
                                @foreach($series as $serie)
                                    <option value="{{ $serie->id }}">
                                        {{ $serie->serie }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div>
                            <label for="tipo_documento_id" class="block text-sm font-medium text-slate-700 mb-1">
                                Tipo Doc. Identidad <span class="text-red-500">*</span>
                            </label>
                            <select id="tipo_documento_id" name="tipo_documento_id" required
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                                <option value="">Seleccione...</option>
                                <!-- Aquí iterarías tus tipos de documentos desde la BD -->
                                @foreach($tipoDocumentos as $td)
                                    <option value="{{ $td->id }}">{{ $td->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="fecha_contratacion" class="block text-sm font-medium text-slate-700 mb-1">
                                Fecha de Contratación
                            </label>
                            <input type="date" id="fecha_contratacion" name="fecha_contratacion"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>

                        <div>
                            <label for="fecha_vencimiento_contrato" class="block text-sm font-medium text-slate-700 mb-1">
                                Fecha de Vencimiento de Contrato
                            </label>
                            <input type="date" id="fecha_vencimiento_contrato" name="fecha_vencimiento_contrato"
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                    </div>
                </div>

                <!-- 3. PESTAÑA: FOTO Y SEGURIDAD -->
                <div class="hidden peer-checked/tab3:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Foto </label>
                            <label for="foto" class="flex flex-col items-center justify-center w-36 h-44 border-2 border-dashed border-slate-300 rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100 transition-all overflow-hidden relative">
                                <div id="preview-container"
                                    class="flex flex-col items-center justify-center w-full h-full text-slate-400">
                                    <span class="text-4xl font-light text-slate-300">x</span>
                                </div>

                                <button type="button" id="quitar-foto" onclick="quitarFoto(event)"
                                    class="hidden absolute top-1 right-1 w-6 h-6 bg-red-500 text-white rounded-full items-center justify-center text-sm font-bold hover:bg-red-600 z-10">
                                    x
                                </button>
                                <input type="file" id="foto" name="foto" accept="image/*" class="hidden" onchange="mostrarFoto(this)">
                            </label>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Estado</label>
                            <label class="inline-flex items-center cursor-pointer gap-3 mt-1">
                                <input type="hidden" name="estado" value="0">
                                <input type="checkbox" name="estado" value="1" class="sr-only peer" checked>
                                <span class="text-sm font-medium text-slate-600">Inactivo</span>
                                <div class="relative w-11 h-6 bg-slate-300 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px]
                                    after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"
                                    style="background-color: var(--active-pink);">
                                </div>
                                <span class="text-sm font-medium text-slate-800">Activo</span>
                            </label>
                        </div>
                    </div>
                </div>
                <!-- 4. PESTAÑA: ACCESO Y PERMISOS -->
                <div class="hidden peer-checked/tab4:block space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="correo_laboral" class="block text-sm font-medium text-slate-700 mb-1">
                                Correo Laboral <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="correo_laboral" name="correo_laboral" maxlength="150" required
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">
                                Contraseña <span class="text-red-500">*</span>
                            </label>
                            <input type="password" id="password" name="password" maxlength="100" required
                                class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-sm font-semibold text-slate-800 mb-3">Permisos Módulos</h3>
                        <div class="max-h-[300px] overflow-y-auto pr-2 border border-slate-200 rounded-lg bg-white p-3 space-y-3">
                            @foreach ($permisos as $modulo => $grupoPermisos)
                                <div class="space-y-1 permission-group">
                                    <div class="flex items-center gap-2 py-1.5 px-2 hover:bg-slate-50 rounded-md transition-colors">
                                        <button type="button"  onclick="toggleSubpermisos(this)" class="p-1 focus:outline-none cursor-pointer">
                                            <svg class="w-3.5 h-3.5 text-slate-500 transform transition-transform duration-200 rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"> </path>
                                            </svg>
                                        </button>
                                        <label class="flex items-center gap-2 cursor-pointer select-none">
                                            <input type="checkbox" class="modulo-checkbox w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500"
                                                onchange="togglePermisosModulo(this)">
                                            <span class="text-xs font-bold text-slate-700">
                                                {{ $modulo }}
                                            </span>
                                        </label>
                                    </div>
                                    <div class="pl-6 space-y-1 border-l border-slate-100 ml-3 subpermisos-container">
                                        @foreach ($grupoPermisos as $permiso)
                                            <label class="flex items-center gap-2.5 py-1 px-2 hover:bg-slate-50 rounded-md cursor-pointer transition-colors">
                                                <input type="checkbox" name="permisos[]" value="{{ $permiso->id }}" class="permiso-checkbox w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500" 
                                                 onchange="actualizarModulo(this)">
                                                <span class="text-xs text-slate-600">{{ $permiso->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción Inferiores -->
                <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-slate-100">
                    <button type="button"
                        onclick="document.getElementById('modalNuevoUsuario').classList.add('hidden')"
                        class="px-5 py-2 rounded-md border border-slate-300 text-slate-700 text-sm font-medium hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-md text-white text-sm font-medium bg-indigo-600 hover:bg-indigo-700"
                    style="background-color: var(--active-pink);" >
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection



