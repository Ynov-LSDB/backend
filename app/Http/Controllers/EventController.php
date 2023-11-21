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
        $event = Event::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Event created',
            'data' => $event
        ], 200);
    }

    public function update($id, Request $request)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 400);
        }

        $updated = $event->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'Event updated',
                'data' => $event
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Event not updated'
            ], 500);
        }
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
