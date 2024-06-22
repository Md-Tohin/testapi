<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\ErrorResource;

trait LoginService 
{
    public function loginToken(array $credentials){
        $user = User::where('email', $credentials['email'])->first();
        
        if($user && Hash::check($credentials['password'], $user->password)){
            $token = $user->createToken($user->name);
            $response = [
                'message' => 'Login token generated successfully!',
                'data' => [
                    'token' => $token->plainTextToken,
                ],
            ];
            return new SuccessResource($response);
        }

        $errors['email'][] = __('auth.failed');
        return (new ErrorResource($errors))->response()->setStatusCode(422);
    }
}