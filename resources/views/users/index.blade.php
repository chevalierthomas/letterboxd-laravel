@extends('layouts.app')

@section('title', 'Liste des utilisateurs')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-6">Liste des utilisateurs</h1>

    @if($users->isEmpty())
        <p class="text-gray-600">Aucun utilisateur trouvé.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($users as $user)
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-600">Email: {{ $user->email }}</p>
                    <p class="text-sm text-gray-600">Films visionnés: {{ $user->watchedFilms->count() }}</p>
                    <p class="text-sm text-gray-600">Critiques laissées: {{ $user->reviews->count() }}</p>
                    <a href="{{ route('users.show', $user->id) }}" class="mt-4 inline-block text-blue-500 hover:text-blue-700">Voir profil</a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
