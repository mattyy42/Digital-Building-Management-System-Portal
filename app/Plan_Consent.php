<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan_Consent extends Model
{
    //
    protected $fillable=['applicant_id','city','sub_city',
    'new_woreda','street_address','house_number','ownership_authentication_number'
    ,'ownership_authentication_type','ownership_authentication_issued_date','name_stated_on_ownership_authentication',
    'previous_service','status','type_of_construction','application_id','application_issued_date','ground_floor_number',
    'owner_full_name','reperesentative_full_name','phone_number','mobile_number','TIN_number','bureau','buildingOfficer_id'];
    public function application()
    {
        # code...
        return $this->hasOne(application::class);
    }
    public function Plan_Consent_BO()
    {
        # code...
        return $this->hasOne(Plan_Consent_BO::class);
    }
    public function buildingOfficer(){
        return $this->belongsTo(User::class,'buildingOfficer_id');
    }
    public function applicant(){
        return $this->belongsTo(User::class,'applicant_id');
    }
}
