<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Score;

class Transactions extends Model
{
	protected $fillable = ['estado', 'user_id', 'combo_lounge_id'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function score()
	{
		return $this->hasOne(Score::class);
	}
}
