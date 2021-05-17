<?php

namespace App\Http\Controllers;

use App\Effort;
use App\Goal;
use App\User;

use DB;
use Illuminate\Http\Request;

class EffortGraphController extends Controller
{
  public function index($id){
    // viewから受け渡された$idに対応するユーザーの取得
    $user = User::find($id);
    $goal_label = 0;
    $goals = $this->goalsGet($user, $goal_label);

    //日付を取得する日数
    $numOfDays = 7; 
    $startOfWeek = now()->startOfWeek();
    $week[0] = $startOfWeek->format('Y-m-d');    

    //Carbonのインスタンスが上書きされないようにcopy()して日付を加算
    for ($i=1; $i < $numOfDays ; $i++) {
      $week[$i] = $startOfWeek->copy()->addDay($i)->format('Y-m-d');
    }    

    // $i番目の目標に紐づく軌跡の1週間の積み上げ時間を配列で取得
    for ($i=0; $i < count($goals) ; $i++) {
      for ($j=0; $j < $numOfDays ; $j++) {
        $effortsOfWeek[$i] = Effort::where('goal_id', $goals[$i]->id)
          ->where(function ($query) use ($week, $j) {
            $query->whereDate('created_at', $week[$j]);
          });

        if ($effortsOfWeek[$i]->exists()) {
          $effortsTimeOfWeek[$i][$j] = $effortsOfWeek[$i]->pluck('effort_time')->all();
          $effortsTimeTotalOfWeek[$i][$j] = array_sum($effortsTimeOfWeek[$i][$j]);                  
        }
        else {
          $effortsTimeTotalOfWeek[$i][$j] = 0;
        }
      
      }       

    }

    return [
      'week' => $week,
      'effortsTimeTotalOfWeek' => $effortsTimeTotalOfWeek,
    ];     

  	// $apiEffortCreate = DB::table('efforts')
  	// 	->select('created_at', 'effort_time')
  	// 	->whereBetween('efforts.created_at', [now()->startOfMonth()->format('Y-m-d'), now()->endOfMonth()->format('Y-m-d')])
  	// 	->limit(7)
  	// 	->orderby('created_at', 'desc')
  	// 	->pluck('created_at')
  	// 	->all();

  	// $apiEffortTime = DB::table('efforts')
  	// 	->select('created_at', 'effort_time')
  	// 	->whereBetween('efforts.created_at', [now()->startOfMonth()->format('Y-m-d'), now()->endOfMonth()->format('Y-m-d')])
  	// 	->limit(7)
  	// 	->orderby('created_at', 'desc')
  	// 	->pluck('effort_time')
  	// 	->all();  		

  	// return [
  	// 	'apiEffortCreate' => $apiEffortCreate, 
  	// 	'apiEffortTime' => $apiEffortTime
  	// ];


  }


  /**
    * ユーザーの(未達成or達成済みの)目標を全て取得する
    * @param Goal $goal
    * @return Builder
  */    
  private function goalsGet($user, $goal_label)
  {
    if ($goal_label == 1) {
      $goals = Goal::where('user_id', $user->id)
        ->where(function($goals){
          $goals->where('status', 1);
        })->get();
    } else {
      $goals = Goal::where('user_id', $user->id)
        ->where(function($goals){
          $goals->where('status', 0);
        })->get();      
    }

    return $goals;
  }

}
