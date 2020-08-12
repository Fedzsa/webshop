<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'price' => $faker->randomNumber(),
        'amount' => $faker->randomNumber(),
        'description' => $faker->realText(),
        'category_id' => factory(Category::class)
    ];
});
