<?php

use Faker\Generator as Faker;
use App\User as UserEloquent;
use App\Post as PostEloquent;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'post_id' => PostEloquent::inRandomOrder()->first()->id,
        'user_id' => UserEloquent::inRandomOrder()->first()->id,
        'content' => $faker->sentence,
    ];
});
