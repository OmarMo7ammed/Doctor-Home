<?php

namespace App\Http\Controllers\Coordinate;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorCoordinate extends Controller
{
    public function index()
    {
        $data = Doctor::select('latitude','longitude')->where('Acceptance','=',1)->where('Acceptance_Edit','=',1)->get();
        return  response()->json($data);
    }
    
    public function show($id)
    {
        $latitude = Doctor::FindOrFail($id)->select('latitude')->where('id', '=', $id)
        ->value('latitude');
        $longitude = Doctor::select('longitude')->where('id', '=', $id)
        ->value('longitude');
        $Location = $latitude.','.$longitude;
        return  $Location;

    } 
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */


    public function update(Request $request, $id)
    {
    
        $DoctorCoordinate = Doctor::FindOrFail($id);
        $DoctorCoordinate->latitude = $request->latitude;
        $DoctorCoordinate->longitude = $request->longitude;
        $DoctorCoordinate->Status = $request->Status;

        $DoctorCoordinate->save();
        return response()->json([
            'message'=>'Doctor Coordinate Update Successfully!!',
            'data' => $DoctorCoordinate
            
        ]);
    }
    
    
    public function destroy($id)
    {
        Doctor::FindOrFail($id)->delete();
        return response()->json([
            'message'=>'Doctor Coordinate Destroy Successfully!!'
        ]);
        
    }
    
}
