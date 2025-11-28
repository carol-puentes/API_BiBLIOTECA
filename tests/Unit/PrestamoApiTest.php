<?php

namespace Tests\Unit;

use Tests\TestCase;

class PrestamoApiTest extends TestCase
{
    
    //Un invitado no puede tener más de un préstamo activo
     
    // public function test_invitado_no_puede_tener_mas_de_un_prestamo()
    // {
    //     // Validacion del primer prestamo 
    //     $response1 = $this->postJson('/api/prestamo', [
    //         'isbn' => '12345',
    //         'identificacionUsuario' => '2000000000',
    //         'tipoUsuario' => 3, 
    //     ]);

    //     $response1->assertStatus(200);
    //     $response1->assertJsonStructure(['id', 'fechaMaximaDevolucion']);



    //     //  Validacion del segundo prestamo 
    //     $response2 = $this->postJson('/api/prestamo', [
    //         'isbn' => '67890',
    //         'identificacionUsuario' => '1000000000',
    //         'tipoUsuario' => 3,
    //     ]);

    //     $response2->assertStatus(400);
    //     $response2->assertJson([
    //         'error' => 'El usuario ya tiene un libro prestado',
    //     ]);
    // }


    //  Validacion de los campos guardados en el prestamo
    // public function test_campos_invalidos_retorna_error_400()
    // {
    //     $response = $this->postJson('/api/prestamo', [
    //         'isbn' => '', // inválido
    //         'identificacionUsuario' => '123456789012', // más de 10 caracteres
    //         'tipoUsuario' => 5, // valor no permitido
    //     ]);

    //     // Ahora esperamos 400 en vez de 422
    //     $response->assertStatus(400);

    //     // Verificamos que los campos tengan errores de validación
    //     $response->assertJsonStructure([
    //         'error' => [
    //             'isbn',
    //             'identificacionUsuario',
    //             'tipoUsuario',
    //         ]
    //     ]);
    // }

     //  Validacion de creacion de un prestamo valido
    // public function test_crear_prestamo_valido_retorna_json_correcto()
    // {
    //     $response = $this->postJson('/api/prestamo', [
    //         'isbn' => '123456',
    //         'identificacionUsuario' => '1000000001',
    //         'tipoUsuario' => 1, 
    //     ]);

    //     $response->assertStatus(200);
    //     $response->assertJsonStructure([
    //         'id',
    //         'fechaMaximaDevolucion',
    //     ]);

    // }

    public function test_mostrar_prestamo_existente_e_inexistente()
{
    // Crear un préstamo válido primero
    $responseCreate = $this->postJson('/api/prestamo', [
        'isbn' => '123456',
        'identificacionUsuario' => '1000000002',
        'tipoUsuario' => 1,
    ]);

    $id = $responseCreate->json('id');

    // Préstamo existente → debe devolver 200 y JSON completo
    $responseExistente = $this->getJson("/api/prestamo/{$id}");
    $responseExistente->assertStatus(200);
    $responseExistente->assertJsonStructure([
        'id',
        'isbn',
        'identificacionUsuario',
        'tipoUsuario',
        'fechaMaximaDevolucion',
    ]);

    // Préstamo inexistente → debe devolver 404
    $responseInexistente = $this->getJson("/api/prestamo/non-existent-id");
    $responseInexistente->assertStatus(404);
    $responseInexistente->assertJson([
        'error' => 'El préstamo no existe'
    ]);
}



}
