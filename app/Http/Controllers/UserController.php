<?php

namespace App\Http\Controllers;

use App\Models\UserEvent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['role', 'rank', 'drink', 'events', 'doublette'])->get();
        return response()->json([
            'success' => true,
            'message' => 'OK',
            'data' => $users
        ], 200);
    }

    public function show($id)
    {
        $user = User::with(['role', 'rank', 'drink', 'events', 'doublette'])->find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'User found',
            'data' => $user
        ], 200);
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->fill($request->all());
        if ($user->isDirty('imageURL_profile')) {
            $file = $request->file('imageURL_profile');
            $extension = $file->getClientOriginalExtension();
            $pathProfile = time() . '_Profile.' . $extension;
            $s3 = Storage::disk('s3');
            $s3->put($pathProfile, file_get_contents($file));
            $user->imageURL_profile = $pathProfile;
        }

        if ($user->isDirty('imageURL_fav_balls')) {
            $file = $request->file('imageURL_fav_balls');
            $extension = $file->getClientOriginalExtension();
            $pathFavBalls = time() . '_FavBalls.' . $extension;
            $s3 = Storage::disk('s3');
            $s3->put($pathFavBalls, file_get_contents($file));
            $user->imageURL_fav_balls = $pathFavBalls;
        }
        $user->role()->associate(2);
        $created = $user->save();
        if ($created) {
            if ($user->imageURL_profile) {
                $user->imageURL_profile = $s3->temporaryUrl($pathProfile, now()->addMinutes(5)); //give a temporary url that expires in 5 minutes
            }
            if ($user->imageURL_fav_balls) {
                $user->imageURL_fav_balls = $s3->temporaryUrl($pathFavBalls, now()->addMinutes(5));
            }
            return response()->json([
                'success' => true,
                'message' => 'User created',
                'data' => $user
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not created'
            ], 500);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 400);
        }
        $this->authorize('delete', $user);
        $image_profile = $user->imageURL_profile;
        $image_fav_balls = $user->imageURL_fav_balls;
        $deleted = $user->delete();
        if ($deleted) {
            if ($image_profile) {
                Storage::disk('s3')->delete($image_profile);
            }
            if ($image_fav_balls) {
                Storage::disk('s3')->delete($image_fav_balls);
            }
            return response()->json([
                'success' => true,
                'message' => 'User deleted'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not deleted'
            ], 500);
        }
    }

    public function update($id, Request $request)
    {
        $user = User::with(['role', 'rank', 'drink', 'events', 'doublette'])->find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 400);
        }

        $this->authorize('update', [$user, $id]);

        $oldImageProfile = $user->imageURL_profile;
        $oldImageFavBalls = $user->imageURL_fav_balls;

        $user->fill($request->all());
        if ($user->isDirty('imageURL_profile')) {
            $file = $request->file('imageURL_profile');
            $extension = $file->getClientOriginalExtension();
            $pathProfile = time() . '_Profile.' . $extension;
            //$file = Image::make($file)->resize(1200, 360)->encode($extension)->save(); // resize image
            //Storage::disk('s3')->put($path, $file);
            $s3 = Storage::disk('s3');
            $s3->put($pathProfile, file_get_contents($file));
            $user->imageURL_profile = $pathProfile;
        }

        if ($user->isDirty('imageURL_fav_balls')) {
            $file = $request->file('imageURL_fav_balls');
            $extension = $file->getClientOriginalExtension();
            $pathFavBalls = time() . '_FavBalls.' . $extension;
            //$file = Image::make($file)->resize(1200, 360)->encode($extension)->save(); // resize image
            //Storage::disk('s3')->put($path, $file);
            $s3 = Storage::disk('s3');
            $s3->put($pathFavBalls, file_get_contents($file));
            $user->imageURL_fav_balls = $pathFavBalls;
        }

        if ($user->isDirty('fav_drink_id') && $user->fav_drink_id == 0) {
            $user->fav_drink_id = null;
        }
        if ($user->isDirty('doublette_user_id') && $user->doublette_user_id == 0) {
            $user->doublette_user_id = null;
        }

        $updated = $user->save();

        if ($updated) {
            if ($oldImageProfile != $user->imageURL_profile) {
                if ($oldImageProfile) {
                    Storage::disk('s3')->delete($oldImageProfile);
                }
            }
            if ($user->imageURL_profile) {
                $user->imageURL_profile = $s3->temporaryUrl($pathProfile, now()->addMinutes(5)); //give a temporary url that expires in 5 minutes
            }

            if ($oldImageFavBalls != $user->imageURL_fav_balls) {
                if ($oldImageFavBalls) {
                    Storage::disk('s3')->delete($oldImageFavBalls);
                }
            }
            if ($user->imageURL_fav_balls) {
                $user->imageURL_fav_balls = $s3->temporaryUrl($pathFavBalls, now()->addMinutes(5)); //give a temporary url that expires in 5 minutes
            }

            return response()->json([
                'success' => true,
                'message' => 'User updated',
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not updated'
            ], 500);
        }
    }

    public function nextEvent()
    {
        $userId = auth()->user()->id;
        // affiche le prochain event auquel l'utilisateur participe
        $user = User::with(['events'])->find($userId);
        $nextEvent = $user['events']->sortBy('date')->last();
        if (!$nextEvent) {
            return response()->json([
                'success' => true,
                'message' => 'No event found',
                'data' => null
            ], 400);
        }
        if ($nextEvent->imageURL) {
            $nextEvent->imageURL = Storage::disk('s3')->temporaryUrl($nextEvent->imageURL, now()->addMinutes(5)); //give a temporary url that expires in 5 minutes
        }
        return response()->json([
            'success' => true,
            'message' => 'Next event found',
            'data' => $nextEvent
        ], 200);
    }

    public function inEvent()
    {
        $userId = auth()->user()->id;
        // affiche tous les events dans lesquel l'utilisateur participe
        $user = User::with(['events'])->find($userId);
        $events = $user['events'];
        foreach ($events as $event) {
            if ($event->imageURL) {
                $event->imageURL = Storage::disk('s3')->temporaryUrl($event->imageURL, now()->addMinutes(5)); //give a temporary url that expires in 5 minutes
            }
        }
        if (!$events) {
            return response()->json([
                'success' => true,
                'message' => 'No event found',
                'data' => null
            ], 400);
        } else {
            return response()->json([
                'success' => true,
                'message' => count($events) . ' event(s) found',
                'data' => $events
            ], 200);
        }
    }

    public function notInEvent()
    {
        $userId = auth()->user()->id;
        // affiche tous les events dans lesquel l'utilisateur ne participe pas
        $events = UserEvent::with(['event'])
            ->where('user_id', '!=', $userId)
            ->groupBy('event_id')
            ->selectRaw('event_id')
            ->get();
        foreach ($events as $event) {
            $data[] = $event['event'];
            if ($event['event']->imageURL) {
                $event['event']->imageURL = Storage::disk('s3')->temporaryUrl($event['event']->imageURL, now()->addMinutes(5)); //give a temporary url that expires in 5 minutes
            }
        }

        if (!$events) {
            return response()->json([
                'success' => true,
                'message' => 'No event found',
                'data' => null
            ], 400);
        } else {
            return response()->json([
                'success' => true,
                'message' => count($events) . ' event(s) found',
                'data' => $data
            ], 200);
        }
    }

    public function joinEvent($id)
    {
        $userId = auth()->user()->id;
        $user = User::with(['events'])->find($userId);
        if ($user['events']->find($id) != null) {
            return response()->json([
                'success' => false,
                'message' => 'User already in event',
                'data' => null
            ], 400);
        } else {
            UserEvent::create([
                'user_id' => $userId,
                'event_id' => $id
            ]);
            return response()->json([
                'success' => true,
                'message' => 'User joined event',
            ], 200);
        }
    }

    public function leaveEvent($id)
    {
        $userId = auth()->user()->id;
        $user = User::with(['events'])->find($userId);
        if ($user['events']->find($id) == null) {
            return response()->json([
                'success' => false,
                'message' => 'User not in event',
                'data' => null
            ], 400);
        } else {
            UserEvent::where('user_id', $userId)->where('event_id', $id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'User left event',
            ], 200);
        }
    }

    public function getRankingPaginate(Request $request)
    public function getRankingPaginate(Request $request)
    {
        $users = User::select('id', 'firstname', 'lastname', 'score')->orderBy('score', 'desc')->paginate($request->get('size'));
        return response()->json([
            'success' => true,
            'message' => 'OK',
            'data' => $users
        ], 200);
    }

    public function weeklyScoreReduction()
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->score = $user->score * 0.9;
            $user->save();
        }
        
        return response()->json([
            'success' => true,
            'message' => 'All users score reduced by 10%',
        ], 200);
    }

    public function weeklyScoreReduction()
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->score = $user->score * 0.9;
            $user->save();
        }
        
        return response()->json([
            'success' => true,
            'message' => 'All users score reduced by 10%',
        ], 200);
    }
}
