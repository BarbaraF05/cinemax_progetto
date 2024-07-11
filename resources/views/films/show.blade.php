@extends('layouts.app')


@section('content')

<div>

    {{-- @dd($film->reviews) --}}
 <div class="col-lg-10 offset-lg-1">
    <div class="card border-0">
        <div class="film-poster overflow-hidden">
            @if (filter_var($film->poster, FILTER_VALIDATE_URL))
                <img src="{{ $film->poster }}" alt="Poster del film" class="img-fluid">
            @else
                <img src="{{ asset('storage/' . $film->poster) }}" alt="Poster del film" class="img-fluid">
            @endif
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
    
            <h1 class="card-title">{{$film->title}}</h1>
            <h2 class="card-text"><strong>Regista: </strong>{{$film->director->name}}</h2>
            <p class="card-text"><strong>Attori:</strong></p>
                        <ul class="list-unstyled">
                            @foreach ($film->actors as $actor)
                            <li>{{ $actor->name }}</li>
                            @endforeach
                        </ul>
            <p><strong>Trama: </strong>{{$film->description}}</p>

           
        </div>
    </div>
    </div>
    @endsection
</div>