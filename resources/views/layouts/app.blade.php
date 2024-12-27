<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Letterboxd')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand text-primary fw-bold" href="{{ url('/') }}">🎥 My Film App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Accueil</a>
                    </li>

                @auth
                    @if(auth()->user()->role === 'admin')
                        <!-- L'administrateur a accès à tout -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('films') ? 'active' : '' }}" href="{{ route('films.index') }}">Films</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('directors') ? 'active' : '' }}" href="{{ route('directors.index') }}">Réalisateurs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('genres') ? 'active' : '' }}" href="{{ route('genres.index') }}">Genres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('films/manage') ? 'active' : '' }}" href="{{ route('films.manage') }}">Ma bibliothèque</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('users') ? 'active' : '' }}" href="{{ route('users.index') }}">Utilisateurs</a>
                        </li>
                    @elseif(auth()->user()->role === 'user')
                        <!-- Les utilisateurs classiques ont un accès limité -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('films/manage') ? 'active' : '' }}" href="{{ route('films.manage') }}">Ma bibliothèque</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('users') ? 'active' : '' }}" href="{{ route('users.index') }}">Utilisateurs</a>
                        </li>
                    @endif
                @endauth
                </ul>

                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-primary fw-bold" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Bonjour, {{ auth()->user()->name }} <span class="badge bg-secondary">{{ auth()->user()->role }}</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Déconnexion</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-primary">Inscription</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer >
        <div class="container">
            <p class="mb-0">© 2024 LetterBoxd</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
