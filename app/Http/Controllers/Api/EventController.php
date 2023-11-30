<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\UserEvent;
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
        $events = Event::with('category')->where('status', '=','ok')->where('is_closed', '=', false)->get();
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

    public function indexPaginated()
    {
        $events = Event::with('category')->where('status', '=','ok')->where('is_closed', '=', false)->paginate(6);
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
        $event = Event::with(['category', 'drinks', 'users'])->where('status', '=','ok')->find($id);
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
        if ($event->imageURL) {
            $file = $request->file('imageURL');
            $extension = $file->getClientOriginalExtension();
            $pathProfile = time() . '_Event.' . $extension;
            //$file = Image::make($file)->resize(1200, 360)->encode($extension)->save(); // resize image
            //Storage::disk('s3')->put($path, $file);
            $s3 = Storage::disk('s3');
            $s3->put($pathProfile, file_get_contents($file));
            $event->imageURL = Storage::disk('s3')->temporaryUrl($event->imageURL, now()->addMinutes(5)); //give a temporary url that expires in 5 minutes
        }
        // il faut ajouter a user_event la relation entre le user (creator) et l'event
        $userEvent = new UserEvent();
        $userEvent->user_id = $creatorId;
        $userEvent->event_id = $event->id;
        $userEvent->save();

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

        // delete all user_event relations
        $userEvents = UserEvent::where('event_id', '=', $id)->get();
        foreach ($userEvents as $userEvent) {
            $userEvent->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Event deleted'
        ], 200);
    }

    public function last()
    {
        //by created at
        $event = Event::with('category')->where('status', '=','ok')->where('is_closed', '=', false)->orderBy('created_at', 'desc')->first();
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

    public function close($id)
    {
        $event = Event::findOrFail($id);
        $this->authorize('close', $event);
        $request = request()->all();
        $firstUser = UserEvent::where('user_id', '=', $request['first'])->where('event_id', '=', $id)->first();
        $secondUser = UserEvent::where('user_id', '=', $request['second'])->where('event_id', '=', $id)->first();
        $thirdUser = UserEvent::where('user_id', '=', $request['third'])->where('event_id', '=', $id)->first();

        //check if the users are in the event && are different
        if (!$firstUser || !$secondUser || !$thirdUser || $firstUser->user_id == $secondUser->user_id || $firstUser->user_id == $thirdUser->user_id || $secondUser->user_id == $thirdUser->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Users not found in the event or are the same'
            ], 400);
        }

        //check if the event is already closed
        if ($event->is_closed) {
            return response()->json([
                'success' => false,
                'message' => 'Event already closed'
            ], 400);
        }

        // give points to the users
        $users = UserEvent::where('event_id', '=', $id)->get();
        $averageScore = 0;
        foreach ($users as $user) {
            $averageScore += $user->user->score;
        }
        $averageScore = $averageScore / count($users);

        $firstUser->user->score += $averageScore * 0.1;
        $secondUser->user->score += $averageScore * 0.05;
        $thirdUser->user->score += $averageScore * 0.03;
        $firstUser->user->save();
        $secondUser->user->save();
        $thirdUser->user->save();

        $event->is_closed = true;
        $event->save();

        return response()->json([
            'success' => true,
            'averageScore' => $averageScore,
            'message' => 'Event closed',
            'data' => $event
        ], 200);
    }
}
