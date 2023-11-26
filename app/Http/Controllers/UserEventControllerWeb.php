<?php

namespace App\Http\Controllers;

use App\Models\UserEvent;
use Illuminate\Http\Request;

class UserEventControllerWeb extends Controller
{
    public function index()
    {
        return view('userEvent.index', [
            'userEvents' => UserEvent::all()
        ]);
    }

    public function edit($id)
    { // pas besoin pour la table de jonction
        return view('userEvent.edit', [
            'userEvent' => UserEvent::findOrFail($id)
        ]);
    }

    public function create()
    {
        return view('userEvent.create');
    }
}
