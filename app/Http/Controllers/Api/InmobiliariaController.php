<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class InmobiliariaController extends Controller
{
    public function show($id)
    {
        $inmobiliaria = User::where('id', $id)->where('tipo', 1)->firstOrFail();

        return response()->json([
            'inmobiliaria' => [
                'id' => $inmobiliaria->id,
                'name' => $inmobiliaria->name,
                'email' => $inmobiliaria->email,
                'telefono' => $inmobiliaria->telefono,
                'fondo' => $inmobiliaria->getFirstMediaUrl('fondo') ?: '/images/placeholder-fondo.jpg',
                'logo' => $inmobiliaria->getFirstMediaUrl('logo') ?: '/images/placeholder-logo.jpg',
                'descripcion' => $inmobiliaria->descripcion,
                'nombre_comercial' => $inmobiliaria->nombre_comercial,
                'localidad' => $inmobiliaria->localidad,
                'direccion' => $inmobiliaria->direccion,
            ],
        ]);
    }
}