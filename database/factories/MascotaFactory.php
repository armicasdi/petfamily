<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Mascota;
use Faker\Generator as Faker;

$factory->define(Mascota::class, function (Faker $faker) {

    return [
        'nombre' => $faker->word,
        'fecha_nac' => $faker->word,
        'Color' => $faker->word,
        'cod_propietario' => $faker->randomDigitNotNull,
        'cod_sexo' => $faker->word,
        'cod_raza' => $faker->randomDigitNotNull
    ];
});
