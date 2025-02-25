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
        Schema::create('inmobiliarias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255)->unique()->notNullable();
            $table->string('password', 255)->notNullable();
            $table->string('telefono', 20)->notNullable();
            $table->string('email', 255)->notNullable();
            $table->string('nombre_comercial', 255)->notNullable();
            $table->string('direccion', 255)->notNullable();
            $table->string('codigo_postal', 10)->notNullable();
            $table->string('localidad', 255)->notNullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inmobiliarias');
    }
};