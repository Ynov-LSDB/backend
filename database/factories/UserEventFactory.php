<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use App\Models\UserEvent;
use Closure;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserEvent>
 */
class UserEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'event_id' => Event::all()->random()->id
        ];
    }

    public function configure(): UserEventFactory
    {
        return $this->afterCreating(function (UserEvent $userEvent) {
            if (UserEvent::all()->where('user_id', '=', $userEvent->user_id)->where('event_id', '=', $userEvent->event_id)->count() > 1) {
                $userEvent->delete(); // si l'event existe déjà pour l'user, on le supprime
            }
        });
    }
}
