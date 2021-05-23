<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable=['application_stutus','applicant_id','buildingOfficer_id'];

    public function applicant(){
        return $this->belongsTo(User::class,'applicant_id');
    }
    public function buildingOfficer(){
        return $this->belongsTo(User::class);
    }
    
}
