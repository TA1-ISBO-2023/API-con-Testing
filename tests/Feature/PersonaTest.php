<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PersonaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    private $campos = [
        "id",
        "nombre",
        "apellido",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function test_ListarPersonas()
    {
        $response = $this
                    -> withHeaders(["Accept" => "application/json"])
                    -> get('/api/v1/persona');

        $response->assertStatus(200);
        $response->assertJsonStructure([
             "*" => $this -> campos
        ]);
    }

    public function test_BuscarPersonaExistente()
    {
        $response = $this
                    -> withHeaders(["Accept" => "application/json"]) 
                    -> get('/api/v1/persona/10');

        $response->assertStatus(200);
        $response->assertJsonStructure($this -> campos);
    }

    public function test_BuscarPersonaNoExistente()
    {
        $response = $this
                    -> withHeaders(["Accept" => "application/json"])
                    -> get('/api/v1/persona/1000');

        $response->assertStatus(404);
        $response->assertJsonFragment([
            "message" => "No query results for model [App\\Models\\Persona] 1000"
        ]);

    }

    public function test_CrearPersona()
    {
        $datosParaInsertar = [
            "nombre" => "Juan",
            "apellido" => "Perez"
        ];
        $campos = [
            "id",
            "nombre",
            "apellido",
            "created_at",
            "updated_at",
        ];

        $response = $this
                    -> withHeaders(["Accept" => "application/json"])
                    -> post('/api/v1/persona',$datosParaInsertar);

        $response->assertStatus(201);
        $response->assertJsonStructure($campos);
        $response->assertJsonFragment($datosParaInsertar);

        $this->assertDatabaseHas('personas', $datosParaInsertar); 

    }
    
    public function test_EliminarPersonaExistente()
    {
        $response = $this
                    -> withHeaders(["Accept" => "application/json"])
                    -> delete('/api/v1/persona/8');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            "message" => "Persona eliminada"
        ]);
        $this->assertDatabaseMissing("personas",[
            "id" => 8,
            "deleted_at" => null
        ]);
    }

    public function test_EliminarPersonaNoExistente()
    {
        $response = $this
                    -> withHeaders(["Accept" => "application/json"])
                    -> delete('/api/v1/persona/1000');

        $response->assertStatus(404);
        $response->assertJsonFragment([
            "message" => "No query results for model [App\\Models\\Persona] 1000"
        ]);
    }

    public function test_ModificarPersonaExistente(){
        $datosParaModificar = [
            "nombre" => "Jose",
            "apellido" => "Gomez"
        ];

        $response = $this
                    -> withHeaders(["Accept" => "application/json"])
                    -> put('/api/v1/persona/3',$datosParaModificar);

        $response->assertStatus(200);
        $response->assertJsonStructure($this->campos);
        $response->assertJsonFragment($datosParaModificar);




    }

    public function test_ModificarPersonaNoExistente(){
        $datosParaModificar = [
            "nombre" => "Jose",
            "apellido" => "Gomez"
        ];

        $response = $this
                    -> withHeaders(["Accept" => "application/json"])
                    -> put('/api/v1/persona/1000',$datosParaModificar);

        $response->assertStatus(404);
        $response->assertJsonFragment([
            "message" => "No query results for model [App\\Models\\Persona] 1000"
        ]);
    }
}
