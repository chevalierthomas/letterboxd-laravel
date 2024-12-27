@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Détails du Genre</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nom : {{ $genre->name }}</h5>
        </div>
    </div>

    <a href="{{ route('genres.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
</div>
@endsection
