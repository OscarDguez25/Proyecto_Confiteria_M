<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permisos';
    public $timestamps = false;
    protected $fillable = ['Permiso'];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'idPermiso');
    }
}
