<?php

namespace App\Http\Controllers\API\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStore;
use App\Http\Requests\UserUpdate;
use App\Http\Resources\Users\UserResource;
use App\Services\Users\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{

    public function index(UserService $userService): \App\Http\Resources\Users\UserCollection{
        return $userService->getAll();
    }

    public function show(UserService $userService,$id): \App\Http\Resources\Users\UserResource{
        return $userService->getOne($id);
    }

    public function profile(UserService $userService): UserResource{
        return $userService->profile();
    }

    public function update(UserUpdate $request, $id, UserService $userService): \Illuminate\Http\JsonResponse{
        $validatedData = $request->validated();
        return $userService->update($validatedData,$id);
    }

    public function destroy(UserService $userService,$id): \Illuminate\Http\JsonResponse{
        return $userService->destroy($id);
    }
}