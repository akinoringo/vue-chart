<?php

namespace App\Services;

use App\Effort;
use App\Goal;
use Illuminate\Support\Facades\Auth;

class DayService{
	public function addStackingdays($goal, $efforts_today) {
		// 本日の軌跡がなければ、積み上げ日数を+1
		if ($efforts_today->isEmpty()) {
			$goal->stacking_days += 1;						
		}

	}	

	public function updateContinuationdays($goal, $efforts_yesterday, $efforts_today){
		// 昨日の軌跡がなければ、継続日数を1にリセットする
		if ($efforts_yesterday->isEmpty()) {
			$goal->continuation_days = 1;		
		}			

		// 昨日の軌跡が存在し、今日の軌跡が空だった場合継続日数を+1
		if ($efforts_yesterday->isNotEmpty() && $efforts_today->isEmpty()) {
			$goal->continuation_days += 1;
		}		

	}

	public function updateContinuationdaysmax($goal){
		// 最大継続日数を更新する
		if ($goal->continuation_days_max < $goal->continuation_days) {
			$goal->continuation_days_max = $goal->continuation_days;
		}		
	}	
}
