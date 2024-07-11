<?php

namespace Database\Factories;

use App\Models\Director;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        //crea un ID casuale di una foto da Lorem Picsum
        $imageId = fake()->numberBetween(1, 1000);
        //crea l'URL del poster usando l'ID dell'immagine casuale
        $posterUrl = "https://picsum.photos/id/{$imageId}/400/600";
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'director_id' => function () {
                return Director::inRandomOrder()->first()->id; //ottengo un ID casuale di un regista
                },
                'year' => fake()->year(),
                'poster' => $posterUrl
        ];
    }
}
