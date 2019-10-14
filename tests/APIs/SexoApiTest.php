<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Sexo;

class SexoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_sexo()
    {
        $sexo = factory(Sexo::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sexos', $sexo
        );

        $this->assertApiResponse($sexo);
    }

    /**
     * @test
     */
    public function test_read_sexo()
    {
        $sexo = factory(Sexo::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/sexos/'.$sexo->cod_sexo
        );

        $this->assertApiResponse($sexo->toArray());
    }

    /**
     * @test
     */
    public function test_update_sexo()
    {
        $sexo = factory(Sexo::class)->create();
        $editedSexo = factory(Sexo::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sexos/'.$sexo->cod_sexo,
            $editedSexo
        );

        $this->assertApiResponse($editedSexo);
    }

    /**
     * @test
     */
    public function test_delete_sexo()
    {
        $sexo = factory(Sexo::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sexos/'.$sexo->cod_sexo
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sexos/'.$sexo->cod_sexo
        );

        $this->response->assertStatus(404);
    }
}
