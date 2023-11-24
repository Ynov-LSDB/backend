<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return response()->json([
            'success' => true,
            'message' =>count($roles) . " roles found",
            'data' => $roles
        ], 200);
    }

    public function show($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json([
                'success' => false,
                'message' => 'Role not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Role found',
            'data' => $role
        ], 200);
    }

    public function store(Request $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->save();

        return response()->json([
            'success' => true,
            'message' => 'Role created',
            'data' => $role
        ], 200);
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json([
                'success' => false,
                'message' => 'Role not found'
            ], 400);
        }
        $role->delete();
        return response()->json([
            'success' => true,
            'message' => 'Role deleted',
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        if (!$role) {
            return response()->json([
                'success' => false,
                'message' => 'Role not found'
            ], 400);
        }
        $role->name = $request->name;
        $role->save();
        return response()->json([
            'success' => true,
            'message' => 'Role updated',
            'data' => $role
        ], 200);
    }
}
