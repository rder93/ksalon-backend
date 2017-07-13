<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
	protected $fillable = ['puntaje', 'comentario', 'transaction_id'];
    
}
