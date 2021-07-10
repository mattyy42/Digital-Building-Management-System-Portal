<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan_Consent_BO extends Model
{
    //
    public function Plan_Consent()
    {
        # code...
        return $this->belongsTo(Plan_Consent::class);
    }
    public function user()
    {
        # code...
        return $this->belongsTo(Plan_Consent_BO::class);
    }
}
