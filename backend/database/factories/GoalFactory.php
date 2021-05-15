<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Goal;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Goal::class, function (Faker $faker) {
    return [
        //
  		'title' => $faker->text(20),
  		'content' => $faker->text(100),
  		'goal_time' => 10000,
  		// 'user_id' => function () {
  		// 	return factory(User::class);
  		// },  
  		'user_id' => 1, 	
  		'created_at' => $faker->dateTimeBetween($startDate = '-1 month', $endDate = 'now'),
      'updated_at' => Carbon::now(),
    ];
});
