<?php

namespace App\Http\Controllers;

use App\Effort;
use App\Goal;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\EffortRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EffortController extends Controller
{
  // EffortPolicyでCRUD操作を制限
	public function __construct()
	{
		$this->authorizeResource(Effort::class, 'effort');
	}

	/**
		* 軌跡一覧の表示
		* @param Request $request
		* @param Effort $effort
		* @return  \Illuminate\Http\Response
	*/
	public function index(Request $request) {

		// 検索語の取得
		$search = $request->search;

		// 全ての軌跡を検索語でソートして作成順に並び替えて取得
		$efforts = $this->getEffortsAll($search);

		// フォロー中の人の軌跡を検索語でソートして作成順に並び替えて取得
		// 誰もフォローしていない場合はnullを代入
		if (Auth::check()) {
			$efforts_follow = $this->getEffortsFollow($search);
			
			return view('home', compact('efforts', 'efforts_follow'));				
		} else {

			$efforts_follow = null;
			return view('home', compact('efforts', 'efforts_follow'));
		}

	}

	/**
		* 軌跡詳細画面の表示
		* @param Effort $effort
		* @return  \Illuminate\Http\Response
	*/
	public function show(Effort $effort)
	{
		return view('efforts.show', [
			'effort' => $effort,
			'user' => Auth::user()
		]);
	}	

	/**
		* 軌跡作成フォームの表示
		* @param Request $request
		* @param Goal $goal
		* @return  \Illuminate\Http\Response
	*/
	public function create(){
		// 自身の未達成の目標を取得
		$goals = $this->myGoalsGet();

		// 未達成の目標がない場合は、マイページへリダイレクト
		if (!isset($goals[0])) {

			return redirect()
							->route('mypage.show', ['id' => Auth::user()->id])
							->with([
								'flash_message' => 'まずは目標を作成してください',
								'color' => 'danger'
							]);
		}

		return view('efforts.create', compact('goals'));
	}

	/**
		* 軌跡の登録
		* @param EffortRequest $request
		* @param Goal $goal
		* @param Effort $effort
		* @return  \Illuminate\Http\RedirectResponse
	*/
	public function store(EffortRequest $request, Effort $effort ){
		// 軌跡に紐づく目標を取得
		$goal = Goal::where('id', $request->goal_id)->get()->first();

		// 昨日および今日の軌跡を取得する。
		[$efforts_yesterday, $efforts_today] = $this->getEffortsYesterdayAndToday($goal);

		// 本日の軌跡がなければ、積み上げ日数を+1
		if ($efforts_today->isEmpty()) {
			$goal->stacking_days += 1;						
		}
		
		// 昨日の軌跡がなければ、継続日数を1にリセットする
		if ($efforts_yesterday->isEmpty()) {
			$goal->continuation_days = 1;		
		}	

		// 昨日の軌跡が存在し、今日の軌跡が空だった場合継続日数を+1
		if ($efforts_yesterday->isNotEmpty() && $efforts_today->isEmpty()) {
			$goal->continuation_days += 1;
		}

		// 最大継続日数を更新する
		if ($goal->continuation_days_max < $goal->continuation_days) {
			$goal->continuation_days_max = $goal->continuation_days;
		}

		//軌跡の保存処理
		$effort->fill($request->all());
		$effort->goal_id = $request->goal_id;
		$effort->user_id = $request->user()->id;
		$effort->save();

		// 目標に紐づく軌跡の継続時間の合計をDBに保存。
		$efforts = Effort::where('goal_id', $request->goal_id)
			->where(function($efforts) {
					$efforts->where('status', 0);
				})->get();

		$goal->efforts_time = $this->sumEffortsTime($efforts);		

		$goal->save();

		$user = User::where('id', Auth::user()->id)->first();

		// 積み上げ時間が99時間以上でバッジを獲得
		if ($goal->efforts_time > 99 && $user->efforts_time_badge == 0) {
			$user->efforts_time_badge = 1;
			session()->flash('badge_message', 'おめでとうございます。忍耐力の称号を取得しました。');
			session()->flash('badge_color', 'primary');				

		}

		// 積み上げ日数が10日以上でバッジを獲得
		if ($goal->stacking_days > 9 && $user->stacking_days_badge == 0) {
			$user->stacking_days_badge = 1;
			session()->flash('badge_message', 'おめでとうございます。継続力の称号を取得しました。');
			session()->flash('badge_color', 'primary');				
		}		

		// 目標時間>合計継続時間であれば目標ステータスを1に更新
		$this->updateGoalStatus($goal, $efforts);


		// 目標をクリアしたら、バッジを獲得
		if ($goal->status == 1 && $user->goal_clear_badge == 0) {
			$user->goal_clear_badge = 1;
			session()->flash('badge_message', 'おめでとうございます。達成力の称号を取得しました。');
			session()->flash('badge_color', 'primary');				

		}

		$user->save();

		return redirect()
						->route('mypage.show', ['id' => Auth::user()->id]);			

	}

	/**
		* 軌跡の編集画面
		* @param Effort $effort
		* @return  \Illuminate\Http\Response
	*/
	public function edit(Effort $effort){
		// 自身の未達成の目標を取得
		$goals = $this->myGoalsGet();

		// 未達成の目標に紐づく軌跡なら編集可能
		$goal = Goal::where('id', $effort->goal_id)->get()->first();

		if ($goal->status == 0) {
			
			return view('efforts.edit', compact('effort', 'goals'));	
		
		}	

		// 達成済みの目標に紐づく軌跡は編集不可能
		if ($goal->status == 1) {
			return redirect()
							->route('mypage.show', ['id' => Auth::user()->id])
							->with([
								'flash_message' => 'クリア済みの目標なので、軌跡は編集できません。',
								'color' => 'danger'
							]);			
		}

	}	

	/**
		* 軌跡の更新
		* @param EffortRequest $request
		* @param Goal $goal
		* @param Effort $effort
		* @return  \Illuminate\Http\RedirectResponse
	*/
	public function update(EffortRequest $request, Effort $effort){

		$effort->fill($request->all())->save();

		// 軌跡に紐づく目標と、目標に紐づく軌跡を全て抽出
		$goal = Goal::where('id', $effort->goal_id)->get()->first();

		// 目標に紐づく軌跡の継続時間の合計をDBに保存
		$efforts = Effort::where('goal_id', $effort->goal_id)
			->where(function($efforts) {
					$efforts->where('status', 0);
				})->get();

		$goal->efforts_time = $this->sumEffortsTime($efforts);
		$goal->save();

		$user = User::where('id', Auth::user()->id)->first();		

		// 積み上げ時間が99時間以上でバッジを獲得
		if ($goal->efforts_time > 99 && $user->efforts_time_badge == 0) {
			$user->efforts_time_badge = 1;
			session()->flash('badge_message', 'おめでとうございます。忍耐力の称号を取得しました。');
			session()->flash('badge_color', 'primary');				

		}

		// 積み上げ日数が10日以上でバッジを獲得
		if ($goal->stacking_days > 9 && $user->stacking_days_badge == 0) {
			$user->stacking_days_badge = 1;
			session()->flash('badge_message', 'おめでとうございます。継続力の称号を取得しました。');
			session()->flash('badge_color', 'primary');				
		}					

		//goal_time>total(effort_time)であれば目標ステータスを1に更新する。
			
		$this->updateGoalStatus($goal, $efforts);

		// 目標をクリアしたら、バッジを獲得
		if ($goal->status == 1 && $user->goal_clear_badge == 0) {
			$user->goal_clear_badge = 1;
			session()->flash('badge_message', 'おめでとうございます。達成力の称号を取得しました。');
			session()->flash('badge_color', 'primary');				

		}		

		$user->save();		

		return redirect()
						->route('mypage.show', ['id' => Auth::user()->id])
						->with([
							'flash_message' => '軌跡を編集しました。',
							'color' => 'success'
						]);			


	}	

	/**
		* 軌跡の削除
		* @param Goal $goal
		* @param Effort $effort
		* @return  \Illuminate\Http\RedirectResponse
	*/
	public function destroy(Effort $effort)
	{
		// 軌跡に紐づく目標の取得
		$goal = Goal::where('id', $effort->goal_id)->get()->first();

		// 軌跡に紐づく目標が未達成の場合は、軌跡を削除可能。
		if ($goal->status === 0) {

			// $effortのステータスを削除(1)に変更する。
			$effort->status = 1;
			$effort->save();

			// 消去した$effortに紐づいていた$goalに紐づく軌跡合計時間($efforts_time)を再計算
			$efforts = Effort::where('goal_id', $goal->id)
				->where(function($efforts) {
					$efforts->where('status', 0);
				})->get();

			$goal->efforts_time = $this->sumEffortsTime($efforts);
			$goal->save();
		
			return redirect()
							->route('mypage.show', ['id' => Auth::user()->id])
							->with([
								'flash_message' => '軌跡を削除しました。',
								'color' => 'success'
							]);			
		} else {
			// 軌跡に紐づく目標がすでに達成済みの場合は、軌跡を削除不可。
			return redirect()
							->route('mypage.show', ['id' => Auth::user()->id])
							->with([
								'flash_message' => 'クリア済みの目標なので、軌跡は削除できません。',
								'color' => 'danger'
							]);			
		}


	}


	/**
		* 軌跡へのいいね
		* @param Request $request
		* @param Effort $effort
		* @return  array
	*/
	public function like(Request $request, Effort $effort){
		$effort->likes()->detach($request->user()->id);
		$effort->likes()->attach($request->user()->id);

		return [
			'id' => $effort->id,
			'countLikes' => $effort->count_likes,
		];
	}


	/**
		* 軌跡へのいいね解除
		* @param Request $request
		* @param Effort $effort
		* @return  array
	*/
	public function unlike(Request $request, Effort $effort){

		$effort->likes()->detach($request->user()->id);

		return [
			'id' => $effort->id,
			'countLikes' => $effort->count_likes,
		];
	}	

	/** 
		* 全ての軌跡を検索語でソートして取得する
		* @param Effort $effort
		* @return  LengthAwarePaginator
	*/
	private function getEffortsAll($search) {
		$efforts = Effort::orderBy('created_at', 'DESC')
							->where('status', 0)
							->where(function($query) use ($search) {
								$query->orwhere('title', 'like', "%{$search}%")
											->orwhere('content', 'like', "%{$search}%");
							})->paginate(10);

		return $efforts;
	}

	/** 
		* フォロー中の人の軌跡を検索語でソートして取得する
		* @param Effort $effort
		* @return  LengthAwarePaginator
	*/
	private function getEffortsFollow($search) {
		$efforts_follow = Effort::query()
			->where('status', 0)
			->whereIn('user_id', Auth::user()->followings()->pluck('followee_id'))
			->orderBy('created_at', 'DESC')
			->where(function($query) use ($search) {
									$query->orwhere('title', 'like', "%{$search}%")
												->orwhere('content', 'like', "%{$search}%");
			})->paginate(10);	

		return $efforts_follow;
	}


	/** 
		* 自身の未達成の目標を取得する
		* @param Goal $goal
		* @return  Builder
	*/
	private function myGoalsGet() {
		$goals = Goal::where('user_id', Auth::user()->id)
							->where(function($goals){
								$goals->where('status', 0);
							})->get();

		return $goals;		
	}


	/** 
		* 軌跡の合計時間を計算し、目標ステータスを更新する
		* @param Goal $goal
		* @param Effort $effort		
		* @return  void
	*/
	private function updateGoalStatus($goal, $efforts){

		if ($goal->goal_time <= $this->sumEffortsTime($efforts)) {

			$goal->status = 1;
			$goal->save();

			session()->flash('flash_message', 'おめでとうございます。目標をクリアしました。');
			session()->flash('color', 'success');

		} else {

			$goal->status = 0;
			$goal->save();

			session()->flash('flash_message', '軌跡を作成しました。');
			session()->flash('color', 'success');			

		}		

	}

	/** 
		* 軌跡の合計時間を計算する
		* @param Effort $effort		
		* @return  int
	*/
	private function sumEffortsTime($efforts) {
		$total_efforts_time = 0;

		foreach ($efforts as $effort) {
			$total_efforts_time += $effort->effort_time;
			
		}
		return $total_efforts_time;
	}	

	/** 
		* 軌跡の合計時間を計算する
		* @param Carbon $yesterday
		* @param Carbon $today
		* @param Effort $effort	
		* @return  array
	*/
	private function getEffortsYesterdayAndToday($goal){

		$yesterday = Carbon::yesterday()->format('Y-m-d');
		$today = Carbon::today()->format('Y-m-d');

		$efforts_yesterday = Effort::where('goal_id', $goal->id)
			->where(function($goals) use ($yesterday){
				$goals->whereDate('created_at', $yesterday);
			})->get();

		$efforts_today = Effort::where('goal_id', $goal->id)
			->where(function($goals) use ($today){
				$goals->whereDate('created_at', $today);
			})->get();		

		return array($efforts_yesterday, $efforts_today);
	}


}
