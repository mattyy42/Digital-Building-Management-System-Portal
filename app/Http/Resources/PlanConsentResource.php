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
            'bureau' => $this->bureau,
            'applicant' => new UserResource($this->applicant),
            'buildingOfficer' => new UserResource($this->buildingOfficer),
            'status' => $this->status,
        ];
    }
}
