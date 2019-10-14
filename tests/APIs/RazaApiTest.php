<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Raza;

class RazaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_raza()
    {
        $raza = factory(Raza::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/razas', $raza
        );

        $this->assertApiResponse($raza);
    }

    /**
     * @test
     */
    public function test_read_raza()
    {
        $raza = factory(Raza::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/razas/'.$raza->cod_raza
        );

        $this->assertApiResponse($raza->toArray());
    }

    /**
     * @test
     */
    public function test_update_raza()
    {
        $raza = factory(Raza::class)->create();
        $editedRaza = factory(Raza::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/razas/'.$raza->cod_raza,
            $editedRaza
        );

        $this->assertApiResponse($editedRaza);
    }

    /**
     * @test
     */
    public function test_delete_raza()
    {
        $raza = factory(Raza::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/razas/'.$raza->cod_raza
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/razas/'.$raza->cod_raza
        );

        $this->response->assertStatus(404);
    }
}
