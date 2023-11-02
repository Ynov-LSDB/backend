<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Drink;
use App\Models\DrinkEvent;
use App\Models\Event;
use App\Models\Rank;
use App\Models\Role;
use App\Models\User;
use App\Models\UserEvent;
use Database\Factories\DrinkEventFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::Factory()->count(10)->create();
        Rank::Factory()->count(5)->create();
        Role::Factory()->count(5)->create();
        Drink::Factory()->count(5)->create();
        Event::Factory()->count(3)->create();
        User::Factory()->count(10)->create();
        DrinkEvent::Factory()->count(10)->create();
        UserEvent::Factory()->count(20)->create();
    }
}
