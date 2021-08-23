<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Resources;
class Application extends Model
{
    protected $fillable=['application_stutus','applicant_id','buildingOfficer_id','bureau','revit_file'];

    public function applicant(){
        return $this->belongsTo(User::class,'applicant_id');
    }
    public function buildingOfficer(){
        return $this->belongsTo(User::class,'buildingOfficer_id');
    }
    public function location(){
        return $this->hasOne(ConstructionLocation::class);
    }
    public function consultingFirm(){
        return $this->hasOne(ConsultingFirm::class);
    }
    public function constructionType(){
        return $this->hasOne(ConstructionType::class);
    }
    public function complain(){
        return $this->hasOne(complain::class); 
     }
     public function appointment()
     {
         return $this->hasOne(appointment::class);
     }
     public function Plan_Consent()
     {
         # code...
         return $this->belongsTo(Plan_Consent::class);
     }
    
}
