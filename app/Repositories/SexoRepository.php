<?php

namespace App\Repositories;

use App\Models\Sexo;
use App\Repositories\BaseRepository;

/**
 * Class SexoRepository
 * @package App\Repositories
 * @version October 13, 2019, 5:33 am UTC
*/

class SexoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'sexo'
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
        return Sexo::class;
    }
}
