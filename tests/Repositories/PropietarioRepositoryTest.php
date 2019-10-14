<?php namespace Tests\Repositories;

use App\Models\Propietario;
use App\Repositories\PropietarioRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PropietarioRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PropietarioRepository
     */
    protected $propietarioRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->propietarioRepo = \App::make(PropietarioRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_propietario()
    {
        $propietario = factory(Propietario::class)->make()->toArray();

        $createdPropietario = $this->propietarioRepo->create($propietario);

        $createdPropietario = $createdPropietario->toArray();
        $this->assertArrayHasKey('id', $createdPropietario);
        $this->assertNotNull($createdPropietario['id'], 'Created Propietario must have id specified');
        $this->assertNotNull(Propietario::find($createdPropietario['id']), 'Propietario with given id must be in DB');
        $this->assertModelData($propietario, $createdPropietario);
    }

    /**
     * @test read
     */
    public function test_read_propietario()
    {
        $propietario = factory(Propietario::class)->create();

        $dbPropietario = $this->propietarioRepo->find($propietario->cod_propietario);

        $dbPropietario = $dbPropietario->toArray();
        $this->assertModelData($propietario->toArray(), $dbPropietario);
    }

    /**
     * @test update
     */
    public function test_update_propietario()
    {
        $propietario = factory(Propietario::class)->create();
        $fakePropietario = factory(Propietario::class)->make()->toArray();

        $updatedPropietario = $this->propietarioRepo->update($fakePropietario, $propietario->cod_propietario);

        $this->assertModelData($fakePropietario, $updatedPropietario->toArray());
        $dbPropietario = $this->propietarioRepo->find($propietario->cod_propietario);
        $this->assertModelData($fakePropietario, $dbPropietario->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_propietario()
    {
        $propietario = factory(Propietario::class)->create();

        $resp = $this->propietarioRepo->delete($propietario->cod_propietario);

        $this->assertTrue($resp);
        $this->assertNull(Propietario::find($propietario->cod_propietario), 'Propietario should not exist in DB');
    }
}
