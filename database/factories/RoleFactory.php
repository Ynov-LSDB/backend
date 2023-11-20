<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => "user"
        ];
    }

    public function configure() {
        //just the first one

        return $this->afterCreating(function (Role $role) { // just the first one
            $role->name = $role->id == 1 ? 'admin' : $role->name;
            $role->save();
        });
    }
}
