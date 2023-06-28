<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Report;
use App\Models\Province;
use App\Models\Waterbody;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ProvincesResource;
use App\Http\Resources\WaterbodyResource;
use App\Http\Resources\ProvinceReportsGridResource;

class FrontPageController extends Controller
{
    public function getProvinces()
    {
        $provinces = Province::with(['regions.waterbodies.reports'])->where('is_active', true)->orderBy('province_name')->get();
        return new ProvincesResource($provinces);
    }
    

    public function getDefaultWaterbodies()
    {
           $defaultWaterbodyData = Province::with(['regions.waterbodies.reports'])
                        ->where('id', env('DEFAULT_LANDING_PAGE_PROVINCE', 13))
                        ->get(); 
             
        return new WaterbodyResource($defaultWaterbodyData);
    }

    public function getActiveWaterbodies()
    {
          $recent_waterbodies = Report::with(['waterbody.region'])
            ->where('updated_at','>=',Carbon::now()->subYear())->get();
        
        return new WaterbodyResource($recent_waterbodies);
    }

    // Test for seeds, all waterbodies
     public function getWaterbodies()
    {
          $demo_waterbodies = Waterbody::with(['region'])
          ->whereHas('region', function ($q) {
                $q->whereIn('province_id', [11,12,13,14,15]);
            })
            
           ->whereHas('reports') 
            ->get();

            $ids = [];
            foreach($demo_waterbodies as $key=>$value) {
                $ids[] = $value->id;
            }
            $collection = Waterbody::with('personalReports')
            ->whereIn('id', $ids)
            ->where('waterbody_unlisted', '=', false)
            ->get();
            return response($collection);
    }

     public function getProvinceReportData($id)
    {
        $collection_data = Waterbody::with(['region.province','reports'])
            ->whereHas('reports', function ($q) {
            })
            ->whereHas('region', function ($q) use($id) {
                $q->whereIn('province_id', [$id]);
            })->get();

        return new ProvinceReportsGridResource($collection_data);
    }

    public function getWaterbodiesByLocation($lat, $lng)
    {
        
        $radius =  env('DEFAULT_RADIUS', 100);

        $waterbodies_collection = DB::table('waterbodies')
        
            ->selectRaw("*,
                        ( 6371 * acos( cos( radians(" . $lat . ") ) *
                        cos( radians(latitude) ) *
                        cos( radians(longitude) - radians(" . $lng . ") ) + 
                        sin( radians(" . $lat . ") ) *
                        sin( radians(latitude) ) ) ) 
                        AS distance")
            ->having("distance", "<", $radius)
            ->orderBy("distance")
            ->get();
           return response($waterbodies_collection);
    }

}