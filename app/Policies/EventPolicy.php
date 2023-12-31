<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function index(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Event $event): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Event $event): Response
    {
        return $user->isAdmin() || $user->id === $event->creator_id ? Response::allow() : Response::deny('You do not own this event.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Event $event): Response
    {
        return $user->isAdmin() || $user->id === $event->creator_id ? Response::allow() : Response::deny('You do not own this event.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Event $event): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Event $event): bool
    {
        //return $user->isAdmin() || $user->id === $event->creator_id;
        return false;
    }

    public function close(User $user, Event $event): Response
    {
        return $user->isAdmin() || $user->id === $event->creator_id ? Response::allow() : Response::deny('You do not own this event.');
    }
}
