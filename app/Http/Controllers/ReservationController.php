<?php

namespace App\Http\Controllers;

use App\Models\Excpert;
use App\Models\ExcpertDay;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationController extends Controller
{   public function createReserv(Request $request){
    $user = User::where('id',$request->user_id)->get();
        $user_id = $user[0]['id'];

    $excpert = Excpert::where('id',$request->excpert_id)->get();
    $excpert_id = $excpert[0]['id'];
    
    $day = ExcpertDay::where('id',$request->excpertday_id)->get();
    $excpertday_id = $day[0]['id'];

    
    $from = $request->from;
    $to = $request->to;


$reserv = new Reservation();
$reserv->user_id=$user->id;
$reserv->excpert_id=$excpert->id;
$reserv->excpertday_id=$day[0]['id'];
$reserv->from = $from;
$reserv->to = $to;

$reserv->save();
return response()->json([
  'status'=> 1,
  'message'=>'Reservation Created'
]);
}
public function listReserv(){

$reserv =Reservation::get();
return response()->json([

'message'=>'all reservation',
'data'=>$reserv

]);
}
public function updateReserv(Request $request, $reservation_id){

  $user = User::where('id',$request->user_id)->get();
  $user_id = $user[0]['id'];

$excpert = Excpert::where('id',$request->excpert_id)->get();
$excpert_id = $excpert[0]['id'];

$day = ExcpertDay::where('id',$request->excpertday_id)->get();
    $excpertday_id = $day[0]['id'];


 if(Reservation::where([
     'excpert_id' =>$excpert_id,
      'user_id'=>$user_id,
      'excpertday_id'=>$excpertday_id

 ])->exists()){
   
   $reserv = Reservation::find($reservation_id);
   
   $reserv->from =isset($request->from) ?$request->from :$reserv->from;
   $reserv->to =isset($request->to) ?$request->to :$reserv->to;
    
   $reserv->save();
   return response()->json([
 
    'message'=>'Reservation has been updated'
    
    ]);
    }

else
return response()->json([
 
'message'=>'The Reservation does not exists'

]);
}

public function deleteReserv(Request $request ,$reservation_id)
{ $user = User::where('id',$request->user_id)->get();
  $user_id = $user[0]['id'];
  $user_money=User::where('id',$request->user_id)->get()->user_money;

$excpert = Excpert::where('id',$request->excpert_id)->get();
$excpert_id = $excpert[0]['id'];
$excpert_price = Excpert::where('id',$request->excpert_id)->get()->excpert_price;

$day = ExcpertDay::where('id',$request->excpertday_id)->get();
$excpertday_id = $day[0]['id'];

    if(Reservation::where([
     'excpert_id' =>$excpert_id,
      'user_id'=>$user_id,
      'excpertday_id'=>$excpertday_id
      
 ])->exists()){
   
   $reserv = Reservation::find($reservation_id);
   
   $reserv->delete();

   return response()->json([
 
    'message'=>'The Reservation has been deleted'
    
    ]);

  }

     else
     return response()->json([
 
     'message'=>'The Reservation does not exists'

    ]);
  
  }
  public function pay(Request $request,$reservation_id){

    $excpert_price = Excpert::where('id',$request->excpert_id)->get()->excpert_price;
    $user=User::find($request->user_id);

     $user->money -= $excpert_price;

     $user->save();



  }
  
}
