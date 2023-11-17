<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Clinical;

class DepartmentController extends Controller
{

    public function DepartmentDoctor($Department){
        
        $departments = Doctor::select()->Where('Acceptance' ,'=', 1)->Where('Name_Department','LIKE',"%{$Department}%")->get();
        return response()->json($departments);
    }

    public function DepartmentClinical($Department){
        $departments = Clinical::select()->Where('Acceptance' ,'=', 1)->Where('Name_Department','LIKE',"%{$Department}%")->get();
        return response()->json($departments);
    }

}
