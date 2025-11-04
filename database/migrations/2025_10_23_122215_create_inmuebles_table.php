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
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->id();
            $table->string('direccion', 255);
            $table->string('titulo', 150);
            $table->enum('tipoOferta', ['venta', 'arriendo', 'venta y arriendo']);
            $table->decimal('precio', 15, 2)->nullable();
            $table->decimal('precioAdministracion', 15, 2)->nullable();
            $table->decimal('area', 10, 2)->nullable();
            $table->integer('nHabitaciones')->nullable();
            $table->integer('nBaños')->nullable();
            $table->integer('nParqueaderos')->nullable();
            $table->integer('nPiso')->nullable();
            $table->integer('pisoNumero')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamp('fechaPublicacion')->useCurrent();
            $table->enum('estadoPublicacion', ['activa', 'inactiva', 'vendida'])->default('activa');
            $table->timestamp('fechaCreacion')->useCurrent();

            // Relaciones
            $table->unsignedBigInteger('idUsuario');
            $table->foreign('idUsuario')->references('id')->on('usuarios')->onDelete('cascade');

            $table->unsignedBigInteger('idBarrio');
            $table->foreign('idBarrio')->references('id')->on('barrios')->restrictOnDelete();

            $table->unsignedBigInteger('idTipoInmueble');
            $table->foreign('idTipoInmueble')->references('id')->on('tipoinmuebles')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inmuebles');
    }
};
