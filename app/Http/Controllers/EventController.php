<?php

namespace App\Http\Controllers;

use App\Models\DrinkEvent;
use App\Models\Event;
use Illuminate\Http\Request;


class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('category')->get();
        return response()->json([
            'success' => true,
            'message' =>count($events) . " events found",
            'data' => $events
        ], 200);
    }

    public function show($id)
    {
        $event = Event::with(['category', 'drinks', 'users'])->find($id);
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Event found',
            'data' => $event
        ], 200);
    }

    public function store(Request $request)
    {
        $event = new Event();
        $event->title = $request->title;
        $event->date = $request->date;
        $event->price = $request->price;
        $event->category_id = $request->category_id;
        $event->adresse = $request->adresse;
        $event->is_food_on_site = $request->is_food_on_site;
        $event->registered_limit = $request->registered_limit;
        $event->team_style = $request->team_style;
        $event->status = $request->status;
        $event->save();

        return response()->json([
            'success' => true,
            'message' => 'Event created',
            'data' => $event
        ], 200);
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 400);
        }
        $event->delete();
        return response()->json([
            'success' => true,
            'message' => 'Event deleted'
        ], 200);
    }
}
