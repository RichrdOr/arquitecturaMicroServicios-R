<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            // Identificador único del libro para evitar duplicidad de stock por producto
            $table->unsignedBigInteger('book_id')->unique(); 
            
            // Cantidad total física en bodega
            $table->integer('quantity')->default(0); 
            
            // Unidades bloqueadas (ej: carritos de compra activos)
            $table->integer('reserved_quantity')->default(0); 
            
            // Cálculo: quantity - reserved_quantity
            $table->integer('available_quantity')->default(0); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};