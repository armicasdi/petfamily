<?php namespace Tests\Repositories;

use App\Models\Sexo;
use App\Repositories\SexoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SexoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SexoRepository
     */
    protected $sexoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->sexoRepo = \App::make(SexoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_sexo()
    {
        $sexo = factory(Sexo::class)->make()->toArray();

        $createdSexo = $this->sexoRepo->create($sexo);

        $createdSexo = $createdSexo->toArray();
        $this->assertArrayHasKey('id', $createdSexo);
        $this->assertNotNull($createdSexo['id'], 'Created Sexo must have id specified');
        $this->assertNotNull(Sexo::find($createdSexo['id']), 'Sexo with given id must be in DB');
        $this->assertModelData($sexo, $createdSexo);
    }

    /**
     * @test read
     */
    public function test_read_sexo()
    {
        $sexo = factory(Sexo::class)->create();

        $dbSexo = $this->sexoRepo->find($sexo->cod_sexo);

        $dbSexo = $dbSexo->toArray();
        $this->assertModelData($sexo->toArray(), $dbSexo);
    }

    /**
     * @test update
     */
    public function test_update_sexo()
    {
        $sexo = factory(Sexo::class)->create();
        $fakeSexo = factory(Sexo::class)->make()->toArray();

        $updatedSexo = $this->sexoRepo->update($fakeSexo, $sexo->cod_sexo);

        $this->assertModelData($fakeSexo, $updatedSexo->toArray());
        $dbSexo = $this->sexoRepo->find($sexo->cod_sexo);
        $this->assertModelData($fakeSexo, $dbSexo->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_sexo()
    {
        $sexo = factory(Sexo::class)->create();

        $resp = $this->sexoRepo->delete($sexo->cod_sexo);

        $this->assertTrue($resp);
        $this->assertNull(Sexo::find($sexo->cod_sexo), 'Sexo should not exist in DB');
    }
}
