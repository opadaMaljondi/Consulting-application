<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Excpert;
use App\Models\Day;
use App\Models\ExcpertDay;
class DayController extends Controller
{
    public function createDay(Request $request){
        $day = Day::where('id',$request->day_id)->get();
            $day_id = $day[0]['id'];
        $excpert = Excpert::where('id',$request->excpert_id)->get();
        $excpert_id = $excpert[0]['id'];
        $from = $request->from;
        $to = $request->to;
    $day_exc = new ExcpertDay();
    $day->day_id=$day->id;
    $day->excpert_id=$excpert->id;
    $day->from = $from;
    $day->to = $to;
    $day->save();
    return response()->json
    (
        [
      'status'=> 1,
      'message'=>'DayAvailliable Created'
    ]
    );
    }
    public function listDay(){
    $day =ExcpertDay::get();
    return response()->json([
    'message'=>'all DayAvailiable',
    'data'=>$day
    ]
);
    }
    public function updateDay(Request $request, $reservation_id){
        $day = Day::where('id',$request->day_id)->get();
        $day_id = $day[0]['id'];
    $excpert = Excpert::where('id',$request->excpert_id)->get();
    $excpert_id = $excpert[0]['id'];
     if(ExcpertDay::where([
         'excpert_id' =>$excpert_id,
          'day_id'=>$day_id

     ])->exists()){

       $day =ExcpertDay ::find($day_id);

       $day->from =isset($request->from) ?$request->from :$day->from;
       $day->to =isset($request->to) ?$request->to :$day->to;

       $day->save();
       return response()->json([
        'message'=>'DayAvailliable has been updated'
        ]);
        }
    else
    return response()->json([
    'message'=>'The DayAvailliable does not exists'
    ]);
    }
    public function deleteDay(Request $request ,$reservation_id)
    {   $day = Day::where('id',$request->day_id)->get();
        $day_id = $day[0]['id'];
    $excpert = Excpert::where('id',$request->excpert_id)->get();
    $excpert_id = $excpert[0]['id'];
        if(ExcpertDay::where([
         'excpert_id' =>$excpert_id,
          'day_id'=>$day_id
     ])->exists()){
       $day = ExcpertDay::find($day_id);
       $day->delete();
       return response()->json([
        'message'=>'The DayAvailliable has been deleted'
        ]);
      }
         else
         return response()->json([
         'message'=>'The DayAvailliable does not exists'
        ]);
      }
}
