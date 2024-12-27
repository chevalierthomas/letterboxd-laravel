<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Film;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function manage()
    {
        $user = auth()->user();
        $reviews = $user->reviews()->with('film')->get();
        $watchedFilms = $user->watchedFilms;

        return view('reviews.manage', compact('reviews', 'watchedFilms'));
    }

    public function filmReviews(Film $film)
    {
        $reviews = $film->reviews()->with('user')->get(); // Charger les critiques avec les utilisateurs
        $userReview = $film->reviews()->where('user_id', auth()->id())->first(); // Critique existante de l'utilisateur

        return view('reviews.index', compact('film', 'reviews', 'userReview'));
    }

    public function store(Request $request, Film $film)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:10',
            'content' => 'nullable|string|max:1000',
        ]);

        // Création ou mise à jour de la critique
        Review::updateOrCreate(
            ['user_id' => auth()->id(), 'film_id' => $film->id],
            ['rating' => $request->rating, 'content' => $request->content]
        );

        return redirect()->route('reviews.film', $film->id)->with('success', 'Votre critique a été enregistrée avec succès.');
    }

    public function update(Request $request, Review $review)
    {
        // Vérifie l'autorisation
        $this->authorize('update', $review);

        // Valide les données de la requête
        $request->validate([
            'rating' => 'required|integer|min:1|max:10',
            'content' => 'nullable|string|max:1000',
        ]);

        // Met à jour la critique
        $review->update([
            'rating' => $request->rating,
            'content' => $request->content,
        ]);

        return redirect()->route('reviews.film', $review->film_id)
            ->with('success', 'Votre critique a été mise à jour avec succès.');
    }

    public function toggleWatched($filmId)
    {
        $user = auth()->user();

        if ($user->watchedFilms()->where('film_id', $filmId)->exists()) {
            $user->watchedFilms()->detach($filmId);
            return back()->with('success', 'Film retiré de la liste des visionnés.');
        } else {
            $user->watchedFilms()->attach($filmId);
            return back()->with('success', 'Film ajouté à la liste des visionnés.');
        }
    }
}
