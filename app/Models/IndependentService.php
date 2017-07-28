<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use App\Models\User;

class IndependentService extends Model
{

	protected $fillable = ['independent_id', 'service_id', 'precio'];

	protected $table = 'independents_services';

	public function independent()
    {
        return $this->belongsTo(User::class);
    }
    
=======
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
>>>>>>> origin/master
}
