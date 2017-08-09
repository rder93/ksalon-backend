<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ComboProfessional extends Model
{
    protected $fillable = ['descripcion','precio', 'foto', 'user_id'];

    protected $table= 'combos_professionals';
    protected $primarykey = 'id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
