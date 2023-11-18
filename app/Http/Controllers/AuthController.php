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
    // Validation des données de requête
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

    // Récupération de l'utilisateur par email
    $user = User::where('email', $request->input('email'))->first();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'Login failed',
            'data' => 'User not found'
        ], 400);
    }

    // Vérification du mot de passe
    if (Hash::check($request->input('password'), $user->password)) {
        // Création du jeton d'accès
        $token = $user->createToken('auth_token')->plainTextToken;
        $user->remember_token = $token;
        $user->save();

        // Validation du token côté serveur
        $sanctumUser = $user->fresh(); // Charger l'utilisateur fraîchement pour s'assurer que les dernières modifications sont prises en compte
        $sanctumUserFromToken = $request->user();

        if ($sanctumUser->id !== $sanctumUserFromToken->id) {
            // Les identifiants d'utilisateur ne correspondent pas, le token n'est pas valide
            return response()->json([
                'success' => false,
                'message' => 'Invalid token',
                'data' => null
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Login success',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ], 200);
    } else {
        // Mot de passe incorrect
        return response()->json([
            'success' => false,
            'message' => 'Login failed',
            'data' => 'Wrong password'
        ], 400);
    }
}

    public function me()
    {
        $user = auth()->user();
        return response()->json([
            'success' => true,
            'message' => 'User found',
            'data' => $user
        ], 200);
    }

    public function logout()
    {
        $user = auth()->user();
        $user->tokens()->delete();
        return response()->json([
            'success' => true,
            'message' => 'User logout',
            'data' => $user
        ], 200);
    }
}
