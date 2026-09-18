<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión | SistemaTienda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/css/login.css', 'resources/js/login.js'])
</head>
<body>

{{-- FONDO DEL LOGIN --}}
<div class="login-background">
    @if(isset($imagenes) && $imagenes->count() > 0)
        <div id="loginBackgroundCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="6000">
            <div class="carousel-inner">
                @foreach($imagenes as $index => $imagen)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset($imagen->imagen) }}" class="background-image" alt="Fondo de inicio de sesión">
                    </div>
                @endforeach
            </div>
            @if($imagenes->count() > 1)
                <div class="carousel-indicators">
                    @foreach($imagenes as $index => $imagen)
                        <button type="button" data-bs-target="#loginBackgroundCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-label="Imagen {{ $index + 1 }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    @else
        <div style="width: 100%; height: 100%; background: #0f172a;"></div>
    @endif
    <div class="background-overlay"></div>
</div>


{{-- LOGO EN CÍRCULO (SUPERIOR IZQUIERDA) --}}
@if($compania?->logo)
    <div class="company-logo-badge
        {{ ($login->posicion_logo ?? 'SUPERIOR_IZQUIERDA') == 'SUPERIOR_CENTRO' ? 'logo-centro' : '' }}
        {{ ($login->posicion_logo ?? 'SUPERIOR_IZQUIERDA') == 'SUPERIOR_DERECHA' ? 'logo-derecha' : '' }}">
        <img src="{{ asset('uploads/companias/' . $compania->logo) }}" alt="Logo" class="company-logo">
    </div>
@endif

{{--CONTENIDO PRINCIPAL --}}
<div class="login-container
    {{ ($login->posicion_formulario ?? 'DERECHA') == 'IZQUIERDA' ? 'formulario-izquierda' : 'formulario-derecha' }}">
    <div class="login-card">
        <div class="text-center">
            <div class="login-title">
                {{ $compania?->nombre_comercial ?? $compania?->nombre ?? 'SistemaTienda' }}
            </div>
            <div class="login-subtitle">
                Ingresa tus credenciales para acceder
            </div>
        </div>
        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center">
                <i class="bi bi-exclamation-circle-fill me-2 fs-5"></i>
                <div>{{ session('error') }}</div>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                <div>{{ $errors->first() }}</div>
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="correo@ejemplo.com" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"> <i class="bi bi-lock"></i> </span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                    <button class="btn btn-outline-secondary"
                        type="button"  id="togglePassword" style="border-color: #cbd5e1; background: #f8fafc; color: #64748b;">
                        <i class="bi bi-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember"> Recordarme</label>
                </div>
            </div>
            <button type="submit" class="btn btn-login w-100">
                Iniciar sesión
                <i class="bi bi-arrow-right ms-1"></i>
            </button>
        </form>
    </div>
</div>

</body>
</html>