<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\User;

class Independent extends Model
{
    protected $fillable = ['user_id'];

    public function services(){
    	return $this->belongsToMany(Service::class, 'independents_services');
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
