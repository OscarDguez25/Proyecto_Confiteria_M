<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Si ya hay sesión activa, ir directo al dashboard
        if (session('empleado_id')) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'usuario'  => 'required|string',
            'password' => 'required|string',
        ], [
            'usuario.required'  => 'Ingresa tu usuario.',
            'password.required' => 'Ingresa tu contraseña.',
        ]);

        $empleado = Empleado::with('permiso')->where('Usuario', $request->usuario)->first();

        if (!$empleado || !Hash::check($request->password, $empleado->Contraseña)) {
            return back()->withInput($request->only('usuario'))
                ->with('error', 'Usuario o contraseña incorrectos.');
        }

        // Estado 1 = Activo
        if ((int) $empleado->idEstado !== 1) {
            return back()->withInput($request->only('usuario'))
                ->with('error', 'Tu cuenta está inactiva. Contacta al administrador.');
        }

        $request->session()->regenerate();

        session([
            'empleado_id'      => $empleado->idEmpleado,
            'empleado_nombre'  => $empleado->NomEmpleado,
            'empleado_usuario' => $empleado->Usuario,
            'empleado_permiso' => $empleado->idPermiso,
            'empleado_rol'     => $empleado->permiso->Permiso ?? 'Sin rol',
            'inicio_sesion'    => now()->format('H:i:s'),
        ]);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}
