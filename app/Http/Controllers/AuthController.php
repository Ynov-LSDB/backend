<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //create function register
    public function register(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'birth_date' => 'required|date',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);
        // dd($request->input('password'), $request->input('confirm_password'));
        if ($validators->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validators->errors()
            ], 400);
        }

            //create user
            $user = new User();
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->birth_date = $request->input('birth_date');
            $user->email = $request->input('email');

            //hash password before saving
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();
            // dd($user);
            //return successful response
            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => $user
            ], 200);
    }

    public function login(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if ($validators->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validators->errors()
            ], 400);
        }

        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
                'data' => 'User not found'
            ], 400);
        }

        if (Hash::check($request->input('password'), $user->password)) {
            $token = bin2hex(random_bytes(40));
            $user->remember_token = $token;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Login success',
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
                'data' => 'Wrong password'
            ], 400);
        }
    }

    public function me(Request $request)
    {
        dd($request->user());
        return response()->json([
            'success' => false,
            'message' => 'User not found'
        ], 400);
    }
}
