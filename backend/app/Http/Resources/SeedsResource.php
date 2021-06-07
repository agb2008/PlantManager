<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class SeedsResource extends JsonResource
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
            'name' => $this->name,
            'number_of_seeds' => $this->number_of_seeds,
            'amount' => $this->amount,
            'type_id' => $this->type_id,
            'manufacturer_id' => $this->manufacturer_id,
            'production_date' => $this->production_date,
            'expiration_date' => $this->expiration_date,
            'harvest_date' => $this->harvest_date,
            'notes' => $this->notes,
            'price' => $this->price,
            'img_id' => $this->img_id,
            'user_id' => $this->user_id,
            'createdAt' => $this->created_at->diffForHumans(),
            'updatedAt' => $this->updated_at->diffForHumans(),
        ];
    }
}
