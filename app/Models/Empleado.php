<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Empleado extends Authenticatable
{
    protected $table = 'empleados';
    protected $primaryKey = 'idEmpleado';

    protected $fillable = [
        'NomEmpleado',
        'Usuario',
        'Telefono',
        'Direccion',
        'Contraseña',
        'idPermiso',
        'idEstado',
    ];

    protected $hidden = ['Contraseña'];

    // La columna de contraseña tiene un nombre personalizado.
    public function getAuthPassword()
    {
        return $this->Contraseña;
    }

    public function permiso()
    {
        return $this->belongsTo(Permiso::class, 'idPermiso');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'idEstado');
    }

    public function compras()
    {
        return $this->hasMany(Compra::class, 'idEmpleado');
    }
}
