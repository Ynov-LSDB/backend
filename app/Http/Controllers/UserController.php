<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

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
        $this->validate($request, [
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'rank_id' => 'exists:ranks,id',
            'birth_date' => 'required|date',
            'fav_drink_id' => 'exists:drinks,id',
            'doublette_user_id' => 'exists:users,id',
            'role_id' => 'exists:roles,id',
        ]);
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
            ], 500);
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
        $this->authorize('delete', $user);
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

    public function update($id, Request $request)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 400);
        }
        $this->validate($request, [
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'min:8',
            'confirm_password' => 'same:password',
            'birth_date' => 'date',
            'rank_id' => 'exists:ranks,id',
            'fav_drink_id' => 'exists:drinks,id',
            'doublette_user_id' => 'exists:users,id',
            'role_id' => [
                'exists:roles,id',
                function ($attribute, $value, $fail) {
                    if (!auth()->user()->isAdmin()) {
                        $fail("Vous n'avez pas le droit de modifier le rôle.");
                    }
                },
            ],
        ]);

        $this->authorize('update', [$user, $id]);
        $updated = $user->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'User updated',
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not updated'
            ], 500);
        }
    }
}
