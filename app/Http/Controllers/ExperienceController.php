<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;
use App\Models\User;
use App\Models\Excpert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class ExperienceController extends Controller
{
  function addExperience(Request $request){
if(Auth::user()->excpert==1)
{
$input = $request->all();
$validated = Validator::make($input, [
    'name'=>'required',
    'description'=>'required',

]);
if ($validated->fails()) {
    return response()->json( $validated->errors(), 400);
}
$exp=Excpert::where('user_id',Auth::id())->get()->first();

$input['excpert_id'] = $exp['id'];
$exp = Experience::create($input);

return response()->json($exp, 200);

}
}
function getAllExperience($id){
 $exp = Experience::where('excpert_id',$id)->get();

    return response()->json($exp, 200);


    }


}
