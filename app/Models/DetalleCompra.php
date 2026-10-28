<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    protected $table = 'detalle_compras';
    public $timestamps = false;

    protected $fillable = ['idCompra', 'idProductos', 'Cantidad', 'PrecioUnitario', 'Subtotal'];

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'idCompra');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProductos', 'idProductos');
    }
}
