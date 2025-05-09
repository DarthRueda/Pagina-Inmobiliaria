<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['id_usuario', 'id_vivienda'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function vivienda()
    {
        return $this->belongsTo(Vivienda::class, 'id_vivienda');
    }

}
