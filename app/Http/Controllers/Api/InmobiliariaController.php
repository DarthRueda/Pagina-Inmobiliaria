<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class InmobiliariaController extends Controller
{
    public function show($id)
    {
        // Fetch the inmobiliaria user with tipo = 1
        $inmobiliaria = User::where('id', $id)->where('tipo', 1)->firstOrFail();

        // Optionally, include related data (e.g., viviendas)
        $viviendas = $inmobiliaria->viviendas()->with('filtros', 'media')->get();

        return response()->json([
            'inmobiliaria' => $inmobiliaria,
            'viviendas' => $viviendas,
        ]);
    }
}