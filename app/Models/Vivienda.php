<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Vivienda extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'viviendas';

    protected $fillable = [
        'id_usuario', 'id_inmobiliaria', 'precio', 'localizacion', 'descripcion', 
        'habitaciones', 'banyos', 'dimensiones', 'planta', 'tipo', 'orientacion', 
        'agua_caliente', 'calefaccion', 'estado', 'antiguedad', 'parking', 'ascensor',
        'aire_acondicionado', 'terraza', 'trastero', 'electrodomesticos', 'balcon', 
        'puerta_blindada', 'jardin', 'patio', 'piscina', 'suite_con_bano', 
        'serv_porteria', 'internet', 'lavadero'
    ];

    public function getPrecioAttribute($value)
    {
        return number_format($value, 0, '', '.') . '€';
    }

    public function filtros()
    {
        return $this->belongsToMany(Filtro::class,'vivienda_filtros','id_vivienda','id_filtro');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->useFallbackUrl('/images/placeholder.jpg')
            ->useFallbackPath(public_path('/images/placeholder.jpg'));
    }
}