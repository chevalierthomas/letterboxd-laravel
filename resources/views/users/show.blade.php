@extends('layouts.app')

@section('title', 'Profil de ' . $user->name)

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-6">Profil de {{ $user->name }}</h1>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Biographie:</strong> {{ $user->biography ?? 'Non renseignée' }}</p>
        <p><strong>Films visionnés:</strong> {{ $user->watchedFilms->count() }}</p>
        <p><strong>Critiques laissées:</strong> {{ $user->reviews->count() }}</p>
    </div>

    <h2 class="text-xl font-semibold mb-4">Films visionnés</h2>
    @if($user->watchedFilms->isEmpty())
        <p class="text-gray-600">Aucun film visionné.</p>
    @else
        <ul class="list-disc list-inside mb-6">
            @foreach($user->watchedFilms as $film)
                <li>{{ $film->title }} ({{ $film->year }})</li>
            @endforeach
        </ul>
    @endif

    <h2 class="text-xl font-semibold mb-4">Critiques</h2>
    @if($user->reviews->isEmpty())
        <p class="text-gray-600">Aucune critique laissée.</p>
    @else
        <div class="grid grid-cols-1 gap-4">
            @foreach($user->reviews as $review)
                <div class="bg-gray-100 p-4 rounded shadow">
                    <p><strong>Film:</strong> {{ $review->film->title }}</p>
                    <p><strong>Note:</strong> {{ $review->rating }}/10</p>
                    <p>{{ $review->content }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
