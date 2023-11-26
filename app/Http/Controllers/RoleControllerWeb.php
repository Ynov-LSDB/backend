<?php

namespace App\Http\Controllers;

use App\Models\Role;

class RoleControllerWeb extends Controller
{
    public function index()
    {
        return view('role.index', [
            'roles' => Role::all()
        ]);
    }

    public function edit($id)
    {
        return view('role.edit', [
            'role' => Role::findOrFail($id)
        ]);
    }

    public function create()
    {
        return view('role.create');
    }
}
