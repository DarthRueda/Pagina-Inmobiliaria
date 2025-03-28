<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Notificacion extends Model
{
    use HasFactory;
    
    protected $table = 'notificaciones';
    protected $fillable = ['mensaje','id_vivienda'];

    // Relación con viviendas (N:1)
    public function vivienda()
    {
        return $this->belongsTo(Vivienda::class, 'id_vivienda');
    }

    // Relación con usuarios (N:M)
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'notificaciones_usuarios', 'id_notificacion', 'id_usuario')
                    ->withPivot('leida') // Para acceder al campo de la tabla intermedia
                    ->withTimestamps(); // Si en el futuro agregas timestamps en la tabla intermedia
    }
}
