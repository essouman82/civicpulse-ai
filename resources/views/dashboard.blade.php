@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-md-3 mb-4">
        <div class="card shadow border-0">
            <div class="card-body">
                <h6 class="text-muted">Incidents</h6>
                <h2 class="fw-bold">{{ $totalIncidents ?? 0 }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card shadow border-0">
            <div class="card-body">
                <h6 class="text-muted">En cours</h6>
                <h2 class="text-warning fw-bold">{{ $enCours ?? 0 }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card shadow border-0">
            <div class="card-body">
                <h6 class="text-muted">Résolus</h6>
                <h2 class="text-success fw-bold">{{ $resolus ?? 0 }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card shadow border-0">
            <div class="card-body">
                <h6 class="text-muted">Utilisateurs</h6>
                <h2 class="text-primary fw-bold">{{ $totalUsers ?? 0 }}</h2>
            </div>
        </div>
    </div>

</div>

<div class="card shadow border-0">

    <div class="card-header bg-white">

        <h5 class="mb-0">Bienvenue sur CivicPulse AI</h5>

    </div>

    <div class="card-body">

        <p class="mb-0">
            Sélectionnez une option dans le menu de gauche pour gérer les incidents,
            consulter les statistiques ou accéder à la carte interactive.
        </p>

    </div>

</div>

@endsection
