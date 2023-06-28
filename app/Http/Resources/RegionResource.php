<?php

namespace App\Http\Resources;

use App\Http\Resources\WaterBodiesResource;
use App\Models\Waterbody;
use Illuminate\Http\Resources\Json\JsonResource;

class RegionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'regionName' => $this->region_name,
            'province' => ProvinceResource::make($this->whenLoaded('province')),
            'waterbodies' => WaterbodyResource::collection($this->whenLoaded('waterbodies')),

        ];
    }
}