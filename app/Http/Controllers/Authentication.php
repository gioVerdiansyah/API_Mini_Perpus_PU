<?php

namespace App\Http\Controllers;

use App\Helpers\HandleJsonResponseHelper;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Authentication extends Controller
{
    public function login(LoginRequest $request)
    {
        try{
            if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){
                $user = auth()->user();
                $user->access_token = $user->createToken("verdi")->plainTextToken;
                $user->role = "admin";

                return HandleJsonResponseHelper::res("Successfully Login!", $user, 200, true);
            }

            return HandleJsonResponseHelper::res("Email or Password is incorrect!", [], 422, false);
        }catch (\Exception $e){
            return HandleJsonResponseHelper::res("There is a error", $e->getMessage(), 500, false);
        }
    }

    public function logout()
    {
        try {
            auth('sanctum')->user()->currentAccessToken()->delete();

            return HandleJsonResponseHelper::res("Successfully logout!");
        } catch (\Exception $e) {
            return HandleJsonResponseHelper::res("There is a error", $e->getMessage(), 500, false);
        }
    }
}
