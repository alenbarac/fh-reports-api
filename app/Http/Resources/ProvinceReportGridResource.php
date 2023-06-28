<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceReportGridResource extends JsonResource
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
            'waterbodyName' => $this->waterbody_name,
            'regionName' =>  $this->region->region_name, 
        ];

        if ($this->latestReport->toArray()) {
            foreach($this->latestReport->toArray() as $key => $property) {
                $row_data[$key] = $property;
            }
        }

        return $row_data;
    }
}