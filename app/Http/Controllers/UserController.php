<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role', 'rank', 'drink')->get();
        return response()->json([
            'success' => true,
            'message' => 'OK',
            'data' => $users
        ], 200);
    }

    public function show($id)
    {
        $user = User::with(['role', 'rank', 'drink', 'events'])->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'User found',
            'data' => $user
        ], 200);
    }

    //create a new user
    public function store(Request $request)
    {
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->imageURL_fav_balls = $request->imageURL_fav_balls;
        $user->fav_balls_name = $request->fav_balls_name;
        $user->rank_id = $request->rank_id;
        $user->birth_date = $request->birth_date;
        $user->fav_drink_id = $request->fav_drink_id;
        $user->doublette_user_id = $request->doublette_user_id;
        $user->status = $request->status;
        $user->role_id = $request->role_id;

        if ($user->save()) {
            return response()->json([
                'success' => true,
                'message' => 'User created',
                'data' => $user
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not created'
            ], 400);
        }
    }

    public function destroy($id) {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 400);
        }

        if ($user->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'User deleted'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not deleted'
            ], 500);
        }
    }
}
