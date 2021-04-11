<?php

namespace App\Http\Controllers;

use App\Effort;
use App\Goal;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    //
	public function index() {
		$user = Auth::user();

		$goals = User::where('id', Auth::id())->first()->goals;

		$goal0 = $goals[0];
		$goal1 = $goals[1];
		$goal2 = $goals[2];

		$efforts0 = $goal0->efforts;
		$efforts1 = $goal1->efforts;
		$efforts2 = $goal2->efforts;

		return view('mypage.index', compact('user', 'goal0', 'goal1', 'goal2', 'efforts0', 'efforts1', 'efforts2' ));
	}

	public function edit() {
		return view('mypage.edit')->with('user', Auth::user());
	}
	public function update(ProfileRequest $request) {

		$user = Auth::user();

		$user->name = $request->input('name');

		if ($request->has('image')){
			$fileName = $this->saveImage($request->file('image'));
			$user->image = $fileName;
		}

		$user->save();

		return redirect()->route('mypage.index');
	}

	
	//プロフィール画像をリサイズして保存するメソッド		
	private function saveImage(UploadedFile $file):string
	{
		$tempPath = $this->makeTempPath();
		Image::make($file)->fit(200, 200)->save($tempPath);

		$filePath = Storage::disk('public')
			->putFile('images', new File($tempPath)); //publicディレクトリの	imagesフォルダに保存。

		return basename($filePath);
	}
	//一時的なファイルパスを生成してパスを返すメソッド	
	private function makeTempPath():string
	{
		$tmp_fp = tmpfile();
		$meta = stream_get_meta_data($tmp_fp);
		return $meta["uri"];
	}
}
