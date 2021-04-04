<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
	public function index() {
		return view('mypage.index');
	}

	public function edit() {
		return view('mypage.edit')->with('user', Auth::user());
	}
}
