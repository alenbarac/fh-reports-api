<?php

namespace App\Http\Resources;

use App\Models\Region;
use App\Models\Province;
use App\Http\Resources\HomeReportGridResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProvinceReportsGridResource extends ResourceCollection
{

    
    private function getColumns() {
       $columns = [
            [
                "name"  => "waterbodyName",
                "title" => "Waterbody",
            ],
            [
                "name"  => "regionName",
                "title" => "Region",
            ],
        ];

        $report = $this->collection->first();
        $province =  $report ?  $report->region->province->toArray() : null;

        if ($province) {
            foreach($province as $key => $prop) {
               if (strpos($key, 'column') !== false && $prop) {
                    $columns[] = [
                        "name" => str_replace('label', 'value', $key),
                        "title" => $prop,
                    ];
                }
            }
        }

        return $columns;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $province_id =  $this->collection->first() ? $this->collection->first()->region->province->id : null;
        $province_name =  $this->collection->first() ? $this->collection->first()->region->province->province_name : null;
        $regions = Region::where('province_id', $province_id)->get();
      
        return [     
            "rows"     => ProvinceReportGridResource::collection($this->collection),
            "columns"  => $this->getColumns(),
            "regions" => $regions,
            "provinceName" => $province_name
        ];
    }

}