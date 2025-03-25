<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiltrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filtros = [
            'Aire acondicionado',
            'Terraza',
            'Trastero',
            'Electrodomésticos',
            'Balcón',
            'Puerta Blindada',
            'Calefacción',
            'Jardín',
            'Patio',
            'Piscina',
            'Suite - con baño',
            'Serv. portería',
            'Internet',
            'Lavadero'
        ];

        foreach ($filtros as $filtro) {
            DB::table('filtros')->insert(['nombre' => $filtro]);
        }
    }
}