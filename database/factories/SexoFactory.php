<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Sexo;
use Faker\Generator as Faker;

$factory->define(Sexo::class, function (Faker $faker) {

    return [
        'sexo' => $faker->word
    ];
});
