<?php

namespace App\Services;

use App\Effort;
use Illuminate\Support\Facades\Auth;

class EffortService{

	/** 
		* 全ての軌跡を検索語でソートして取得する
		* @param Effort $effort
		* @return  LengthAwarePaginator
	*/
	public function getEffortsAll($search) {
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
	public function getEffortsFollow($search) {
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




}