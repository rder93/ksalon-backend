<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Independent;
use App\Models\Service;

class IndependentService extends Model
{
	protected $table = 'independents_services';
    protected $fillable = ['indepent_id', 'service_id', 'precio'];

    public function independiente(){
    	return $this->belongsTo(Independent::class);
    }

    public function servicio(){
    	return $this->belongsTo(Service::class);
    }
}
