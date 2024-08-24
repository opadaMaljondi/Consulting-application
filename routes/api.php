<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExcpertController;
 use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ConsultingController;
use App\Http\Controllers\MethIMpController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ExperienceController;
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
Route::post('register',[UserController::class,'Register']);
Route::post('login',[UserController::class,'Login']);

Route::group(['middleware'=> ['auth:api']],function(){
//user
Route::get('profile',[UserController::class,'Profile']);
Route::post('logout',[UserController::class,'Logout']);

//Excpert

Route::get('getallExp/{id}',[ExperienceController::class,'getAllExperience']);
Route::post('addDiatelsExp',[ExcpertController::class,'adddiatels']);
Route::post('addExp',[ExperienceController::class,'addExperience']);
Route::get('profileExp/{id}',[ExcpertController::class,'ProfileExc']);
//image add
Route::post('image',[UploadController::class,'add']);

//reservation
Route::post('createReserv',[ReservationController::class,'createReserv']);
Route::get('listReserv',[ReservationController::class,'listReserv']);
Route::post('updateReserv/{id}',[ReservationController::class,'updateReserv']);
Route::post('deleteReserv/{id}',[ReservationController::class,'deleteReserv']);
Route::post('pay',[ReservationController::class,'pay']);


//consulitation
Route::post('createConsulition',[ConsultingController::class,'createConsulition']);
Route::get('listConsulting',[ConsultingController::class,'listConsulting']);
Route::get('singleConsulting/{id}',[ConsultingController::class,'singleConsulting']);
Route::post('UpdateConsulting/{id}',[ConsultingController::class,'updateConsulting']);
Route::get('deleteConsulting/{id}',[ConsultingController::class,'deleteConsulting']);
Route::get('EXcpertCons/{id}',[ConsultingController::class,'excpC']);
//searh

Route::get('searche',[MethIMpController::class,'searchwithExcp']);
Route::get('searchc',[MethIMpController::class,'searchwithcons']);

//rate
Route::post('make_rate',[RateController::class,'makeRate']);
Route::get('list_rate',[RateController::class,'listRate']);
Route::post('update_rate/{id}',[RateController::class,'updateRate']);
Route::post('delete_rate/{id}',[RateController::class,'deleteRate']);
Route::post('final_rate/{id}',[RateController::class,'finalRate']);


//day
Route::post('create_day',[ConsultingController::class,'createDay']);
Route::get('list_day',[ConsultingController::class,'listDay']);
Route::post('Update_day/{id}',[ConsultingController::class,'updateDay']);
Route::get('delete_day/{id}',[ConsultingController::class,'deleteDay']);





});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
