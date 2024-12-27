<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    // Liste des réalisateurs
    public function index()
    {
        $directors = Director::orderBy('name')->paginate(10);
        return view('directors.index', compact('directors'));
    }

    // Formulaire de création
    public function create()
    {
        return view('directors.create');
    }

    // Enregistrer un nouveau réalisateur
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'bio'  => 'nullable|string',
        ]);

        Director::create($request->all());
        return redirect()->route('directors.index')->with('success', 'Réalisateur ajouté avec succès.');
    }

    // Afficher un réalisateur
    public function show(Director $director)
    {
        return view('directors.show', compact('director'));
    }

    // Éditer un réalisateur
    public function edit(Director $director)
    {
        return view('directors.edit', compact('director'));
    }

    // Mettre à jour
    public function update(Request $request, Director $director)
    {
        $request->validate([
            'name' => 'required|max:255',
            'bio'  => 'nullable|string',
        ]);

        $director->update($request->all());
        return redirect()->route('directors.index')->with('success', 'Réalisateur mis à jour.');
    }

    // Supprimer
    public function destroy(Director $director)
    {
        $director->delete();
        return redirect()->route('directors.index')->with('success', 'Réalisateur supprimé.');
    }
}
