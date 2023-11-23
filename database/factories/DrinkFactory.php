<?php

namespace Database\Factories;

use App\Models\Drink;
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
        $degree = fake()->numberBetween(0, 80);

        return [
            'title' => "",
            'description' => fake()->text(),
            'degree' => $degree,
            'imageURL' => fake()->imageUrl(640, 480, 'drink'),
            'is_cuite_possible' => $degree < 5 ? false : true,
            'nbr_ice_max' => fake()->numberBetween(0, 3),
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (Drink $drink) {
            $boissons = ["Ricard", "Vodka", "Whisky", "Rhum", "Tequila", "Gin", "Vermouth", "Cognac", "Champagne", "Martini", "Bourbon", "Sambuca", "Baileys", "Cointreau", "Pisco", "Absinthe", "Amaretto", "Saké", "Prosecco", "Brandy", "Campari", "Jägermeister", "Kalhua", "Grand Marnier", "Chambord", "Chartreuse", "Irish Cream", "Midori", "Drambuie", "Armagnac", "Limoncello", "Pimm's", "Pastis", "Grappa", "Crème de Menthe", "Soju", "Pina Colada", "Mojito", "Margarita", "White Russian", "Dark and Stormy", "Bellini", "Moscow Mule", "Negroni", "Piña Colada", "Sex on the Beach", "Mai Tai", "Mojito", "Caipirinha", "Old Fashioned"];
            $descriptions = ["Comme un feu de camp dans une bouteille - réchauffe l'âme et les orteils en même temps.", "C'est comme une fête dans un verre, avec la menthe qui fait le moonwalk sur votre langue.", "L'eau de vie qui transforme instantanément n'importe quelle soirée en fête.", "La potion magique qui transforme les timides en danseurs de salsa impromptus.", "Comme une forêt enchantée dans un verre - chaque gorgée est une balade dans les bois.", "Capture l'esprit des îles en une gorgée - le soleil, la mer et une brise légère.", "L'élégance en verre, secoué avec une touche de sophistication.", "Les bulles sont comme des éclats de rire dans une célébration perpétuelle.", "Un peu comme une soirée en forêt avec des amis - épicé, mémorable et un peu mystérieux.", "Un voyage instantané vers une plage tropicale - la gourmandise et la détente dans chaque gorgée."];
            $drink->title = $boissons[$drink->id - 1];
            $drink->description = $descriptions[rand(0, count($descriptions) - 1)];
            $drink->save();
        });
    }
}
