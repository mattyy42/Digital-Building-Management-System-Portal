<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name','user_id','bureau','BOA_id'];
    public function user(){
        return $this->belongsTo(User::class);
    } 
    public function complain()
    {
        # code...
        return $this->hasMany(User::class);
    }
}
