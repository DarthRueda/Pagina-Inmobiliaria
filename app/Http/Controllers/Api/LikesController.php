<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Vivienda;

class LikesController extends Controller {
    public function getLikes($userId){
        $viviendas = Vivienda::whereHas('likes', function ($query) use ($userId) {
            $query->where('id_usuario', $userId);
        })->get();

        return response()->json(['likes' => $viviendas]);
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
