<?php

namespace App\Http\Controllers;

use App\Models\Vivienda;
use Illuminate\Http\Request;
use App\Models\Filtro;
use App\Http\Controllers\NotificacionController;

                        


class ViviendaController extends Controller
{
    public function show($id)
    {
        $vivienda = Vivienda::with('media', 'filtros')->findOrFail($id);
        $vivienda->media->each(function ($media) {
            $media->url = str_replace('http://localhost', config('app.url'), $media->getUrl());
        });
        $vivienda->image = $vivienda->getFirstMediaUrl('images') ?: '/images/placeholder.jpg';
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

        if ($request->has('filters')) {
            $filters = json_decode($request->filters, true);
            foreach ($filters as $filter) {
                $filtro = Filtro::firstOrCreate(['nombre' => $filter]);
                $vivienda->filtros()->attach($filtro->id);
            }
        }

        return response()->json($vivienda, 201);
    }

    public function index(Request $request)
    {
        $userId = $request->query('user_id');
        if ($userId) {
            $viviendas = Vivienda::with('filtros', 'media')->where('id_usuario', $userId)->get();
        } else {
            $viviendas = Vivienda::with('filtros', 'media')->get();
        }
        $viviendas->each(function ($vivienda) {
            $vivienda->image = $vivienda->getFirstMediaUrl('images') ?: '/images/placeholder.jpg';
        });

        return response()->json($viviendas);
    }

    public function filter(Request $request)
    {
        $filters = $request->query('filters', []);
        $viviendas = Vivienda::whereHas('filtros', function ($query) use ($filters) {
            $query->whereIn('nombre', $filters);
        })->with('filtros')->get();

        return response()->json($viviendas);
    }

    public function filterByCaracteristicas(Request $request)
    {
        $orderColumn = $request->query('order_column', 'created_at');
        if (!in_array($orderColumn, ['id', 'precio', 'habitaciones', 'banyos', 'tipo', 'created_at'])) {
            $orderColumn = 'created_at';
        }

        $orderDirection = $request->query('order_direction', 'desc');
        if (!in_array($orderDirection, ['asc', 'desc'])) {
            $orderDirection = 'desc';
        }

        $filters = $request->query('filters', []);
        $habitaciones = $request->query('habitaciones', []);
        $banyos = $request->query('banyos', []);
        $tipo = $request->query('tipo', []);
        $priceMin = $request->query('price_min');
        $priceMax = $request->query('price_max');
        $surface = $request->query('surface');

        $viviendas = Vivienda::query()
            ->when($filters, function ($query, $filters) {
                return $query->whereHas('filtros', function ($query) use ($filters) {
                    $query->whereIn('nombre', $filters);
                });
            })
            ->when($habitaciones, function ($query, $habitaciones) {
                return $query->where(function ($query) use ($habitaciones) {
                    foreach ($habitaciones as $habitacion) {
                        $query->orWhere('habitaciones', '>=', $habitacion);
                    }
                });
            })
            ->when($banyos, function ($query, $banyos) {
                return $query->where(function ($query) use ($banyos) {
                    foreach ($banyos as $bano) {
                        $query->orWhere('banyos', '>=', $bano);
                    }
                });
            })
            ->when($tipo, function ($query, $tipo) {
                return $query->whereIn('tipo', $tipo);
            })
            ->when($priceMin, function ($query, $priceMin) {
                return $query->where('precio', '>=', $priceMin);
            })
            ->when($priceMax, function ($query, $priceMax) {
                return $query->where('precio', '<=', $priceMax);
            })
            ->when($surface, function ($query, $surface) {
                return $query->where('dimensiones', '>=', $surface);
            })
            ->orderBy($orderColumn, $orderDirection)
            ->with('filtros', 'media')
            ->get();

        // Asegurarse de que la URL de la imagen sea correcta
        $viviendas->each(function ($vivienda) {
            $vivienda->image = $vivienda->getFirstMediaUrl('images') ?: '/images/placeholder.jpg';
        });

        return response()->json($viviendas);
    }

    public function update(Request $request, $id)
    {
        $vivienda = Vivienda::findOrFail($id);

        $oldPrecio = $vivienda->precio;

        $vivienda->update($request->all());

        $notificacionController = new NotificacionController();
        $notificacionController->sendNotification($vivienda, $oldPrecio);


        if ($request->hasFile('images')) {
            $vivienda->clearMediaCollection('images');
            foreach ($request->file('images') as $image) {
                $vivienda->addMedia($image)->toMediaCollection('images');
            }
        }

        if ($request->has('filters')) {
            $filters = json_decode($request->filters, true);
            $vivienda->filtros()->detach();
            foreach ($filters as $filter) {
                $filtro = Filtro::firstOrCreate(['nombre' => $filter]);
                $vivienda->filtros()->attach($filtro->id);
            }
        }

        return response()->json($vivienda);
    }

    public function getByUserId($userId)
    {
        $viviendas = Vivienda::with('media', 'filtros')
            ->where('id_usuario', $userId)
            ->get();

        // Asegurarse de que la URL de la imagen sea correcta
        $viviendas->each(function ($vivienda) {
            $vivienda->image = $vivienda->getFirstMediaUrl('images') ?: '/images/placeholder.jpg';
        });

        return response()->json($viviendas);
    }
}