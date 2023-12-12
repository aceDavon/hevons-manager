<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginUserRequest;
use App\Http\Requests\Api\V1\Auth\StoreUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        return $this->success([
            "data" => $user,
            "token" => $user->createToken('API token for '. $user->name)->plainTextToken,

        ]);
    }

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        // @dd($request->only(['email', 'password']));

        if (!Auth::attempt($request->only(['email', 'password'])))
        {
            return $this->error('', 'Credentials could not verified...', 401);
        }

        $user = User::where('email', $request->email)->first();

        return $this->success([
            'data' => $user,
            'token' => $user->createToken('API token for '. $user->first_name)->plainTextToken
        ]);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            'You are now logged out, see you again soon..',
        ]);
    }
}
