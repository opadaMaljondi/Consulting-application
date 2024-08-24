<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\post;

class UploadController extends Controller
{
    public function add(Request $request){

$file = $request->hasFile('thumbnail');
if ($file){

$newFile =$request->file('thumbnail');
$file_path = $newFile->store('images');
dd($file_path);


post::create([
'title'=> $request->title,
'image_path'=> $file_path
]);
dd(asset('/storage/'.$file_path));

}


    }
}