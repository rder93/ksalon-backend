<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Score extends Model
{
	protected $fillable = ['puntaje', 'comentario', 'transaction_id'];

	public function transaction()
    {
    	return $this->belongsTo(Transaction::class);
    } 
}
