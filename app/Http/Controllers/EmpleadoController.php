<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Estado;
use App\Models\Permiso;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmpleadoController extends Controller
{
    private array $mensajes = [
        'NomEmpleado.required' => 'El nombre es obligatorio.',
        'Usuario.required'     => 'El usuario es obligatorio.',
        'Usuario.unique'       => 'Ese nombre de usuario ya está en uso.',
        'Telefono.required'    => 'El teléfono es obligatorio.',
        'Direccion.required'   => 'La dirección es obligatoria.',
        'password.required'    => 'La contraseña es obligatoria.',
        'password.min'         => 'La contraseña debe tener al menos 6 caracteres.',
        'idPermiso.required'   => 'Selecciona un rol.',
        'idPermiso.exists'     => 'El rol seleccionado no existe.',
        'idEstado.required'    => 'Selecciona un estado.',
        'idEstado.exists'      => 'El estado seleccionado no existe.',
    ];

    public function index()
    {
        return view('empleados.index', [
            'empleados' => Empleado::with(['permiso', 'estado'])->orderBy('idEmpleado')->get(),
            'permisos'  => Permiso::orderBy('id')->get(),
            'estados'   => Estado::orderBy('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'NomEmpleado' => 'required|string|max:100',
            'Usuario'     => 'required|string|max:50|unique:empleados,Usuario',
            'Telefono'    => 'required|string|max:20',
            'Direccion'   => 'required|string|max:150',
            'password'    => 'required|string|min:6',
            'idPermiso'   => 'required|exists:permisos,id',
            'idEstado'    => 'required|exists:estados,id',
        ], $this->mensajes);

        Empleado::create([
            'NomEmpleado' => $datos['NomEmpleado'],
            'Usuario'     => $datos['Usuario'],
            'Telefono'    => $datos['Telefono'],
            'Direccion'   => $datos['Direccion'],
            'Contraseña'  => Hash::make($datos['password']),
            'idPermiso'   => $datos['idPermiso'],
            'idEstado'    => $datos['idEstado'],
        ]);

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado registrado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);

        $datos = $request->validate([
            'NomEmpleado' => 'required|string|max:100',
            'Usuario'     => ['required', 'string', 'max:50',
                              Rule::unique('empleados', 'Usuario')->ignore($empleado->idEmpleado, 'idEmpleado')],
            'Telefono'    => 'required|string|max:20',
            'Direccion'   => 'required|string|max:150',
            'password'    => 'nullable|string|min:6',
            'idPermiso'   => 'required|exists:permisos,id',
            'idEstado'    => 'required|exists:estados,id',
        ], $this->mensajes);

        $cambios = [
            'NomEmpleado' => $datos['NomEmpleado'],
            'Usuario'     => $datos['Usuario'],
            'Telefono'    => $datos['Telefono'],
            'Direccion'   => $datos['Direccion'],
            'idPermiso'   => $datos['idPermiso'],
            'idEstado'    => $datos['idEstado'],
        ];

        // Solo se cambia la contraseña si se escribió una nueva
        if ($request->filled('password')) {
            $cambios['Contraseña'] = Hash::make($request->password);
        }

        $empleado->update($cambios);

        // Si el administrador se editó a sí mismo, refrescar los datos de su sesión
        if ((int) $id === (int) session('empleado_id')) {
            $empleado->load('permiso');
            session([
                'empleado_nombre'  => $empleado->NomEmpleado,
                'empleado_usuario' => $empleado->Usuario,
                'empleado_permiso' => $empleado->idPermiso,
                'empleado_rol'     => $empleado->permiso->Permiso ?? 'Sin rol',
            ]);
        }

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado actualizado correctamente.');
    }

    public function destroy($id)
    {
        if ((int) $id === (int) session('empleado_id')) {
            return back()->with('error', 'No puedes eliminarte a ti mismo.');
        }

        $empleado = Empleado::findOrFail($id);

        try {
            $empleado->delete();
        } catch (QueryException $e) {
            return back()->with('error', 'No se puede eliminar: el empleado tiene ventas registradas. Mejor márcalo como Inactivo.');
        }

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado eliminado correctamente.');
    }
}
