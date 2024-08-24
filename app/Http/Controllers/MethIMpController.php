<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Excpert;
use App\Models\Consultation;
use App\Models\User;
use App\Models\Rate;
use App\Models\Favorite;

class MethIMpController extends Controller
{
  public function searchwithcons(Request $request){

    $consultation = $request->input('typename');



    $excpert = Excpert::with(function($query) use ($consultation) {
      $query->where('typename', 'LIKE', '%' . $consultation . '%');
 })->get();

 return view('browse.index', compact('excperts'));
    }
  

    public function searchwithExcp(Request $request){
      $user = $request->input('name'); 
      
      $excpert = User::with(function($query) use ($user) {
        $query->where('excpert', 'LIKE', 'true' . $user);
   })->get()->user_id;
  
  
  
      $exc = Excpert::with(function($query) use ($excpert) {
        $query->where('user_id', 'LIKE', '%' . $excpert . '%');
   })->get();
  
   return view('browse.index', compact('excperts'));
  }}
 




