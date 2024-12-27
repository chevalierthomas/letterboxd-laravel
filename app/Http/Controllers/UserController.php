<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['watchedFilms', 'reviews.film'])->get();
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['watchedFilms', 'reviews.film']);
        return view('users.show', compact('user'));
    }
}
