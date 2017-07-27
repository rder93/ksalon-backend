<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndependentService extends Model
{
	protected $table = 'indepents_services';
    protected $fillable = ['indepent_id', 'service_id', 'precio'];
}
