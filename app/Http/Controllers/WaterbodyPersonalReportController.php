<?php

namespace App\Http\Controllers;

use App\Models\PersonalReport;
use App\Models\Waterbody;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class WaterbodyPersonalReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate request
        $validator = Validator::make($request->all(),[
            'poster_name' => 'required',
            'poster_email' => 'required|email',
            'poster_message' => 'required',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $personal_report = new PersonalReport([
            'poster_name' => $request->poster_name,
            'poster_email' => $request->poster_email,
            'poster_message' => $request->poster_message,
            'report_approved' => 0,
            'report_date' =>  Carbon::now()
         ]);
        
        $waterbody = Waterbody::find($request->waterbody_id);
        $waterbody->personalReports()->save($personal_report); 

        return response()->json(['Personal Report created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}