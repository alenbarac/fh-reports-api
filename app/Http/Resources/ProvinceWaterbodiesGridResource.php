<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceWaterbodiesGridResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request)
  {
    $row_data = [
      'id' => $this->id,
      'waterbodyName' => $this->waterbody_name,
      'latitude' =>  $this->latitude,
      'longitude' =>  $this->longitude,
      'regionName' =>  $this->region->region_name, 
      'regionId' =>  $this->region_id, 
      'waterbodyUnlisted' => boolval($this->waterbody_unlisted),
      'provinceName' => $this->region->province->province_name  
    ];

    return $row_data;
  }
}
