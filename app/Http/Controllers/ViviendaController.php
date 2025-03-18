<?php

namespace App\Http\Controllers;

use App\Models\Vivienda;
use Illuminate\Http\Request;

class ViviendaController extends Controller
{
    public function show($id)
    {
        $vivienda = Vivienda::with('media')->findOrFail($id);
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
            $viviendas = Vivienda::where('id_usuario', $userId)->get();
        } else {
            $viviendas = Vivienda::all();
        }
        return response()->json($viviendas);
    }

    public function filter(Request $request)
    {
        $query = Vivienda::query();
    
        if ($request->has('location')) {
            $query->where('localizacion', 'like', '%' . $request->input('location') . '%');
        }
    
        if ($request->has('priceMin')) {
            $query->where('precio', '>=', $request->input('priceMin'));
        }
    
        if ($request->has('priceMax')) {
            $query->where('precio', '<=', $request->input('priceMax'));
        }
    
        if ($request->has('surface')) {
            $query->where('dimensiones', '>=', $request->input('surface'));
        }
    
        if ($request->has('tipo')) {
            $tipo = $request->input('tipo');
            $query->where(function ($q) use ($tipo) {
                if ($tipo['piso']) {
                    $q->orWhere('tipo', 'piso');
                }
                if ($tipo['casa']) {
                    $q->orWhere('tipo', 'casa');
                }
            });
        }
    
        if ($request->has('habitaciones')) {
            $habitaciones = array_keys(array_filter($request->input('habitaciones')));
            if (!empty($habitaciones)) {
                $query->whereIn('habitaciones', $habitaciones);
            }
        }
    
        if ($request->has('banos')) {
            $banos = array_keys(array_filter($request->input('banos')));
            if (!empty($banos)) {
                $query->whereIn('banyos', $banos);
            }
        }
    
        if ($request->has('caracteristicas')) {
            foreach ($request->input('caracteristicas') as $key => $value) {
                if ($value) {
                    $query->where($key, true);
                }
            }
        }
    
        $viviendas = $query->get();
    
        return response()->json($viviendas);
    }
}