<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lounge;
class Product extends Model
{
	protected $fillable = ['nombre', 'precio','descripcion', 'lounge_id'];
    
    public function lounge(){
    	return $this->belongsTo(Lounge::class);
    }
}
