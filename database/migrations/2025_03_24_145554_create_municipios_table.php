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
        Schema::create('municipios', function (Blueprint $table) {
            $table->smallIncrements('idMunicipio')->unsigned();
            $table->smallInteger('idProvincia')->notNullable();
            $table->integer('codMunicipio')->notNullable();
            $table->integer('DC')->notNullable();
            $table->string('Municipio', 100)->notNullable();
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->comment('Lista de Municipios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('municipios');
    }
};