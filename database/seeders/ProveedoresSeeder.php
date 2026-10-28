<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ProveedoresSeeder extends Seeder
{
    public function run(): void
    {
        $proveedores = [
            ['NomProveedor' => 'Dulces del Norte',      'Telefono' => '6621112233', 'Direccion' => 'Hermosillo, Son.', 'Correo' => 'ventas@dulcesdelnorte.mx'],
            ['NomProveedor' => 'Chocolates La Sierra',  'Telefono' => '6622223344', 'Direccion' => 'Cd. Obregón, Son.', 'Correo' => 'contacto@lasierra.mx'],
            ['NomProveedor' => 'Distribuidora Azúcar',  'Telefono' => '6633334455', 'Direccion' => 'Guadalajara, Jal.', 'Correo' => 'pedidos@azucar.mx'],
        ];

        foreach ($proveedores as $p) {
            Proveedor::updateOrCreate(['NomProveedor' => $p['NomProveedor']], $p);
        }
    }
}
