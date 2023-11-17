<?php

namespace App\Http\Controllers\Coordinate;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientCoordinate extends Controller
{
    public function index()
    {
        $data = Patient::select('latitude','longitude')->get();
        return  response()->json($data) ;
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function show($id)
    {
        $latitude = Patient::FindOrFail($id)->select('latitude')->where('id', '=', $id)
        ->value('latitude');
        $longitude = Patient::select('longitude')->where('id', '=', $id)
        ->value('longitude');
        $Location = $latitude.','.$longitude;
        return  response()->json($Location);
    } 

    public function update(Request $request, $id)
        {
    
        $PatientCoordinate = Patient::find($id);
        $PatientCoordinate->latitude = $request->latitude;
        $PatientCoordinate->longitude = $request->longitude;
        $PatientCoordinate->save();
        return response()->json([
            'message'=>'Patient Coordinate Update Successfully!!',
            'data' => $PatientCoordinate
        ]);
    }
    
    
    public function destroy($id)
    {

        Patient::FindOrFail($id)->delete();
        return response()->json([
            'message'=>'Patient Coordinate Destroy Successfully!!'
        ]);
    }
    
}
