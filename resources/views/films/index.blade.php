@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">🎥 Liste des films</h1>
        <a href="{{ route('films.create') }}" class="btn btn-success">+ Ajouter un film</a>
    </div>

    <!-- Formulaire de recherche/filtrage -->
    <form method="GET" action="{{ route('films.index') }}" class="mb-4">
        <div class="d-flex flex-wrap gap-2 align-items-center">
            <input type="text" name="search" class="form-control" placeholder="🔍 Recherche par titre" value="{{ request('search') }}" style="flex: 1;">
            <select name="year" class="form-select" style="flex: 1;">
                <option value="">-- Année --</option>
                @for($y = date('Y'); $y >= 1900; $y--)
                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
            <select name="director_id" class="form-select" style="flex: 1;">
                <option value="">-- Réalisateur --</option>
                @foreach($directors as $director)
                    <option value="{{ $director->id }}" {{ request('director_id') == $director->id ? 'selected' : '' }}>
                        {{ $director->name }}
                    </option>
                @endforeach
            </select>
            <select name="genre_id" class="form-select" style="flex: 1;">
                <option value="">-- Genre --</option>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Filtrer</button>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-hover table-striped text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th style="width: 15%;">Image</th>
                <th style="width: 25%;">Titre</th>
                <th style="width: 10%;">Année</th>
                <th style="width: 20%;">Réalisateur</th>
                <th style="width: 20%;">Genres</th>
                <th style="width: 10%;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($films as $film)
            <tr>
                <td>
                    @if($film->image)
                        <img src="{{ asset('storage/' . $film->image) }}" alt="{{ $film->title }}" style="max-width: 100px; max-height: 100px; object-fit: cover;">
                    @else
                        <img src="{{ asset('placeholder.jpg') }}" alt="Placeholder" style="max-width: 100px; max-height: 100px; object-fit: cover;">
                    @endif
                </td>
                <td>{{ $film->title }}</td>
                <td>{{ $film->year ?? 'N/A' }}</td>
                <td>{{ optional($film->director)->name ?? 'N/A' }}</td>
                <td>
                    @if($film->genres->isEmpty())
                        <span class="text-muted">Aucun genre associé</span>
                    @else
                        {{ $film->genres->pluck('name')->join(', ') }}
                    @endif
                </td>
                <td>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('films.show', $film->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('films.edit', $film->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('films.destroy', $film->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce film ?')">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted">Aucun film trouvé.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $films->links() }}
    </div>
</div>
@endsection
