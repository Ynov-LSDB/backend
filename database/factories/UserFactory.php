<?php

namespace Database\Factories;

use App\Models\Drink;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'imageURL_fav_balls' => $this->faker->imageUrl(),
            'fav_balls_name' => $this->faker->word(),
            'rank_id' => $this->faker->numberBetween(1, 10),
            'birth_date' => $this->faker->date(),
            'fav_drink_id' => Drink::all()->random()->id,
            'doublette_user_id' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->word(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
