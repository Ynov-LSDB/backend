<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;


class EventController extends Controller
{

    public function __construct()
    {
        //
    }

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

    public function update($id, Request $request)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 400);
        }
        $this->authorize('update', $event);
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

    public function delete($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 400);
        }
        $this->authorize('delete', $event);
        $event->delete();
        return response()->json([
            'success' => true,
            'message' => 'Event deleted'
        ], 200);
    }

    public function last()
    {
        //by created at
        $event = Event::with('category')->where('status', '=','À venir')->orderBy('created_at', 'desc')->first();
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 400);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Event found',
                'data' => $event
            ], 200);
        }
    }
}
