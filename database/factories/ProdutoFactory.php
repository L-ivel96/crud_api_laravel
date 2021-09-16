<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\model\Produto;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Produto::class, function (Faker $faker) {
    return [
        'produto' => $faker->city,
        'produto' => $faker->text(300),
        'valor' => random_int(100, 10000) / 100,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];
});
