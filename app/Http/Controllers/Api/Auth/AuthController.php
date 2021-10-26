<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStore;
use App\Services\Users\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class AuthController extends Controller{

    public function login(Request $request){

        $credentials = $request->only(['email','password']);

        if (Auth::attempt($credentials)){
             $user = Auth::user();
             $success['token'] = $user->createToken('user_token')->accessToken;
             $success['type']  = 'Bearer ';
             $success['user']  = $user;
            return response()->json(['token'=>$success]);
        }else{
            return response()->json(['error'=>'Invalid credentials'],Response::HTTP_UNAUTHORIZED);
        }

    }

    public function register(UserStoreRequest $request, UserService $userService): \Illuminate\Http\JsonResponse{
        $data = $request->validated();
        return $userService->store($data);
    }

    public function logout(): \Illuminate\Http\JsonResponse{
        auth()->user()->tokens->each(function($token,$key){
            $token->delete();
        });

        return response()->json('Session closed');
    }

}