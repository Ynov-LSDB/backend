<?php

namespace App\Http\Controllers;

use App\Models\DrinkEvent;
use Illuminate\Http\Request;

class DrinkEventControllerWeb extends Controller
{
    public function index()
    {
        return view('drinkEvent.index', [
            'drinkEvents' => DrinkEvent::all()
        ]);
    }

    public function edit($id)
    { // pas besoin pour la table de jonction
        return view('drinkEvent.edit', [
            'drinkEvent' => DrinkEvent::findOrFail($id)
        ]);
    }

    public function create()
    {
        return view('drinkEvent.create');
    }
}
