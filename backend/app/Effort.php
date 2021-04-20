<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Effort extends Model
{
	protected $fillable = [
		'title',
		'content',
		'effort_time',
	];
    //
	public function goal(): BelongsTo
	{
		return $this->belongsTo('App\Goal');
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo('App\User');
	}

	public function likes() BelongsToMany
	{
		return $this->belongsToMany('App\User', 'likes')->withTimestamps();
	}

	public function isLikedBy(?User $user):bool
	{
		return $user
			? (bool)$this->likes->where('id', $user->id)->count()
			:false;
	}

}



