<?php

namespace App\Repositories;

use App\Models\Mascota;
use App\Repositories\BaseRepository;

/**
 * Class MascotaRepository
 * @package App\Repositories
 * @version October 13, 2019, 2:09 am UTC
*/

class MascotaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'fecha_nac',
        'Color',
        'cod_propietario',
        'cod_sexo',
        'cod_raza'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Mascota::class;
    }
}
