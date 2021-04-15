<?php

namespace App\Http\Controllers;

use App\Effort;
use App\Goal;
use Illuminate\Http\Request;
use App\Http\Requests\EffortRequest;
use Illuminate\Support\Facades\DB;

class EffortController extends Controller
{
    //
	public function index(Request $request){
		$search = $request->search;

		if ($search !== null) {
			$efforts = Effort::where('title', 'like', "%{$search}%")
			->orWhere('content', 'like', "%{$search}%")
			->paginate(10);

		} else {
			$efforts = Effort::paginate(10);
		}

		// $efforts = Effort::all()->sortByDesc('created_at');

		return view('efforts.index', compact('efforts'));
	}

	public function create(){
		$goals = Goal::all()->sortByDesc('created_at');
		


		return view('efforts.create', compact('goals'));
	}

	public function store(EffortRequest $request, Effort $effort ){
		//軌跡の保存処理
		$effort->fill($request->all());
		$effort->goal_id = $request->goal_id;
		$effort->user_id = $request->user()->id;
		$effort->save();

		// 軌跡に紐づく目標と、目標に紐づく軌跡を全て抽出
		$goal = Goal::where('id', $request->goal_id)->get()->first();
		$efforts = Effort::where('goal_id', $request->goal_id)->get();

		//目標のステータスが0(目標未達成)の場合、goal_time>total(effort_time)であれば目標ステータスを1に更新する。
		if($goal->status === 0) {
			
			updateGoalStatus($goal, $efforts);
			return redirect()->route('mypage.index');			

		} else {

			return redirect()->route('mypage.index')->with('flash_message', 'クリア済みの目標です。');
		}


	}

	public function edit(Effort $effort){
		$goals = Goal::all()->sortByDesc('created_at');
		return view('efforts.edit', compact('effort', 'goals'));
	}	

	public function update(EffortRequest $request, Effort $effort){

		$effort->fill($request->all())->save();

		// 軌跡に紐づく目標と、目標に紐づく軌跡を全て抽出
		$goal = Goal::where('id', $request->goal_id)->get()->first();
		$efforts = Effort::where('goal_id', $request->goal_id)->get();

		//目標のステータスが0(目標未達成)の場合、goal_time>total(effort_time)であれば目標ステータスを1に更新する。
		if($goal->status === 0) {
			
			updateGoalStatus($goal, $efforts);

			return redirect()->route('mypage.index');			

		} else {

			return redirect()->route('mypage.index')->with('flash_message', 'クリア済みの目標です。');
		}

	}	

	public function destroy(Effort $effort)
	{
		$effort->delete();
		return redirect()->route('efforts.index');
	}


	public function show(Effort $effort)
	{
		return view('efforts.show', compact('effort'));
	}	



	// 軌跡の合計時間に応じて目標ステータスを更新する。
	private function updateGoalStatus($goal, $efforts){

		if ($goal->goal_time <= sumEffortsTime($efforts)) {

			$goal->status = 1;
			$goal->save();

			session()->flash('flash_message', '目標をクリアしました。');

		} else {

			$goal->status = 0;
			$goal->save();

		}		

	}

	// 軌跡の合計時間の算出メソッド
	private function sumEffortsTime($efforts) {
		$total_efforts_time = 0;

		foreach ($efforts as $effort) {
			$total_efforts_time += $effort->effort_time;
			
		}
		return $total_efforts_time;
	}	


}
