<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filtro extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function viviendas()
    {
        return $this->belongsToMany(Vivienda::class,'vivienda_filtros','id_filtro');
    }
}
