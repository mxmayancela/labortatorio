<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
            if (auth()->attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $user->token = $token;
                return response()->json([
                    'success' => true,
                    'message' => 'Login successfully',
                    'data' => $user
                ], 200);
            }
            return response()->json([
                'message' => 'Invalid credentials'
            ], 402);
        } catch (\Throwable $th) {
            dd($th);
        }
        

    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);


            $person=Person::create([
                'name' => $request->name,
                'lastnamefather' => $request->lastnamefather,
                'lastnamemother' => $request->lastnamemother,
                'cedula' => $request->cedula,
                'birthdate' => $request->birthdate,
            ]);

            if ($person) {
                $user = User::create([
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'id_person' => $person->id,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'typeMessage' => 'success'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
                'data' => $th
            ]);
        }
    }


}
