<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminProvinceResource extends ResourceCollection
{


  private function getColumns()
  {
    $columns = [
      [
        "name"  => "provinceName",
        "title" => "Province Name",
      ],
      [
        "name"  => "isActive",
        "title" => "Active",
      ],
    ];

    $province_collection = $this->collection->first();
    $province =  $province_collection ?  $province_collection->toArray() : null;

    if ($province) {
      foreach ($province as $key => $prop) {
        if (strpos($key, 'column') !== false) {
          $columns[] = [
            "name" =>  $this->dashesToCamelCase($key),
            "title" => str_replace('_', ' ', ucwords($key)),
          ];
        }
      }
    }


    return $columns;
  }

  private function getProvinceData() 
  {
    $province_collection = $this->collection->first();
    $province =  $province_collection ?  $province_collection->toArray() : null;

    $row_data = [
      'id' => $province['id'],
      'provinceName' => $province['province_name'],
      'isActive' => $province['is_active'],
      'columnLabel1' => $province['column_label_1'],
      'columnLabel2' => $province['column_label_2'],
      'columnLabel3' =>  $province['column_label_3'],
      'columnLabel4' =>  $province['column_label_4'],
      'columnLabel5' =>  $province['column_label_5'],
      'columnLabel6' => $province['column_label_6'],
      'columnLabel7' => $province['column_label_7'],
      'columnLabel8' => $province['column_label_8'],
      'columnLabel9' => $province['column_label_9'],
      'columnLabel10' => $province['column_label_10'],
      'columnLabel11' => $province['column_label_11'],
      'columnLabel12' => $province['column_label_12'],
    ];

    return $row_data;
}

  public function dashesToCamelCase($string, $capitalizeFirstCharacter = false) 
  {
      $str = str_replace('_', '', ucwords($string, '_'));
      if (!$capitalizeFirstCharacter) {
          $str = lcfirst($str);
      }
      return $str;
  }

  /**
   * Transform the resource collection into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
   */
  public function toArray($request)
  {
    $province_data =  $this->collection->first() ? $this->collection->first()->toArray() : null;

    return [
      "provinces"     => $this->getProvinceData(),
      "regions"  => $province_data['regions'], 
    ];
  }
}
