<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\lounge;
use App\Models\Service;

class LoungeService extends Model
{
    protected $fillable = ['lounge_id','service_id','precio'];

    protected $table= 'lounges_services';
    protected $primarykey = 'id';

    public function lounge()
    {
        return $this->belongsTo(lounge::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
