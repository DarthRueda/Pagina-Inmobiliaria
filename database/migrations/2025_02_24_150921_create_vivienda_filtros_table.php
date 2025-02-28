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
        Schema::create('vivienda_filtros', function (Blueprint $table) {
            $table->unsignedBigInteger('id_vivienda');
            $table->unsignedBigInteger('id_filtro');
            $table->primary(['id_vivienda', 'id_filtro']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vivienda_filtros');
    }
};
