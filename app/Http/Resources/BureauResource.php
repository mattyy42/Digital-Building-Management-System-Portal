<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BureauResource extends JsonResource
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
            'id'=>$this->id,
            'bureau' => $this->Bureau,
            'subcity' => $this->subcity,
        ];
    }
}
