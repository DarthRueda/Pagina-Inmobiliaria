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
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_vivienda')->notNullable();
            $table->text('mensaje')->notNullable();
            $table->timestamp('fecha')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
            $table->foreign('id_vivienda')->references('id')->on('viviendas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificaciones');
    }
};
