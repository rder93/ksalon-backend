<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndepentService extends Model
{
	protected $table = 'indepents_services';
    protected $fillable = ['indepent_id', 'service_id', 'precio'];
}
