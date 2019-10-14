<?php

namespace App\Repositories;

use App\Models\Propietario;
use App\Repositories\BaseRepository;

/**
 * Class PropietarioRepository
 * @package App\Repositories
 * @version October 13, 2019, 1:58 am UTC
*/

class PropietarioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombres',
        'apellidos',
        'direccion',
        'telefono',
        'correo'
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
        return Propietario::class;
    }
}
