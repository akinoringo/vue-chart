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

	



	public function index() {
		$goals = Goal::all()->sortByDesc('created_at');

		return view('goals.index', ['goals' => $goals]);
	}

	public function create() {
		$user = Auth::user();

		$number = Goal::where('user_id', $user->id)
			->where(function($goals) {
				$goals->where('status', 0);
		})->count();

		// 目標が３つの場合は、新たに作成不可。
		if ($number !== 3){
			return view('goals.create');
		} else {
			return redirect()->route('mypage.index');
		}
	}

	public function store(GoalRequest $request, Goal $goal) {
		$goal->fill($request->all());
		$goal->user_id = $request->user()->id;
		$goal->save();
		return redirect()->route('mypage.index');
	}

	public function edit(Goal $goal)
	{
		return view('goals.edit', ['goal' => $goal]);
	}

	public function update(GoalRequest $request, Goal $goal)
	{
		$goal->fill($request->all())->save();
		return redirect()->route('mypage.index');
	}	

	public function destroy(Goal $goal)
	{
		$goal->delete();
		return redirect()->route('mypage.index');
	}		

	public function show(Goal $goal)
	{
		return view('goals.show', ['goal' => $goal]);
	}			
}
