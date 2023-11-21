<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quadrette>
 */
class QuadretteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "creator_user_id_1" => function () {
                return User::all()->random()->id;
            },
            "user_id_2" => function (array $attributes) {
                // Sélectionne un utilisateur différent de creator_user_id_1
                return User::where('id', '!=', $attributes['creator_user_id_1'])->get()->random()->id;
            },
            "user_id_3" => function (array $attributes) {
                // Sélectionne un utilisateur différent de creator_user_id_1 et user_id_2
                return User::whereNotIn('id', [$attributes['creator_user_id_1'], $attributes['user_id_2']])
                    ->get()->random()->id;
            },
            "user_id_4" => function (array $attributes) {
                // Sélectionne un utilisateur différent de creator_user_id_1, user_id_2 et user_id_3
                return User::whereNotIn('id', [$attributes['creator_user_id_1'], $attributes['user_id_2'], $attributes['user_id_3']])
                    ->get()->random()->id;
            },
        ];
    }
}
