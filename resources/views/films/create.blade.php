@extends('layouts.app')

@section('title', 'Ajouter un film')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Ajouter un film</h1>

    <form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
        @csrf

        <div class="mb-4">
            <label for="title" class="block mb-1 font-medium">Titre</label>
            <input type="text" name="title" id="title" class="border border-gray-300 rounded p-2 w-full" value="{{ old('title') }}" required>
            @error('title')
                <div class="text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="year" class="block mb-1 font-medium">Année</label>
            <input type="number" name="year" id="year" class="border border-gray-300 rounded p-2 w-full" value="{{ old('year') }}">
        </div>

        <div class="mb-4">
            <label for="director_id" class="block mb-1 font-medium">Réalisateur</label>
            <select name="director_id" id="director_id" class="form-select">
                @foreach($directors as $director)
                    <option value="{{ $director->id }}">{{ $director->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="genres" class="block mb-1 font-medium">Genres</label>
            <select name="genres[]" id="genres" class="form-select" multiple>
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="synopsis" class="block mb-1 font-medium">Synopsis</label>
            <textarea name="synopsis" id="synopsis" rows="4" class="border border-gray-300 rounded p-2 w-full">{{ old('synopsis') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block mb-1 font-medium">Image (optionnelle)</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded">
            Ajouter
        </button>
    </form>
@endsection
