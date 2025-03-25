<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    protected $table = 'municipios';

    protected $primaryKey = 'idMunicipio';

    public $timestamps = false;

    protected $fillable = [
        'idProvincia',
        'codMunicipio',
        'DC',
        'Municipio',
    ];
}