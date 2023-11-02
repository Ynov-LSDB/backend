<?php

namespace Database\Factories;

use App\Models\Drink;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DrinkEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'drink_id' => Drink::all()->random()->id,
            'event_id' => Event::all()->random()->id,
        ];
    }
}
