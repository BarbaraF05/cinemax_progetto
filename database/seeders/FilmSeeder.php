<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Actor::factory()->count(20)->create();
        Director::factory()->count(10)->create();
        Film::factory()->count(20)->create();
        Genre::factory()->count(10)->create();
        
        $this->call(ActorFilmSeeder::class); 
        $this->call(FilmGenreSeeder::class);
    }
}
