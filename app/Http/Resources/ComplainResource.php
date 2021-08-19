<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComplainResource extends JsonResource
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
            'complain'=> $this->complain,
            'applicant' => new UserResource($this->applicant),
            'board' => new UserResource($this->board),    
        ];
        
    }
}
