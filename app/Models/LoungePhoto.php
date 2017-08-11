<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoungePhoto extends Model
{
    protected $fillable = ['foto','lounge_id'];

    protected $table= 'lounges_photos';
    protected $primarykey = 'id';

    public function lounge()
    {
        return $this->belongsTo(lounge::class);
    }
}
