<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;
use App\Models\Like;

class NotificacionController extends Controller
{
    public function sendNotification($vivienda, $oldPrecio) {
        
        if ($vivienda->precio != $oldPrecio) {
            $notificacion = Notificacion::create([
            'id_vivienda' => $vivienda->id, 
            'mensaje' => 'El precio de ' . $vivienda->tipo . ' en ' . $vivienda->localizacion . ' ha cambiado de ' . $oldPrecio . ' a ' . $vivienda->precio
            ]);
        } else {
            $notificacion = Notificacion::create([
            'id_vivienda' => $vivienda->id, 
            'mensaje' => 'Tu vivienda favorita ' . $vivienda->tipo . ' en ' . $vivienda->localizacion .' ha sido actualizada.'
            ]);
        }

        $usuariosFavoritos = Like::where('id_vivienda', $vivienda->id)->pluck('id_usuario');

        // Relacionar a los usuarios favoritos con la notificación
        foreach ($usuariosFavoritos as $usuarioId) {
            $notificacion->usuarios()->attach($usuarioId, ['leida' => false]); // Agregar la relación en la tabla intermedia
        }

        return response()->json($notificacion, 201);
    }

    public function getUserNotifications($userId) {
        $notificaciones = Notificacion::whereHas('usuarios', function ($query) use ($userId) {
                $query->where('id_usuario', $userId);
            })
            ->with(['usuarios' => function ($query) use ($userId) {
                $query->where('id_usuario', $userId)->select('id_usuario', 'id_notificacion', 'leida');
            }])
            ->get();
    
        // Agregar el estado 'leida' a cada notificación
        $notificaciones->each(function ($notificacion) {
            $notificacion->leida = $notificacion->usuarios->first()->pivot->leida ?? false;
            unset($notificacion->usuarios); // No necesitamos enviar toda la relación
        });
    
        return response()->json($notificaciones);
    }

    public function markAsRead($notificacionId, $userId) {
        $notificacion = Notificacion::where('id', $notificacionId)
            ->whereHas('usuarios', function ($query) use ($userId) {
                $query->where('id_usuario', $userId);
            })
            ->first();
    
        if ($notificacion) {
            $notificacion->usuarios()->updateExistingPivot($userId, ['leida' => true]);
            return response()->json(['message' => 'Notificación marcada como leída.'], 200);
        } else {
            return response()->json(['message' => 'Notificación no encontrada.'], 404);
        }
    }
    
    public function getUnreadNotificationsCount($userId){
        $count = Notificacion::whereHas('usuarios', function ($query) use ($userId) {
            $query->where('id_usuario', $userId)->where('leida', false);
        })->count();
    
        return response()->json(['unread_count' => $count]);
    }

  
    

}