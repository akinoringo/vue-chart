<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EffortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    // 	DB::table('efforts')->insert([
    // 		[
    // 			'id' => 1,
	   //  		'user_id' => 1,
	   //  		'goal_id' => 1,
	   //  		'title' => 'タイトル(軌跡)1',
	   //  		'content' => '内容1',
	   //  		'effort_time' => 2,
    // 		],
    // 		[
    // 			'id' => 2,
	   //  		'user_id' => 1,
	   //  		'goal_id' => 1,
	   //  		'title' => 'タイトル(軌跡)2',
	   //  		'content' => '内容2',
	   //  		'effort_time' => 3,    			
    // 		],
    // 		[
    // 			'id' => 3,
	   //  		'user_id' => 1,
	   //  		'goal_id' => 1,
	   //  		'title' => 'タイトル(軌跡)3',
	   //  		'content' => '内容3',
	   //  		'effort_time' => 1,    			
    // 		],
  		// ]); 
      factory(App\Effort::class, 30)->create();
    }
}
