<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';
    public $timestamps = false;

    protected $fillable = ['idEmpleado', 'idProductos', 'Total', 'FechaCompra'];

    protected $casts = ['FechaCompra' => 'datetime'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'idEmpleado');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleCompra::class, 'idCompra');
    }
}
