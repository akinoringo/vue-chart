<?php

namespace App\Http\Controllers;

use App\Effort;
use App\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    //
	public function index() {
		$efforts = Effort::paginate(10);
		return view('mypage.index', compact('efforts'));
	}

	public function edit() {
		return view('mypage.edit')->with('user', Auth::user());
	}
	public function update(ProfileRequest $request) {

		$user = Auth::user();

		$user->name = $request->input('name');
		$user->save();

		return redirect()->route('mypage.index');
	}
}
