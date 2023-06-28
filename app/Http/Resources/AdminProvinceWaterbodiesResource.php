<?php

namespace App\Http\Resources;

use App\Models\Region;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminProvinceWaterbodiesResource extends ResourceCollection
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
      "rows"     => ProvinceWaterbodiesGridResource::collection($this->collection),
    ];
  }
}
