<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;


use Response;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use PHPUnit\Framework\TestStatus\Success;   
use App\Models\User;
use App\Http\Requests\ValidatioinRequest;

use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class AuthController extends Controller
{  
    public function register(ValidatioinRequest $request)
    {
       $user= User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
       ]);
       $token=$user->createToken('user confirmed')->accessToken;
       return response()->json(['token'=>$token,'user'=>$user], 200);
       }
    public function login(Request $request)
    {
        $remember = $request->filled('remember'); 
        $user = User::where('email',$request->email)->first();
        $credentials = $request->only('email', 'password');
        if ($user) {
            if (Auth::attempt($credentials)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
               $remember;
                return response()->json(['token'=>$token,'user'=>$user], 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response()->json($response, 422);
            }
        } else {
          
            return response()->json(["message" =>'User does not exist'], 401);
        }
    }
        public function logout(Request $request){
             $token=$request->user()->token();
             $token->revoke();
             return response()->json(["Message"=>"successfully logout"],200);

        }
        }

