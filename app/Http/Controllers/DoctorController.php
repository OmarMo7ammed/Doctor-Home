<?php

namespace App\Http\Controllers;

use App\Models\Clinical;
use App\Models\Doctor;
use App\Models\ReservationDoctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function create(Request $request,$UserId){
        $doctors = new  Doctor();

        if($request->Photo){
            $imagePhoto = time().$request->file('Photo')-> getClientOriginalName();
            $path = $request->file('Photo')->storeAs('images',$imagePhoto,'public');
            $doctors->Photo     = '/storage/'.$path;
            }
        $imageNationalID = time().$request->file('Photo_National_ID')-> getClientOriginalName();
            
            $path = $request->file('Photo_National_ID')->storeAs('images',$imageNationalID,'public');
            $doctors->Photo_National_ID     = '/storage/'.$path;
        
        $imageWorkPermit = time().$request->file('Photo_Work_Permit')-> getClientOriginalName();
            
            $path = $request->file('Photo_Work_Permit')->storeAs('images',$imageWorkPermit,'public');
            $doctors->Photo_Work_Permit     = '/storage/'.$path; 
            
        $imageDoctorsSyndicate = time().$request->file('Photo_Doctors_Syndicate')-> getClientOriginalName();
            
            $path = $request->file('Photo_Doctors_Syndicate')->storeAs('images',$imageDoctorsSyndicate,'public');
            $doctors->Photo_Doctors_Syndicate     = '/storage/'.$path;

        $doctors->DName                         = $request->DName;
        $doctors->Years_Exp                     = $request->Years_Exp;
        $doctors->Doctor_Ssn                    = $request->Doctor_Ssn ;
        $doctors->Description                   = $request->Description;
        $doctors->Phone_Number                  = $request->Phone_Number ;
        $doctors->Name_Department               = $request->Name_Department;
        $doctors->Age                           = $request->Age;
        $doctors->Gender                        = $request->Gender;
        $doctors->Service_Price                 = $request->Service_Price;
        $doctors->User_Id                       = $UserId;
    
        $doctors->save();
        return response()->json($doctors);
    }

    
    public function show($id){
        
        $doctors = Clinical::select()->where('Acceptance' ,'=', 1)
        ->where('Doctor_Id' ,'=', $id)->get();
        return response()->json($doctors);
    }

    public function ReservationShow($id){

        $doctor = Doctor::FindOrFail($id);
        return ReservationDoctor::where('reservation_doctors.Status','=',0)->where('Doctor_Id','=',$id)->select(
            "reservation_doctors.*", 
            "doctors.Name_Department as Department",
            "patients.Address as Address",
            "patients.PName as Patient name",
            "patients.Phone_Number as Phone_Number",
            "patients.Photo as photo"
            )
            ->join("patients", "patients.id", "=", "reservation_doctors.Patient_Id")
            ->join("doctors", "doctors.id", "=", "reservation_doctors.Doctor_Id")->get();

        $doctor =Doctor::with('reservationDoctors')->FindOrFail($id);
        return $doctor;
    }

    public function ReservationShowDone($id){

        $doctor = Doctor::FindOrFail($id);
        return ReservationDoctor::where('reservation_doctors.Status','=',1)->where('Doctor_Id','=',$id)->select(
            "reservation_doctors.*", 
            "doctors.Name_Department as Department",
            "patients.Address as Address",
            "patients.PName as Patient name" ,
            "patients.Phone_Number as Phone_Number",
            "patients.Photo as photo"
            )
            ->join("patients", "patients.id", "=", "reservation_doctors.Patient_Id")
            ->join("doctors", "doctors.id", "=", "reservation_doctors.Doctor_Id")->get();
        $doctor =Doctor::with('reservationDoctors')->FindOrFail($id);
        return $doctor;
    }

    public function DoctorShow($DName){

            $doctors = Doctor::select()->where('Acceptance' ,'=', 1)->Where('DName','LIKE',"%{$DName}%")->get();
            return response()->json($doctors);
    }

    public function ShowById($id){
        $doctor = Doctor::where('doctors.id' ,'=' , $id)->value('Acceptance');
        if ( $doctor == 0){
            return response()->json([
                'message'=>'The data can not be displayed due to the lack of an Acceptance!!'
            ]);
        
        }else{
            $doctors = Doctor::FindOrFail($id)->where('doctors.id' ,'=' , $id)
            ->select(
                "doctors.*", 
                "users.email as Email")
                ->join("users", "users.id", "=", "doctors.User_Id")->get();
            return response()->json($doctors);
        }
    }

    public function update(Request $request,$id){
        $doctors = Doctor::FindOrFail($id);

        if($request->Photo){
            $imagePhoto = time().$request->file('Photo')-> getClientOriginalName();
            $path = $request->file('Photo')->storeAs('images',$imagePhoto,'public');
            $doctors->Photo     = '/storage/'.$path;
            }

        $doctors->DName                     = $request->DName;
        $doctors->Years_Exp                 = $request->Years_Exp;
        $doctors->Description               = $request->Description;
        $doctors->Phone_Number              = $request->Phone_Number;
        $doctors->Age                       = $request->Age;
        $doctors->Gender                    = $request->Gender;
        $doctors->Service_Price             = $request->Service_Price;

        $doctors->save();
        return response()->json($doctors);
    }

    public function UpdatePhoto(Request $request,$id){
        $doctors = Doctor::FindOrFail($id);

        if($request->Photo_National_ID){

        $imageNationalID = time().$request->file('Photo_National_ID')-> getClientOriginalName();
            
            $path = $request->file('Photo_National_ID')->storeAs('images',$imageNationalID,'public');
            $doctors->Photo_National_ID     = '/storage/'.$path;
        }

        if($request->Photo_Work_Permit){
        $imageWorkPermit = time().$request->file('Photo_Work_Permit')-> getClientOriginalName();
            
            $path = $request->file('Photo_Work_Permit')->storeAs('images',$imageWorkPermit,'public');
            $doctors->Photo_Work_Permit     = '/storage/'.$path; 
        }
        
        if($request->Photo_Doctors_Syndicate){
        $imageDoctorsSyndicate = time().$request->file('Photo_Doctors_Syndicate')-> getClientOriginalName();
            
            $path = $request->file('Photo_Doctors_Syndicate')->storeAs('images',$imageDoctorsSyndicate,'public');
            $doctors->Photo_Doctors_Syndicate     = '/storage/'.$path;
        }
        $doctors->Acceptance_Edit                        = 0 ;

        $doctors->save();
        return response()->json($doctors);
    }

    public function delete($id){
        $doctors = Doctor::FindOrFail($id);
        $doctors->delete();
        return response("تم حذف البيانات بنجاح");
    }
}
