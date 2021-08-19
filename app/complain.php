<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class complain extends Model
{
    //
    protected $fillable=['applicant_id','application_id','complain','status','BOA_id'];
    public function application()
    {
        # code...
        return $this->belongsTo(Application::class);
    }
    public function user()
    {
        # code...
        return $this->hasMany(User::class);
    }
    public function role()
    {
        # code...
        return $this->belongsTo(User::class);
    }
    public function applicant(){
        return $this->belongsTo(User::class,'applicant_id');
    }

    public function board(){
        return $this->belongsTo(User::class,'BOA_id');
    }
}
