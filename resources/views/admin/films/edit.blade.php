@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-body p-5 bg-light rounded">
                    <h2 class="mb-4">Modifica Film</h2>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('films.update', $film->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Titolo del film -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Titolo</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $film->title }}">
                        </div>

                        <!-- Generi del film -->
                        <div class="mb-3">
                            <label class="form-label">Generi</label>
                            <div class="row">
                                {{-- <div class="mb-3">
                                    <label class="form-label">Generi</label> --}}
                                    <div class="row">
                                        @foreach($genres as $genre)
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input type="checkbox" name="genres[]" id="genre{{ $genre->id }}" value="{{ $genre->id }}" class="form-check-input" {{ in_array($genre->id, $film->genres->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                    <label for="genre{{ $genre->id }}" class="form-check-label">{{ $genre->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Regista del film -->
                        <div class="mb-3">
                            <label for="director" class="form-label">Regista</label>
                            <select name="director_id" id="director" class="form-control" required>
                                @foreach($directors as $director)
                                    <option value="{{ $director->id }}" {{ $film->director_id == $director->id ? 'selected' : '' }}>{{ $director->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Attori del film -->
                        <div class="mb-3">
                            <label for="actors" class="form-label">Attori</label>
                            <select name="actors[]" id="actors" class="form-control" multiple required>
                                @foreach($actors as $actor)
                                    <option value="{{ $actor->id }}" {{ in_array($actor->id, $film->actors->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $actor->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Anno di uscita del film -->
                        <div class="mb-3">
                            <label for="year" class="form-label">Anno di uscita</label>
                            <input type="text" name="year" id="year" class="form-control" value="{{ $film->year }}" required>
                        </div>

                        <!-- Descrizione del film -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione</label>
                            <textarea name="description" id="description" class="form-control" required>{{ $film->description }}</textarea>
                        </div>

                        <!-- Immagine del poster -->
                        <div class="mb-3">
                            <label for="poster" class="form-label">Immagine del poster</label>
                            <input type="file" name="poster" id="poster" class="form-control-file">
                            <img src="{{ asset('storage/' . $film->poster) }}" alt="{{ $film->title }}" class="img-thumbnail mt-2" style="max-width: 150px;">
                        </div>

                        <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection