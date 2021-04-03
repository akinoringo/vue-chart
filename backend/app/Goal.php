<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Goal extends Model
{
    //
	protected $fillable = [
		'title',
		'content',
		'goal_time',
	];


	public function user(): BelongsTo
	{
		return $this->belongsTo('App\User');
	}
}
