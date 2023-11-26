<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserEvent;

class UserEventController extends Controller
{
    public function index()
    {
        $userEvents = UserEvent::all();
        return response()->json([
            'success' => true,
            'message' => count($userEvents) . ' UserEvents found',
            'data' => $userEvents
        ], 200);
    }

    public function delete($id)
    {
        $userEvent = UserEvent::findOrFail($id);
        $userEvent->delete();
        $eventdeleted = false;
        // si c'était le dernier user de l'event, on supprime aussi l'event
        $userEvents = UserEvent::where('event_id', $userEvent->event_id)->count();
        if ($userEvents == 0) {
            $userEvent->event->delete();
            $eventdeleted = true;
        }
        return response()->json([
            'success' => true,
            'message' => $eventdeleted ? 'User is not in the event anymore and the event is deleted' : 'User is not in the event anymore',
            'data' => $userEvent
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'event_id' => 'required|integer'
        ]);
        $userEvent = UserEvent::where('user_id', $request->user_id)->where('event_id', $request->event_id)->first();
        if ($userEvent) {
            return response()->json([
                'success' => false,
                'message' => 'User is already in the event',
                'data' => $userEvent
            ], 409);
        }

        $userEvent = new UserEvent();
        $userEvent->user_id = $request->user_id;
        $userEvent->event_id = $request->event_id;
        $userEvent->save();
        return response()->json([
            'success' => true,
            'message' => 'User is now in the event',
            'data' => $userEvent
        ], 200);
    }

    public function doublonsDestroyer()
    {
        // j'ai plein de controles pour ne pas avoir de doublons donc...
    }
}
