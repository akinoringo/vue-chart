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
	public function show($id, Request $request) {

		// viewから受け渡された$idに対応するユーザーの取得
		$user = User::find($id);

		// リクエストから検索条件と目標のステータス(0：未クリア、1：クリア済み)の取得
		$search = $request->search;
		$goal_label = $request->label;		

		// $userと$goal_labelに対応する目標を配列として取得
		// $goalひとつひとつに紐づく$effortを配列として取得
		$goals = $this->goalsGet($user, $goal_label);
		$efforts = $this->effortsGet($goals, $search);

		// 達成済みの目標を配列で取得
		$cleared_goals = $this->goalsGet($user, 1);

		return view('mypage.show', compact('user', 'goals', 'efforts', 'goal_label', 'search', 'cleared_goals'));

	}

	public function edit($id) {
		if ($id == Auth::user()->id){
			return view('mypage.edit')->with('user', Auth::user());	
		} else {
			return redirect()->back();
		}
		
	}

	public function update(ProfileRequest $request) {
		$user = Auth::user();

		$user->name = $request->input('name');
		$user->introduction = $request->input('introduction');

		if ($request->has('image')){
			$fileName = $this->saveImage($request->file('image'));
			$user->image = $fileName;
		}

		$user->save();

		return redirect()->route('mypage.show', ['id' => $user->id]);
	}

	public function follow(Request $request, string $name)
	{
		$user = User::where('name', $name)->first();

		if ($user->id === $request->user()->id)
		{
			return abort('404', 'Cannot follow yourself.');
		}

		$request->user()->followings()->detach($user);
		$request->user()->followings()->attach($user);

		return ['name' => $name];
	}

	public function unfollow(Request $request, string $name)
	{
		$user = User::where('name', $name)->first();

		if ($user->id === $request->user()->id)
		{
			return abort('404', 'Cannot follow yourself.');
		}

		$request->user()->followings()->detach($user);

		return ['name' => $name];
	}	


	// ユーザーと目標のステータス(0:未クリア、1:クリア済)に応じて該当する目標を全て取得
	private function goalsGet($user, $goal_label)
	{
		if ($goal_label == 1) {
			$goals = Goal::where('user_id', $user->id)
				->where(function($goals){
					$goals->where('status', 1);
				})->get();
		} else {
			$goals = Goal::where('user_id', $user->id)
				->where(function($goals){
					$goals->where('status', 0);
				})->get();			
		}

		return $goals;
	}

	// 目標に紐づく軌跡(複数)を配列で取得する。
	private function effortsGet($goals, $search)
	{

		$efforts = [];

		foreach ($goals as $goal) {
			$efforts[] = Effort::orderBy('created_at', 'DESC')
				->where('goal_id', $goal->id)
				->where(function($query) use ($search) {
									$query->orwhere('title', 'like', "%{$search}%")
												->orwhere('content', 'like', "%{$search}%");
					})->paginate(3);
		}

		return $efforts;
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
