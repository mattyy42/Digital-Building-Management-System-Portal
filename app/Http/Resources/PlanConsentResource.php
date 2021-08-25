<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanConsentResource extends JsonResource
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
            'id' => $this->id,
            'sub_city' => $this->sub_city,
            'applicant' => new UserResource($this->applicant),
            'buildingOfficer' => new UserResource($this->buildingOfficer),
            'status' => $this->status,
            'phone_number'=> $this->phone_number,
            'comment'=>$this->comment_BO,
        ];
    }
}
