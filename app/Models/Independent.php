<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Independent extends Model
{
    protected $fillable = ['user_id'];

    public function services(){
    	return $this->belongsToMany(Service::class);
    }
}
