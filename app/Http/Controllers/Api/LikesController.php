<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;

class LikesController extends Controller {
    public function getLikes($userId){
        $likes = Like::where('id_usuario', $userId)->pluck('id_vivienda');

        return response()->json(['likes' => $likes]);
    }


    public function checkLike($userId, $viviendaId){
        $exists = Like::where('id_usuario', $userId)
                      ->where('id_vivienda', $viviendaId)
                      ->exists();

        return response()->json(['liked' => $exists]);
    }

    public function toggleLike(Request $request){
        $userId = $request->input('userId');
        $viviendaId = $request->input('viviendaId');

        $like = Like::where('id_usuario', $userId)
                    ->where('id_vivienda', $viviendaId)
                    ->first();

        if ($like) {
            $like->delete();
            return response()->json(['liked' => false]);
        } else {
            Like::create([
                'id_usuario' => $userId,
                'id_vivienda' => $viviendaId
            ]);
            return response()->json(['liked' => true]);
        }
    }
}

