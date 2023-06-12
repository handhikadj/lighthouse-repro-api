<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends ApiBaseController
{
    public function login()
    {
        $user = User::latest()->first();

        auth()->loginUsingId($user->id);

        $token = auth()->user()->createToken('authToken')->plainTextToken;

        return $this->responseSuccess([
            'user' => auth()->user(),
            'token' => $token
        ]);
    }
}
