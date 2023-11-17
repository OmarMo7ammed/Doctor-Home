<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservationClinical;

class ReservationClinicalController extends Controller
{
    public function ReservationClinical($Clinical_Id,$Patient_Id,$WorkDays_Id){
        $reservations = new ReservationClinical();

        $reservations->Clinical_Id            =  $Clinical_Id;
        $reservations->Patient_Id             =  $Patient_Id;
        $reservations->Work_Days_Id           =  $WorkDays_Id;
        $reservations->Status                 = 0 ;
        $reservations->save();
        return response()->json($reservations);
    }



    public function update(Request $request,$id){
        $ReservationClinical = ReservationClinical::FindOrFail($id);

        $ReservationClinical->Status            = $request->Status;
        
        $ReservationClinical->save();
        return response()->json($ReservationClinical);
    }


    public function delete($id){
        $reservations = ReservationClinical::FindOrFail($id);
        $reservations->delete($id);
        return response("تم حذف البيانات بنجاح");
    }

}
