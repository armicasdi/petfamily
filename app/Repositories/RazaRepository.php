<?php

namespace App\Repositories;

use App\Models\Raza;
use App\Repositories\BaseRepository;

/**
 * Class RazaRepository
 * @package App\Repositories
 * @version October 13, 2019, 5:30 am UTC
*/

class RazaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'raza',
        'cod_especie'
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
        return Raza::class;
    }
}
