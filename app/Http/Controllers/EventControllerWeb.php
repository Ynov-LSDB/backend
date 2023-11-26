<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventControllerWeb extends Controller
{
    public function index()
    {
        return view('event.index', [
            'events' => Event::all()
        ]);
    }

    public function edit($id)
    {
        return view('event.edit', [
            'event' => Event::findOrFail($id)
        ]);
    }

    public function create()
    {
        return view('event.create');
    }
}
