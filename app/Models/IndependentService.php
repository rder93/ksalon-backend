<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class IndependentService extends Model
{

	protected $fillable = ['independent_id', 'service_id', 'precio'];

	protected $table = 'independents_services';

	public function independent()
    {
        return $this->belongsTo(User::class);
    }
    
}
