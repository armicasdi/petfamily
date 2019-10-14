<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Sexo",
 *      required={""},
 *      @SWG\Property(
 *          property="cod_sexo",
 *          description="cod_sexo",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="sexo",
 *          description="sexo",
 *          type="string"
 *      )
 * )
 */
class Sexo extends Model
{
    use SoftDeletes;

    public $table = 'sexo';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'cod_sexo';

    public $fillable = [
        'sexo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cod_sexo' => 'boolean',
        'sexo' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function mascotas()
    {
        return $this->hasMany(\App\Models\Mascota::class, 'cod_sexo');
    }
}
