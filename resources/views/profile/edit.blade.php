@extends('layouts.app')

@section('title', 'Modifier le profil')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-6">Modifier le profil</h1>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            @error('name') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @error('email') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="biography" class="block text-sm font-medium text-gray-700">Biographie</label>
            <textarea name="biography" id="biography" rows="4" class="form-control">{{ old('biography', $user->biography) }}</textarea>
            @error('biography') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
