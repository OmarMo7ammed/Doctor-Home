<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public  function PatientCreate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            ]);
            $Patient = New User;
            $Patient->name = $request->name;
            $Patient->email = $request->email;
            $Patient->password = Hash::make($request->password);
            $Patient->type  = 0;
            $Patient->save();
        return response()->json([
            'message'=>'Patient Create Successfully!!' ,
            'data' => User::where('email' ,'=' ,$request->email)->get()

        ]);
    }

    public  function DoctorCreate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            ]);
            $Doctor = New User;
            $Doctor->name = $request->name;
            $Doctor->email = $request->email;
            $Doctor->password = Hash::make($request->password);
            $Doctor->type  = 1;
            $Doctor->save();
        return response()->json([
            'message'=>'Doctor Create Successfully!!',
            'data' => User::where('email' ,'=' ,$request->email)->get()
        ]);
    }


    public  function SystemAuditorCreate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            ]);
            $SystemAuditor = New User;
            $SystemAuditor->name = $request->name;
            $SystemAuditor->email = $request->email;
            $SystemAuditor->password = Hash::make($request->password);
            $SystemAuditor->type  = 2;
            $SystemAuditor->save();
        return response()->json([
            'message'=>'System Auditor Create Successfully!!' ,
            'data' => User::where('email' ,'=' ,$request->email)->get()
        ]);
    }
}
