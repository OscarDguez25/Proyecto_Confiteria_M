<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Seeder;

class EstadosSeeder extends Seeder
{
    public function run(): void
    {
        // 1 = Activo, 2 = Inactivo
        Estado::updateOrCreate(['id' => 1], ['Estado' => 'Activo', 'Descripcion' => 'Cuenta habilitada para iniciar sesión']);
        Estado::updateOrCreate(['id' => 2], ['Estado' => 'Inactivo', 'Descripcion' => 'Cuenta bloqueada, no puede iniciar sesión']);
    }
}
