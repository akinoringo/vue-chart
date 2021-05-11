<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Effort;
use App\User;
use App\Goal;
use Faker\Generator as Faker;

$factory->define(Effort::class, function (Faker $faker) {
    return [
        //
  		'title' => $faker->text(20),
  		'content' => $faker->text(100),
  		'goal_id' => function () {
  			return factory(Goal::class);
  		},  		
  		'user_id' => function () {
  			return factory(User::class);
  		},
  		'effort_time' => 1,
  		'status' => 0,
    ];
});
