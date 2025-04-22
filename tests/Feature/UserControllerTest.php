<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserControllerTest extends TestCase
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

    public function test_create_user()
    {
        $this->authenticate();

        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'telefono' => '123456789',
            'nombre_comercial' => 'Comercial Test',
            'direccion' => 'Calle Falsa 123',
            'codigo_postal' => '08001',
            'localidad' => 'Barcelona',
            'tipo' => 1,
            'fondo' => 'fondo.jpg',
            'logo' => 'logo.jpg',
            'descripcion' => 'Descripción de prueba',
        ];

        $response = $this->postJson('/api/users', $userData);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Test User']);
    }

    public function test_list_users()
    {
        $this->authenticate();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200);
    }

    public function test_update_user()
    {
        $this->authenticate();

        // Creamos un usuario para actualizarlo
        $userData = [
            'name' => 'Usuario para actualizar',
            'email' => 'update@example.com',
            'password' => 'password',
            'telefono' => '123456789',
            'nombre_comercial' => 'Comercial Test',
            'direccion' => 'Calle Falsa 123',
            'codigo_postal' => '08001',
            'localidad' => 'Barcelona',
            'tipo' => 1,
        ];

        $createResponse = $this->postJson('/api/users', $userData);
        $createResponse->assertStatus(201);
        
        $userId = $createResponse->json('id');
        
        // Actualizamos el usuario
        $updateData = [
           'name' => 'ACTUALIZADO',
            'email' => 'update@example.com',
            'password' => 'password',
            'telefono' => '123456789',
            'nombre_comercial' => 'Comercial Test',
            'direccion' => 'Calle Falsa 123',
            'codigo_postal' => '08001',
            'localidad' => 'Barcelona',
            'tipo' => 1,
        ];

        $response = $this->postJson("/api/users/{$userId}", $updateData);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'ACTUALIZADO']);
    }

    public function test_delete_user()
    {
        $this->authenticate();

        // Creamos un usuario para eliminarlo
        $userData = [
            'name' => 'Usuario para eliminar',
            'email' => 'delete@example.com',
            'password' => 'password',
            'telefono' => '123456789',
        ];

        $createResponse = $this->postJson('/api/users', $userData);
        $createResponse->assertStatus(201);
        
        // Obtenemos el usuario y extraemos su ID correctamente
        $user = User::where('name', 'Usuario para eliminar')->first();
        $this->assertNotNull($user, 'No se pudo encontrar el usuario creado');
        $userId = $user->id;

        // Eliminamos el usuario
        $response = $this->deleteJson("/api/users/{$userId}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Usuario eliminado correctamente.']);
    }
}
