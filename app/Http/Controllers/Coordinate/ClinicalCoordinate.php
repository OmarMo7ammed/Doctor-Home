<?php

namespace App\Http\Controllers\Coordinate;

use App\Http\Controllers\Controller;
use App\Models\Clinical;
use Illuminate\Http\Request;

class ClinicalCoordinate extends Controller
{
    public function index()
    {
        $data = Clinical::select('latitude','longitude')->where('Acceptance_Edit','=',1)->where('Acceptance','=',1)->get();
    return  response()->json($data);
    }
    
    
    public function show($id)
    {
        $latitude = Clinical::FindOrFail($id)->select('latitude')->where('id', '=', $id)
        ->value('latitude');
        $longitude = Clinical::select('longitude')->where('id', '=', $id)
        ->value('longitude');
        $Location = $latitude.','.$longitude;
        return  $Location;

    } 

    public function update(Request $request, $id)
    {
    
        $ClinicalCoordinate = Clinical::find($id);
        $ClinicalCoordinate->latitude = $request->latitude;
        $ClinicalCoordinate->longitude = $request->longitude;
        $ClinicalCoordinate->save();
        return response()->json([
            'message'=>'Clinical Coordinate Update Successfully!!',
            'data' => $ClinicalCoordinate
        ]);
    }
    
    
    public function destroy($id)
    {
        Clinical::FindOrFail($id)->delete();
        return response()->json([
            'message'=>'Clinical Coordinate Destroy Successfully!!'
        ]);
    }
    
}
