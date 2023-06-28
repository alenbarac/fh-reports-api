<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceResource extends JsonResource
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
            'provinceName' => $this->province_name,
            'isActive' => $this->is_active,
            'columns' => [
                'label1' => $this->column_label_1,
                'label2' => $this->column_label_2,
                'label3' => $this->column_label_3,
                'label4' => $this->column_label_4,
                'label5' => $this->column_label_5,
                'label6' => $this->column_label_6,
                'label7' => $this->column_label_7,
                'label8' => $this->column_label_8,
                'label9' =>  $this->column_label_9,
                'label10' => $this->column_label_10,
                'label11' => $this->column_label_11,
                'label12' => $this->column_label_12,
               
            ],
             'regions' => RegionResource::collection($this->whenLoaded('regions')),    
           
        ];
    }
}