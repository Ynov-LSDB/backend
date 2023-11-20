<?php

namespace Database\Factories;

use App\Models\Drink;
use App\Models\Role;
use App\Models\Rank;
use App\Models\Event;
use App\Models\User;
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
            'rank_id' => Rank::all()->random()->id,
            'birth_date' => $this->faker->date(),
            'fav_drink_id' => Drink::all()->random()->id,
            'doublette_user_id' => null,
            'status' => "OK",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role_id' => Role::all()->random()->id,
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

    public function configure() {
        return $this->afterCreating(function (User $user) {
            $doublette = User::all()->random()->id;
            while ($doublette == $user->id) {
                $doublette = User::all()->random()->id;
            }
            $user->doublette_user_id = $doublette;
            $user->save();
        });
    }
}
