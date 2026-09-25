<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    @yield('title', 'SistemaTienda')
    </title>
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('css')
    
</head>
@php
    $estiloActivo = \App\Models\Estilo::where('estado', 'ACTIVO')->first();
@endphp
<style>
    :root {
        --active-pink: {{ $estiloActivo->color ?? '#269ad5' }};
    }
</style>
<body>
    <div id="sidebarOverlay" class="sidebar-overlay"></div>
        <aside id="sidebar-left" class="sidebar-left">
            <div class="sidebar-header">
                <a href="{{ route('dashboard') }}" class="logo">
                    <img src="{{ asset('image/logo.jpeg') }}" alt="Logo">
                </a>
            </div>
            <div class="nano">
                <div class="nano-content">
                    <nav id="menu" class="nav-main-wrapper">
                        <ul class="nav-main">
                            <li class="{{ request()->routeIs('dashboard') ? 'nav-active' : '' }}">
                                <a class="nav-link" href="{{ route('dashboard') }}">
                                    <i class="fa-regular fa-compass"></i>
                                    <span>DASHBOARD</span>
                                </a>
                            </li>

                            {{-- PREVENTA --}}
                            <li class="nav-parent">
                                <a class="nav-link" href="#">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    <span>Preventa</span>
                                    <i class="fas fa-chevron-down chevron"></i>
                                </a>
                                <ul class="nav-children">
                                    <li><a class="nav-link" href="#">Nueva preventa</a></li>
                                    <li><a class="nav-link" href="#">Preventas</a></li>
                                </ul>
                            </li>

                            {{-- VENTAS --}}
                            <li class="nav-parent">
                                <a class="nav-link" href="#">
                                    <i class="fa-regular fa-file-lines"></i>
                                    <span>VENTAS</span>
                                    <i class="fas fa-chevron-down chevron"></i>
                                </a>
                                <ul class="nav-children">
                                    <li><a class="nav-link" href="#">Nueva venta</a></li>
                                    <li><a class="nav-link" href="#">Ventas</a></li>
                                    <li><a class="nav-link" href="#">Cotizaciones</a></li>
                                    <li><a class="nav-link" href="#">Punto de venta</a></li>
                                </ul>
                            </li>

                            {{-- COMPRAS --}}
                            <li class="nav-parent">
                                <a class="nav-link" href="#">
                                    <i class="fa-solid fa-bag-shopping"></i>
                                    <span>Compras</span>
                                    <i class="fas fa-chevron-down chevron"></i>
                                </a>
                                <ul class="nav-children">
                                    <li><a class="nav-link" href="#">Nueva compra</a></li>
                                    <li><a class="nav-link" href="#">Compras</a></li>
                                    <li><a class="nav-link" href="#">Proveedores</a></li>
                                </ul>
                            </li>

                            {{-- CLIENTES --}}
                            <li class="nav-parent {{ request()->routeIs('cliente') ? 'nav-expanded' : '' }}" style="{{ request()->routeIs('cliente') ? 'display: block;' : '' }}">
                                <a class="nav-link" href="#">
                                    <i class="fa-regular fa-address-card"></i><span>Clientes</span><i class="fas fa-chevron-down chevron"></i>
                                </a>

                                <ul class="nav-children" style="{{ request()->routeIs('cliente','tipocliente') ? 'display: block !important;' : '' }}">
                                    <li class="{{ request()->routeIs('cliente') ? 'nav-active' : '' }}">
                                        <a class="nav-link" href="{{ route('cliente') }}">
                                            <i class="fa-solid fa-circle text-[8px]"></i>
                                            <span>Clientes</span>
                                        </a>
                                    </li>

                                    <li class="{{ request()->routeIs('tipocliente') ? 'nav-active' : '' }}">
                                        <a class="nav-link" href="{{ route('tipocliente') }}">
                                            <i class="fa-solid fa-circle text-[8px]"></i>
                                            <span>Tipos de clientes</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{-- PRODUCTOS / SERVICIOS --}}
                            <li class="nav-parent">
                                <a class="nav-link" href="#">
                                    <i class="fa-regular fa-square"></i>
                                    <span>Productos/Servicios</span>
                                    <i class="fas fa-chevron-down chevron"></i>
                                </a>
                                <ul class="nav-children">
                                    <li><a class="nav-link" href="#">Productos</a></li>
                                    <li><a class="nav-link" href="#">Categorías</a></li>
                                    <li><a class="nav-link" href="#">Marcas</a></li>
                                    <li><a class="nav-link" href="#">Promociones</a></li>
                                </ul>
                            </li>

                            {{-- INVENTARIO --}}
                            <li class="nav-parent">
                                <a class="nav-link" href="#">
                                    <i class="fa-solid fa-warehouse"></i>
                                    <span>Inventario</span>
                                    <i class="fas fa-chevron-down chevron"></i>
                                </a>
                                <ul class="nav-children">
                                    <li><a class="nav-link" href="#">Stock</a></li>
                                    <li><a class="nav-link" href="#">Movimientos</a></li>
                                    <li><a class="nav-link" href="#">Kardex</a></li>
                                    <li><a class="nav-link" href="#">Ajustes de inventario</a></li>
                                </ul>
                            </li>

                            {{-- FINANZAS --}}
                            <li class="nav-parent">
                                <a class="nav-link" href="#">
                                    <i class="fa-solid fa-calculator"></i>
                                    <span>Finanzas</span>
                                    <i class="fas fa-chevron-down chevron"></i>
                                </a>
                                <ul class="nav-children">
                                    <li><a class="nav-link" href="#">Cuentas por cobrar</a></li>
                                    <li><a class="nav-link" href="#">Cuentas por pagar</a></li>
                                    <li><a class="nav-link" href="#">Caja y bancos</a></li>
                                </ul>
                            </li>

                            {{-- GUÍAS DE REMISIÓN --}}
                            <li class="nav-parent">
                                <a class="nav-link" href="#">
                                    <i class="fa-solid fa-truck"></i>
                                    <span>Guías de remisión</span>
                                    <i class="fas fa-chevron-down chevron"></i>
                                </a>
                                <ul class="nav-children">
                                    <li><a class="nav-link" href="#">Nueva guía</a></li>
                                    <li><a class="nav-link" href="#">Guías emitidas</a></li>
                                </ul>
                            </li>

                            {{-- COMPROBANTES PENDIENTES --}}
                            <li class="nav-parent">
                                <a class="nav-link" href="#">
                                    <i class="fa-regular fa-circle-question"></i>
                                    <span>Comprobantes pendientes</span>
                                    <i class="fas fa-chevron-down chevron"></i>
                                </a>
                                <ul class="nav-children">
                                    <li><a class="nav-link" href="#">Por enviar</a></li>
                                    <li><a class="nav-link" href="#">Rechazados</a></li>
                                </ul>
                            </li>

                            {{-- COMPROBANTES AVANZADOS --}}
                            <li class="nav-parent">
                                <a class="nav-link" href="#">
                                    <i class="fa-regular fa-clipboard"></i>
                                    <span>Comprobantes avanzados</span>
                                    <i class="fas fa-chevron-down chevron"></i>
                                </a>
                                <ul class="nav-children">
                                    <li><a class="nav-link" href="#">Facturas</a></li>
                                    <li><a class="nav-link" href="#">Boletas</a></li>
                                    <li><a class="nav-link" href="#">Notas de crédito</a></li>
                                    <li><a class="nav-link" href="#">Notas de débito</a></li>
                                </ul>
                            </li>

                            {{-- CONTABILIDAD --}}
                            <li class="nav-parent">
                                <a class="nav-link" href="#">
                                    <i class="fa-solid fa-chart-simple"></i>
                                    <span>Contabilidad</span>
                                    <i class="fas fa-chevron-down chevron"></i>
                                </a>
                                <ul class="nav-children">
                                    <li><a class="nav-link" href="#">Plan de cuentas</a></li>
                                    <li><a class="nav-link" href="#">Asientos contables</a></li>
                                </ul>
                            </li>

                            {{-- REPORTES --}}
                            <li class="nav-parent">
                                <a class="nav-link" href="#">
                                    <i class="fa-regular fa-file"></i>
                                    <span>Reportes</span>
                                    <i class="fas fa-chevron-down chevron"></i>
                                </a>
                                <ul class="nav-children">
                                    <li><a class="nav-link" href="#">Reporte de ventas</a></li>
                                    <li><a class="nav-link" href="#">Reporte de compras</a></li>
                                    <li><a class="nav-link" href="#">Reporte de productos</a></li>
                                    <li><a class="nav-link" href="#">Reporte de inventario</a></li>
                                </ul>
                            </li>

                            {{-- SUSCRIPCIÓN ESCOLAR (BETA) --}}
                            <li class="nav-parent">
                                <a class="nav-link" href="#">
                                    <i class="fa-regular fa-calendar-days"></i>
                                    <span>Suscripción Escolar</span>
                                    <span class="badge-beta">Beta</span>
                                    <i class="fas fa-chevron-down chevron"></i>
                                </a>
                                <ul class="nav-children">
                                    <li><a class="nav-link" href="#">Matrículas</a></li>
                                    <li><a class="nav-link" href="#">Pensiones</a></li>
                                </ul>
                            </li>

                        </ul>

                    </nav>

                </div>
            </div>
        
            <!-- CONTENEDOR PRINCIPAL -->
            <div class="relative">
                <button type="button" onclick="document.getElementById('configuracionMenu').classList.toggle('hidden')"
                    class="flex items-center gap-3 px-3 py-2 text-gray-700 text-sm font-medium w-full">
                    <i class="fa-solid fa-gear text-gray-500 text-lg"></i>
                    <span>Configuración y más</span>
                </button>
                <!-- MENÚ DESPLEGABLE -->
                <div id="configuracionMenu"
                    class="hidden absolute bottom-full left-0 mb-2 w-72 bg-white rounded-xl shadow-xl border border-gray-200 p-2 z-50">
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 text-gray-700 text-sm font-medium transition-colors">
                        <i class="fa-solid fa-users text-gray-600 w-5 text-base"></i>
                        <span>Usuarios</span>
                    </a>
                    <a href="{{ route('sucursal') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 text-gray-700 text-sm font-medium transition-colors">
                        <i class="fa-solid fa-list-ol text-gray-600 w-5 text-base"></i>
                        <span>Sucursales & Series</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 text-gray-700 text-sm font-medium transition-colors">
                        <i class="fa-solid fa-mobile-screen-button text-gray-600 w-5 text-base"></i>
                        <span>APP 3.1</span>
                    </a>

                    <a href="{{ route('configuracion.menu') }}"class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 text-gray-700 text-sm font-medium transition-colors">
                        <i class="fa-solid fa-briefcase text-gray-600 w-5 text-base"></i>
                        <span>Configuraciones Globales</span>
                    </a>
                </div>
            </div>

    </div>
    </aside>
    <header class="topbar">
        <div class="topbar-left">
            <button id="sidebarToggle" class="sidebar-toggle" type="button" aria-label="Mostrar/ocultar menú">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="topbar-shortcuts">
                <a href="#" class="shortcut-btn">
                    <i class="fa-regular fa-file-lines " style="font-size: 23px;"></i>
                    NC
                </a>
                <a href="#" class="shortcut-btn">
                    <i class="fa-solid fa-cash-register" style="font-size: 23px;"></i>
                    POS
                </a>
                <a href="#" class="shortcut-btn">
                    <i class="fa-solid fa-money-bill-transfer" style="font-size: 23px;"></i>
                    ME
                </a>
                <a href="#" class="shortcut-btn">
                    <i class="fas fa-ellipsis" style="font-size: 23px;"></i>
                </a>
            </div>
        </div>
        <div class="topbar-right">
            <div class="demo-badge">
                <strong>Modo: DEMO</strong>
                <span>Conectado a SUNAT</span>
            </div>
            <a href="#" class="icon-btn">
                <i class="fas fa-cart-shopping"></i>
                <span class="count">0</span>
            </a>

            <a href="#" class="icon-btn notif">
                <i class="fas fa-bell"></i>
                <span class="count">4</span>
            </a>

            <div class="admin-block" style="position: relative; cursor: pointer;" onclick="document.getElementById('logoutMenu').classList.toggle('d-none')">
                <div class="admin-text">
                    <strong>{{ Auth::user()->name }}</strong>
                    <span>{{ Auth::user()->email }}</span>
                </div>
                <div class="admin-avatar">
                    <i class="fas fa-circle-user"></i>
                </div>
                <!-- Menú desplegable -->
                <div id="logoutMenu" class="d-none"
                    style="position: absolute; top: 50px; right: 0; background: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,.15); min-width: 220px; z-index: 9999; overflow: hidden; font-family: sans-serif;">
                    <!-- Opciones superiores -->
                    <div style="padding: 8px 0;">
                        <a href="#" style="display: flex; align-items: center; padding: 10px 16px; color: #333; text-decoration: none; font-size: 14px;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='transparent'">
                            <i class="fas fa-file-invoice-dollar" style="width: 20px; margin-right: 10px; color: #666;"></i> Mis Pagos
                        </a>
                        <a href="#" id="open-styles" style="display: flex; align-items: center; padding: 10px 16px; color: #333; text-decoration: none; font-size: 14px;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='transparent'">
                            <i class="fas fa-paint-roller" style="width: 20px; margin-right: 10px; color: #666;"></i> Estilos y temas
                        </a>
                    </div>

                    <!-- Sección Cambiar Sucursal -->
                    <div style="border-top: 1px solid #eaeaea; border-bottom: 1px solid #eaeaea; padding: 12px 16px;">
                        <span style="display: block; font-size: 12px; color: #666; margin-bottom: 6px;">Cambiar Sucursal:</span>
                        <select style="width: 100%; padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px; background: #fff; font-size: 14px; outline: none; cursor: pointer;">
                            <option value="principal">Oficina Principal</option>
                            <!-- Agrega más sucursales aquí si las necesitas -->
                        </select>
                    </div>

                    <!-- Cerrar Sesión -->
                    <div style="padding: 4px 0;">
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit"
                                style="width: 100%; border: none; background: none; padding: 10px 16px; text-align: left; cursor: pointer; display: flex; align-items: center; color: #333; font-size: 14px;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='transparent'">
                                <i class="fas fa-right-from-bracket" style="width: 20px; margin-right: 10px; color: #666;"></i>
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>

    </header>
    <main class="main-content">

        @yield('content')

    </main>

    @yield('js')
    <script>
        function confirmarEliminar(url) {
            document.getElementById('formEliminar').action = url;
            document.getElementById('modalEliminar').classList.remove('hidden');
        }
    </script>

    <script>
        (function () {
            const toggleBtn = document.getElementById('sidebarToggle');
            const overlay   = document.getElementById('sidebarOverlay');
            if (window.innerWidth <= 991.98) {
                document.body.classList.add('sidebar-collapsed');
            }
            toggleBtn.addEventListener('click', function () {
                document.body.classList.toggle('sidebar-collapsed');
            });
            overlay.addEventListener('click', function () {
                document.body.classList.add('sidebar-collapsed');
            });
            document.querySelectorAll('.nav-link').forEach(function (link) {
                link.addEventListener('click', function () {
                    document.querySelectorAll('.nav-link.is-active')
                        .forEach(function (el) { el.classList.remove('is-active'); });
                    link.classList.add('is-active');
                });
            });
            window.addEventListener('resize', function () {
                if (window.innerWidth > 991.98) {
                    document.body.classList.remove('sidebar-collapsed');
                } else {
                    document.body.classList.add('sidebar-collapsed');
                }
            });
        })();
    </script>
    {{-- ================= MENSAJE FLOTANTE DE ÉXITO ================= --}}
    {{-- Colócalo dentro de tu layout principal (justo después de abrir <body> o
        dentro del topbar), y en tus controladores usa:
        return redirect()->back()->with('success', 'Banco editado con éxito'); --}}

    @if (session('success'))
    <div id="alertaExito"
        class="fixed top-4 left-1/2 -translate-x-1/2 z-[9999]">
        
        <div class="flex items-center gap-2 bg-green-50 border border-green-100
                    text-green-600 text-sm font-medium px-5 py-2.5
                    rounded-lg shadow-sm">
            <i class="fa-solid fa-circle-check text-green-500"></i>
            <span>{{ session('success') }}</span>
        </div>

    </div>

    <script>
        setTimeout(function () {
            const alerta = document.getElementById('alertaExito');
            if (alerta) {
                alerta.style.transition = 'opacity .4s ease';
                alerta.style.opacity = '0';
                setTimeout(function () {
                    alerta.remove();
                }, 400);
            }
        }, 3000);
    </script>
