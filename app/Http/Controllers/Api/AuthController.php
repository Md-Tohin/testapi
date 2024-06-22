<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\Api\UserResource;
use App\Services\RegisterService;
use App\Services\LoginService;

class AuthController extends Controller
{
    use RegisterService, LoginService;

    //  register
    public function register(RegisterRequest $request){
        $data = $request->validated();
        $this->createUser($data);
        return (new SuccessResource(['message' => 'Successfully Register!, Now Login']))->response()->setStatusCode(401);
    }

    //  login
    public function login(LoginRequest $request){
        $credentials = $request->validated();
        return $this->loginToken($credentials);
    }

    //  user
    public function user(Request $request){
        $response['data'] = new UserResource($request->user());
        $response['message'] = 'User Information!';
        return new SuccessResource($response);
    }

    //  logout
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        $response['message'] = 'Successfully Logout';
        return new SuccessResource($response);
    }

}
