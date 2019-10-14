<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Propietario;

class PropietarioApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_propietario()
    {
        $propietario = factory(Propietario::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/propietarios', $propietario
        );

        $this->assertApiResponse($propietario);
    }

    /**
     * @test
     */
    public function test_read_propietario()
    {
        $propietario = factory(Propietario::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/propietarios/'.$propietario->cod_propietario
        );

        $this->assertApiResponse($propietario->toArray());
    }

    /**
     * @test
     */
    public function test_update_propietario()
    {
        $propietario = factory(Propietario::class)->create();
        $editedPropietario = factory(Propietario::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/propietarios/'.$propietario->cod_propietario,
            $editedPropietario
        );

        $this->assertApiResponse($editedPropietario);
    }

    /**
     * @test
     */
    public function test_delete_propietario()
    {
        $propietario = factory(Propietario::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/propietarios/'.$propietario->cod_propietario
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/propietarios/'.$propietario->cod_propietario
        );

        $this->response->assertStatus(404);
    }
}
