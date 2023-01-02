<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails())
        {
            $response = ['success'=>0, 'message'=>$validator->errors()->all()];
            return response($response, 422);
        }
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['success'=>1, 'message'=>'Registration Success', 'token' => $token];
        return response($response, 200);
        
    

    // //display error code
    // function fatal_handler()
    // {
    // $error = error_get_last();
    // print_r($error);
    // }
    // ini_set('display_errors', 1);
    // ini_set('error_reporting', E_ERROR);
    // register_shutdown_function('fatal_handler');
    
    // $data = $request->validate([
    //     'name' => 'required|max:255',
    //     'email' => 'required|email|unique:users',
    //     'password' => 'required|confirmed'
    // ]);
    // exit("hello-world1");
    

    //     $data['password'] = bcrypt($request->password);

    //     $user = User::create($data);

    //     $token = $user->createToken('API Token')->accessToken;

    //     return response([ 'user' => $user, 'token' => $token]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['success'=>'0', 'message'=>$validator->message()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['success'=>1, 'message'=> 'Login Success', 'token' => $token];
                return response($response, 200);
            } else {
                $response = ['success'=>0, "message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ['success'=>0, "message" =>'User does not exist'];
            return response($response, 422);
        }
        // $data = $request->validate([
        //     'email' => 'email|required',
        //     'password' => 'required'
        // ]);

        // if (!auth()->attempt($data)) {
        //     return response(['error_message' => 'Incorrect Details. 
        //     Please try again']);
        // }

        // $token = auth()->user()->createToken('API Token')->accessToken;

        // return response(['user' => auth()->user(), 'token' => $token]);

    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['success'=>1, 'message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}