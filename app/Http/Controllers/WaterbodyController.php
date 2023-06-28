<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminProvinceWaterbodiesResource;
use Illuminate\Http\Request;

use App\Models\Waterbody;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\WaterbodyReportGridResource;
use App\Models\Region;


class WaterbodyController extends Controller
{

    public function getWaterbodiesByProvince($id)
    {
        $collection_data = Waterbody::with(['region.province'])
            ->whereHas('region', function ($q) use ($id) {
                $q->whereIn('province_id', [$id]);
            })->get();

        return new AdminProvinceWaterbodiesResource($collection_data);
    }

    public function getUnlistedWaterbodies()
    {
        $collection_data = Waterbody::with(['region.province'])
        ->where('waterbody_unlisted', '=', true)    
        ->get();

        return new AdminProvinceWaterbodiesResource($collection_data);
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showWaterbodyReport($id)
    {
        $collection_data = Waterbody::with(['region.province','reports', 'personalReports'])
           
             ->whereHas('region', function ($q) {
            })

            ->whereId($id)->get();

       return new WaterbodyReportGridResource($collection_data);
       
    
    }



    public function storeProvinceWaterbody(Request $request)
    {
        //validate request
        $validator = Validator::make($request->all(), [
            'waterbody_name' => 'required',     

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $waterbody = new Waterbody([
            'waterbody_name' => $request->waterbody_name,
            'longitude' => floatval($request->longitude),
            'latitude' => floatval($request->latitude),
            'waterbody_unlisted' => $request->waterbody_unlisted,
        ]);

        $region = Region::find($request->region_id);
        $region->waterbodies()->save($waterbody);

        return response()->json(['Waterbody created successfully.']);
    }

    public function updateProvinceWaterbody(Request $request, $id)
    {
        //validate request
        $validator = Validator::make($request->all(), [
            'waterbody_name' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $province_waterbody = Waterbody::find($id);

        $province_waterbody->region_id = $request->region_id;
        $province_waterbody->waterbody_name = $request->waterbody_name;
        $province_waterbody->longitude = $request->longitude;
        $province_waterbody->latitude = $request->latitude;
        $province_waterbody->waterbody_unlisted = $request->waterbody_unlisted;

        $province_waterbody->save();

        return response()->json(['Waterbody updated successfully.']);
    }


     public function storeUnlistedWaterbody(Request $request)
    {
        //validate request
        $validator = Validator::make($request->all(),[
            'waterbody_name' => 'required',
            'created_name' => 'required',
            'created_email' => 'required|email',
            'waterbody_report' => 'required',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $unlisted_waterbody = new Waterbody([
            'waterbody_name' => $request->waterbody_name,
            'created_email' => $request->created_email,
            'created_name' => $request->created_name,
            'waterbody_report' => $request->waterbody_report,
            'waterbody_unlisted' => 1,
         ]);
        
        $region = Region::find($request->region_id);
        $region->waterbodies()->save($unlisted_waterbody); 

        return response()->json(['Unlisted waterbody created successfully.']);
    }

    public function destroy($id)
    {
        $waterbody = Waterbody::find($id);
        $waterbody->delete();

        return response()->json(['Waterbody deleted successfully.']);
    }
}