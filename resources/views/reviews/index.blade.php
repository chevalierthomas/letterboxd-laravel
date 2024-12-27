@extends('layouts.app')

@section('title', 'Critiques de ' . $film->title)

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Critiques pour : {{ $film->title }}</h1>

    <div class="mb-6">
        @if($userReview)
            <h2 class="text-xl font-semibold mb-2">Modifier votre critique</h2>
            <form action="{{ route('reviews.update', $userReview->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="rating" class="block mb-1 font-medium">Note (1-10)</label>
                    <input type="number" name="rating" id="rating" value="{{ $userReview->rating }}" min="1" max="10" class="form-control">
                </div>
                <div class="mb-4">
                    <label for="content" class="block mb-1 font-medium">Votre avis</label>
                    <textarea name="content" id="content" rows="4" class="form-control">{{ $userReview->content }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        @else
            <h2 class="text-xl font-semibold mb-2">Ajouter une critique</h2>
            <form action="{{ route('reviews.store', $film->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="rating" class="block mb-1 font-medium">Note (1-10)</label>
                    <input type="number" name="rating" id="rating" min="1" max="10" class="form-control">
                </div>
                <div class="mb-4">
                    <label for="content" class="block mb-1 font-medium">Votre avis</label>
                    <textarea name="content" id="content" rows="4" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        @endif
    </div>

    <h2 class="text-xl font-semibold mb-4">Toutes les critiques</h2>
    @foreach($reviews as $review)
        <div class="bg-gray-100 p-4 rounded mb-4">
            <p><strong>{{ $review->user->name }}</strong> a noté : {{ $review->rating }}/10</p>
            <p>{{ $review->content }}</p>
        </div>
    @endforeach
@endsection
