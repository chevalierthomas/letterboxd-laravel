@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Ajouter un Genre</h1>

    <form action="{{ route('genres.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
