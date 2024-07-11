<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Director;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$films = Film::orderBy('id')->paginate(10); //ordina i film in base alla chiave primaria

        $sorting_options = [
            'title_asc' => ['title', 'asc'],
            'title_desc' => ['title', 'desc'],
            'anno_asc' => ['year', 'asc'],
            'anno_desc' => ['year', 'desc'],
            'director_asc' => ['name', 'asc'],
            'director_desc' => ['name', 'desc'],
        ];

        $default_sorting = ['title', 'asc'];
        $sort = $request->input('sort');

        $orderBy =  $sorting_options[$sort] ?? $default_sorting;
        // dd($orderBy);
        //nel model la relazione si chiama director        
        $films = Film::with('director')->leftJoin('directors', 'films.director_id', '=', 'directors.id')->orderBy($orderBy[0], $orderBy[1])->select('films.*', 'directors.name as director_name')->paginate(10);
        
        return view('admin.films.index', compact('films', 'sort'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        // Recupera tutti i registi disponibili
        $directors = Director::all();
        // Recupera tutti gli attori disponibili
        $actors = Actor::all();
        // Passa i dati alla vista create
        return view('admin.films.create', compact('genres', 'directors', 'actors'));
    }

    private function validateFilmData(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'director_id' => 'required|exists:directors,id',
            'actors' => 'required|array',
            'actors.*' => 'exists:actors,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y')),
            'description' => 'required|string',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'genres' => 'required|array',
            'genres.*' => 'exists:genres,id',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //valido i dati
        $validateData = $this->validateFilmData($request);
        //creo l'istanza
        $film = new Film();
        //riempio i campi della tabella
        $film->fill($validateData);

        //gestione immagine
        if ($request->hasFile('poster')) {
            $fileName = time() . '_' . $request->file('poster')->getClientOriginalName();
            //carica l'immagine dentro la cartella storage/posters
            $request->file('poster')->storeAs('posters', $fileName, 'public');
            //salva il percorso solo del nome del file nel campo del db
            $film->poster = $fileName;
        }

        if($film->save()){

            $film->actors()->attach($validateData['actors']);//se il film si è salvato, "attacca" gli attori e i generi nelle tabelle ponte
            $film->genres()->attach($validateData['genres']);
        }

        return redirect()->route('films.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $film = Film::find($id);
        return view('films.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Trova il film da modificare
        $film = Film::findOrFail($id);
        //ottiene tutti i generi disponibili
        $genres = Genre::all();
        //ottiene tutti i registi disponibili
        $directors = Director::all();
        //ottiene tutti gli attori disponibili
        $actors = Actor::all();
        //passa i dati alla vista edit
        return view('admin.films.edit', compact('film', 'genres', 'directors', 'actors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         //validare i dati
         $validateData = $this->validateFilmData($request);
         $film = Film::findOrFail($id); //trova il film con quell'ID
         $film->fill($validateData); //riempie i campi della tabella film

         //gestisce l'immagine
 
         if ($request->hasFile('poster')) {
             //gestiamo l'immagine
             $fileName = time() . '_' . $request->file('poster')->getClientOriginalName();
             //carica l'immagine dentro la cartella storage/posters
             $posterPath = $request->file('poster')->storeAs('posters', $fileName, 'public');
             //salva il percorso nel campo del db
             $film->poster = $posterPath;
         }
 
         if ($film->save()) {
             $film->actors()->sync($validateData['actors']); //quando si modifica, non si utikizza attach ma sync
             $film->genres()->sync($validateData['genres']);
         }
 
         return redirect()->route('films.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //trova il film da eliminare
    $film = Film::findOrFail($id);

    //gestione delle relazioni (se necessario)
    //assicura di rimuovere le relazioni prima di eliminare il film
    $film->actors()->detach();
    $film->genres()->detach();

    //elimina l'immagine associata, se esiste
    if ($film->poster && Storage::disk('public')->exists($film->poster)) {
        Storage::disk('public')->delete($film->poster);
    }

    //elimina il film
    $film->delete();

    //mostra un messaggio di successo
    return redirect()->route('films.index')->with('success', 'Film eliminato con successo!');
    }
}
