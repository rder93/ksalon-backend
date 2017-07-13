<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Lounge;

class Category extends Model
{
	protected $fillable = ['nombre'];
    
    public function lounges(){
		return $this->hasMany(Lounge::class);
    }
}
