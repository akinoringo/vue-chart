<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Goal extends Model
{
    //
	protected $fillable = [
		'title',
		'content',
		'goal_time',
		'user_id',
	];


	public function user(): BelongsTo
	{
		return $this->belongsTo('App\User');
	}

  public function efforts()
  {
      return $this->hasMany('App\Effort');
  }

  public function tags(): BelongsToMany
  {
  	return $this->BelongsToMany("App\Tag")->withTimestamps();
  }

}
