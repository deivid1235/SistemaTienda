<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grupoaosc | Tienda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50">

    {{-- ================= MENSAJE FLOTANTE DE ÉXITO ================= --}}
   @if (session('success'))
        <div id="alertaExito"
            class="fixed top-4 left-1/2 -translate-x-1/2 z-[99999] transition-all duration-300">
            <div class="flex items-center gap-2.5 bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-sm font-semibold px-5 py-2.5 rounded-xl shadow-md backdrop-blur-sm">
                <!-- Icono Check SVG NATIVO -->
                <svg class="w-4 h-4 text-emerald-600 fill-current shrink-0" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif
    {{-- ================= MENSAJE FLOTANTE DE ERROR ================= --}}
    @if (session('error'))
        <div id="alertaError"
            class="fixed top-4 left-1/2 -translate-x-1/2 z-[99999]">
            <div class="flex items-center gap-2 bg-red-50 border border-red-100
                        text-red-600 text-sm font-medium px-5 py-2.5
                        rounded-lg shadow-sm">
                <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif
    {{-- ================= CONTENIDO DE LA VISTA ================= --}}
    @yield('content')
    <div id="modalEliminar"
        class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-24">
        <div class="absolute inset-0 bg-black/20"
            onclick="cerrarModalEliminar()">
        </div>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-lg font-semibold text-slate-800">Eliminar</h2>
                <button type="button" onclick="cerrarModalEliminar()"class="text-slate-400 hover:text-slate-600"><i class="fa-solid fa-xmark"></i></button>
            </div>
            {{-- MENSAJE --}}
            <div class="flex items-center gap-3 mb-8">
                <i class="fa-solid fa-triangle-exclamation text-amber-500 text-lg"></i>
                <p class="text-sm text-slate-600">¿Desea eliminar el producto del carrito?</p>
            </div>
            {{-- FORMULARIO --}}
            <form id="formEliminar" action="#" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end gap-3">
                    <button type="button"
                        onclick="cerrarModalEliminar()" class="px-4 py-2 rounded-md border border-slate-200text-slate-600 text-sm font-semibold hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-md bg-[#D50000] hover:bg-red-700 text-white text-sm font-semibold">
                        Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        window.confirmarEliminar = function(url) {
            const modal = document.getElementById('modalEliminar');
            const formulario = document.getElementById('formEliminar');
            if (!modal || !formulario) {
                console.error('No se encontró el modal de eliminación.');
                return;
            }
            formulario.action = url;
            modal.classList.remove('hidden');
        };
        window.cerrarModalEliminar = function() {
            const modal = document.getElementById('modalEliminar');
            if (modal) {
                modal.classList.add('hidden');
            }
        };
        document.addEventListener('DOMContentLoaded', function() {
            ['alertaExito', 'alertaError'].forEach(function(id) {
                const alerta = document.getElementById(id);
                if (alerta) {
                    setTimeout(function() {
                        alerta.style.transition = 'opacity .4s ease';
                        alerta.style.opacity = '0';
                        setTimeout(function() {
                            alerta.remove();
                        }, 400);
                    }, 3000);
                }
            });
        });
    </script>




    <footer class="bg-[#269ad5] text-white pt-12 pb-8 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 pb-10 border-b border-white/20">
                <div class="space-y-3">
                    <h2 class="text-2xl font-black tracking-tight text-white">
                        GRUPO<span class="text-amber-300">AOSC.</span>
                    </h2>
                    <p class="text-white/80 text-xs sm:text-sm leading-relaxed">
                        Tu estilo, tu camino. Encuentra las mejores zapatillas y calzado con calidad garantizada y actitud en cada paso.
                    </p>
                    <div class="flex items-center gap-2 pt-2">
                        <a href="#" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white hover:text-[#269ad5] flex items-center justify-center text-white transition-all">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white hover:text-[#269ad5] flex items-center justify-center text-white transition-all">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-amber-300 mb-3">Enlaces rápidos</h3>
                    <ul class="space-y-2 text-xs text-white/80">
                        <li><a href="#inicio" class="hover:text-amber-300 transition-colors">Inicio</a></li>
                        <li><a href="#productos" class="hover:text-amber-300 transition-colors">Catálogo de Productos</a></li>
                        <li><a href="#" class="hover:text-amber-300 transition-colors">Términos y Condiciones</a></li>
                        <li><a href="#" class="hover:text-amber-300 transition-colors">Política de Privacidad</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-amber-300 mb-3">Atención al cliente</h3>
                    <ul class="space-y-2 text-xs text-white/80">
                        <li><a href="#" class="hover:text-amber-300 transition-colors">Sigue tu pedido</a></li>
                        <li><a href="#" class="hover:text-amber-300 transition-colors">Preguntas frecuentes</a></li>
                        <li><a href="#" class="hover:text-amber-300 transition-colors">Cambios y devoluciones</a></li>
                        <li><a href="#" class="hover:text-amber-300 transition-colors">Contáctanos</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-amber-300 mb-3">Ofertas exclusivas</h3>
                    <p class="text-xs text-white/80 mb-3">Suscríbete para recibir promociones e información de lanzamientos.</p>
                    <form action="#" method="POST" class="space-y-2">
                        <input type="email" placeholder="Tu correo electrónico" class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-lg text-xs text-white placeholder-white/60 outline-none focus:bg-white focus:text-gray-800 focus:placeholder-gray-400 transition-all">
                        <button type="submit" class="w-full py-2 px-4 bg-amber-400 hover:bg-amber-300 text-gray-900 font-extrabold text-xs rounded-lg transition-colors shadow-sm uppercase tracking-wider">
                            Suscribirme
                        </button>
                    </form>
                </div>
            </div>

            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-white/80 text-center sm:text-left">
                <p>© {{ date('Y') }} GRUPOAOSC. Todos los derechos reservados.</p>
                <div class="flex items-center justify-center gap-4 text-[11px] font-medium flex-wrap">
                    <span>💳 Pagos 100% seguros</span>
                    <span>🚚 Envíos a todo el país</span>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
