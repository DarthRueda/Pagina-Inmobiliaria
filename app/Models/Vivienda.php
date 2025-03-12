<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vivienda extends Model
{
    use HasFactory;

    protected $table = 'viviendas';

    protected $fillable = [
        'id_usuario', 'id_inmobiliaria', 'precio', 'localizacion', 'descripcion', 
        'habitaciones', 'banyos', 'dimensiones', 'planta', 'tipo', 'orientacion', 
        'agua_caliente', 'calefaccion', 'estado', 'antiguedad', 'parking', 'ascensor'
    ];
}

