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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('email');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('codigo_postal');

            $table->decimal('total', 10,2);
            $table->string('estado')->default('pendiente');
            $table->string('metodo_pago')->default('tarjeta');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};

