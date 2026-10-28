<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('idEmpleado');
            $table->string('NomEmpleado', 100);
            $table->string('Usuario', 50)->unique();
            $table->string('Telefono', 20);
            $table->string('Direccion', 150);
            $table->string('Contraseña', 255); // hash bcrypt (Hash::make)
            $table->foreignId('idPermiso')->constrained('permisos');
            $table->foreignId('idEstado')->constrained('estados');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
