<?php

namespace App\Http\Controllers;

use App\Models\Vivienda;
use Illuminate\Http\Request;

class ViviendaController extends Controller
{
    public function show($id)
    {
        $vivienda = Vivienda::findOrFail($id);
        return response()->json($vivienda);
    }
}