@endif
    {{-- ================= MODAL DE CONFIRMACIÓN: ELIMINAR ================= --}}
    {{-- Inclúyelo una vez dentro de tu vista (o layout) y usa la función JS
     confirmarEliminar('URL_DEL_REGISTRO') en el onclick de cada botón "Eliminar". --}}
    <div id="modalEliminar" class="hidden fixed inset-0 z-[99999] flex items-start justify-center pt-24">
        {{-- fondo sutil --}}
        <div class="absolute inset-0 bg-black/10"
            onclick="document.getElementById('modalEliminar').classList.add('hidden')"></div>
        {{-- contenido --}}
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 p-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="text-lg font-semibold text-slate-800">Eliminar</h2>
                <button type="button"
                        onclick="document.getElementById('modalEliminar').classList.add('hidden')"
                        class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="flex items-center gap-3 mb-8">
                <i class="fa-solid fa-triangle-exclamation text-amber-500 text-lg"></i>
                <p class="text-sm text-slate-600">¿Desea eliminar el registro?</p>
            </div>

            <form id="formEliminar" action="#" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end gap-3">
                    <button type="button"
                            onclick="document.getElementById('modalEliminar').classList.add('hidden')"
                            class="px-4 py-2 rounded-md border border-slate-200 text-slate-600 text-sm font-semibold hover:bg-slate-50">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="px-4 py-2 rounded-md bg-[#0407e2] hover:bg-[#0305b8] text-white text-sm font-semibold">
                        Eliminar
                    </button>
                </div>
            </form>

        </div>
    </div>

    
    
</body>
</html>