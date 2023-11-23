<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Drink;
use App\Models\DrinkEvent;
use App\Models\Event;
use App\Models\Quadrette;
use App\Models\Rank;
use App\Models\Role;
use App\Models\Triplette;
use App\Models\User;
use App\Models\UserEvent;
use Database\Factories\DrinkEventFactory;
use Database\Factories\QuadretteFactory;
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
        Role::Factory()->count(2)->create();
        Drink::Factory()->count(50)->create();
        User::Factory()->count(100)->create();
        Event::Factory()->count(10)->create();
        DrinkEvent::Factory()->count(10)->create();
        UserEvent::Factory()->count(30)->create();
        Triplette::Factory()->count(50)->create();
        Quadrette::Factory()->count(5)->create();
    }
}
