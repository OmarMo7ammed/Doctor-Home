<?php

namespace App\Http\Controllers;
use App\Models\WorkDays;
use Illuminate\Http\Request;

class WorkDayController extends Controller
{
    public function create(Request $request,$ClinicalId){
        $Work_days = new WorkDays();

        $Work_days->Clinical_Id          = $ClinicalId;
        $Work_days->From_Time            = $request->From_Time;
        $Work_days->To_Time              = $request->To_Time;
        $Work_days->Day                  = $request->Day;
        $Work_days->Patient_Number       = $request->Patient_Number;

        $Work_days->save();
        return response()->json($Work_days);
    }

    public function WorkClinical($ClinicalId){
        $Work_days = WorkDays::select()->where('Clinical_Id' ,'=' , $ClinicalId)->get();
        return response()->json($Work_days);
    }

    public function ShowById($id){
        $Work_days = WorkDays::FindOrFail($id);
        return response()->json($Work_days);
    }

    public function update(Request $request,$id){
        $Work_days = WorkDays::FindOrFail($id);

        $Work_days->From_Time            = $request->From_Time;
        $Work_days->To_Time              = $request->To_Time;
        $Work_days->Day                  = $request->Day;
        $Work_days->Patient_Number       = $request->Patient_Number;

        $Work_days->save();
        return response()->json($Work_days);
    }

    public function delete($id){
        $Work_days = WorkDays::FindOrFail($id);
        $Work_days->delete();
        return response()->json($Work_days);
    }
}
