<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Specification;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Specification::class, function (Faker $faker) {
    return [
        'name' => $faker->unique(true)->word,
    ];
});
