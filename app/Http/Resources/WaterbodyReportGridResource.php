<?php

namespace App\Http\Resources;

use App\Models\PersonalReport;
use Illuminate\Http\Resources\Json\ResourceCollection;
class WaterbodyReportGridResource extends ResourceCollection
{
  private $waterbody_name;
  private $region_name;
  private $province_name;
  private $province_id;
  private $personal_reports;

    private function getColumns() {
       $columns = [
            [
                "name"  => "report_date",
                "title" => "Report date",
            ],
           
        ];

        $report = $this->collection->first();
        $province = $report ? $report->region->province->toArray() : null;

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
      if(!empty($this->collection->first()->waterbody_name)) {
        $this->waterbody_name = $this->collection->first()->waterbody_name;
      }

      if(!empty($this->collection->first()->region->region_name)) {
        $this->region_name = $this->collection->first()->region->region_name;
      }

       if(!empty($this->collection->first()->region->province->province_name)) {
        $this->province_name = $this->collection->first()->region->province->province_name;
      }

      if(!empty($this->collection->first()->region->province->id)) {
        $this->province_id = $this->collection->first()->region->province->id;
      }
      
      if(!empty($this->collection->first()->personalReports)) {
            $this->personal_reports = $this->collection->first()->personalReports
                                    ->where('report_approved', true);
      }
 
        return [
            'waterbodyName' => $this->waterbody_name ? $this->waterbody_name : null,
            'regionName' =>  $this->region_name ? $this->region_name : null, 
            'provinceName' => $this->province_name ? $this->province_name : null, 
            'provinceID' => $this->province_id ? $this->province_id : null,
             "columns"  => $this->getColumns(),
             "rows" =>  $this->collection->first() ? $this->collection->first()->reports->toArray() : null,
             'personalReports' => $this->personal_reports ? $this->personal_reports : null,
        ];
    }

}