<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Director;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
public function index(Request $request)
{
    // Appliquer les filtres de recherche
    $search = $request->input('search');
    $year = $request->input('year');
    $directorId = $request->input('director_id');
    $genreId = $request->input('genre_id');

    $query = Film::with('director', 'genres');

    if ($search) {
        $query->where('title', 'LIKE', "%$search%");
    }
    if ($year) {
        $query->where('year', $year);
    }
    if ($directorId) {
        $query->where('director_id', $directorId);
    }
    if ($genreId) {
        $query->whereHas('genres', function ($q) use ($genreId) {
            $q->where('genres.id', $genreId); // Correction ici
        });
    }

    $films = $query->orderBy('title')->paginate(5);
    $directors = Director::orderBy('name')->get();
    $genres = Genre::orderBy('name')->get();

    return view('films.index', compact('films', 'directors', 'genres'));
}

    public function create()
    {
        $directors = Director::orderBy('name')->get();
        $genres = Genre::orderBy('name')->get();
        return view('films.create', compact('directors', 'genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'year'        => 'nullable|digits:4',
            'synopsis'    => 'nullable|string',
            'director_id' => 'required|exists:directors,id',
            'genres'      => 'array',
            'genres.*'    => 'exists:genres,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('films', 'public');
        }

        $film = Film::create($data);

        if ($request->has('genres')) {
            $film->genres()->sync($request->genres);
        }

        return redirect()->route('films.index')->with('success', 'Film ajouté avec succès.');
    }

    public function show(Film $film)
    {
        return view('films.show', compact('film'));
    }

    public function edit(Film $film)
    {
        $directors = Director::orderBy('name')->get();
        $genres = Genre::orderBy('name')->get();
        return view('films.edit', compact('film', 'directors', 'genres'));
    }

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'year'        => 'nullable|digits:4',
            'synopsis'    => 'nullable|string',
            'director_id' => 'required|exists:directors,id',
            'genres'      => 'array',
            'genres.*'    => 'exists:genres,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($film->image) {
                Storage::disk('public')->delete($film->image);
            }
            $data['image'] = $request->file('image')->store('films', 'public');
        }

        $film->update($data);

        if ($request->has('genres')) {
            $film->genres()->sync($request->genres);
        } else {
            $film->genres()->detach();
        }

        return redirect()->route('films.index')->with('success', 'Film mis à jour avec succès.');
    }

    public function destroy(Film $film)
    {
        if ($film->image) {
            Storage::disk('public')->delete($film->image);
        }
        $film->delete();

        return redirect()->route('films.index')->with('success', 'Film supprimé avec succès.');
    }

    public function manage(Request $request)
    {
        $query = Film::query();

        // Recherche par titre
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filtrer par année
        if ($request->has('year') && $request->year) {
            $query->where('year', $request->year);
        }

        // Filtrer par genre
        if ($request->has('genre_id') && $request->genre_id) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->where('genres.id', $request->genre_id); // Spécifiez la table genres
            });
        }

        // Filtrer par réalisateur
        if ($request->has('director_id') && $request->director_id) {
            $query->where('director_id', $request->director_id);
        }

        // Filtrer par statut vu/non vu
        if ($request->has('watched')) {
            $user = auth()->user();
            if ($request->watched == '1') {
                $query->whereHas('watchedBy', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            } elseif ($request->watched == '0') {
                $query->whereDoesntHave('watchedBy', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });
            }
        }

        // Charger les films
        $films = $query->paginate(12);

        // Charger les genres et réalisateurs pour les filtres
        $genres = Genre::orderBy('name')->get();
        $directors = Director::orderBy('name')->get();

        return view('films.manage', compact('films', 'directors', 'genres'));
    }

    public function toggleWatched(Film $film)
    {
        $user = auth()->user();

        if ($user->watchedFilms()->where('film_id', $film->id)->exists()) {
            $user->watchedFilms()->detach($film->id);
            return back()->with('success', 'Film retiré de votre liste de visionnés.');
        } else {
            $user->watchedFilms()->attach($film->id);
            return back()->with('success', 'Film marqué comme vu.');
        }
    }
}
