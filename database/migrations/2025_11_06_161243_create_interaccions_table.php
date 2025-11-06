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
        Schema::create('interaccions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idUsuario');
            $table->unsignedBigInteger('idInmueble');
            $table->string('tipoInteraccion'); // vista, click, contacto, etc.
            $table->timestamp('fechaInteraccion')->useCurrent();

            $table->foreign('idUsuario')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('idInmueble')->references('id')->on('inmuebles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interaccions');
    }
};
