<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Transactions extends Model
{
	protected $fillable = ['estado', 'user_id', 'combo_lounge_id'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
