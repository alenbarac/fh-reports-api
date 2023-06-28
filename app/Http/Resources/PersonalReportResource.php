<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonalReportResource extends JsonResource
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
            'provinceName' => $this->waterbody->region->province->province_name,
            'regionName' => $this->waterbody->region->region_name,
            'waterbodyName' => $this->waterbody->waterbody_name,
            'posterName' =>  $this->poster_name,
            'posterEmail' =>  $this->poster_email,
            'posterMessage' =>  $this->poster_message,
            'reportApproved' => $this->report_approved,
            'reportDate' => date('d.m.Y.', strtotime($this->report_date))     
        ];

        return $row_data;
    }
}
