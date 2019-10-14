<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Raza",
 *      required={""},
 *      @SWG\Property(
 *          property="cod_raza",
 *          description="cod_raza",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="raza",
 *          description="raza",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="cod_especie",
 *          description="cod_especie",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Raza extends Model
{
    use SoftDeletes;

    public $table = 'razas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'cod_raza';

    public $fillable = [
        'raza',
        'cod_especie'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cod_raza' => 'integer',
        'raza' => 'string',
        'cod_especie' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'cod_especie' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function codEspecie()
    {
        return $this->belongsTo(\App\Models\Especy::class, 'cod_especie');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function mascotas()
    {
        return $this->hasMany(\App\Models\Mascota::class, 'cod_raza');
    }
}
