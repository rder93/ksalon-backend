<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\professionals;

class Certificate extends Model
{
    protected $fillable = ['nombre','professional_id','foto'];
    

    public function professionals()
    {
        return $this->belongsTo(professionals::class);
    }
}
