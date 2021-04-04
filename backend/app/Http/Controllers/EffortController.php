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
		$effort->fill($request->all());
		$effort->goal_id = $request->goal_id;
		$effort->user_id = $request->user()->id;
		$effort->save();
		return redirect()->route('efforts.index');
	}

	public function edit(Effort $effort){
		$goals = Goal::all()->sortByDesc('created_at');
		return view('efforts.edit', compact('effort', 'goals'));
	}	

	public function update(EffortRequest $request, Effort $effort){

		$effort->fill($request->all())->save();
		return redirect()->route('efforts.index');
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


}
