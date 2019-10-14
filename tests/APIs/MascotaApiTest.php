<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Mascota;

class MascotaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_mascota()
    {
        $mascota = factory(Mascota::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/mascotas', $mascota
        );

        $this->assertApiResponse($mascota);
    }

    /**
     * @test
     */
    public function test_read_mascota()
    {
        $mascota = factory(Mascota::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/mascotas/'.$mascota->cod_expediente
        );

        $this->assertApiResponse($mascota->toArray());
    }

    /**
     * @test
     */
    public function test_update_mascota()
    {
        $mascota = factory(Mascota::class)->create();
        $editedMascota = factory(Mascota::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/mascotas/'.$mascota->cod_expediente,
            $editedMascota
        );

        $this->assertApiResponse($editedMascota);
    }

    /**
     * @test
     */
    public function test_delete_mascota()
    {
        $mascota = factory(Mascota::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/mascotas/'.$mascota->cod_expediente
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/mascotas/'.$mascota->cod_expediente
        );

        $this->response->assertStatus(404);
    }
}
