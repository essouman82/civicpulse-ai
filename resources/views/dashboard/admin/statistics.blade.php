@extends('layouts.app')

@section('title', 'Statistiques')

@section('content')

<div class="container-fluid py-4">

    {{-- ========================= --}}
    {{-- EN-TÊTE --}}
    {{-- ========================= --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-bar-chart-fill me-2"></i>
                Statistiques
            </h2>

            <p class="text-muted mb-0">
                Analyse globale de l'activité de CivicPulse AI
            </p>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="btn btn-outline-primary">

            <i class="bi bi-arrow-left me-1"></i>
            Retour au tableau de bord

        </a>

    </div>


    {{-- ========================= --}}
    {{-- INDICATEURS --}}
    {{-- ========================= --}}

    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>
                            <small class="text-muted">
                                Utilisateurs
                            </small>

                            <h2 class="fw-bold mt-2 mb-0">
                                {{ $totalUsers }}
                            </h2>
                        </div>

                        <i class="bi bi-people-fill text-primary fs-1"></i>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>
                            <small class="text-muted">
                                Total incidents
                            </small>

                            <h2 class="fw-bold mt-2 mb-0">
                                {{ $totalIncidents }}
                            </h2>
                        </div>

                        <i class="bi bi-exclamation-triangle-fill text-warning fs-1"></i>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>
                            <small class="text-muted">
                                Interventions
                            </small>

                            <h2 class="fw-bold mt-2 mb-0">
                                {{ $totalInterventions }}
                            </h2>
                        </div>

                        <i class="bi bi-tools text-success fs-1"></i>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>
                            <small class="text-muted">
                                Confiance IA
                            </small>

                            <h2 class="fw-bold mt-2 mb-0 text-success">
                                {{ $scoreIAMoyen }}%
                            </h2>
                        </div>

                        <i class="bi bi-robot text-success fs-1"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================= --}}
    {{-- DEUXIÈME LIGNE --}}
    {{-- ========================= --}}

    @php

        $resolus = $incidentsParStatut
            ->where('statut', 'Résolu')
            ->sum('total');

        $tauxResolution = $totalIncidents > 0
            ? round(($resolus / $totalIncidents) * 100, 1)
            : 0;

    @endphp


    <div class="row g-4 mb-4">

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Incidents des 7 derniers jours
                    </small>

                    <h2 class="fw-bold mt-2">
                        {{ $incidentsRecents }}
                    </h2>

                    <div class="progress mt-3" style="height:8px;">

                        <div class="progress-bar"
                             style="width: {{ $totalIncidents > 0 ? min(100, ($incidentsRecents / $totalIncidents) * 100) : 0 }}%">
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Incidents critiques
                    </small>

                    <h2 class="fw-bold text-danger mt-2">
                        {{ $incidentsCritiques }}
                    </h2>

                    <p class="text-muted mb-0">
                        nécessitent une attention prioritaire
                    </p>

                </div>

            </div>

        </div>


        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Taux de résolution
                    </small>

                    <h2 class="fw-bold text-success mt-2">
                        {{ $tauxResolution }}%
                    </h2>

                    <div class="progress mt-3" style="height:8px;">

                        <div class="progress-bar bg-success"
                             style="width: {{ $tauxResolution }}%">
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================= --}}
    {{-- GRAPHIQUES --}}
    {{-- ========================= --}}

    <div class="row g-4 mb-4">


        {{-- ÉVOLUTION --}}

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 pt-4 px-4">

                    <h5 class="fw-bold mb-1">
                        <i class="bi bi-graph-up me-2"></i>
                        Évolution des incidents
                    </h5>

                    <small class="text-muted">
                        Activité des sept derniers jours
                    </small>

                </div>

                <div class="card-body">

                    <canvas id="evolutionChart"
                            height="120"></canvas>

                </div>

            </div>

        </div>


        {{-- PRIORITÉS --}}

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 pt-4 px-4">

                    <h5 class="fw-bold mb-1">
                        <i class="bi bi-pie-chart-fill me-2"></i>
                        Priorités
                    </h5>

                </div>

                <div class="card-body">

                    <canvas id="prioriteChart"></canvas>

                </div>

            </div>

        </div>


        {{-- CATÉGORIES --}}

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 pt-4 px-4">

                    <h5 class="fw-bold">
                        <i class="bi bi-bar-chart-fill me-2"></i>
                        Incidents par catégorie
                    </h5>

                </div>

                <div class="card-body">

                    <canvas id="categorieChart"
                            height="180"></canvas>

                </div>

            </div>

        </div>


        {{-- STATUTS --}}

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 pt-4 px-4">

                    <h5 class="fw-bold">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        Incidents par statut
                    </h5>

                </div>

                <div class="card-body">

                    <canvas id="statutChart"
                            height="180"></canvas>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================= --}}
    {{-- SERVICES --}}
    {{-- ========================= --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white border-0 pt-4 px-4">

            <h5 class="fw-bold mb-1">
                <i class="bi bi-building-fill me-2"></i>
                Activité des services
            </h5>

            <small class="text-muted">
                Nombre d'incidents associés à chaque service
            </small>

        </div>

        <div class="card-body">

            @forelse($incidentsParService as $service)

                @php

                    $pourcentageService = $totalIncidents > 0
                        ? round(($service->total / $totalIncidents) * 100, 1)
                        : 0;

                @endphp

                <div class="mb-4">

                    <div class="d-flex justify-content-between mb-2">

                        <strong>
                            {{ $service->service ?: 'Service non défini' }}
                        </strong>

                        <span class="text-muted">
                            {{ $service->total }} incident(s)
                        </span>

                    </div>

                    <div class="progress" style="height:10px;">

                        <div class="progress-bar"
                             style="width: {{ $pourcentageService }}%">
                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center text-muted py-4">

                    <i class="bi bi-building fs-1"></i>

                    <p class="mt-2 mb-0">
                        Aucun service associé aux incidents.
                    </p>

                </div>

            @endforelse

        </div>

    </div>


    {{-- ========================= --}}
    {{-- ANALYSE IA --}}
    {{-- ========================= --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-dark text-white">

            <div class="d-flex align-items-center">

                <i class="bi bi-cpu-fill fs-4 me-2"></i>

                <div>

                    <h5 class="mb-0">
                        Analyse CivicPulse AI
                    </h5>

                    <small class="opacity-75">
                        Synthèse automatique des indicateurs
                    </small>

                </div>

            </div>

        </div>

        <div class="card-body">

            <div class="row g-4">


                <div class="col-lg-4">

                    <div class="p-4 bg-light rounded-3 h-100">

                        <small class="text-muted">
                            Niveau de confiance IA
                        </small>

                        <h2 class="fw-bold text-success mt-2">
                            {{ $scoreIAMoyen }}%
                        </h2>

                        <p class="text-muted mb-0">
                            Score moyen enregistré par le système d'analyse.
                        </p>

                    </div>

                </div>


                <div class="col-lg-4">

                    <div class="p-4 bg-light rounded-3 h-100">

                        <small class="text-muted">
                            Incidents nécessitant une attention
                        </small>

                        <h2 class="fw-bold text-danger mt-2">
                            {{ $incidentsCritiques }}
                        </h2>

                        <p class="text-muted mb-0">
                            Incidents classés comme critiques.
                        </p>

                    </div>

                </div>


                <div class="col-lg-4">

                    <div class="p-4 bg-light rounded-3 h-100">

                        <small class="text-muted">
                            Activité récente
                        </small>

                        <h2 class="fw-bold text-primary mt-2">
                            {{ $incidentsRecents }}
                        </h2>

                        <p class="text-muted mb-0">
                            Incidents enregistrés durant les sept derniers jours.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


</div>


{{-- ========================= --}}
{{-- CHART.JS --}}
{{-- ========================= --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | EVOLUTION
    |--------------------------------------------------------------------------
    */

    const evolutionLabels = @json(
        $evolutionIncidents->pluck('date')
    );

    const evolutionData = @json(
        $evolutionIncidents->pluck('total')
    );

    new Chart(
        document.getElementById('evolutionChart'),
        {
            type: 'line',

            data: {

                labels: evolutionLabels,

                datasets: [{

                    label: 'Incidents',

                    data: evolutionData,

                    tension: 0.35,

                    fill: true

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        display: true
                    }

                },

                scales: {

                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }

                }

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | PRIORITES
    |--------------------------------------------------------------------------
    */

    const prioriteLabels = @json(
        $incidentsParPriorite->pluck('priorite')
    );

    const prioriteData = @json(
        $incidentsParPriorite->pluck('total')
    );

    new Chart(
        document.getElementById('prioriteChart'),
        {
            type: 'doughnut',

            data: {

                labels: prioriteLabels,

                datasets: [{

                    data: prioriteData

                }]

            },

            options: {

                responsive: true,

                plugins: {

                    legend: {
                        position: 'bottom'
                    }

                }

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | CATEGORIES
    |--------------------------------------------------------------------------
    */

    const categorieLabels = @json(
        $incidentsParCategorie->pluck('categorie')
    );

    const categorieData = @json(
        $incidentsParCategorie->pluck('total')
    );

    new Chart(
        document.getElementById('categorieChart'),
        {
            type: 'bar',

            data: {

                labels: categorieLabels,

                datasets: [{

                    label: 'Nombre d’incidents',

                    data: categorieData

                }]

            },

            options: {

                responsive: true,

                plugins: {

                    legend: {
                        display: false
                    }

                },

                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {
                            precision: 0
                        }

                    }

                }

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | STATUTS
    |--------------------------------------------------------------------------
    */

    const statutLabels = @json(
        $incidentsParStatut->pluck('statut')
    );

    const statutData = @json(
        $incidentsParStatut->pluck('total')
    );

    new Chart(
        document.getElementById('statutChart'),
        {
            type: 'doughnut',

            data: {

                labels: statutLabels,

                datasets: [{

                    data: statutData

                }]

            },

            options: {

                responsive: true,

                plugins: {

                    legend: {
                        position: 'bottom'
                    }

                }

            }

        }
    );

});

</script>

@endsection