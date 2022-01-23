<?php

namespace App\Http\Controllers\Auth;

use App\User;

use App\Http\Requests\UserRegisterRequest;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Event;

use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;

use App\Http\Resources\UserResource;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ApiAuthController extends Controller
{
    public function isValid(Request $request){
        return response([
            'message'=>'User has valid token and is currently authenticated.'
        ],200);
    }

    public function register (UserRegisterRequest $request) {

        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());

        event(new Registered($user));

        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];
        return response($response, 200);
    }

    public function login (Request $request) {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = [
                    'user'  => new UserResource($user),
                    'token' => $token
                ];
                return response($response, 200);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'User does not exist'];
            return response($response, 422);
        }
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }



}
