@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Modifier le Réalisateur</h1>

    <form action="{{ route('directors.update', $director->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $director->name }}" required>
        </div>
        <div class="mb-3">
            <label for="bio" class="form-label">Biographie</label>
            <textarea name="bio" id="bio" class="form-control">{{ $director->bio }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
