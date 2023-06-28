<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminRegionController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return $regions;
    }
    public function create(Request $request)
    {
        //validate request
        $validator = Validator::make($request->all(), [
            'region_name' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $province = Province::find($request->province_id);
 

        $region = new Region();
        $region->region_name = $request->region_name;

        $province->regions()->save($region);

        return response()->json(['Region Created successfully.']);
    }

    public function update(Request $request, $region_id)
    {
        //validate request
        $validator = Validator::make($request->all(), [
            'region_name' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
       
        Region::where('id', $region_id)->update($request->all());
        
        return response()->json(['Region Updated successfully.']);
    }

    public function destroy($id)
    {
        $region = Region::find($id);
        $region->delete();

        return response()->json(['Region deleted successfully.']);
    }

}
