<?php

namespace App\Http\Controllers;

use App\Models\Inmobiliaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InmobiliariaController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:inmobiliarias',
            'password' => 'required|string|min:8|confirmed',
            'telefono' => 'required|string|max:20',
            'nombre_comercial' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:10',
            'localidad' => 'required|string|max:255',
        ]);

        $inmobiliaria = Inmobiliaria::create([
            'nombre' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'nombre_comercial' => $request->nombre_comercial,
            'direccion' => $request->direccion,
            'codigo_postal' => $request->codigo_postal,
            'localidad' => $request->localidad,
        ]);

        return response()->json(['message' => 'Registration successful'], 201);
    }

    public function registerEmpresa(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:inmobiliarias',
            'password' => 'required|string|min:8|confirmed',
            'telefono' => 'required|string|max:20',
            'nombre_comercial' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:10',
            'localidad' => 'required|string|max:255',
        ]);

        try {
            $inmobiliaria = Inmobiliaria::create([
                'nombre' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telefono' => $request->telefono,
                'nombre_comercial' => $request->nombre_comercial,
                'direccion' => $request->direccion,
                'codigo_postal' => $request->codigo_postal,
                'localidad' => $request->localidad,
            ]);

            return response()->json(['message' => 'Empresa registration successful'], 201);
        } catch (\Exception $e) {
            \Log::error('Error registering empresa: ' . $e->getMessage());
            return response()->json(['message' => 'Error registering empresa', 'error' => $e->getMessage()], 500);
        }
    }
}