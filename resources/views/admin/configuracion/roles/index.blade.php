@extends('layouts.admin.app')
@section('title', 'Configuración - Roles')
@section('js')
@endsection
@section('content')

    <div class="flex items-center gap-2 text-sm mb-4">
        <a href="{{ route('configuracion') }}"
        class="text-slate-400 hover:text-slate-700 flex items-center gap-1">
            <i class="fa-solid fa-house"></i>Dashboard</a>
        <span class="text-slate-400">/</span>
        <span class="text-slate-700 font-semibold flex items-center gap-1">
            <i class="fa-solid fa-gear"></i>Configuración
        </span>
    </div>
   
    <h1 class="flex items-center gap-2 text-sm font-semibold text-slate-700 mb-4">
        <i class="fa-solid fa-user-shield text-slate-600"></i>
        Listado de Roles
    </h1>

    <div class="bg-white rounded-3xl shadow-md p-6">
        <div class="flex justify-end">
            <button type="button"
                onclick="document.getElementById('modalNuevoRoles').classList.remove('hidden')"
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
                        <th class="py-2 text-left">Nombre</th>
                        <th class="py-2 text-left">Descripción</th>
                        <th class="py-2 text-left">Estado</th>
                        <th class="font-semibold text-right">Acciones</th>
                    </tr>
                </thead>
               
                <tbody>
                    @forelse($roles as $index => $role)
                        <tr class="border-b border-slate-100">
                            <td class="py-2 text-slate-600">{{ $index + 1 }}</td>
                            <td class="py-2 text-black font-medium">
                                <div class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md bg-amber-50 border border-amber-200">
                                    <span class="text-amber-500 text-xs">
                                        <i class="fa-solid fa-user"></i>
                                    </span>
                                    <span class="text-xs font-semibold text-amber-900">{{ $role->nombre }}</span>
                                </div>
                            </td>
                            <td class="py-2 text-black font-medium">{{ $role->descripcion }}</td>
                            <td class="py-3 px-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold
                                    {{ $role->estado ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-600/20' : 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-600/20' }}">
                                    <span class="w-1.5 h-1.5 rounded-full
                                        {{ $role->estado ? 'bg-emerald-500' : 'bg-rose-500' }}">
                                    </span>{{ $role->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="flex justify-end gap-2">
                                    {{-- EDITAR --}}
                                    <button type="button" onclick="document.getElementById('modalEditarRol{{ $role->id }}').classList.remove('hidden')"
                                        class="px-4 py-1.5 rounded-md text-white text-xs font-semibold" style="background-color: #64DD17;">
                                        Editar
                                    </button>

                                    {{-- MODAL EDITAR --}}
                                    <div id="modalEditarRol{{ $role->id }}" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
                                        <div class="absolute inset-0 bg-black/10"
                                            onclick="document.getElementById('modalEditarRol{{ $role->id }}').classList.add('hidden')">
                                        </div>
                                        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
                                            <div class="flex items-center justify-between mb-6">
                                                <h2 class="text-lg font-semibold text-slate-800">
                                                    <i class="fa-solid fa-user-shield text-slate-600"></i> Editar Rol
                                                </h2>
                                                <button type="button" onclick="document.getElementById('modalEditarRol{{ $role->id }}').classList.add('hidden')"
                                                    class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('configuracion.roles.update', $role->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="flex flex-col md:flex-row gap-4">
                                                    {{-- Nombre --}}
                                                    <div class="w-full md:w-1/3">
                                                        <label for="nombre_rol{{ $role->id }}"class="block text-sm font-medium text-black mb-1">
                                                            Nombre
                                                        </label>
                                                        <input type="text" id="nombre_rol{{ $role->id }}" name="nombre" value="{{ old('nombre', $role->nombre) }}" maxlength="100" required
                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                                                            placeholder="Ej. Administrador">
                                                    </div>

                                                    {{-- Descripción --}}
                                                    <div class="flex-1">
                                                        <label for="descripcion_rol{{ $role->id }}" class="block text-sm font-medium text-black mb-1">
                                                            Descripción
                                                        </label>
                                                        <input type="text" id="descripcion_rol{{ $role->id }}" name="descripcion" value="{{ old('descripcion', $role->descripcion) }}" maxlength="255" required
                                                            class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                                                            placeholder="Descripción detallada del rol...">
                                                    </div>
                                                </div>
                                                {{-- Estado --}}
                                                <div class="mt-4">
                                                    <label class="block text-sm font-medium text-black mb-2">
                                                        Estado
                                                    </label>
                                                    <label class="inline-flex items-center cursor-pointer gap-3">
                                                        <input type="hidden" name="estado" value="0">
                                                        <input type="checkbox" name="estado" value="1" class="sr-only peer" {{ $role->estado ? 'checked' : '' }}>
                                                        <span class="text-sm font-medium text-slate-700">
                                                            Inactivo
                                                        </span>
                                                        <div class="relative w-11 h-6 bg-slate-300 rounded-full peer 
                                                        peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white
                                                        after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#269ad5]">
                                                        </div>
                                                        <span class="text-sm font-medium text-[#000000]">
                                                            Activo
                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="flex justify-end gap-3 mt-8">
                                                    <button type="button" onclick="document.getElementById('modalEditarRol{{ $role->id }}').classList.add('hidden')"
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
                                    {{-- ELIMINAR --}}
                                    <button type="button"
                                        onclick="confirmarEliminar('{{ route('configuracion.roles.destroy', $role->id) }}')"
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
                                No hay roles registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

    <div id="modalNuevoRoles" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-6 sm:pt-24 overflow-y-auto">
        <div class="absolute inset-0 bg-black/10"
            onclick="document.getElementById('modalNuevoRoles').classList.add('hidden')">
        </div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-5xl mx-3 sm:mx-4 p-4 sm:p-6 my-4 sm:my-0">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-slate-800">
                    <i class="fa-solid fa-user-shield text-slate-600"></i>
                    Nuevo Rol 
                </h2>
                <button type="button"
                    onclick="document.getElementById('modalNuevoRoles').classList.add('hidden')"
                    class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('configuracion.roles.store') }}" method="POST">
                @csrf
                <div class="flex flex-col md:flex-row gap-4">
                    {{-- Nombre del Rol --}}
                    <div class="w-full md:w-1/3">
                        <label for="nombre_rol" class="block text-sm font-medium text-black mb-1">
                            Nombre
                        </label>
                        <input type="text" id="nombre_rol" name="nombre" maxlength="100" required
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        placeholder="Ej. Administrador">
                    </div>
                    {{-- Descripción --}}
                    <div class="flex-1">
                        <label for="descripcion_rol" class="block text-sm font-medium text-black mb-1">
                            Descripción
                        </label>
                        <input type="text" id="descripcion_rol" name="descripcion" maxlength="255" required
                        class="w-full rounded-md border border-slate-200 bg-slate-50 px-3 py-2 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        placeholder="Descripción detallada del rol...">
                    </div>
                </div>
                {{-- Estado (Booleano) --}}
                <div class="mt-4">
                    <label class="block text-sm font-medium text-black mb-2">
                        Estado
                    </label>
                    <label class="inline-flex items-center cursor-pointer gap-3">
                        <input type="hidden" name="estado" value="0">
                        <input type="checkbox" name="estado" value="1" class="sr-only peer" checked>
                        <span class="text-sm font-medium text-slate-700">Inactivo</span>
                        <div class="relative w-11 h-6 bg-slate-300 rounded-full peer
                            peer-checked:after:translate-x-full after:content-['']
                            after:absolute after:top-[2px]  after:left-[2px] after:bg-white
                            after:border-slate-300 after:border after:rounded-full after:h-5
                            after:w-5 after:transition-all peer-checked:bg-[#269ad5]">
                        </div>
                        <span class="text-sm font-medium text-[#000000]">
                            Activo
                        </span>
                    </label>
                </div>

                <div class="flex justify-end gap-3 mt-8">
                    <button type="button"
                        onclick="document.getElementById('modalNuevoRoles').classList.add('hidden')"
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


