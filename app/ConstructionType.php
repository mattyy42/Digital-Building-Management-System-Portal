<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConstructionType extends Model
{
    protected $fillable = ['construction_condition', 'construction_type', 'estimated_cost', 'number_of_floor', 'ground_floor_number', 'building_height', 'ground_building_height', 'application_id'];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
}
