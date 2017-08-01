<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProfessionalService;
use App\Models\ComboProfessional;

class DetailProfessionalCombo extends Model
{
    protected $fillable = ['combo_professional_id','professional_service_id'];

    protected $table= 'detail_professional_combos';
    protected $primarykey = 'id';

    public function professional_service()
    {
        return $this->belongsTo(ProfessionalService::class);
    }

    public function combo()
    {
    	return $this->belongsTo(ComboProfessional::class);
    }
}
