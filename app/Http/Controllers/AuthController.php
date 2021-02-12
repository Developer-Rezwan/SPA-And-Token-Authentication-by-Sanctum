<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
            $request->validate([
                "name"          => "required",
                "email"          => "required|email|unique:users",
                "password"    => "required|confirmed"
            ] ,
            [
                'email.unique' => "Email already exist! please try with another email"
            ]);
            User::create([
                    "name" => $request->name,
                    "email" => $request->email,
                    'password' => Hash::make($request->password)
              ]);
     }
    public function login(Request $request)
    {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $request->email)->first();
            $deviceName = $request->header('User-Agent');
            if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }
            return $user->createToken($deviceName)->plainTextToken;
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['logout' => true] , 200);
    }
}
