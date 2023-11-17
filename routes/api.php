<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Coordinate\DoctorCoordinate;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\Coordinate\PatientCoordinate;
use App\Http\Controllers\WorkDayController;
use App\Http\Controllers\ClinicalController;
use App\Http\Controllers\Coordinate\ClinicalCoordinate;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SystemAuditorController;
use App\Http\Controllers\Coordinate\DistanceBetweenCoordinate;
use App\Http\Controllers\ReservationDoctorController;
use App\Http\Controllers\ReservationClinicalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Coordinate of Patient
Route::get('PatientCoordinate/{id}', [PatientCoordinate::class ,'show']); //
Route::put('PatientCoordinate/update/{id}', [PatientCoordinate::class ,'update']); // add location patient with parameter(patient id)
Route::delete('PatientCoordinate/destroy/{id}', [PatientCoordinate::class ,'destroy']); // delete location patient with parameter(patient id)
//Coordinate of Doctor

Route::get('DoctorCoordinate', [DoctorCoordinate::class ,'index']); //show all locations doctor
Route::put('DoctorCoordinate/update/{id}', [DoctorCoordinate::class ,'update']); // add location doctor with parameter(doctor id)
Route::delete('DoctorCoordinate/destroy/{id}', [DoctorCoordinate::class ,'destroy']); // delete location doctor with parameter(doctor id)
//Coordinate of Clinical

Route::get('ClinicalCoordinate', [ClinicalCoordinate::class ,'index']); // show all locations clinic
Route::put('ClinicalCoordinate/update/{id}', [ClinicalCoordinate::class ,'update']); // add location clinic with parameter(clinic id)
Route::delete('ClinicalCoordinate/destroy/{id}', [ClinicalCoordinate::class ,'destroy']); // delete location clinic with parameter(clinic id)

Route::get('DistanceBetweenCoordinate/{id}', [DistanceBetweenCoordinate::class ,'index']); // show distance Between every doctors,clinics  to patient with parameter(patient id)

// Register And Login .


Route::post('login',[LoginController::class,'login']); // login 
// Route::post('logout', [LoginController::class,'logout'])->name('logout');

Route::post('PatientRegister', [RegisterController::class,'PatientCreate']); // Create patient in table user
Route::post('DoctorRegister', [RegisterController::class,'DoctorCreate']); // Create doctor in table user
Route::post('SystemAuditorRegister', [RegisterController::class,'SystemAuditorCreate']); // Create system auditor in table user


//Patient Api Route. 
Route::post('createPatient/{User_Id}',[PatientController::class,'create']); //create patient in table patient with parameter(user id) 
Route::get('patient/{id}',[PatientController::class,'ShowById']); //show patient with parameter(patient id)
Route::get('ReservationClinicalShow/{id}', [PatientController::class ,'ReservationClinicalShow']); //show all reservations clinic  in patient with parameter(patient id)
Route::get('ReservationClinicalShowDone/{id}', [PatientController::class ,'ReservationClinicalShowDone']); //show all reservations clinic done in patient with parameter(patient id)
Route::get('ReservationDoctorShow/{id}', [PatientController::class ,'ReservationDoctorShow']); //show all reservations doctor  in patient with parameter(patient id)
Route::get('ReservationDoctorShowDone/{id}', [PatientController::class ,'ReservationDoctorShowDone']); //show all reservations doctor done in patient with parameter(patient id)
Route::post('patientUpdate/{id}',[PatientController::class,'update']); // update date in patient with parameter(patient id)
Route::delete('patientDelete/{id}',[PatientController::class,'delete']); // delete patient with parameter(patient id)


// Doctor Api Route //Done
Route::post('createDoctor/{UserId}',[DoctorController::class,'create']); //create doctor from table doctor with parameter(user id)
Route::get('doctorAll/{DName}',[DoctorController::class,'DoctorShow']); // Search of doctor with parameter(name doctor)
Route::get('doctorsClinical/{id}',[DoctorController::class,'show']); // show all clinics create by  doctor with parameter(doctor id)
Route::get('doctor/{id}',[DoctorController::class,'ShowById']); // show  doctor with parameter(doctor id)
Route::get('ReservationShowDoctor/{id}',[DoctorController::class,'ReservationShow']); //show reservation  in doctor with parameter(doctor id)
Route::get('ReservationShowDoctorDone/{id}',[DoctorController::class,'ReservationShowDone']); //show reservation done in doctor with parameter(doctor id)
Route::post('doctorUpdate/{id}',[DoctorController::class,'update']); //update date in doctor with parameter(doctor id)
Route::post('updatePhoto/{id}',[DoctorController::class,'UpdatePhoto']); //update image doctor with parameter(doctor id)
Route::delete('doctorDelete/{id}',[DoctorController::class,'delete']); //delete doctor with parameter(doctor id)

