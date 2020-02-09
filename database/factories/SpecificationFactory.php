<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Specification;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Specification::class, function (Faker $faker) {
    return [
        'specification_type' => $faker->word,
        'specification_description' => $faker->sentence(),
        'product_id' => factory(Product::class)->create()->id
    ];
});
