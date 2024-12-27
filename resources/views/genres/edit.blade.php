@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Modifier le Genre</h1>

    <form action="{{ route('genres.update', $genre->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $genre->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
