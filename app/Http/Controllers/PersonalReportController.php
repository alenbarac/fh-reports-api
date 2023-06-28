<?php

namespace App\Http\Controllers;

use App\Http\Resources\PersonalReportResource;
use App\Http\Resources\PersonalReportsGridResource;
use Illuminate\Support\Facades\Validator;
use App\Models\PersonalReport;
use Illuminate\Http\Request;

class PersonalReportController extends Controller
{
    public function index()
    {
        $personal_reports = PersonalReport::with(['waterbody.region'])->orderBy('report_date', 'desc')->get();

        return new PersonalReportsGridResource($personal_reports);
    }

    public function getUnapprovedReports()
    {
        $personal_reports = PersonalReport::with(['waterbody.region'])->where('report_approved', false)->orderBy('report_date', 'desc')->get();

        return new PersonalReportsGridResource($personal_reports);
    }

    public function update(Request $request, $id)
    {
        //validate request
        $validator = Validator::make($request->all(), [
            'poster_name' => 'required',
            'poster_email' => 'required|email',
            'poster_message' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $personal_report = PersonalReport::find($id);

        $personal_report->poster_name = $request->poster_name;
        $personal_report->poster_email = $request->poster_email;
        $personal_report->poster_message = $request->poster_message;
        $personal_report->report_approved = $request->report_approved;

        $personal_report->save();

        return response()->json(['Personal Report updated successfully.']);
    }

    public function destroy($id)
    {
        $personal_report = PersonalReport::find($id);
        $personal_report->delete();

        return response()->json(['Personal Report deleted successfully.']);
    }
}


