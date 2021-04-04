<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
