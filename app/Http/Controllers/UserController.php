<?php

namespace App\Http\Controllers;

use App\Models\Excpert;
use App\Models\Consultation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{ public function Register(Request $request){
    //validation user

         $input = $request->all();
         $validated = Validator::make($input, [
            'first_name'=>'required',
             'last_name'=>'required',
             'email' => 'required|email|unique:users',
             'password' => 'required',


         ]);
         if ($validated->fails()) {
             return response()->json( $validated->errors(), 401);
         }

         $input['password'] = Hash::make($input['password']);
         $user = User::create($input);

         $user['token']  = $user->createToken('£$%"$Gffcv')->accessToken;
         return response()->json($user, 200);


        //  $user=new User();
        //  $user->first_name=$request->first_name;
        //  $user->last_name=$request->last_name;
        //  $user->password=bcrypt($request->password);
        //  //$user->phone_num=$request->phone_num;
        //  $user->email=$request->email;

        // $cons = new Consultation;

        //============================
        // $cons = Consultation::where('id',$request->consultaion_id)->get();
        // $cons_id = $cons[0]['id'];

        // echo($cons_id);



        //  if ($request->excpert=1){
        //    $excpert=new Excpert();
        //    $excpert->user_id=$user->id;// Auth::id();
        //    $excpert->consultation_id = $cons_id;
        //    $excpert->ExcperityType=$request->ExcperityType;
        //    $excpert->ExcperityPropirities=$request->ExcperityPropirities;
        //    $excpert->adress=$request->adress;
        //    $excpert->price=$request->price;
        //    $excpert->phonenum= $request->phone_number;
        //  }
        //      $excpert->save();



    }

    public function Login(Request $request){
        $input = $request->all();
        $validated = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
		if ($validated->fails()) {
			return response()->json( $validated->errors(), 401);

        }
        if (Auth::attempt($input)) {
            $user = Auth::user();

            $user['token']  = $user->createToken('£$%"$Gffcv')->accessToken;

            return response()->json($user, 200);
        }
        else{
            return response()->json([
                'message'=>'email or password not correct'
            ], 400);
        }

}

//get
public function Profile(User $user){
    $user_data=auth()->user();
    return response()->json([
       'statsus'=> true,
       'message'=>'User Data',
       'Data'=> $user_data,
    ]);


}




   //post
   public function Logout(Request $request){
   $request->user()->token()->delete();


   return response()->json([
       'statsus'=> true,
       'message'=>'user logged out',
    //    'access_token'=> $token
       ]);

}
}
