<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Service;

class IndependentService extends Model
{
	protected $table = 'independents_services';
    protected $fillable = ['independent_id', 'service_id', 'precio'];

    public function independent(){
    	return $this->belongsTo(User::class);
    }

    public function service(){
    	return $this->belongsTo(Service::class);
    }
}
