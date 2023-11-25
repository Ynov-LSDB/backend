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
}
