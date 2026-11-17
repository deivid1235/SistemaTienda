<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthUsuarioExterno
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle( string $request, Closure $next)
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('home')
                ->with('error', 'Debes iniciar sesión para registrar una reclamación.');
        }
        return $next($request);
    }
}
