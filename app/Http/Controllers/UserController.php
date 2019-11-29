<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

   /**
    * Register api
    *
    * @return \Illuminate\Http\Response
    */

    // validation new users,
   public function register(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'name' => 'required',
           'email' => 'required|email',
           'password' => 'required',
           'confirm_password' => 'required|same:password',
       ]);
       if ($validator->fails()) {
                   return response()->json(['error'=>$validator->errors()], 401);
               }
        // if validation didn't fail, populate database with new user's credentials
               $input = $request->all();
               $input['password'] = bcrypt($input['password']);
               $user = User::create($input);
               $success['token'] =  $user->createToken('MyApp')-> accessToken;
               $success['name'] =  $user->name;

       return response()->json(['success'=>$success], $this-> successStatus);
   }

   /**
    * login api
    *
    * @return \Illuminate\Http\Response
    */
    // autrhenticate user's login detail
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['name'] = $user->name;

            return response()->json(['success' => $success], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>'Invalid login credentials'], 401);
        }
    }

}
