<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $fillable = ['NomProveedor', 'Telefono', 'Direccion', 'Correo'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'idProveedor');
    }
}
