<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Score;

class Transaction extends Model
{
	protected $fillable = ['monto', 'estado', 'user_id', 'user_to_id','combo_lounge_id'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function user_to_id()
	{
		return $this->belongsTo(User::class);
	}

	public function score()
	{
		return $this->hasOne(Score::class);
	}
}
