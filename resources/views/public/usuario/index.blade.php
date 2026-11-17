@extends('public.app')
@section('content')
<section class="min-h-screen bg-slate-50 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-200 pb-6 transition-all duration-500">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0f1d3a] tracking-tight flex items-center gap-2.5">
                    <span class="text-[#d4af37]">¡HOLA</span> 
                    <span>{{ Auth::user()->name ?? 'Usuario' }}!</span>
                    <i class="fa-solid fa-hand text-[#d4af37] animate-bounce"></i>
                </h1>
                <p class="text-slate-500 text-sm mt-1">Administra tu información personal y la seguridad de tu cuenta.</p>
            </div>
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#0f1d3a] text-[#d4af37] text-xs font-bold uppercase tracking-wider shadow-sm self-start sm:self-auto hover:scale-105 transition-transform duration-300">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Panel de Usuario</span>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-md border border-slate-200 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <div class="h-24 bg-[#0f1d3a] border-b-4 border-[#d4af37] relative"></div>
                    <div class="px-6 pb-7 text-center relative">
                        <div class="w-24 h-24 mx-auto -mt-12 rounded-full bg-[#0f1d3a] border-4 border-[#d4af37] flex items-center justify-center shadow-lg mb-4 transition-transform duration-300 hover:scale-110">
                            <i class="fa-solid fa-user text-4xl text-[#d4af37]"></i>
                        </div>
                        <h2 class="text-xl font-extrabold text-[#0f1d3a]">{{ Auth::user()->name ?? 'Usuario' }}</h2>
                        <p class="text-sm text-slate-500 mt-1 break-all">{{ Auth::user()->email ?? 'Correo no disponible' }}</p>
                        <div class="mt-4">
                            <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#d4af37]/15 text-[#9a7b1c] border border-[#d4af37]/40 text-xs font-bold">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                </span>
                                Cuenta activa
                            </span>
                        </div>
                        <div class="border-t border-slate-100 mt-6 pt-6 space-y-4 text-left">
                            <div class="flex items-center gap-3.5 p-3 rounded-xl bg-slate-50 border border-slate-100 transition-all duration-300 hover:border-[#d4af37] hover:bg-white hover:shadow-xs">
                                <div class="w-10 h-10 rounded-lg bg-[#0f1d3a] text-[#d4af37] flex items-center justify-center shrink-0 transition-transform duration-300 hover:rotate-6">
                                    <i class="fa-solid fa-calendar-check"></i>
                                </div>
                                <div>
                                    <p class="text-[11px] uppercase font-bold tracking-wider text-slate-400">Miembro desde</p>
                                    <p class="text-sm font-bold text-[#0f1d3a]">{{ Auth::user()->created_at?->format('d/m/Y') ?? 'No disponible' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3.5 p-3 rounded-xl bg-slate-50 border border-slate-100 transition-all duration-300 hover:border-[#d4af37] hover:bg-white hover:shadow-xs">
                                <div class="w-10 h-10 rounded-lg bg-[#0f1d3a] text-[#d4af37] flex items-center justify-center shrink-0 transition-transform duration-300 hover:rotate-6">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-[11px] uppercase font-bold tracking-wider text-slate-400">Correo electrónico</p>
                                    <p class="text-sm font-bold text-[#0f1d3a] truncate">
                                        {{ Auth::user()->email }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 pt-6 border-t border-slate-100">
                            <form method="POST" action="{{ route('usuario.logout') }}">
                                @csrf
                                <button type="submit" class="group w-full inline-flex justify-center items-center gap-2 bg-[#0f1d3a] hover:bg-[#162953] text-[#d4af37] font-extrabold text-xs uppercase tracking-wider py-3 px-4 rounded-xl shadow-sm transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md active:scale-95 cursor-pointer">
                                    <i class="fa-solid fa-right-from-bracket transition-transform duration-300 group-hover:translate-x-1"></i>
                                    Cerrar sesión
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-md border border-slate-200 p-6 sm:p-8 transition-all duration-300 hover:shadow-xl">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                        <div class="w-10 h-10 rounded-xl bg-[#d4af37]/20 text-[#0f1d3a] flex items-center justify-center transition-transform duration-300 hover:scale-110">
                            <i class="fa-solid fa-user-pen text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-lg sm:text-xl font-extrabold text-[#0f1d3a]">Información personal</h2>
                            <p class="text-xs sm:text-sm text-slate-500">Actualiza tus datos básicos de contacto.</p>
                        </div>
                    </div>
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="group">
                                <label class="block text-xs uppercase font-bold tracking-wider text-slate-600 mb-2 transition-colors group-focus-within:text-[#0f1d3a]">
                                    Nombre completo
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 transition-colors group-focus-within:text-[#d4af37]">
                                        <i class="fa-solid fa-id-card"></i>
                                    </span>
                                    <input type="text"  name="name" value="{{ old('name', Auth::user()->name) }}"  class="w-full rounded-xl border border-slate-200 bg-slate-50/50 pl-10 pr-4 py-3 text-sm font-medium text-slate-800 outline-none focus:bg-white focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] focus:-translate-y-0.5 transition-all duration-300"required>
                                </div>
                            </div>
                            <div class="group">
                                <label class="block text-xs uppercase font-bold tracking-wider text-slate-600 mb-2 transition-colors group-focus-within:text-[#0f1d3a]">
                                    Correo electrónico
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 transition-colors group-focus-within:text-[#d4af37]">
                                        <i class="fa-solid fa-at"></i>
                                    </span>
                                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 pl-10 pr-4 py-3 text-sm font-medium text-slate-800 outline-none focus:bg-white focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] focus:-translate-y-0.5 transition-all duration-300" required>
                                </div>
                            </div>
                        </div>
                        <div class="border-t border-slate-100 my-8"></div>
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-xl bg-[#0f1d3a] text-[#d4af37] flex items-center justify-center transition-transform duration-300 hover:scale-110">
                                <i class="fa-solid fa-lock text-base"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-extrabold text-[#0f1d3a]">Seguridad de la cuenta</h3>
                                <p class="text-xs text-slate-500">Cambia tu contraseña periódicamente para mantener tu cuenta protegida. </p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="group">
                                <label class="block text-xs uppercase font-bold tracking-wider text-slate-600 mb-2 transition-colors group-focus-within:text-[#0f1d3a]">Nueva contraseña</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 transition-colors group-focus-within:text-[#d4af37]">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                    <input type="password" name="password" placeholder="Dejar vacío para no cambiar" autocomplete="new-password" class="w-full rounded-xl border border-slate-200 bg-slate-50/50 pl-10 pr-4 py-3 text-sm text-slate-800 outline-none focus:bg-white focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] focus:-translate-y-0.5 transition-all duration-300">
                                </div>
                            </div>
                            <div class="group">
                                <label class="block text-xs uppercase font-bold tracking-wider text-slate-600 mb-2 transition-colors group-focus-within:text-[#0f1d3a]">Confirmar contraseña</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 transition-colors group-focus-within:text-[#d4af37]">
                                        <i class="fa-solid fa-check-double"></i>
                                    </span>
                                    <input type="password" name="password_confirmation" placeholder="Confirmar nueva contraseña" autocomplete="new-password"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50/50 pl-10 pr-4 py-3 text-sm text-slate-800 outline-none focus:bg-white focus:ring-2 focus:ring-[#d4af37] focus:border-[#d4af37] focus:-translate-y-0.5 transition-all duration-300">
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row justify-end items-center gap-3 mt-8 pt-6 border-t border-slate-100">
                            <button type="submit" class="group w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-[#d4af37] hover:bg-[#b8952d] text-[#0f1d3a] font-extrabold text-sm px-8 py-3.5 rounded-xl shadow-md transition-all duration-300 hover:-translate-y-0.5 hover:shadow-lg active:scale-95 cursor-pointer">
                                <i class="fa-solid fa-floppy-disk transition-transform duration-300 group-hover:scale-110"></i>
                                Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection