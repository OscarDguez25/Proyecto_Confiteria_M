<?php

namespace Database\Seeders;

use App\Models\Permiso;
use Illuminate\Database\Seeder;

class PermisosSeeder extends Seeder
{
    public function run(): void
    {
        // 1 = Administrador, 2 = Almacen, 3 = Vendedor
        foreach (['Administrador', 'Almacen', 'Vendedor'] as $i => $nombre) {
            Permiso::updateOrCreate(['id' => $i + 1], ['Permiso' => $nombre]);
        }
    }
}
