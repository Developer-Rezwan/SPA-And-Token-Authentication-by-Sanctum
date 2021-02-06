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
            'email'                 => "email|required",
            'password'           => "required"
        ]);
        if(Auth::attempt($request->only('email' , 'password'))){
            return response()->json(Auth::user() , 200) ;
        }else{
            throw ValidationException::withMessages([
                'error' => ['The provided credentials are incorrect.'],
            ]);
        }
    }
    public function logout()
    {
        return Auth::logout();
    }
}
