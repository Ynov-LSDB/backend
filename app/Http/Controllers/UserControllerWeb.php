<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserControllerWeb extends Controller
{
    public function index()
    {
        return view('user.index', [
            'users' => User::all()
        ]);
    }

    public function edit($id)
    {
        return view('user.edit', [
            'user' => User::findOrFail($id)
        ]);
    }

    public function create()
    {
        return view('user.create');
    }
}
