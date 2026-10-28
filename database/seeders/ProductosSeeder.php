<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    public function run(): void
    {
        $productos = [
            ['idProductos' => 'CONF001', 'NomProducto' => 'Paleta de caramelo',      'Stock' => 120, 'Precio' => 5.50,  'Descripcion' => 'Bolsa de 50 piezas',     'idProveedor' => 1],
            ['idProductos' => 'CONF002', 'NomProducto' => 'Chocolate con leche',     'Stock' => 14,  'Precio' => 18.00, 'Descripcion' => 'Barra de 40 g',          'idProveedor' => 2],
            ['idProductos' => 'CONF003', 'NomProducto' => 'Gomitas ácidas',          'Stock' => 8,   'Precio' => 12.50, 'Descripcion' => 'Bolsa de 100 g',         'idProveedor' => 1],
            ['idProductos' => 'CONF004', 'NomProducto' => 'Caramelo macizo',         'Stock' => 3,   'Precio' => 2.00,  'Descripcion' => 'Pieza individual',       'idProveedor' => 3],
            ['idProductos' => 'CONF005', 'NomProducto' => 'Malvaviscos',             'Stock' => 0,   'Precio' => 22.00, 'Descripcion' => 'Bolsa de 250 g',         'idProveedor' => 3],
            ['idProductos' => 'CONF006', 'NomProducto' => 'Tamarindo enchilado',     'Stock' => 60,  'Precio' => 7.00,  'Descripcion' => 'Paquete de 10 piezas',   'idProveedor' => 1],
        ];

        foreach ($productos as $p) {
            Producto::updateOrCreate(['idProductos' => $p['idProductos']], $p);
        }
    }
}
