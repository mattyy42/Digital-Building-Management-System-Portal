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
<<<<<<< HEAD
            'buildingOfficer_id'=>$this->buildingOfficer_id,
=======
            'bureau'=>$this->bureau,
>>>>>>> 40809b982ecac6519b8a89cfba5675e44f487ffa
            'applicant'=>new UserResource($this->applicant),
            'buildingOfficer'=>new UserResource($this->buildingOfficer),

            'location'=>new ConstructionLocationResource($this->location),
            'consultingFirm'=>new ConsultingFirmResource($this->consultingFirm),
            'constructionType'=>new ConstructionTypeResource($this->constructionType),
            'appointment'=>new AppointmentResource($this->appointment), 
        ];
    }
}
