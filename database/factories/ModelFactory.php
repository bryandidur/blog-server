<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

// Users factory
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

// Tags factory
$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    $name = $faker->unique()->word;
    $users = App\User::all()->pluck('id')->toArray();

    return [
        'user_id' => $users[array_rand($users)],
        'slug' => str_slug( $name ),
        'name' => ucfirst( $name ),
        'description' => $faker->sentence,
    ];
});

// Categories factory
$factory->define(App\Category::class, function (Faker\Generator $faker) {
    $name = $faker->unique()->word;
    $users = App\User::all()->pluck('id')->toArray();

    return [
        'user_id' => $users[array_rand($users)],
        'slug' => str_slug($name),
        'name' => ucfirst($name),
        'description' => $faker->sentence,
    ];
});

// Articles factory
$factory->define(App\Article::class, function (Faker\Generator $faker) {
    $title = $faker->words( 8, true );
    $users = App\User::all()->pluck('id')->toArray();

    return [
        'user_id' => $users[array_rand($users)],
        'slug' => str_slug($title),
        'title' => ucwords($title),
        'description' => $faker->sentence,
        'content' => $faker->paragraphs(20, true),
        'status' => rand(0, 1),
    ];
});
