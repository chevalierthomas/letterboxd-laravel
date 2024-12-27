{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('title', 'Bienvenue')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center mt-5">
        <h1 class="display-4 fw-bold text-primary mb-4">🎬 Bienvenue sur Letterboxd</h1>
        <p class="lead text-secondary text-center mb-5">
            Rejoignez notre communauté cinéphile pour découvrir, gérer et partager vos avis sur vos films préférés !
        </p>
        <div class="d-flex gap-3">
            @guest
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4 shadow">
                    <i class="bi bi-person-plus-fill"></i> S'inscrire
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg px-4 shadow">
                    <i class="bi bi-box-arrow-in-right"></i> Se connecter
                </a>
            @else
                <a href="{{ route('films.manage') }}" class="btn btn-success btn-lg px-4 shadow">
                    <i class="bi bi-film"></i> Accéder à la bibliothèque
                </a>
            @endguest
        </div>
    </div>

    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">🌟 Découvrez des films</h5>
                        <p class="card-text">Explorez notre vaste collection de films et trouvez vos prochains favoris.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">✍️ Partagez vos critiques</h5>
                        <p class="card-text">Donnez votre avis et notez les films que vous avez visionnés.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">🎥 Gérez votre bibliothèque</h5>
                        <p class="card-text">Gardez une trace de vos films visionnés et organisez votre collection.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
