<?php

namespace App\Http\Controllers;

use App\Models\Clinical;
use App\Models\ReservationClinical;
use App\Models\WorkDays;
use Illuminate\Http\Request;

class ClinicalController extends Controller
{

      public function create(Request $request , $id){
        $Clinicals = new Clinical();

        if($request->Photo){
          $imagePhoto = time().$request->file('Photo')-> getClientOriginalName();
          $path = $request->file('Photo')->storeAs('images',$imagePhoto,'public');
          $Clinicals->Photo     = '/storage/'.$path;
          }
        $imageWorkPermit = time().$request->file('Photo_Work_Permit')-> getClientOriginalName();
            
            $path = $request->file('Photo_Work_Permit')->storeAs('images',$imageWorkPermit,'public');
            $Clinicals->Photo_Work_Permit     = '/storage/'.$path; 
        
        $Clinicals->Clinical_Name           = $request->Clinical_Name;
        $Clinicals->Name_Department         = $request->Name_Department;
        $Clinicals->Address                 = $request->Address;
        $Clinicals->Details                 = $request->Details;
        $Clinicals->Phone_Number            = $request->Phone_Number;
        $Clinicals->Service_Price           = $request->Service_Price;
        $Clinicals->Acceptance              = 0;
        $Clinicals->Doctor_Id               = $id;
        $Clinicals->save();

        if($request->From_Time && $request->To_Time){

        // foreach($request->all() as $From_Time){
        
        $Clinicals->workDays()->create([

          'Clinical_Id'    =>     $Clinicals->id,
          'From_Time'      =>     $request->From_Time,
          'To_Time'        =>     $request->To_Time,
          'Day'            =>     $request->Day,
          'Patient_Number' =>     $request->Patient_Number,
          'Status'         =>     $request->Status

        ]);
      // }

        }
        $Clinicals->save();
        return response()->json($Clinicals);
      }

      public function ReservationShow($id){

        $clinical = Clinical::FindOrFail($id);
          return ReservationClinical::where('Status','=',0)->where('Clinical_Id','=',$id)->select(
          "reservation_clinicals.*", 
          "clinicals.Name_Department as Department",
          "patients.PName as Patient Name",
          "patients.Phone_Number as Phone_Number",
          "patients.Photo as photo")
          ->join("clinicals", "clinicals.id", "=", "reservation_clinicals.Clinical_Id")
          ->join("patients", "patients.id", "=", "reservation_clinicals.Patient_Id")->get();
        $clinical =Clinical::with('reservationClinicals')->FindOrFail($id);
        return $clinical;
    }


    public function ReservationShowDone($id){

      $clinical = Clinical::FindOrFail($id);
      return ReservationClinical::where('Status','=',1)->where('Clinical_Id','=',$id)->select(
        "reservation_clinicals.*", 
        "clinicals.Name_Department as Department",
        "patients.PName as Patient Name",
        "patients.Phone_Number as Phone_Number",
        "patients.Photo as photo"
        )
        ->join("clinicals", "clinicals.id", "=", "reservation_clinicals.Clinical_Id")
        ->join("patients", "patients.id", "=", "reservation_clinicals.Patient_Id")->get();

      $clinical =Clinical::with('reservationClinicals')->FindOrFail($id);
      return $clinical;
  }
  
      public function show($ClinicalName){
        $Clinicals = Clinical::select()->where('Acceptance','=',1)->Where('Clinical_Name','LIKE',"%{$ClinicalName}%")->get();
        return response()->json($Clinicals);
      }

      public function ShowById($id){
        $Clinicals = Clinical::FindOrFail($id)->where('clinicals.id','=',$id)->select(
          "clinicals.*", 
          "doctors.DName as Doctor_Name")
          ->join("doctors", "doctors.id", "=", "clinicals.Doctor_Id")->get();
        return response()->json($Clinicals);
      }

      public function update(Request $request ,$id){
        $Clinicals = Clinical::FindOrFail($id);

        if($request->Photo){
          $imagePhoto = time().$request->file('Photo')-> getClientOriginalName();
          $path = $request->file('Photo')->storeAs('images',$imagePhoto,'public');
          $Clinicals->Photo     = '/storage/'.$path;
          }

        $Clinicals->Clinical_Name           = $request->Clinical_Name;
        $Clinicals->Address                 = $request->Address;
        $Clinicals->Details                 = $request->Details;
        $Clinicals->Phone_Number            = $request->Phone_Number;
        $Clinicals->Service_Price           = $request->Service_Price;

        $Clinicals->save();
        return response()->json($Clinicals);
      }

      public function UpdatePhoto(Request $request,$id){
        $Clinicals = Clinical::FindOrFail($id);

        $imageWorkPermit = time().$request->file('Photo_Work_Permit')-> getClientOriginalName();
        
        $path = $request->file('Photo_Work_Permit')->storeAs('images',$imageWorkPermit,'public');
        $Clinicals->Photo_Work_Permit     = '/storage/'.$path; 

        $Clinicals->Acceptance_Edit                         = 0 ;
        $Clinicals->save();
        return response()->json($Clinicals);
    }


      public function delete($id){
        $Clinicals = Clinical::FindOrFail($id);
        $Clinicals->delete();
        return response("تم حذف البيانات بنجاح");
      }

}
