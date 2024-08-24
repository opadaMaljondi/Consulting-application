<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use App\Models\Excpert;

class ConsultingController extends Controller
{   //post
    public function createConsulition(Request $request){


        $typename = $request->typename;
        $details = $request->details;


       $consultation = new Consultation();
        $consultation->typename = $typename;
        $consultation->details = $details;

        $consultation->save();
        return response()->json([
          'status'=> 1,
          'message'=>'Consultation Created'
       ]);

    }
//get expert in consultation
    public function excpC($cid){

    $consultation= Consultation::find($cid);
      if($cid){
        $exp=Excpert::where('consultation_id',$cid)->with('user')->get();
        return response()->json($exp,200);
      }
      else{
        return response()->json('no consulation',400);
      }

}
//get
public function singleConsulting($consultation_id){
    $consultation=Consultation::find($consultation_id);
  if($consultation){
      return response()->json($consultation);
  }
  else{
      return response()->json('no data');
  }
}
//post
public function updateConsulting(Request $request,$consultation_id){
  $consultation=Consultation::find($consultation_id);
  $consultation->update([
      $consultation->typename = $request->typename,
      $consultation->details = $request->details,

  ]);
  return response()->json('consulation updated successfuly');

}
public function listConsulting(){
  $consultations=Consultation::all();
  return response()->json([
      "message"=>"all consultation",
      "data"=>$consultations
  ]);
}
//
public function deleteConsulting($consultation_id){
  $consultation=Consultation::find($consultation_id)->delete();
  return response()->json('consulation deleted successfuly');

}


}

