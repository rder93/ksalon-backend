<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
	protected $fillable = ['nombre', 'foto', 'direccion', 'user_id'];
    
}
