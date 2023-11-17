<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservationDoctor;

class ReservationDoctorController extends Controller
{
    public function ReservationDoctor(Request $request,$Doctor_Id,$Patient_Id){
        $reservations = new ReservationDoctor();

        $reservations->Doctor_Id              =  $Doctor_Id;
        $reservations->Patient_Id             =  $Patient_Id;

        $imageNationalID = time().$request->file('Photo_National_ID')-> getClientOriginalName();
        $path = $request->file('Photo_National_ID')->storeAs('images',$imageNationalID,'public');
        $reservations->Photo_National_ID     = '/storage/'.$path; 
        
        $reservations->Status                 = 0 ;
        $reservations->save();
        return response()->json($reservations);
    }


    public function PriceDoctor(Request $request,$id){
        $reservations = ReservationDoctor::FindOrFail($id);

        $reservations->Price              = $request->Price;
        $reservations->Date              = $request->Date;
        $reservations->save();
        return response()->json($reservations);
    }


    public function update(Request $request,$id){
        $ReservationDoctor = ReservationDoctor::FindOrFail($id);

        $ReservationDoctor->Status            = $request->Status;
        $ReservationDoctor->save();
        return response()->json($ReservationDoctor);
    }

    public function delete($id){
        $reservations = ReservationDoctor::FindOrFail($id);
        $reservations->delete($id);
        return response("تم حذف البيانات بنجاح");
    }
}
