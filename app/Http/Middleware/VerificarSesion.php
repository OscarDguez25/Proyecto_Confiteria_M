<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarSesion
{
    /**
     * Redirige al login si no existe una sesión de empleado activa.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('empleado_id')) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesion para acceder.');
        }

        return $next($request);
    }
}
