<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class EventController extends Controller
{

    public function __construct()
    {
        //
    }

    public function index()
    {
        $events = Event::with('category')->get();
        foreach ($events as $event) {
            if ($event->imageURL) {
                $event->imageURL = Storage::disk('s3')->temporaryUrl($event->imageURL, now()->addMinutes(5)); //give a temporary url that expires in 5 minutes
            }
        }
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
        if ($event->imageURL) {
            $event->imageURL = Storage::disk('s3')->temporaryUrl($event->imageURL, now()->addMinutes(5)); //give a temporary url that expires in 5 minutes
        }
        return response()->json([
            'success' => true,
            'message' => 'Event found',
            'data' => $event
        ], 200);
    }

    public function store(Request $request)
    {
        $creatorId = auth()->user()->id;
        $event = new Event();
        $event->fill($request->all());
        $event->creator_id = $creatorId;
        $event->status = $request->status ? $request->status : 'ok';
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
        $oldImage = $event->imageURL;

        $event->fill($request->all());

        if ($event->isDirty('imageURL')) {
            $file = $request->file('imageURL');
            $extension = $file->getClientOriginalExtension();
            $pathProfile = time() . '_Event.' . $extension;
            //$file = Image::make($file)->resize(1200, 360)->encode($extension)->save(); // resize image
            //Storage::disk('s3')->put($path, $file);
            $s3 = Storage::disk('s3');
            $s3->put($pathProfile, file_get_contents($file));
            $event->imageURL = $pathProfile;
        }
        $updated = $event->save();
        if ($updated) {
            if ($oldImage != $event->imageURL) {
                if ($oldImage) {
                    Storage::disk('s3')->delete($oldImage);
                }
                $event->imageURL = $s3->temporaryUrl($pathProfile, now()->addMinutes(5)); //give a temporary url that expires in 5 minutes
            }
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
            if ($event->imageURL) {
                $event->imageURL = Storage::disk('s3')->temporaryUrl($event->imageURL, now()->addMinutes(5)); //give a temporary url that expires in 5 minutes
            }
            return response()->json([
                'success' => true,
                'message' => 'Event found',
                'data' => $event
            ], 200);
        }
    }
}
