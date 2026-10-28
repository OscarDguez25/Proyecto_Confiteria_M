<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->string('idProductos', 20)->primary(); // ej: CONF001
            $table->string('NomProducto', 100);
            $table->unsignedInteger('Stock')->default(0);
            $table->decimal('Precio', 10, 2);
            $table->string('Descripcion', 255)->nullable();
            $table->foreignId('idProveedor')->constrained('proveedores');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
