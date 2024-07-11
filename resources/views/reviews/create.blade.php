@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Aggiungi una Recensione per {{ $film->title }}</h1>

    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="film_id" value="{{ $film->id }}">
        <div class="form-group">
            <label for="rating">Voto</label>
            <select name="rating" id="rating" class="form-control" required>
                <option value="">Seleziona un voto</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div class=" mt-2 form-group">
            <label for="comment">Commento</label>
            <textarea name="comment" id="comment" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Invia Recensione</button>
    </form>
</div>
@endsection