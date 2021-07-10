<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan_Consent extends Model
{
    //
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
}
