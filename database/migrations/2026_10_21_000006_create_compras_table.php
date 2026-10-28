<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idEmpleado');
            $table->text('idProductos')->nullable(); // códigos separados por coma
            $table->decimal('Total', 10, 2);
            $table->timestamp('FechaCompra')->useCurrent();
            $table->foreign('idEmpleado')->references('idEmpleado')->on('empleados');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
