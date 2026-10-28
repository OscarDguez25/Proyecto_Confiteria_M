<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Empleado;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'productos'   => Producto::count(),
            'empleados'   => Empleado::where('idEstado', 1)->count(),
            'ventas_hoy'  => (float) Compra::whereDate('FechaCompra', today())->sum('Total'),
            'proveedores' => Proveedor::count(),
        ];

        // Productos con stock <= 15, los más bajos primero
        $bajoStock = Producto::where('Stock', '<=', 15)
            ->orderBy('Stock')
            ->get()
            ->map(function ($p) {
                if ($p->Stock == 0) {
                    $p->nivel = 'Sin stock';
                    $p->clase = 'dark';
                } elseif ($p->Stock <= 5) {
                    $p->nivel = 'Crítico';
                    $p->clase = 'danger';
                } else {
                    $p->nivel = 'Bajo';
                    $p->clase = 'warning';
                }
                return $p;
            });

        // Comprobar la conexión a la base de datos para el panel de actividad
        try {
            DB::connection()->getPdo();
            $bdConectada = true;
        } catch (\Throwable $e) {
            $bdConectada = false;
        }

        return view('dashboard', [
            'stats'       => $stats,
            'bajoStock'   => $bajoStock,
            'bdConectada' => $bdConectada,
        ]);
    }
}
