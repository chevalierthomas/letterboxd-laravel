@extends('layouts.app')

@section('title', $film->title)

@section('content')
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-bold mb-4">{{ $film->title }}</h1>

        @if($film->image_url)
            <div class="mb-4">
                <img src="{{ $film->image_url }}" alt="Affiche de {{ $film->title }}" class="img-fluid rounded">
            </div>
        @endif

        <p><strong>Année :</strong> {{ $film->year ?? 'N/A' }}</p>
        <p><strong>Réalisateur :</strong> {{ optional($film->director)->name ?? 'N/A' }}</p>
        <p><strong>Genres :</strong>
            @if($film->genres->isEmpty())
                <span class="text-muted">Aucun genre</span>
            @else
                @foreach($film->genres as $genre)
                    <span class="badge bg-secondary">{{ $genre->name }}</span>
                @endforeach
            @endif
        </p>
        <p><strong>Synopsis :</strong> {{ $film->synopsis ?? 'N/A' }}</p>

        <div class="mt-4">
            <a href="{{ route('films.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('films.edit', $film->id) }}" class="btn btn-primary">Modifier</a>
        </div>
    </div>
@endsection
