<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Drink>
 */
class DrinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $degree = fake()->numberBetween(0, 100);

        return [
            'title' => fake()->name(),
            'description' => fake()->text(),
            'degree' => $degree,
            'imageURL' => fake()->imageUrl(640, 480, 'drink'),
            'is_cuite_possible' => $degree < 5 ? false : true,
            'nbr_ice_max' => fake()->numberBetween(0, 3),
        ];
    }
}
