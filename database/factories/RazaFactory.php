<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Raza;
use Faker\Generator as Faker;

$factory->define(Raza::class, function (Faker $faker) {

    return [
        'raza' => $faker->word,
        'cod_especie' => $faker->randomDigitNotNull
    ];
});
