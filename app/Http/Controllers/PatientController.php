<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\ReservationClinical;
use App\Models\ReservationDoctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{

    public function create(Request $request,$User_Id){
        $patients = new Patient();

        $patients->PName               = $request->PName;

        if($request->Photo){
        $imagePhoto = time().$request->file('Photo')-> getClientOriginalName();
        $path = $request->file('Photo')->storeAs('images',$imagePhoto,'public');
        $patients->Photo     = '/storage/'.$path;
        }
        $patients->Address             = $request->Address;
        $patients->Phone_Number        = $request->Phone_Number;
        $patients->Age                 = $request->Age ;
        $patients->Gender              = $request->Gender;
        $patients->User_Id             = $User_Id ;

        $patients->save();
        return response()->json($patients);
    }

    public function show(){
        $patients = Patient::all();
        return response()->json($patients);
    }

    public function ShowById($id){

        $patients = Patient::FindOrFail($id)->where('patients.id' ,'=' ,$id)->select(
            "patients.*", 
            "users.email as Email")
            ->join("users", "users.id", "=", "patients.User_Id")->get();
        return response()->json($patients);
    }

    public function ReservationClinicalShow($id){

        $reservationClinical = Patient::FindOrFail($id);
            return ReservationClinical::where('Status','=',0)->where('Patient_Id','=',$id)->select(
            "reservation_clinicals.*", 
            "clinicals.Clinical_Name as ClinicName",
            "clinicals.Name_Department as Department",
            "clinicals.Photo as photo",
            "work_days.Day as ReservationDay",
            "clinicals.Phone_Number  as Phone_Number"
            )
            ->join("clinicals", "clinicals.id", "=", "reservation_clinicals.Clinical_Id")
            ->join("work_days", "work_days.id", "=", "reservation_clinicals.Work_Days_Id")->get();

        $reservationClinical = Patient::with('reservationClinics')->FindOrFail($id);
        return $reservationClinical;
    }

    public function ReservationClinicalShowDone($id){

        $reservationClinical = Patient::FindOrFail($id);
            return ReservationClinical::where('Status','=',1)->where('Patient_Id','=',$id)->select(
            "reservation_clinicals.*", 
            "clinicals.Clinical_Name as ClinicName",
            "clinicals.Photo as photo",
            "clinicals.Name_Department as Department",
            "work_days.Day as ReservationDay",
            "clinicals.Phone_Number  as Phone_Number "
            )
            ->join("clinicals", "clinicals.id", "=", "reservation_clinicals.Clinical_Id")
            ->join("work_days", "work_days.id", "=", "reservation_clinicals.Work_Days_Id")->get();

        $reservationClinical = Patient::with('reservationClinics')->FindOrFail($id);
        return $reservationClinical;
    }

    public function ReservationDoctorShow($id){

        $reservation = Patient::FindOrFail($id);
            return ReservationDoctor::where('reservation_doctors.Status','=',0)->where('Patient_Id','=',$id)->select(
            "reservation_doctors.*", 
            "doctors.DName as Doctor Name",
            "doctors.Name_Department as Department",
            "doctors.Photo as photo"
            )
            ->join("doctors", "doctors.id", "=", "reservation_doctors.Doctor_Id")->get(); 
        $reservation = Patient::with('reservationDoctors')->FindOrFail($id);
        return $reservation;
    }


    public function ReservationDoctorShowDone($id){

        $reservation = Patient::FindOrFail($id);
            return ReservationDoctor::where('reservation_doctors.Status','=',1)->where('Patient_Id','=',$id)->select(
            "reservation_doctors.*", 
            "doctors.DName as Doctor Name",
            "doctors.Name_Department as Department",
            "doctors.Photo as photo"
            )
            ->join("doctors", "doctors.id", "=", "reservation_doctors.Doctor_Id")->get(); 
        $reservation = Patient::with('reservationDoctors')->FindOrFail($id);
        return $reservation;
    }

    public function update(Request $request , $id){
        $patients = Patient::find($id);

        if($request->Photo){
            $imagePhoto = time().$request->file('Photo')-> getClientOriginalName();
            $path = $request->file('Photo')->storeAs('images',$imagePhoto,'public');
            $patients->Photo     = '/storage/'.$path;
            }

        $patients->PName            = $request->PName;
        $patients->Address          = $request->Address;
        $patients->Phone_Number     = $request->Phone_Number;
        $patients->Age 	            = $request->Age;
        $patients->Gender           = $request->Gender;

        $patients->save();
        return response()->json($patients);
        
    }

    public function delete($id){
        $patients = Patient::FindOrFail($id);
        $patients->delete();
        return response("تم حذف ");
    }

    }


