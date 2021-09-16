<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\model\Cliente;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'cpf_cnpj' => random_int(10000000000000, 99999999999999),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
    ];

});
