<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Combo;
use App\Models\Lounge;
use App\Models\Professional;

class Service extends Model
{
	protected $fillable = ['nombre'];

	public function lounges(){
    	return $this->belongsToMany(Lounge::class);
    }

    public function professionals(){
    	return $this->belongsToMany(Professional::class);
    }

    public function combos(){
    	return $this->belongsToMany(Combo::class);
    }
}
