@extends('layouts.app')

@section('title', 'Films Disponibles')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-6">Films Disponibles</h1>

    <!-- Formulaire de recherche/filtrage -->
    <form method="GET" action="{{ route('films.manage') }}" class="mb-4">
        <div class="flex flex-wrap gap-4 mb-6">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Recherche</label>
                <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="Rechercher par titre">
            </div>
            <div>
                <label for="year" class="block text-sm font-medium text-gray-700">Année</label>
                <select name="year" id="year" class="form-select w-full">
                    <option value="">-- Année --</option>
                    @for($y = date('Y'); $y >= 1900; $y--)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label for="genre_id" class="block text-sm font-medium text-gray-700">Genre</label>
                <select name="genre_id" id="genre_id" class="form-select w-full">
                    <option value="">-- Genre --</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="director_id" class="block text-sm font-medium text-gray-700">Réalisateur</label>
                <select name="director_id" id="director_id" class="form-select w-full">
                    <option value="">-- Réalisateurs --</option>
                    @foreach($directors as $director)
                        <option value="{{ $director->id }}" {{ request('director_id') == $director->id ? 'selected' : '' }}>{{ $director->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="watched" class="block text-sm font-medium text-gray-700">Statut</label>
                <select name="watched" id="watched" class="form-select w-full">
                    <option value="">-- Tous --</option>
                    <option value="1" {{ request('watched') == '1' ? 'selected' : '' }}>Vu</option>
                    <option value="0" {{ request('watched') == '0' ? 'selected' : '' }}>Non vu</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary px-4 py-2">Filtrer</button>
            </div>
        </div>
    </form>

    <div class="row">
        @foreach($films as $film)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    @if($film->image)
                        <img src="{{ asset('storage/' . $film->image) }}" class="card-img-top" alt="{{ $film->title }}" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('placeholder.jpg') }}" class="card-img-top" alt="Placeholder" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $film->title }}</h5>
                        <p class="card-text">
                            <strong>Réalisateur :</strong> {{ $film->director->name ?? 'N/A' }}<br>
                            <strong>Année :</strong> {{ $film->year ?? 'N/A' }}
                        </p>
                        <form action="{{ route('films.watched', $film->id) }}" method="POST" class="d-inline">
                            @csrf
                            @if(auth()->user()->watchedFilms->contains($film->id))
                                <button type="submit" class="btn btn-danger btn-sm">Non vu</button>
                            @else
                                <button type="submit" class="btn btn-success btn-sm">Marquer comme vu</button>
                            @endif
                        </form>
                        <a href="{{ route('reviews.film', $film->id) }}" class="btn btn-info btn-sm">Critiques</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $films->links() }}
    </div>
</div>
@endsection
