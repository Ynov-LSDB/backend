<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Drink;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $teamstyle = ['doublette', 'triplette', 'quadrette', 'tete tete'];
        return [
            'title' => $this->faker->name(),
            'date' => $this->faker->dateTime(),
            'price' => $this->faker->numberBetween(0, 100),
            'category_id' => Category::all()->random()->id,
            'adresse' => $this->faker->address(),
            'is_food_on_site' => $this->faker->boolean(),
            'registered_limit' => $this->faker->numberBetween(0, 100),
            'team_style' => $teamstyle[array_rand($teamstyle)],
            'status' => $this->faker->word(),
        ];
    }
}
