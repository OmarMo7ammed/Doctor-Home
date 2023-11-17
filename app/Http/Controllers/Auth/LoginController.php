<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {   
        $input = $request->all();
    
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->type == 'Doctor') {
                return  response()->json(['status'=>true ,
                    'message'=>'Doctor Login Successfully!!' ,'data' => Doctor::select(
                        "doctors.*", 
                        "users.email as Email ",
                        "users.password as Password")
                        ->join("users", "users.id", "=", "doctors.User_Id")
                        ->where('doctors.User_Id','=',User::where('email' ,'=' ,$input['email'])->value('id'))->get() 
                ]);
            }else if (auth()->user()->type == 'SystemAuditor') {
                return   response()->json(['status'=>true ,
                    'message'=>'System Auditor Login Successfully!!',
                    'data' => User::where('email' ,'=' ,$input['email'])->get()
                ]);
            }else{
                return  response()->json(['status'=>true ,
                    'message'=>'Patient Login Successfully!!',
                    'data' => Patient::select(
                        "patients.*", 
                        "users.email as Email ",
                        "users.password as Password",
                        )
                        ->join("users", "users.id", "=", "patients.User_Id")
                        ->where('patients.User_Id','=',User::where('email' ,'=' ,$input['email'])->value('id'))->get() 
                    ]);
            }
        }else{
            return  response()->json(['status'=>false ,
                'message'=>'Login Not Successfully!!'
            ]);
                
        }
    
    }
}
