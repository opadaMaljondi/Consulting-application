<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Excpert;
use App\Models\User;
use App\Models\Consultation;

class ExcpertController extends Controller
{

public function adddiatels(Request $request){

   if(Auth::user()->excpert==1){
   $cons = Consultation::find($request->consultaion_id);

      $excpert=new Excpert();
      $excpert->user_id=Auth::id();
      $excpert->consultation_id = $cons->id;


        $excpert->adress=$request->adress;
        $excpert->price=$request->price;
        $excpert->phonenum=$request->phonenum;
if($request->photo){
    $filename=time().'.png';
    \Storage::disk('profiles')->put($filename,base64_decode($request->photo));
    $excpert->photo="profiles/$filename";
}


           $excpert->save();


          return response()->json([
            'status'=> 1,
            'message'=>'expert Created',
             'expert'=>$excpert
         ],200);
       }
}

public function profileExc($id){
$excpert = Excpert::find($id);
$user=User::where('id',$excpert->user_id)->get()->first();
$excpert['name']=$user->first_name . " $user->last_name";
      if($excpert){
        return response()->json($excpert,200);
      }
      return response()->json([
    
        'message'=>'expeert not found',

     ],400);


     }







     }


