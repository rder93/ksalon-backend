<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComboLounge extends Model
{
    protected $fillable = ['descripcion','precio','lounge_id'];

    protected $table= 'combos_lounges';
    protected $primarykey = 'id';

    public function lounge()
    {
        return $this->belongsTo(lounge::class);
    }

}
