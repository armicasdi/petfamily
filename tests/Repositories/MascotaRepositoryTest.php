<?php namespace Tests\Repositories;

use App\Models\Mascota;
use App\Repositories\MascotaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MascotaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MascotaRepository
     */
    protected $mascotaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->mascotaRepo = \App::make(MascotaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_mascota()
    {
        $mascota = factory(Mascota::class)->make()->toArray();

        $createdMascota = $this->mascotaRepo->create($mascota);

        $createdMascota = $createdMascota->toArray();
        $this->assertArrayHasKey('id', $createdMascota);
        $this->assertNotNull($createdMascota['id'], 'Created Mascota must have id specified');
        $this->assertNotNull(Mascota::find($createdMascota['id']), 'Mascota with given id must be in DB');
        $this->assertModelData($mascota, $createdMascota);
    }

    /**
     * @test read
     */
    public function test_read_mascota()
    {
        $mascota = factory(Mascota::class)->create();

        $dbMascota = $this->mascotaRepo->find($mascota->cod_expediente);

        $dbMascota = $dbMascota->toArray();
        $this->assertModelData($mascota->toArray(), $dbMascota);
    }

    /**
     * @test update
     */
    public function test_update_mascota()
    {
        $mascota = factory(Mascota::class)->create();
        $fakeMascota = factory(Mascota::class)->make()->toArray();

        $updatedMascota = $this->mascotaRepo->update($fakeMascota, $mascota->cod_expediente);

        $this->assertModelData($fakeMascota, $updatedMascota->toArray());
        $dbMascota = $this->mascotaRepo->find($mascota->cod_expediente);
        $this->assertModelData($fakeMascota, $dbMascota->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_mascota()
    {
        $mascota = factory(Mascota::class)->create();

        $resp = $this->mascotaRepo->delete($mascota->cod_expediente);

        $this->assertTrue($resp);
        $this->assertNull(Mascota::find($mascota->cod_expediente), 'Mascota should not exist in DB');
    }
}
