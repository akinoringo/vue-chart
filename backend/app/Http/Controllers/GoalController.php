<?php

namespace App\Http\Controllers;

use App\Goal;
use App\Http\Requests\GoalRequest;
use Illuminate\Http\Request;

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
		return view('goals.create');
	}

	public function store(GoalRequest $request, Goal $goal) {
		$goal->fill($request->all());
		$goal->user_id = $request->user()->id;
		$goal->save();
		return redirect()->route('goals.index');
	}

	public function edit(Goal $goal)
	{
		return view('goals.edit', ['goal' => $goal]);
	}

	public function update(GoalRequest $request, Goal $goal)
	{
		$goal->fill($request->all())->save();
		return redirect()->route('goals.index');
	}	

	public function destroy(Goal $goal)
	{
		$goal->delete();
		return redirect()->route('goals.index');
	}		

	public function show(Goal $goal)
	{
		return view('goals.show', ['goal' => $goal]);
	}			
}
