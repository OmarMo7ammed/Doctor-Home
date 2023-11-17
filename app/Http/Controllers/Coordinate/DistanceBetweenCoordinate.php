<?php

namespace App\Http\Controllers\Coordinate;

use App\Http\Controllers\Controller;
use App\Models\Clinical;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class DistanceBetweenCoordinate extends Controller
{
    public function index($id)
    {
        $lat  = Patient::FindOrFail($id)->select('latitude')->where('id', '=', $id)->value('latitude');
        $lon   = Patient::FindOrFail($id)->select('longitude')->where('id', '=', $id)->value('longitude');

        $DoctorDistance = Doctor::select('DName'
                        ,DB::raw('6371 * acos(cos(radians(' . $lat . ')) 
                        * cos(radians(latitude)) 
                        * cos(radians(longitude) - radians(' . $lon . ')) 
                        + sin(radians(' . $lat . ')) 
                        * sin(radians(latitude))) AS distance'))
                        ->groupBy('DName')
                        ->get();

        $ClinicalDistance = Clinical::select('Clinical_Name'
                        ,DB::raw('6371 * acos(cos(radians(' . $lat . ')) 
                        * cos(radians(latitude)) 
                        * cos(radians(longitude) - radians(' . $lon . ')) 
                        + sin(radians(' . $lat . ')) 
                        * sin(radians(latitude))) AS distance'))
                        ->groupBy('Clinical_Name')
                        ->get();                
        $LocationDoctor = $DoctorDistance->where('distance','<=',250);
        $LocationClinic = $ClinicalDistance->where('distance','<=',250);       
            return  response()->json([ $LocationDoctor,$LocationClinic
    ]);
    
    }  
}
