<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Combo;
use App\Models\Product;
use App\Models\Professional;
use App\Models\Service;
use App\Models\User;

class Lounge extends Model
{
	protected $fillable = ['nombre','latitud','altitud','user_id','category_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
