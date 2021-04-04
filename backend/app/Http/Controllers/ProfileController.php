<?php

namespace App\Http\Controllers;

use App\Effort;
use App\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
	public function update() {
		return redirect()->route('mypage.index');
	}
}
