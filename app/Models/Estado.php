<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    public $timestamps = false;
    protected $fillable = ['Estado', 'Descripcion'];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'idEstado');
    }
}
