<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminProvinceResource;
use App\Http\Resources\ProvinceReportsGridResource;
use App\Http\Resources\ProvincesResource;
use App\Models\PersonalReport;
use Illuminate\Support\Facades\Validator;
use App\Models\Province;
use App\Models\Waterbody;
use Illuminate\Http\Request;


class AdminProvinceController extends Controller
{

    public function index()
    {
        $provinces = Province::with(['regions.waterbodies.reports'])->orderBy('province_name')->get();
        return new ProvincesResource($provinces);
    }

    public function show($id)
    {
        $collection_data = Province::with(['regions'])->where('id', $id)->get();

        return new AdminProvinceResource($collection_data);
    }

    public function update(Request $request, $id)
    {
        //validate request
        $validator = Validator::make($request->all(), [
            'province_name' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        Province::where('id', $id)->update($request->all());
        
        return response()->json(['Province Updated successfully.']);
    }

    public function getAdminProvinceReportData($id)
    {
        $collection_data = Waterbody::with(['region.province', 'reports'])
        ->whereHas('reports', function ($q) {
        })
            ->whereHas('region', function ($q) use ($id) {
                $q->whereIn('province_id', [$id]);
            })->get();

        return new ProvinceReportsGridResource($collection_data);
    }

    public function getProvincesUnapprovedData()
    {
        $unlisted_waterbodies = Waterbody::where('waterbody_unlisted', true)->count();
        $unapproved_reports = PersonalReport::where('report_approved', false) ->count();
 
        return response()->json([     
            'waterbodies' => $unlisted_waterbodies,
            'reports' => $unapproved_reports
            
        ]);
    }
}
