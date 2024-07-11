<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($filmId)
    {
        $reviews = Review::where('film_id', $filmId)->get();
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Film $film)
    {
        return view('reviews.create', compact('film'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'film_id' => 'required|exists:films,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        // Creazione della recensione
        $review = new Review();
        $review->user_id = null; // Imposta user_id su null
        $review->film_id = $request->film_id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        //reindirizza mostrando messaggio di successo
        return redirect()->route('reviews.index', ['film' => $request->film_id])
                         ->with('success', 'Recensione aggiunta con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
