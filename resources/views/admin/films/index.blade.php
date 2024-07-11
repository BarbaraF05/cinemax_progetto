@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Tutti i film</h2>
        <div class="text-right mb-3">
            <a href="{{ route('films.create') }}" class="btn btn-success">Aggiungi Film</a>
        </div>

        {{-- Messaggi di errore e successo --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Titolo
                            <a href="{{route('films.index',['sort' => $sort === 'title_asc' ? 'title_desc' : 'title_asc' ] ) }}">
                                <i class="fa-solid fa-arrow-{{$sort === 'title_asc' ? 'down' : 'up'}}"></i>
                            </a>

                        </th>
                        <th>Immagine di copertina</th>
                        <th>Genere</th>
                        <th>Regista
                            <a href="{{ route('films.index', ['sort' => $sort === 'director_asc' ? 'director_desc' : 'director_asc']) }}">
                                <i class="fa-solid fa-arrow-{{ $sort === 'director_asc' ? 'down' : 'up' }}"></i>
                            </a>
                        </th>
                        <th>Attori principali</th>
                        <th>Anno
                            <a href="{{route('films.index',['sort' => $sort === 'anno_asc' ? 'anno_desc' : 'anno_asc' ] ) }}">
                                <i class="fa-solid fa-arrow-{{$sort === 'anno_asc' ? 'down' : 'up'}}"></i>
                            </a>
                        </th>
                        <th>Opzioni</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($films as $film)
                    <tr>
                        <td>{{ $film->title }}</td>
                        <td>
                            @if (filter_var($film->poster, FILTER_VALIDATE_URL)) {{-- filtro che, se c'è un'immagine associata al film, crea URL valido  --}}
                            <img src="{{ $film->poster }}" alt="{{ $film->title }}" class="img-thumbnail"
                                style="max-width: 150px;">
                            @elseif($film->poster === null)
                            <img src="https://cdn.pixabay.com/photo/2023/08/11/16/50/water-8183918_1280.jpg" class="img-thumbnail"
                            style="max-width: 150px;">
                            @else {{-- se non c'è un url valido, allora è caricata nello storage --}}
                            <img src="{{ asset('storage/posters/' . $film->poster) }}" alt="{{ $film->title }}"
                                class="img-thumbnail" style="max-width: 150px;">
                            @endif
                        </td>
                        <td>
                        {{-- @dd($film->genres) --}}
                        @foreach($film->genres as $genre)
                            {{ $genre->name }}
                        @endforeach
                        </td>
                        <td>{{ $film->director->name }}</td> {{-- relazione one to many, senza foreach --}}
                        <td>@foreach($film->actors as $actor)
                            {{ $actor->name }}
                            @endforeach</td>
                        {{-- @dd($film->actors) --}}
                        <td>{{ $film->year }}</td>
                        <td>
                            <a href="{{ route('films.edit', $film->id) }}" class="btn btn-primary btn-sm">Modifica</a>
                            <form action="{{ route('films.destroy', $film->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Sei sicuro di voler eliminare questo film?')">Elimina</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>
    
    {{-- modifichiamo la paginazione per non perdere l'ordinamento --}}
    <div class="pagination-container">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                {{-- Link alla pagina precedente --}}
                @if ($films->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $films->appends(['sort' => $sort])->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                @endif
                
                {{-- Link alle pagine --}}
                @foreach ($films->getUrlRange(1, $films->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $films->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $films->appends(['sort' => $sort])->url($page) }}">{{ $page }}</a>
                    </li>
                @endforeach
                
                {{-- Link alla pagina successiva --}}
                @if ($films->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $films->appends(['sort' => $sort])->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
    
    
</div>
@endsection