<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Mascota",
 *      required={""},
 *      @SWG\Property(
 *          property="cod_expediente",
 *          description="cod_expediente",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="nombre",
 *          description="nombre",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="fecha_nac",
 *          description="fecha_nac",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="Color",
 *          description="Color",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="cod_propietario",
 *          description="cod_propietario",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="cod_sexo",
 *          description="cod_sexo",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="cod_raza",
 *          description="cod_raza",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Mascota extends Model
{
    use SoftDeletes;

    public $table = 'mascotas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'cod_expediente';

    public $fillable = [
        'nombre',
        'fecha_nac',
        'Color',
        'cod_propietario',
        'cod_sexo',
        'cod_raza'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cod_expediente' => 'string',
        'nombre' => 'string',
        'fecha_nac' => 'date',
        'Color' => 'string',
        'cod_propietario' => 'integer',
        'cod_sexo' => 'boolean',
        'cod_raza' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cod_propietario' => 'required',
        'cod_sexo' => 'required',
        'cod_raza' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function propietario()
    {
        return $this->belongsTo(\App\Models\Propietario::class, 'cod_propietario');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function razas()
    {
        return $this->belongsTo(\App\Models\Raza::class, 'cod_raza');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function sexo()
    {
        return $this->belongsTo(\App\Models\Sexo::class, 'cod_sexo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function empleados()
    {
        return $this->belongsToMany(\App\Models\Empleado::class, 'consulta');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function controlVacunas()
    {
        return $this->hasMany(\App\Models\ControlVacuna::class, 'cod_expediente');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function empleado1s()
    {
        return $this->belongsToMany(\App\Models\Empleado::class, 'peluqueria');
    }
}
