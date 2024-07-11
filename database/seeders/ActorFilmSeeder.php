<?php

namespace Database\Seeders;

use App\Models\Actor;
use App\Models\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ActorFilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $films = Film::all();
        $actors = Actor::all();
        foreach ($films as $film) {
            if ($film->actors()->exists()) {
                //se il film ha degli attori associati
                continue; //passa al prossimo film
                }
                $numActors = rand(1, 5); //genera un numero casuale
                //sceglie casualmente alcuni attori
                $selectedActors = $actors->random($numActors);
                //associa (attach) il film agli attori selezionati
                foreach ($selectedActors as $actor) {
                    $film->actors()->attach($actor->id,
                    [
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                ]);

                }
            }
    }
}
