<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultingFirm extends Model
{
    protected $fillable=['name','application_id','address','phone_number','level'];
    public function application(){
        return $this->belongsTo(Application::class); 
     }
}
