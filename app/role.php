<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name','user_id','bureau'];
    public function user(){
        return $this->belongsTo(User::class);
    } 
    public function complain()
    {
        # code...
        return $this->belongsTo(User::class);
    }
}
