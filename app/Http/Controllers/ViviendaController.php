<?php

namespace App\Http\Controllers;

use App\Models\Vivienda;
use Illuminate\Http\Request;

class ViviendaController extends Controller
{
    public function show($id)
    {
        $vivienda = Vivienda::with('media','filtros')->findOrFail($id);
        $vivienda->media->each(function ($media) {
            $media->url = $media->getUrl();
        });
        return response()->json($vivienda);
    }

    public function store(Request $request)
    {
        $vivienda = Vivienda::create($request->all());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $vivienda->addMedia($image)->toMediaCollection('images');
            }
        }

        return response()->json($vivienda, 201);
    }
    public function index(Request $request)
    {
        $userId = $request->query('user_id');
        if ($userId) {
            $viviendas = Vivienda::with('filtros')->where('id_usuario', $userId)->get();
        } else {
            $viviendas = Vivienda::with('filtros')->get();
        }
        return response()->json($viviendas);
    }
}