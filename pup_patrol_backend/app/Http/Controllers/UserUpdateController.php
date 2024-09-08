<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserUpdateController extends Controller
{
    //
    public function update(Request $request){
        try{
            $user = Auth::user();
            if($request->birthday){
                $user->birthday = $request->birthday;
            }
            if($request->profilePicture){
                $user->profile_picture = $request->profilePicture;
            }
            if($request->name){
                $user->name = $request->name;
            }
            $user->save();
            return response()->json(['data'=>'success']);
        }catch(Exception){
            return response()->json(['data'=>'unauthorized']);
        }
        
    }
}
