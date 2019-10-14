<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Propietario;
use Faker\Generator as Faker;

$factory->define(Propietario::class, function (Faker $faker) {

    return [
        'nombres' => $faker->word,
        'apellidos' => $faker->word,
        'direccion' => $faker->word,
        'telefono' => $faker->word,
        'correo' => $faker->word
    ];
});
