<?php

namespace App\Http\Controllers;

use App\Goal;
use App\User;
use App\Http\Requests\GoalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class GoalController extends Controller
{
    //
	public function __construct()
	{
		$this->authorizeResource(Goal::class, 'goal');
	}

	public function create() {
		$user = Auth::user();

		// ユーザーに紐づく目標を取得し、ステータスが未達成(statu:0)の目標数をカウント。
		$number = $this->GoalCount($user);

		// 目標が３つの場合は、新たに作成不可。
		if ($number !== 3){

			return view('goals.create');
		} else {

			return redirect()
				->route('mypage.show', ['id' => Auth::user()->id])
				->with([
				'flash_message' => '同時に登録できる目標は3つまでです。',
				'color' => 'danger'
			]);
		}
	}
	

	public function store(GoalRequest $request, Goal $goal) {
		// フォームリクエストで取得した情報をフィルターして保存
		$goal->fill($request->all());

		$goal->user_id = $request->user()->id;
		$goal->save();

		return redirect()
						->route('mypage.show', ['id' => Auth::user()->id])
						->with([
							'flash_message' => '目標を登録しました。',
							'color' => 'success',
						]);
	}

	public function edit(Goal $goal)
	{
		if ($goal->status === 0){
			return view('goals.edit', ['goal' => $goal]);			
		} else {
			return redirect()->route('mypage.show', ['id' => Auth::user()->id])->with([
				'flash_message' => 'クリア済みの目標は編集できません',
				'color' => 'danger'
			]);			
		}

	}

	public function update(GoalRequest $request, Goal $goal)
	{
		$goal->fill($request->all())->save();
		return redirect()->route('mypage.show', ['id' => Auth::user()->id])->with([
			'flash_message' => '目標を編集しました。',
			'color' => 'success'			
		]);
	}	

	public function destroy(Goal $goal)
	{
		if ($goal->status === 0){
			$goal->delete();
			return redirect()->route('mypage.show', ['id' => Auth::user()->id])->with([
				'flash_message' => '目標を削除しました。',
				'color' => 'success'			
			]);
		} else {
			return redirect()->route('mypage.show', ['id' => Auth::user()->id])->with([
				'flash_message' => 'クリア済みの目標は削除できません',
				'color' => 'danger'
			]);			
		}
	}		

	public function show(Goal $goal)
	{
		return view('goals.show', [
			'goal' => $goal,
			'user' => Auth::user()
		]);
	}

	private function GoalCount(User $user) {
		$number = Goal::where('user_id', $user->id)
			->where(function($goals) {
				$goals->where('status', 0);
		})->count();

		return $number;		
	}	
}
