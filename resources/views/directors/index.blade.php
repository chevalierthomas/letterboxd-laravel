@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Réalisateurs</h1>
    <a href="{{ route('directors.create') }}" class="btn btn-success mb-3">Ajouter un Réalisateur</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Biographie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($directors as $director)
            <tr>
                <td>{{ $director->name }}</td>
                <td>{{ $director->bio }}</td>
                <td>
                    <a href="{{ route('directors.edit', $director->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('directors.destroy', $director->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce réalisateur ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $directors->links() }}
</div>
@endsection
