<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->notNullable();
            $table->string('email')->unique()->notNullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->notNullable();
            $table->string('telefono', 20)->nullable();
            $table->string('nombre_comercial', 255)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('codigo_postal', 10)->nullable();
            $table->string('localidad', 255)->nullable();
            $table->integer('tipo')->nullable()->default(0);
            $table->string('fondo', 255)->nullable();
            $table->string('logo', 255)->nullable();
            $table->text('descripcion')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
