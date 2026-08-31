<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CivicPulse AI</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet"
href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold" href="#">
            🚦 CivicPulse AI
        </a>

        <div class="ms-auto">

            <span class="text-white me-3">
                Bonjour {{ auth()->user()->name }}
            </span>

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf

                <button class="btn btn-outline-light btn-sm">
                    Déconnexion
                </button>

            </form>

        </div>

    </div>
</nav>

<div class="container mt-4">

    @yield('content')

</div>

</body>
</html>