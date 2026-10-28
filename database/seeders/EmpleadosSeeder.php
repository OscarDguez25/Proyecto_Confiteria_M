<?php

namespace Database\Seeders;

use App\Models\Empleado;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmpleadosSeeder extends Seeder
{
    public function run(): void
    {
        $empleados = [
            ['NomEmpleado' => 'Administrador General', 'Usuario' => 'admin',     'Telefono' => '6311234567', 'Direccion' => 'Av. Obregón 100, Nogales, Son.',  'password' => 'admin1234',    'idPermiso' => 1, 'idEstado' => 1],
            ['NomEmpleado' => 'Carlos Ruiz',           'Usuario' => 'cruiz',     'Telefono' => '6312345678', 'Direccion' => 'Calle Elías 45, Nogales, Son.',   'password' => 'vendedor123',  'idPermiso' => 3, 'idEstado' => 1],
            ['NomEmpleado' => 'María González',        'Usuario' => 'mgonzalez', 'Telefono' => '6313456789', 'Direccion' => 'Blvd. Colosio 230, Nogales, Son.', 'password' => 'almacen123',   'idPermiso' => 2, 'idEstado' => 1],
            ['NomEmpleado' => 'Juan Pérez',            'Usuario' => 'jperez',    'Telefono' => '6314567890', 'Direccion' => 'Calle Internacional 12, Nogales, Son.', 'password' => 'vendedor123', 'idPermiso' => 3, 'idEstado' => 2],
        ];

        foreach ($empleados as $e) {
            Empleado::updateOrCreate(
                ['Usuario' => $e['Usuario']],
                [
                    'NomEmpleado' => $e['NomEmpleado'],
                    'Telefono'    => $e['Telefono'],
                    'Direccion'   => $e['Direccion'],
                    'Contraseña'  => Hash::make($e['password']),
                    'idPermiso'   => $e['idPermiso'],
                    'idEstado'    => $e['idEstado'],
                ]
            );
        }
    }
}
