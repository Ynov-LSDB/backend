<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
