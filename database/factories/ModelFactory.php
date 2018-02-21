<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

// $factory->define(App\User::class, function (Faker $faker) {
//     return [
//         'name'           => $faker->name,
//         'email'          => $faker->unique()->safeEmail,
//         'password'       => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
//         'remember_token' => str_random(10),
//     ];
// });

$factory->define(App\Product::class, function (Faker $faker) {
    $tags = collect(['home', 'fruits', 'meat', 'breakfast', 'clean', 'fish', 'frozen'])->random(2);
    $img = collect(['cheese-2389218_640.png', 'fried-chicken-2389214_640.png', 'mushroom-2389225_640.png', 'noodle-2389221_640.png', 'pizza-2389233_640.png'])->random();
    return [
        'name'     => $faker->text(10),
        'price'    => $faker->randomNumber(2),
        'img'      => $img,
        'category' => $tags,
        'notes'    => $faker->text(15),
    ];
});
