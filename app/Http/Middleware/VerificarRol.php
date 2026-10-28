<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarRol
{
    /**
     * Uso en rutas: ->middleware('rol:1') o ->middleware('rol:1,2')
     * Si el rol del empleado no está permitido, regresa al Dashboard con un aviso.
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $permiso = (string) session('empleado_permiso');

        if (!in_array($permiso, $roles, true)) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permiso para acceder a esa seccion.');
        }

        return $next($request);
    }
}
