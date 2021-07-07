<?php

namespace App\Http\Resources;

use App\ConstructionLocation;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'applicant'=>new UserResource($this->applicant),
            'buildingOfficer'=>new UserResource($this->buildingOfficer),

            'location'=>new ConstructionLocationResource($this->location),
            'consultingFirm'=>new ConsultingFirmResource($this->consultingFirm),
            'constructionType'=>new ConstructionTypeResource($this->constructionType),
            'appointment'=>new AppointmentResource($this->appointment), 
        ];
    }
}
