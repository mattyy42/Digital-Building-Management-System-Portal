<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class complain extends Model
{
    //
    protected $fillable=['applicant_id','application_id','buildingOfficer_id','complain','status'];
    public function application()
    {
        # code...
        return $this->hasOne(Application::class);
    }
}
