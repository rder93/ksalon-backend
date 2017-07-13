<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Professional;
use App\Models\Product;
use App\Models\Combo;
use App\Models\Service;

class Lounge extends Model
{
	protected $fillable = ['nombre', 'tipo', 'direccion'];

    public function category(){
    	return $this->belongsTo(Category::class);
    }

    public function products(){
    	return $this->hasMany(Product::class);
    }

    public function services(){
    	return $this->belongsToMany(Service::class);
    }
}
