<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class appointment extends Model
{
    //
    protected $fillable = ['appointment_time','application_id'];
    public function Application()
    {
        # code...
        return $this->belongsTo(Application::class);
    }
}
