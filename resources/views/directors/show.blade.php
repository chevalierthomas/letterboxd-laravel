@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Détails du Réalisateur</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nom : {{ $director->name }}</h5>
            @if($director->bio)
                <p class="card-text">Biographie : {{ $director->bio }}</p>
            @else
                <p class="card-text text-muted">Aucune biographie disponible.</p>
            @endif
        </div>
    </div>

    <h2 class="mt-5">Films réalisés</h2>
    @if($director->films->isEmpty())
        <p class="text-muted">Aucun film associé à ce réalisateur.</p>
    @else
        <ul class="list-group">
            @foreach($director->films as $film)
                <li class="list-group-item">
                    <a href="{{ route('films.show', $film->id) }}">{{ $film->title }}</a> ({{ $film->year }})
                </li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('directors.index') }}" class="btn btn-secondary mt-4">Retour à la liste</a>
</div>
@endsection