// clinical Api Route //Done
Route::post('clinical/{id}',[ClinicalController::class,'create']); //Create Clinic with parameter(Doctor id)
Route::get('clinics/{ClinicalName}',[ClinicalController::class,'show']); //Search of Clinic with parameter(name clinic)
Route::get('clinical/{id}',[ClinicalController::class,'ShowById']); // Show Clinic With parameter(clinic)
Route::get('ReservationShow/{id}',[ClinicalController::class,'ReservationShow']); // Show Clinic Reservation With parameter(Clinic id)
Route::get('ReservationShowDone/{id}',[ClinicalController::class,'ReservationShowDone']); // Show clinic reservation Done (history) with parameter(clinic id)
Route::post('clinicalUpdate/{id}',[ClinicalController::class,'update']); //update date in clinic with parameter(clinic id)
Route::post('updatePhotoClinical/{id}',[ClinicalController::class,'UpdatePhoto']); //update image in clinic with parameter(clinic id)
Route::delete('clinicalDelete/{id}',[ClinicalController::class,'delete']); //delete clinic with parameter(clinic id)

//Department Api Route //Done
Route::get('DepartmentDoctor/{Department}',[DepartmentController::class,'DepartmentDoctor']);  // search of doctor with parameter(name Department)
Route::get('DepartmentClinical/{Department}',[DepartmentController::class,'DepartmentClinical']); //search of clinic with parameter(name Department)


//Work_day Api Route.WorkClinical/{ClinicalId} //Done
Route::post('WorkClinical/{ClinicalId}',[WorkDayController::class,'create']); //create work day in clinic with parameter(clinic id) 
Route::get('workday/{ClinicalId}',[WorkDayController::class,'WorkClinical']); //show all work day in any clinic with parameter(clinic id)
Route::get('workdayShow/{id}',[WorkDayController::class,'ShowById']); // show work day with parameter(work day id)
Route::put('workDayUpdate/{id}',[WorkDayController::class,'update']); // update data in work day with parameter(work day id)
Route::delete('workDayDelete/{id}',[WorkDayController::class,'delete']); // delete work day

//System_auditor Api Route //Done 
Route::get('DoctorShow',[SystemAuditorController::class,'DoctorShow']); // show all doctors not have Acceptance
Route::get('ClinicalShow',[SystemAuditorController::class,'ClinicalShow']); // show all clinics not have Acceptance
Route::get('DoctorEditShow',[SystemAuditorController::class,'DoctorEditShow']); //show all doctors not have Acceptance edit
Route::get('ClinicalEditShow',[SystemAuditorController::class,'ClinicalEditShow']); //show all clinics not have Acceptance edit
Route::post('DoctorUpdate/{id}',[SystemAuditorController::class,'AcceptanceDoctor']); //gave Acceptance of doctor with parameter(doctor id)
Route::post('DoctorEditUpdate/{id}',[SystemAuditorController::class,'AcceptanceEditDoctor']); //gave Acceptance edit of doctor with parameter(doctor id)
Route::post('ClinicalUpdate/{id}',[SystemAuditorController::class,'AcceptanceClinical']); //gave Acceptance of clinic with parameter(clinic id)
Route::post('ClinicalEditUpdate/{id}',[SystemAuditorController::class,'AcceptanceEditClinical']); //gave Acceptance edit of clinic with parameter(clinic id)
Route::get('showAllPatients', [PatientController::class ,'show']); // show all patient

//ReservationDoctor Api Route //Done with edit reservationPrice form put to post
Route::post('reservationDoctor/{Doctor_Id}/{Patient_Id}',[ReservationDoctorController::class,'ReservationDoctor']); //create reservation doctor with parameter(doctor id ,patient id)
Route::put('reservationUpdate/{id}',[ReservationDoctorController::class,'update']); //soon
Route::put('reservationPrice/{id}',[ReservationDoctorController::class,'PriceDoctor']); // add price and date of patient with parameter(reservation doctor id)
Route::delete('reservationDoctorDelete/{id}',[ReservationDoctorController::class,'delete']); //delete reservation doctor with parameter(reservation doctor id)


//ReservationClinical Api Route //Done // with edit  ClinicalId To  Clinical_Id and Patient_Id WorkDays_Id
Route::post('reservationClinical/{Clinical_Id}/{Patient_Id}/{WorkDays_Id}',[ReservationClinicalController::class,'ReservationClinical']); //create reservation Clinic with parameter(Clinic id ,patient id ,Work Day id)
Route::put('reservationUpdate/{id}',[ReservationClinicalController::class,'update']); //soon
Route::delete('reservationClinicalDelete/{id}',[ReservationClinicalController::class,'delete']);  //delete reservation Clinic
