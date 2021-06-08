<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;


class SeedlingResource extends JsonResource
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
            'type_id' => $this->type_id,
            'manufacturer_id' => $this->manufacturer_id,
            'amount' => $this->amount,
            'img_id' => $this->img_id,
            'notes' => $this->notes,
            'price' => $this->price,
            'purchase_date' => $this->purchase_date,
            'plant_date' => $this->plant_date,
            'seeds_id' => $this->seeds_id,
            'user_id' => $this->user_id,
            'createdAt' => $this->created_at->diffForHumans(),
            'updatedAt' => $this->updated_at->diffForHumans(),
        ];
    }
}
