<?php

namespace App\Http\Controllers;

use App\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    //
	public function index() {
		$goals = Goal::all()->sortByDesc('created_at');

		return view('goals.index', compact('goals'));
	}
}
