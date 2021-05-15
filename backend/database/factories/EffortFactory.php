<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Effort;
use App\User;
use App\Goal;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Effort::class, function (Faker $faker) {
    return [
        //
  		'title' => $faker->realText(20),
  		'content' => $faker->realText(100),
  		// 'goal_id' => function () {
  		// 	return factory(Goal::class);
  		// },  		
  		// 'user_id' => function () {
  		// 	return factory(User::class);
  		// },
      'goal_id' => 1,
      'user_id' => 1,
  		'effort_time' => $faker->randomNumber(1),
  		'status' => 0,
      'created_at' => $faker->dateTimeBetween($startDate = '-1 month', $endDate = 'now'),
      'updated_at' => Carbon::now(),
    ];
});
