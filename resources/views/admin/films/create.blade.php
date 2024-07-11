@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="p-5 bg-light rounded">
                <h2 class="mb-4">Inserisci un nuovo film</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('films.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Titolo del film -->
                    <div class="form-group mb-3">
                        <label for="title" class="text-primary">Titolo</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>

                    <!-- Generi del film -->
                    <div class="form-group mb-3">
                        <label class="text-success">Generi</label>
                        <div class="row">
                            @foreach($genres as $genre)
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input type="checkbox" name="genres[]" id="genre{{ $genre->id }}" value="{{ $genre->id }}" class="form-check-input">
                                        <label for="genre{{ $genre->id }}" class="form-check-label">{{ $genre->name }}</label>
                                    </div>
                                </div>                                
                            @endforeach
                        </div>
                    </div>

                    <!-- Regista del film -->
                    <div class="form-group mb-3">
                        <label for="director" class="text-success">Regista</label>
                        <select name="director_id" id="director" class="form-control" required>
                            @foreach($directors as $director)
                                <option value="{{ $director->id }}">{{ $director->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Attori del film -->
                    <div class="form-group mb-3">
                        <label for="actors" class="text-warning">Attori</label>
                        <select name="actors[]" id="actors" class="form-control" multiple required>
                            @foreach($actors as $actor)
                                <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Anno di uscita del film -->
                    <div class="form-group mb-3">
                        <label for="year" class="text-danger">Anno di uscita</label>
                        <input type="text" name="year" id="year" class="form-control" required>
                    </div>

                    <!-- Descrizione del film -->
                    <div class="form-group mb-3">
                        <label for="description" class="text-muted">Descrizione</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>

                    <!-- Immagine del poster -->
                    <div class="form-group mb-4">
                        <label for="poster" class="text-primary">Immagine del poster</label>
                        <input type="file" name="poster" id="poster" class="form-control-file">
                    </div>

                    <button type="submit" class="btn btn-primary">Salva</button>
                </form>
            </div>
        </div>
    </div>
@endsection