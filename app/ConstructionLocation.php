<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConstructionLocation extends Model
{
    protected $fillable=['city','sub_city','wereda/kebele','special_name','house_number','application_id'];

    public function application(){
       return $this->belongsTo(Application::class); 
    }
}
