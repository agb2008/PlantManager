<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PositionsResource extends JsonResource
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
            'posX' => $this->posX,
            'posY' => $this->posY,
            'plant_id' => $this->plant_id,
            'img_id' => $this->img_id,
            'user_id' => $this->user_id,
            'notes' => $this->notes,
            'date' => $this->date,
            'createdAt' => $this->created_at->diffForHumans(),
            'updatedAt' => $this->updated_at->diffForHumans(),
        ];
    }
}
