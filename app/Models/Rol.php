<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
	protected $fillable = ['nombre'];

	// relaciones
	public function user(){
		return $this->hasOne(User::class);
	}
}
