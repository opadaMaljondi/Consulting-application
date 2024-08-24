<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;
use App\Models\User;
use App\Models\Excpert;

class RateController extends Controller
{
    public function makeRate(REQUEST $request){

        $user = User::where('id',$request->user_id)->get();
        $user_id = $user[0]['id'];

        $excpert = Excpert::where('id',$request->excpert_id)->get();
        $excpert_id = $excpert[0]['id'];

        $rate = $request->rate;

        $rate = new Rate();
        $rate->user_id=$user->id;
        $rate->excpert_id=$excpert->id;
        $rate->rate = $rate;
        

        $rate->save();
        return response()->json([
        'status'=> 1,
        'message'=>'Rate Created'
]);
}

public function listRate(){

    $rate =Rate::get();
    return response()->json([
    
    'message'=>'all ratres',
    'data'=>$rate
    
    ]);
    }
    public function updateRate(Request $request, $rate_id){
    
      $user = User::where('id',$request->user_id)->get();
      $user_id = $user[0]['id'];
    
    $excpert = Excpert::where('id',$request->excpert_id)->get();
    $excpert_id = $excpert[0]['id'];
    
    
     if(Rate::where([
         'excpert_id' =>$excpert_id,
          'user_id'=>$user_id,
          
     ])->exists()){
       
       $rate = Rate::find($rate_id);
       
       $rate->rate =isset($request->rate) ?$request->rate :$rate->rate;
        
       $rate->save();
       return response()->json([
     
        'message'=>'Rate has been updated'
        
        ]);
        }
    
    else
    return response()->json([
     
    'message'=>'The Reservation does not exists'
    
    ]);
    }
    
    public function deleteRate(Request $request ,$rate_id)
    { $user = User::where('id',$request->user_id)->get();
      $user_id = $user[0]['id'];
    
    $excpert = Excpert::where('id',$request->excpert_id)->get();
    $excpert_id = $excpert[0]['id'];

    
        if(Rate::where([
         'excpert_id' =>$excpert_id,
          'user_id'=>$user_id,
     ])->exists()){
       
       $rate = Rate::find($rate_id);
       
       $rate->delete();
    
       return response()->json([
     
        'message'=>'The Reservation has been deleted'
        
        ]);
    
      }
    
         else
         return response()->json([
     
         'message'=>'The Reservation does not exists'
    
        ]);
      
      }

public function FinalRate($excpert_id){
    
     
$excpert=Excpert::where('id',$excpert_id);
$data=$excpert->with('rates')->get();
foreach($data as $d) {
   return $d->rates->avg('rate'); 
}
    }

}

