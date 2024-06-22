<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

trait RegisterService
{
    public function createUser(array $data){
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return $user;
    }
}