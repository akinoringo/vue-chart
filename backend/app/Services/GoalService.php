<?php

namespace App\Services;

use App\Effort;
use App\Goal;
use Illuminate\Support\Facades\Auth;

class GoalService{
	/** 
		* 自身の未達成の目標を取得する
		* @param Goal $goal
		* @return  Builder
	*/
	public function myGoalsGet() {
		$goals = Goal::where('user_id', Auth::user()->id)
							->where(function($goals){
								$goals->where('status', 0);
							})->get();

		return $goals;		
	}	

}