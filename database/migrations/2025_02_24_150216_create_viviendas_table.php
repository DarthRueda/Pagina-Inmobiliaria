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
        Schema::create('viviendas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario')->nullable();
            $table->unsignedBigInteger('id_inmobiliaria')->nullable();
            $table->integer('precio')->notNullable();
            $table->string('localizacion', 255)->notNullable();
            $table->text('descripcion')->notNullable();
            $table->integer('habitaciones')->notNullable();
            $table->integer('banyos')->notNullable();
            $table->integer('dimensiones')->notNullable();
            $table->integer('planta')->notNullable();
            $table->string('tipo', 255)->notNullable();
            $table->string('orientacion', 255)->notNullable();
            $table->string('agua_caliente', 255)->notNullable();
            $table->string('calefaccion', 255)->notNullable();
            $table->string('estado', 255)->notNullable();
            $table->string('antiguedad', 255)->notNullable();
            $table->string('parking', 255)->notNullable();
            $table->string('ascensor', 255)->notNullable();
            $table->boolean('aire_acondicionado')->default(false);
            $table->boolean('terraza')->default(false);
            $table->boolean('trastero')->default(false);
            $table->boolean('electrodomesticos')->default(false);
            $table->boolean('balcon')->default(false);
            $table->boolean('puerta_blindada')->default(false);
            $table->boolean('jardin')->default(false);
            $table->boolean('patio')->default(false);
            $table->boolean('piscina')->default(false);
            $table->boolean('suite_con_bano')->default(false);
            $table->boolean('serv_porteria')->default(false);
            $table->boolean('internet')->default(false);
            $table->boolean('lavadero')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viviendas');
    }
};