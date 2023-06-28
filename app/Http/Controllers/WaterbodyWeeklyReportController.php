<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Waterbody;
use Illuminate\Http\Request;

class WaterbodyWeeklyReportController extends Controller
{

    public function storeWaterbodyWeeklyReport(Request $request)
    {
        $weekly_report = new Report([
            'user_id' =>  $request->user()->id,
            'report_date' => $request->report_date,
            'column_value_1' => $request->column_value_1,
            'column_value_2' => $request->column_value_2,
            'column_value_3' => $request->column_value_3,
            'column_value_4' => $request->column_value_4,
            'column_value_5' => $request->column_value_5,
            'column_value_6' => $request->column_value_6,
            'column_value_7' => $request->column_value_7,
            'column_value_8' => $request->column_value_8,
            'column_value_9' => $request->column_value_9,
            'column_value_10' => $request->column_value_10,
            'column_value_11' => $request->column_value_11,
            'column_value_12' => $request->column_value_12,
        ]);

        $waterbody = Waterbody::find($request->waterbody_id);
        $waterbody->reports()->save($weekly_report);
        return response()->json(['Waterbody Report created successfully.']);
    }

    public function updateWaterbodyWeeklyReport(Request $request, $id)
    {
        $weekly_report = Report::find($id);

        $weekly_report->report_date = $request->report_date;
        $weekly_report->column_value_1 = $request->column_value_1;
        $weekly_report->column_value_2 = $request->column_value_2;
        $weekly_report->column_value_3 = $request->column_value_3;
        $weekly_report->column_value_4 = $request->column_value_4;
        $weekly_report->column_value_5 = $request->column_value_5;
        $weekly_report->column_value_6 = $request->column_value_6;
        $weekly_report->column_value_7 = $request->column_value_7;
        $weekly_report->column_value_8 = $request->column_value_8;
        $weekly_report->column_value_9 = $request->column_value_9;
        $weekly_report->column_value_10 = $request->column_value_10;
        $weekly_report->column_value_11 = $request->column_value_11;
        $weekly_report->column_value_12 = $request->column_value_12;


        $weekly_report->save();

        return response()->json(['Waterbody Report updated successfully.']);
    }


    public function deleteWaterbodyWeeklyReport($id)
    {
        $weekly_report = Report::find($id);

        $weekly_report->delete();

        return response()->json(['Waterbody Report deleted successfully.']);
    }
}
