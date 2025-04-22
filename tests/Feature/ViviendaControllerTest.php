<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vivienda;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ViviendaControllerTest extends TestCase
{
    protected function authenticate()
    {
        $user = User::where('email', 'admin@demo.com')->first();
        if (!$user) {
            $user = User::factory()->create([
                'email' => 'admin@demo.com',
                'password' => Hash::make('12345678'),
            ]);
        }

        $this->actingAs($user, 'sanctum');
    }

    public function test_create_vivienda()
    {
        $this->authenticate();

        $user = User::where('email', 'user@demo.com')->first();
        if (!$user) {
            $user = User::factory()->create([
                'email' => 'user@demo.com',
                'password' => Hash::make('12345678'),
            ]);
        }

        $viviendaData = [
            'id_usuario' => $user->id,
            'precio' => 250000,
            'localizacion' => 'Madrid',
            'descripcion' => 'Vivienda de prueba',
            'habitaciones' => 3,
            'banyos' => 2,
            'dimensiones' => 120,
            'planta' => 2,
            'tipo' => 'Piso',
            'disponibilidad' => 'Comprar',
            'orientacion' => 'Sur',
            'agua_caliente' => 'Gas Natural',
            'calefaccion' => 'Central',
            'estado' => 'Nuevo',
            'antiguedad' => '5 años',
            'parking' => 'Sí',
            'ascensor' => 'Sí',
        ];

        $response = $this->postJson('/api/vivienda', $viviendaData);

        $response->assertStatus(201)
                 ->assertJsonFragment(['localizacion' => 'Madrid']);
    }

    public function test_list_viviendas()
    {
        $this->authenticate();

        $response = $this->getJson('/api/viviendas');

        $response->assertStatus(200);
    }

    public function test_update_vivienda_precio()
    {
        $this->authenticate();

        // Creamos primero una vivienda para asegurarnos de que exista
        $user = User::where('email', 'user@demo.com')->first();
        if (!$user) {
            $user = User::factory()->create([
                'email' => 'user@demo.com',
                'password' => Hash::make('12345678'),
            ]);
        }

        $viviendaData = [
            'id_usuario' => $user->id,
            'precio' => 250000,
            'localizacion' => 'Madrid',
            'descripcion' => 'Vivienda para actualizar',
            'habitaciones' => 3,
            'banyos' => 2,
            'dimensiones' => 120,
            'planta' => 2,
            'tipo' => 'Piso',
            'disponibilidad' => 'Comprar',
            'orientacion' => 'Sur',
            'agua_caliente' => 'Gas Natural',
            'calefaccion' => 'Central',
            'estado' => 'Nuevo',
            'antiguedad' => '5 años',
            'parking' => 'Si',
            'ascensor' => 'Si',
        ];

        $createResponse = $this->postJson('/api/vivienda', $viviendaData);
        $createResponse->assertStatus(201);
        
        $viviendaId = $createResponse->json('id');
        
        // Ahora actualizamos la vivienda recién creada
        $updateData = [
            'precio' => 300000,
            'id_usuario' => $user->id,
            'localizacion' => 'Madrid',
            'descripcion' => 'Vivienda para actualizar',
            'habitaciones' => 3,
            'banyos' => 2,
            'dimensiones' => 120,
            'planta' => 2,
            'tipo' => 'Piso',
            'disponibilidad' => 'Comprar',
            'orientacion' => 'Sur',
            'agua_caliente' => 'Gas Natural',
            'calefaccion' => 'Central',
            'estado' => 'Nuevo',
            'antiguedad' => '5 años',
            'parking' => 'Si',
            'ascensor' => 'Si',
        ];

        $response = $this->postJson("/api/vivienda/{$viviendaId}", $updateData);

        $response->assertStatus(200)
                 ->assertJsonFragment(['precio' => '300.000€']);
    }

    public function test_delete_vivienda()
    {
        $this->authenticate();

        $vivienda = Vivienda::where('descripcion', 'Vivienda de prueba')->first();

        $response = $this->deleteJson("/api/vivienda/{$vivienda->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Vivienda eliminada correctamente.']);
     
    }
}