<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MunicipiosTableSeeder extends Seeder
{
    public function run(): void
    {
        // Ruta al archivo SQL
        $sqlFilePath = database_path('municipios.sql');

        // Verificar si el archivo existe
        if (File::exists($sqlFilePath)) {
            // Leer el contenido del archivo SQL
            $sql = File::get($sqlFilePath);

            // Ejecutar las consultas del archivo SQL
            DB::unprepared($sql);
            $this->command->info('Archivo SQL importado correctamente.');
        } else {
            $this->command->error('El archivo SQL no existe.');
        }
    }
}