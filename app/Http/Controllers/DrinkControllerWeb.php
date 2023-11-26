<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use Illuminate\Http\Request;

class DrinkControllerWeb extends Controller
{
    public function index()
    {
        return view('drink.index', [
            'drinks' => Drink::all()
        ]);
    }

    public function edit($id)
    {
        return view('drink.edit', [
            'drink' => Drink::findOrFail($id)
        ]);
    }

    public function create()
    {
        return view('drink.create');
    }
}
