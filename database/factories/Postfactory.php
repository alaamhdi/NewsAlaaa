<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [

        'title' =>$faker->sentence,
        'content'=>$faker->text(400),
        'date_written'=> now(),
        'featured_image'=>$faker->imageUrl(),
        'voted_up'=> $faker->numberBetween(1,100),
        'voted_down'=>$faker->numberBetween(1,100),
        'user_id'=>$faker->numberBetween(1,50),
        'Category_id'=>$faker->numberBetween(1,15)


        //
    ];
});
