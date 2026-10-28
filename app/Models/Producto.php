<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'idProductos';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'idProductos',
        'NomProducto',
        'Stock',
        'Precio',
        'Descripcion',
        'idProveedor',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'idProveedor');
    }
}
