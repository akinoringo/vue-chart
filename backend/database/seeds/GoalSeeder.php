<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	DB::table('goals')->insert([
    		[
    			'id' => 1,
	    		'user_id' => 1,
	    		'title' => 'タイトル(目標)1',
	    		'content' => '内容1',
	    		'goal_time' => 1000,
    		],
    		[
    			'id' => 2,
	    		'user_id' => 1,
	    		'title' => 'タイトル(目標)2',
	    		'content' => '内容2',
	    		'goal_time' => 1000,    			
    		],
    		[
    			'id' => 3,
	    		'user_id' => 1,
	    		'title' => 'タイトル(目標)3',
	    		'content' => '内容3',
	    		'goal_time' => 1000,    			
    		],
  		]);
    }
}
