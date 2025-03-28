<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;
use App\Models\Like;

class NotificacionController extends Controller
{
    public function sendNotification($vivienda, $oldPrecio) {
        
        
        $notificacion = Notificacion::create([
            'id_vivienda' => $vivienda->id, 
            'mensaje' => 'El precio de ' . $vivienda->tipo . ' en ' .$vivienda->localizacion . ' ha cambiado de ' . $oldPrecio . ' a ' . $vivienda->precio 
        ]);

        $usuariosFavoritos = Like::where('id_vivienda', $vivienda->id)->pluck('id_usuario');

        // Relacionar a los usuarios favoritos con la notificación
        foreach ($usuariosFavoritos as $usuarioId) {
            $notificacion->usuarios()->attach($usuarioId, ['leida' => false]); // Agregar la relación en la tabla intermedia
        }

        return response()->json($notificacion, 201);
    }

    public function getUserNotifications($userId) {
        // Obtener las notificaciones que tiene el usuario
        $notificaciones = Notificacion::whereHas('usuarios', function ($query) use ($userId) {
            $query->where('id_usuario', $userId); // Filtrar por el usuario
        })
        ->get(); 

        // Devolver las notificaciones al frontend
        return response()->json($notificaciones);
    }

}