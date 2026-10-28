<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idCompra')->constrained('compras')->cascadeOnDelete();
            $table->string('idProductos', 20);
            $table->unsignedInteger('Cantidad');
            $table->decimal('PrecioUnitario', 10, 2);
            $table->decimal('Subtotal', 10, 2);
            $table->foreign('idProductos')->references('idProductos')->on('productos');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_compras');
    }
};
