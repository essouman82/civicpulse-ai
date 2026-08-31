@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    {{-- ========================================================= --}}
    {{-- EN-TÊTE --}}
    {{-- ========================================================= --}}

    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body p-4">

            <div class="d-flex flex-column flex-lg-row
                        justify-content-between
                        align-items-lg-center gap-3">

                <div>

                    <div class="d-flex align-items-center gap-2 mb-2">

                        <div
                            class="d-flex align-items-center justify-content-center
                                   rounded-3 bg-success text-white"
                            style="width:46px;height:46px;">

                            <i class="bi bi-shield-exclamation fs-4"></i>

                        </div>

                        <div>

                            <h2 class="fw-bold mb-0">
                                Gestion des incidents
                            </h2>

                            <small class="text-muted">
                                Supervision intelligente des signalements urbains
                            </small>

                        </div>

                    </div>

                    <p class="text-muted mb-0">

                        Recherchez, analysez et suivez les incidents signalés
                        dans CivicPulse AI.

                    </p>

                </div>


                <div class="d-flex gap-2">

                    <a href="{{ route('incidents.map') }}"
                       class="btn btn-outline-primary rounded-pill px-4">

                        <i class="bi bi-map-fill me-2"></i>

                        Carte

                    </a>


                    @if(Auth::user()->isCitoyen() || Auth::user()->isAdministrateur())

                        <a href="{{ route('incidents.create') }}"
                           class="btn btn-success rounded-pill px-4">

                            <i class="bi bi-plus-circle-fill me-2"></i>

                            Nouvel incident

                        </a>

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- MESSAGE SUCCÈS --}}
    {{-- ========================================================= --}}

    @if(session('success'))

        <div class="alert alert-success border-0 shadow-sm rounded-4">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- STATISTIQUES --}}
    {{-- ========================================================= --}}

    <div class="row g-3 mb-4">

        {{-- TOTAL --}}

        <div class="col-xl col-md-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted fw-semibold">
                                TOTAL INCIDENTS
                            </small>

                            <h2 class="fw-bold mt-2 mb-1">
                                {{ $total }}
                            </h2>

                            <small class="text-muted">
                                Tous les signalements
                            </small>

                        </div>

                        <div class="text-primary fs-2">
                            <i class="bi bi-clipboard-data-fill"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- SIGNALES --}}

        <div class="col-xl col-md-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted fw-semibold">
                                NOUVEAUX
                            </small>

                            <h2 class="fw-bold text-danger mt-2 mb-1">
                                {{ $signales }}
                            </h2>

                            <small class="text-muted">
                                En attente de traitement
                            </small>

                        </div>

                        <div class="text-danger fs-2">
                            <i class="bi bi-exclamation-octagon-fill"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- EN COURS --}}

        <div class="col-xl col-md-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted fw-semibold">
                                EN COURS
                            </small>

                            <h2 class="fw-bold text-warning mt-2 mb-1">
                                {{ $encours }}
                            </h2>

                            <small class="text-muted">
                                En cours de traitement
                            </small>

                        </div>

                        <div class="text-warning fs-2">
                            <i class="bi bi-hourglass-split"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- RESOLUS --}}

        <div class="col-xl col-md-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted fw-semibold">
                                RÉSOLUS
                            </small>

                            <h2 class="fw-bold text-success mt-2 mb-1">
                                {{ $resolus }}
                            </h2>

                            <small class="text-muted">
                                Incidents traités
                            </small>

                        </div>

                        <div class="text-success fs-2">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- CRITIQUES --}}

        <div class="col-xl col-md-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted fw-semibold">
                                PRIORITÉ CRITIQUE
                            </small>

                            <h2 class="fw-bold text-danger mt-2 mb-1">

                                {{ $incidents->where('priorite','Critique')->count() }}

                            </h2>

                            <small class="text-muted">
                                Attention requise
                            </small>

                        </div>

                        <div class="text-danger fs-2">
                            <i class="bi bi-fire"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- RECHERCHE ET FILTRES --}}
    {{-- ========================================================= --}}

    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body p-4">

            <div class="d-flex align-items-center mb-3">

                <div
                    class="d-flex align-items-center justify-content-center
                           rounded-3 bg-light text-success me-3"
                    style="width:42px;height:42px;">

                    <i class="bi bi-funnel-fill"></i>

                </div>

                <div>

                    <h5 class="fw-bold mb-0">
                        Recherche et filtres
                    </h5>

                    <small class="text-muted">
                        Affinez les résultats selon vos besoins.
                    </small>

                </div>

            </div>


            <form method="GET"
                  action="{{ route('incidents.index') }}">

                <div class="row g-3">


                    {{-- RECHERCHE --}}

                    <div class="col-xl-4">

                        <label class="form-label small fw-semibold">
                            Recherche
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-search text-muted"></i>
                            </span>

                            <input
                                type="text"
                                name="recherche"
                                class="form-control"
                                placeholder="Titre ou description..."
                                value="{{ request('recherche') }}">

                        </div>

                    </div>


                    {{-- CATEGORIE --}}

                    <div class="col-xl-2 col-md-4">

                        <label class="form-label small fw-semibold">
                            Catégorie
                        </label>

                        <select name="categorie"
                                class="form-select">

                            <option value="">
                                Toutes
                            </option>

                            <option value="Route"
                                {{ request('categorie') == 'Route' ? 'selected' : '' }}>
                                Route
                            </option>

                            <option value="Éclairage public"
                                {{ request('categorie') == 'Éclairage public' ? 'selected' : '' }}>
                                Éclairage public
                            </option>

                            <option value="Déchets"
                                {{ request('categorie') == 'Déchets' ? 'selected' : '' }}>
                                Déchets
                            </option>

                            <option value="Inondation"
                                {{ request('categorie') == 'Inondation' ? 'selected' : '' }}>
                                Inondation
                            </option>

                            <option value="Autre"
                                {{ request('categorie') == 'Autre' ? 'selected' : '' }}>
                                Autre
                            </option>

                        </select>

                    </div>


                    {{-- PRIORITE --}}

                    <div class="col-xl-2 col-md-4">

                        <label class="form-label small fw-semibold">
                            Priorité
                        </label>

                        <select name="priorite"
                                class="form-select">

                            <option value="">
                                Toutes
                            </option>

                            <option value="Critique"
                                {{ request('priorite') == 'Critique' ? 'selected' : '' }}>
                                Critique
                            </option>

                            <option value="Haute"
                                {{ request('priorite') == 'Haute' ? 'selected' : '' }}>
                                Haute
                            </option>

                            <option value="Moyenne"
                                {{ request('priorite') == 'Moyenne' ? 'selected' : '' }}>
                                Moyenne
                            </option>

                            <option value="Faible"
                                {{ request('priorite') == 'Faible' ? 'selected' : '' }}>
                                Faible
                            </option>

                        </select>

                    </div>


                    {{-- STATUT --}}

                    <div class="col-xl-2 col-md-4">

                        <label class="form-label small fw-semibold">
                            Statut
                        </label>

                        <select name="statut"
                                class="form-select">

                            <option value="">
                                Tous
                            </option>

                            <option value="Signalé"
                                {{ request('statut') == 'Signalé' ? 'selected' : '' }}>
                                Signalé
                            </option>

                            <option value="En cours"
                                {{ request('statut') == 'En cours' ? 'selected' : '' }}>
                                En cours
                            </option>

                            <option value="Résolu"
                                {{ request('statut') == 'Résolu' ? 'selected' : '' }}>
                                Résolu
                            </option>

                        </select>

                    </div>


                    {{-- BOUTONS --}}

                    <div class="col-xl-2 d-flex align-items-end gap-2">

                        <button
                            type="submit"
                            class="btn btn-success flex-grow-1">

                            <i class="bi bi-search me-1"></i>

                            Filtrer

                        </button>

                        <a
                            href="{{ route('incidents.index') }}"
                            class="btn btn-light border"
                            title="Réinitialiser">

                            <i class="bi bi-arrow-counterclockwise"></i>

                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- GRAPHIQUE + IA --}}
    {{-- ========================================================= --}}

    <div class="row g-4 mb-4">


        <div class="col-lg-7">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-header bg-white border-0 p-4">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h5 class="fw-bold mb-1">
                                Répartition des incidents
                            </h5>

                            <small class="text-muted">
                                État actuel des signalements
                            </small>

                        </div>

                        <i class="bi bi-pie-chart-fill text-success fs-4"></i>

                    </div>

                </div>

                <div class="card-body">

                    <div style="height:280px;">

                        <canvas id="incidentChart"></canvas>

                    </div>

                </div>

            </div>

        </div>


        {{-- IA --}}

        <div class="col-lg-5">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center mb-3">

                        <div
                            class="rounded-3 bg-success text-white
                                   d-flex align-items-center justify-content-center me-3"
                            style="width:44px;height:44px;">

                            <i class="bi bi-robot fs-4"></i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Analyse CivicPulse AI
                            </h5>

                            <small class="text-muted">
                                Synthèse intelligente
                            </small>

                        </div>

                    </div>


                    <div class="p-3 bg-light rounded-4 mb-3">

                        <small class="text-muted d-block mb-1">
                            Incidents actuellement affichés
                        </small>

                        <strong class="fs-4">
                            {{ $incidents->total() }}
                        </strong>

                    </div>


                    <div class="p-3 bg-light rounded-4">

                        <div class="d-flex justify-content-between">

                            <span class="text-muted">
                                Signalements critiques
                            </span>

                            <strong class="text-danger">

                                {{ $incidents->where('priorite','Critique')->count() }}

                            </strong>

                        </div>

                    </div>

                    <div class="mt-3 small text-muted">

                        <i class="bi bi-info-circle me-1"></i>

                        Les niveaux de priorité et de confiance IA
                        permettent d'orienter les interventions.

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- LISTE DES INCIDENTS --}}
    {{-- ========================================================= --}}

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-header bg-white border-0 p-4">

            <div class="d-flex flex-column flex-md-row
                        justify-content-between
                        align-items-md-center gap-2">

                <div>

                    <h5 class="fw-bold mb-1">
                        Signalements urbains
                    </h5>

                    <small class="text-muted">
                        Liste des incidents enregistrés dans la plateforme.
                    </small>

                </div>

                <span class="badge bg-success-subtle text-success
                             rounded-pill px-3 py-2">

                    {{ $incidents->total() }} incident(s)

                </span>

            </div>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead style="background:#f8fafc;">

                    <tr>

                        <th class="px-4 py-3">
                            Incident
                        </th>

                        <th>
                            Catégorie
                        </th>

                        <th>
                            Priorité IA
                        </th>

                        <th>
                            Service
                        </th>

                        <th>
                            Confiance IA
                        </th>

                        <th>
                            Statut
                        </th>

                        <th>
                            Date
                        </th>

                        <th class="text-center">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($incidents as $incident)

                    <tr>


                        {{-- INCIDENT --}}

                        <td class="px-4">

                            <div class="d-flex align-items-center">

                                <div
                                    class="rounded-3 bg-light
                                           d-flex align-items-center justify-content-center me-3"
                                    style="width:42px;height:42px;">

                                    @if($incident->priorite === 'Critique')

                                        <i class="bi bi-exclamation-triangle-fill text-danger"></i>

                                    @elseif($incident->priorite === 'Haute')

                                        <i class="bi bi-exclamation-circle-fill text-warning"></i>

                                    @else

                                        <i class="bi bi-geo-alt-fill text-primary"></i>

                                    @endif

                                </div>


                                <div>

                                    <div class="fw-bold">

                                        {{ $incident->titre }}

                                    </div>

                                    <small class="text-muted">

                                        #{{ $incident->id }}

                                        ·

                                        {{ \Illuminate\Support\Str::limit($incident->description,45) }}

                                    </small>

                                </div>

                            </div>

                        </td>


                        {{-- CATEGORIE --}}

                        <td>

                            <span class="badge rounded-pill bg-light text-dark border">

                                {{ $incident->categorie }}

                            </span>

                        </td>


                        {{-- PRIORITE --}}

                        <td>

                            @switch($incident->priorite)

                                @case('Critique')

                                    <span class="badge rounded-pill bg-danger">

                                        <i class="bi bi-fire me-1"></i>
                                        Critique

                                    </span>

                                    @break

                                @case('Haute')

                                    <span class="badge rounded-pill bg-warning text-dark">

                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        Haute

                                    </span>

                                    @break

                                @case('Moyenne')

                                    <span class="badge rounded-pill bg-info text-dark">

                                        <i class="bi bi-dash-circle me-1"></i>
                                        Moyenne

                                    </span>

                                    @break

                                @default

                                    <span class="badge rounded-pill bg-secondary">

                                        Faible

                                    </span>

                            @endswitch

                        </td>


                        {{-- SERVICE --}}

                        <td>

                            @if($incident->service)

                                <span class="small fw-semibold">

                                    <i class="bi bi-building me-1 text-primary"></i>

                                    {{ $incident->service }}

                                </span>

                            @else

                                <span class="text-muted small">
                                    Non défini
                                </span>

                            @endif

                        </td>


                        {{-- CONFIANCE IA --}}

                        <td>

                            @if($incident->score_ia !== null)

                                @php
                                    $score = (float) $incident->score_ia;
                                @endphp

                                @if($score >= 95)

                                    <span class="badge rounded-pill bg-success">
                                        {{ $score }}%
                                    </span>

                                @elseif($score >= 85)

                                    <span class="badge rounded-pill bg-primary">
                                        {{ $score }}%
                                    </span>

                                @elseif($score >= 75)

                                    <span class="badge rounded-pill bg-warning text-dark">
                                        {{ $score }}%
                                    </span>

                                @else

                                    <span class="badge rounded-pill bg-danger">
                                        {{ $score }}%
                                    </span>

                                @endif

                            @else

                                <span class="text-muted small">
                                    Analyse en attente
                                </span>

                            @endif

                        </td>


                        {{-- STATUT --}}

                        <td>

                            @switch($incident->statut)

                                @case('Signalé')

                                    <span class="badge rounded-pill bg-danger-subtle text-danger">

                                        <i class="bi bi-circle-fill me-1"
                                           style="font-size:7px;"></i>

                                        Signalé

                                    </span>

                                    @break

                                @case('En cours')

                                    <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis">

                                        <i class="bi bi-arrow-repeat me-1"></i>

                                        En cours

                                    </span>

                                    @break

                                @case('Résolu')

                                    <span class="badge rounded-pill bg-success-subtle text-success">

                                        <i class="bi bi-check-circle-fill me-1"></i>

                                        Résolu

                                    </span>

                                    @break

                                @default

                                    <span class="badge rounded-pill bg-secondary">

                                        {{ $incident->statut }}

                                    </span>

                            @endswitch

                        </td>


                        {{-- DATE --}}

                        <td>

                            <span class="small text-muted">

                                {{ $incident->created_at->format('d/m/Y') }}

                            </span>

                        </td>


                        {{-- ACTIONS --}}

                        <td>

                            <div class="d-flex justify-content-center gap-1">


                                <a
                                    href="{{ route('incidents.show',$incident) }}"
                                    class="btn btn-sm btn-light border rounded-3"
                                    title="Consulter">

                                    <i class="bi bi-eye text-primary"></i>

                                </a>


                                <a
                                    href="{{ route('incidents.edit',$incident) }}"
                                    class="btn btn-sm btn-light border rounded-3"
                                    title="Modifier">

                                    <i class="bi bi-pencil text-warning"></i>

                                </a>


                                <form
                                    action="{{ route('incidents.destroy',$incident) }}"
                                    method="POST"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer cet incident ?')">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-light border rounded-3"
                                        title="Supprimer">

                                        <i class="bi bi-trash text-danger"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td colspan="8"
                            class="text-center py-5">

                            <div class="mb-3">

                                <i class="bi bi-inbox text-muted"
                                   style="font-size:50px;"></i>

                            </div>

                            <h5 class="fw-bold">
                                Aucun incident trouvé
                            </h5>

                            <p class="text-muted mb-0">

                                Aucun signalement ne correspond
                                aux critères sélectionnés.

                            </p>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}

        @if($incidents->hasPages())

            <div class="card-footer bg-white border-0 p-4">

                {{ $incidents->links('pagination::bootstrap-5') }}

            </div>

        @endif

    </div>

</div>


{{-- ========================================================= --}}
{{-- CHART.JS --}}
{{-- ========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('incidentChart');

    if (!canvas) {
        return;
    }

    new Chart(canvas, {

        type: 'doughnut',

        data: {

            labels: [
                'Signalés',
                'En cours',
                'Résolus'
            ],

            datasets: [{

                data: [
                    {{ $signales }},
                    {{ $encours }},
                    {{ $resolus }}
                ],

                backgroundColor: [
                    '#dc3545',
                    '#ffc107',
                    '#198754'
                ],

                borderWidth: 0

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            cutout: '68%',

            plugins: {

                legend: {

                    position: 'bottom',

                    labels: {

                        usePointStyle: true,

                        padding: 20

                    }

                }

            }

        }

    });

});

</script>

@endsection