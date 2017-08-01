<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LoungeService;
use App\Models\ComboLounge;

class DetailLoungeCombo extends Model
{
    protected $fillable = ['combo_lounge_id','lounge_service_id'];

    protected $table= 'detail_lounge_combos';
    protected $primarykey = 'id';

    public function lounge_service()
    {
        return $this->belongsTo(LoungeService::class);
    }

    public function combo()
    {
    	return $this->belongsTo(ComboLounge::class);
    }
}
