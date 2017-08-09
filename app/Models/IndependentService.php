<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Service;

class IndependentService extends Model
{
	protected $table = 'independents_services';
    protected $fillable = ['user_id', 'service_id', 'precio', 'descripcion', 'foto'];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function service(){
    	return $this->belongsTo(Service::class);
    }
}
