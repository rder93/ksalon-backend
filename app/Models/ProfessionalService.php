<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Professional;
use App\Models\Service;

class ProfessionalService extends Model
{
    protected $fillable = ['professional_id','service_id'];

    protected $table= 'professionals_services';
    protected $primarykey = 'id';

    public function professional()
    {
        return $this->belongsTo(Professional::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

}
