<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DrinkEvent;

class DrinkEventController extends Controller
{
    public function index()
    {
        $drinkEvents = DrinkEvent::all();
        return response()->json([
            'success' => true,
            'message' => count($drinkEvents) . ' DrinkEvents found',
            'data' => $drinkEvents
        ], 200);
    }

    public function delete($id)
    {
        $drinkEvent = DrinkEvent::findOrFail($id);
        $drinkEvent->delete();
        return response()->json([
            'success' => true,
            'message' => 'drink is not in the event anymore',
            'data' => $drinkEvent
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'drink_id' => 'required|integer',
            'event_id' => 'required|integer'
        ]);
        $drinkEvent = DrinkEvent::where('drink_id', $request->drink_id)->where('event_id', $request->event_id)->first();
        if ($drinkEvent) {
            return response()->json([
                'success' => false,
                'message' => 'This drink is already in the event',
                'data' => $drinkEvent
            ], 409);
        }

        $drinkEvent = new DrinkEvent();
        $drinkEvent->drink_id = $request->drink_id;
        $drinkEvent->event_id = $request->event_id;
        $drinkEvent->save();
        return response()->json([
            'success' => true,
            'message' => 'This drink is now in the event',
            'data' => $drinkEvent
        ], 200);
    }
}
