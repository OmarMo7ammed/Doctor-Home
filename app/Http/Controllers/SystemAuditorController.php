<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\Clinical;
use Illuminate\Http\Request;
use App\Models\SystemAuditor;
use Illuminate\Support\Facades\Hash;

class SystemAuditorController extends Controller
{

    public function DoctorShow(){
        $system_auditors = Doctor::all()->where('Acceptance' ,'=', 0);
        return response()->json($system_auditors);
    }
    
    public function ClinicalShow(){
        $system_auditors = Clinical::all()->where('Acceptance' ,'=', 0);
        return response()->json($system_auditors);
    }

    public function DoctorEditShow(){
        $system_auditors = Doctor::all()->where('Acceptance_Edit' ,'=', 0);
        return response()->json($system_auditors);
    }
    
    public function ClinicalEditShow(){
        $system_auditors = Clinical::all()->where('Acceptance_Edit' ,'=', 0);
        return response()->json($system_auditors);
    }

    public function AcceptanceDoctor(Request $request,$id){
        $doctors = Doctor::FindOrFail($id);

        $doctors->Acceptance                = $request->Acceptance;
        $doctors->save();
        return response()->json($doctors);
    }    
    
    public function AcceptanceEditDoctor(Request $request,$id){
        $doctors = Doctor::FindOrFail($id);

        $doctors->Acceptance_Edit           = $request->Acceptance_Edit;
        $doctors->save();
        return response()->json($doctors);
    }
    
    public function AcceptanceClinical(Request $request,$id){
        $clinicals = Clinical::FindOrFail($id);

        $clinicals->Acceptance                = $request->Acceptance;
        $clinicals->save();
        return response()->json($clinicals);
    }    
    
    public function AcceptanceEditClinical(Request $request,$id){
        $clinicals = Clinical::FindOrFail($id);

        $clinicals->Acceptance_Edit           = $request->Acceptance_Edit;
        $clinicals->save();
        return response()->json($clinicals);
    }

}
