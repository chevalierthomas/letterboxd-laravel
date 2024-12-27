@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Genres</h1>
    <a href="{{ route('genres.create') }}" class="btn btn-success mb-3">Ajouter un Genre</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($genres as $genre)
            <tr>
                <td>{{ $genre->name }}</td>
                <td>
                    <a href="{{ route('genres.edit', $genre->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce genre ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $genres->links() }}
</div>
@endsection
