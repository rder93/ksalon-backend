<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lounge;
class Products extends Model
{
	protected $fillable = ['nombre', 'precio'];
    
    public function lounge(){
    	return $this->belongsTo(Lounge::class);
    }
}
