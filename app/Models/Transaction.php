<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Score;
use App\Models\TransactionDetail;

class Transaction extends Model
{
	protected $fillable = ['total', 'comision', 'valor', 'estado', 'user_id', 'user_to_id'];

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

	public function details(){
    	return $this->hasMany(TransactionDetail::class);
    }
}
