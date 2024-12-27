<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes publiques
|--------------------------------------------------------------------------
|
| Routes accessibles sans authentification.
|
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

/*
|--------------------------------------------------------------------------
| Routes pour les utilisateurs connectés
|--------------------------------------------------------------------------
|
| Ces routes nécessitent que l'utilisateur soit authentifié.
|
*/
Route::middleware(['auth'])->group(function () {
    /*
    |----------------------------------------------------------------------
    | Gestion des critiques (Reviews)
    |----------------------------------------------------------------------
    */
    // Afficher les critiques d'un film
    Route::get('/films/{film}/reviews', [ReviewController::class, 'filmReviews'])->name('reviews.film');

    // Ajouter ou mettre à jour une critique
    Route::post('/films/{film}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Modifier une critique
    Route::patch('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');

    /*
    |----------------------------------------------------------------------
    | Gestion des films pour les utilisateurs connectés
    |----------------------------------------------------------------------
    */
    // Page de gestion des films vus/non vus
    Route::get('/films/manage', [FilmController::class, 'manage'])->name('films.manage');

    // Marquer un film comme vu/non vu
    Route::post('/films/{film}/watched', [ReviewController::class, 'toggleWatched'])->name('films.watched');

    /*
    |----------------------------------------------------------------------
    | Gestion des profils utilisateurs
    |----------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Routes réservées aux administrateurs
|--------------------------------------------------------------------------
|
| Ces routes nécessitent que l'utilisateur soit authentifié et administrateur.
|
*/
Route::middleware(['auth', 'admin'])->group(function () {
    // Gestion des réalisateurs
    Route::resource('directors', DirectorController::class);

    // Gestion des genres
    Route::resource('genres', GenreController::class);

    // Gestion complète des films (CRUD)
    Route::resource('films', FilmController::class);
});

/*
|--------------------------------------------------------------------------
| Authentification (Laravel Breeze)
|--------------------------------------------------------------------------
|
| Fichier généré par Laravel Breeze pour gérer l'authentification.
|
*/
require __DIR__.'/auth.php';
