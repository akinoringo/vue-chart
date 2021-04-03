<?php

namespace App\Http\Controllers;

use App\Goal;
use App\Http\Requests\GoalRequest;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    //
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
}
