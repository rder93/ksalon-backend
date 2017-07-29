<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professional extends Model
{
	protected $fillable = ['nombre', 'foto', 'identificacion', 'lounge_id'];

	public function lounge()
    {
        return $this->belongsTo(lounge::class);
    }
    
}
