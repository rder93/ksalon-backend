<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Lounge;
use App\Models\Professional;
use App\Models\Service;

class Combo extends Model
{
	protected $fillable = ['nombre'];

	public function lounges(){
    	return $this->belongsToMany(Lounge::class);
    }

    public function professionals(){
    	return $this->belongsToMany(Professional::class);
    }

    public function services(){
    	return $this->belongsToMany(Service::class);
    }
    
}
