<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\IndependentService;
use App\Models\ComboProfessional;

class DetailProfessionalCombo extends Model
{
    protected $fillable = ['combo_professional_id','professional_service_id'];

    protected $table= 'detail_profesional_combos';
    protected $primarykey = 'id';

    public function professional_service()
    {
        return $this->belongsTo(IndependentService::class);
    }

    public function combo()
    {
    	return $this->belongsTo(ComboProfessional::class);
    }
}
