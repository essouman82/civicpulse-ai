@extends('layouts.app')

@section('title','Tableau de bord Administrateur')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold">
                Centre de Supervision Urbain
            </h2>

            <p class="text-muted mb-0">
                Tableau de bord intelligent de CivicPulse AI
            </p>

        </div>

        <div class="text-end">

            <span class="badge bg-success fs-6">

                <i class="bi bi-cpu-fill"></i>

                IA Active

            </span>

            <br>

            <small class="text-muted">

                {{ now()->format('d/m/Y H:i') }}

            </small>

        </div>

    </div>



    <div class="row g-4">

        <div class="col-lg-3 col-md-6">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">

                                Utilisateurs

                            </small>

                            <h2 class="fw-bold">

                                {{ $totalUsers }}

                            </h2>

                        </div>

                        <div class="bg-primary rounded-circle d-flex justify-content-center align-items-center"
                             style="width:65px;height:65px;">

                            <i class="bi bi-people-fill text-white fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-lg-3 col-md-6">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">

                                Incidents

                            </small>

                            <h2 class="fw-bold text-danger">

                                {{ $totalIncidents }}

                            </h2>

                        </div>

                        <div class="bg-danger rounded-circle d-flex justify-content-center align-items-center"
                             style="width:65px;height:65px;">

                            <i class="bi bi-exclamation-triangle-fill text-white fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-lg-3 col-md-6">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">

                                Interventions

                            </small>

                            <h2 class="fw-bold text-success">

                                {{ $totalInterventions }}

                            </h2>

                        </div>

                        <div class="bg-success rounded-circle d-flex justify-content-center align-items-center"
                             style="width:65px;height:65px;">

                            <i class="bi bi-tools text-white fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-lg-3 col-md-6">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <small class="text-muted">

                                IA moyenne

                            </small>

                            <h2 class="fw-bold text-primary">

                                {{ $scoreIAMoyen }}%

                            </h2>

                        </div>

                        <div class="bg-info rounded-circle d-flex justify-content-center align-items-center"
                             style="width:65px;height:65px;">

                            <i class="bi bi-cpu-fill text-white fs-3"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <div class="row g-4 mt-1">

        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h5>

                        👑 Administrateurs

                    </h5>

                    <h2 class="text-warning">

                        {{ $administrateurs }}

                    </h2>

                </div>

            </div>

        </div>



        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h5>

                        👮 Agents

                    </h5>

                    <h2 class="text-success">

                        {{ $agents }}

                    </h2>

                </div>

            </div>

        </div>



        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h5>

                        👤 Citoyens

                    </h5>

                    <h2 class="text-primary">

                        {{ $citoyens }}

                    </h2>

                </div>

            </div>

        </div>



        <div class="col-lg-3">

            <div class="card border-0 shadow-sm">

                <div class="card-body text-center">

                    <h5>

                        🔴 Critiques

                    </h5>

                    <h2 class="text-danger">

                        {{ $critiques }}

                    </h2>

                </div>

            </div>

        </div>

    </div>

   <div class="row mt-4">

    <div class="col-lg-8">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    <i class="bi bi-bar-chart-line-fill text-primary"></i>

                    Évolution des incidents

                </h5>

            </div>

            <div class="card-body">

                <canvas id="incidentChart" height="120"></canvas>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    <i class="bi bi-pie-chart-fill text-success"></i>

                    Répartition des statuts

                </h5>

            </div>

            <div class="card-body">

                <canvas id="statusChart"></canvas>

            </div>

        </div>

    </div>

</div>

<div class="row mt-4">

    <!-- Incidents critiques -->

    <div class="col-lg-6">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-danger text-white">

                <h5 class="mb-0">

                    <i class="bi bi-exclamation-octagon-fill"></i>

                    Incidents critiques

                </h5>

            </div>

            <div class="card-body">

                @forelse($incidentsCritiques as $incident)

                    <div class="border-bottom pb-3 mb-3">

                        <div class="d-flex justify-content-between">

                            <strong>{{ $incident->titre }}</strong>

                            <span class="badge bg-danger">

                                {{ $incident->priorite }}

                            </span>

                        </div>

                        <small class="text-muted">

                            {{ $incident->categorie }}

                        </small>

                        <br>

                        <small>

                            {{ Str::limit($incident->description,80) }}

                        </small>

                    </div>

                @empty

                    <div class="alert alert-success mb-0">

                        Aucun incident critique.

                    </div>

                @endforelse

            </div>

        </div>

    </div>



    <!-- Derniers incidents -->

    <div class="col-lg-6">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0">

                    <i class="bi bi-clock-history"></i>

                    Derniers incidents

                </h5>

            </div>

            <div class="card-body">

                @forelse($derniersIncidents as $incident)

                    <div class="border-bottom pb-3 mb-3">

                        <div class="d-flex justify-content-between">

                            <strong>{{ $incident->titre }}</strong>

                            <span class="badge bg-secondary">

                                {{ $incident->statut }}

                            </span>

                        </div>

                        <small class="text-muted">

                            {{ $incident->created_at->format('d/m/Y H:i') }}

                        </small>

                    </div>

                @empty

                    <div class="alert alert-info mb-0">

                        Aucun incident enregistré.

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>
<div class="row mt-4">

    <div class="col-12">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-success text-white">

                <h5 class="mb-0">

                    <i class="bi bi-geo-alt-fill"></i>

                    Carte des incidents

                </h5>

            </div>

            <div class="card-body">

                <div id="mapDashboard"
                     style="height:500px;border-radius:12px;">
                </div>

            </div>

        </div>

    </div>

</div>
<!-- ============================= -->
<!-- PARTIE 5 : ANALYSE IA -->
<!-- ============================= -->

<div class="row mt-4">

    <div class="col-12">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-dark text-white">

                <div class="d-flex align-items-center">

                    <i class="bi bi-cpu-fill fs-4 me-2"></i>

                    <div>
                        <h5 class="mb-0">
                            Analyse intelligente CivicPulse AI
                        </h5>

                        <small class="opacity-75">
                            Synthèse automatique des données urbaines
                        </small>
                    </div>

                </div>

            </div>

            <div class="card-body">

                <div class="row g-4">

                    <!-- Incidents récents -->

                    <div class="col-lg-3 col-md-6">

                        <div class="p-4 bg-light rounded-3 h-100">

                            <small class="text-muted">
                                Incidents récents
                            </small>

                            <h2 class="fw-bold mt-2 mb-0">
                                {{ $incidentsRecents }}
                            </h2>

                            <small class="text-muted">
                                7 derniers jours
                            </small>

                        </div>

                    </div>


                    <!-- Incidents critiques -->

                    <div class="col-lg-3 col-md-6">

                        <div class="p-4 bg-light rounded-3 h-100">

                            <small class="text-muted">
                                Incidents critiques
                            </small>

                            <h2 class="fw-bold text-danger mt-2 mb-0">
                                {{ $critiques }}
                            </h2>

                            <small class="text-muted">
                                nécessitent une attention
                            </small>

                        </div>

                    </div>


                    <!-- Service principal -->

                    <div class="col-lg-3 col-md-6">

                        <div class="p-4 bg-light rounded-3 h-100">

                            <small class="text-muted">
                                Service le plus sollicité
                            </small>

                            <h5 class="fw-bold text-primary mt-2 mb-1">
                                {{ $servicePrincipalNom }}
                            </h5>

                            <small class="text-muted">
                                {{ $servicePrincipalTotal }} incident(s)
                            </small>

                        </div>

                    </div>


                    <!-- Confiance IA -->

                    <div class="col-lg-3 col-md-6">

                        <div class="p-4 bg-light rounded-3 h-100">

                            <small class="text-muted">
                                Confiance moyenne IA
                            </small>

                            <h2 class="fw-bold text-success mt-2 mb-0">
                                {{ $scoreIAMoyen }}%
                            </h2>

                            <small class="text-muted">
                                niveau de confiance
                            </small>

                        </div>

                    </div>

                </div>


                <hr class="my-4">


                <div class="row g-4">

                    <!-- Priorité dominante -->

                    <div class="col-lg-5">

                        <div class="border rounded-3 p-4 h-100">

                            <div class="d-flex align-items-center mb-3">

                                <i class="bi bi-bar-chart-fill text-warning fs-4 me-2"></i>

                                <h6 class="fw-bold mb-0">
                                    Priorité dominante
                                </h6>

                            </div>

                            <h3 class="fw-bold">
                                {{ $prioritePrincipaleNom }}
                            </h3>

                            <p class="text-muted mb-0">
                                Il s'agit actuellement du niveau de priorité
                                le plus représenté parmi les incidents enregistrés.
                            </p>

                        </div>

                    </div>


                    <!-- Recommandation -->

                    <div class="col-lg-7">

                        <div class="alert alert-primary border-0 h-100 mb-0">

                            <div class="d-flex align-items-center mb-3">

                                <i class="bi bi-lightbulb-fill fs-4 me-2"></i>

                                <h6 class="fw-bold mb-0">
                                    Recommandation CivicPulse AI
                                </h6>

                            </div>

                            <p class="mb-0">
                                {{ $recommandationIA }}
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<script>

const incidentChart = new Chart(
    document.getElementById('incidentChart'),
    {
        type: 'bar',

        data: {

            labels: [

                'Signalés',

                'En cours',

                'Résolus',

                'Critiques'

            ],

            datasets: [

                {

                    label: 'Incidents',

                    data: [

                        {{ $nouveaux }},

                        {{ $enCours }},

                        {{ $resolus }},

                        {{ $critiques }}

                    ]

                }

            ]

        },

        options: {

            responsive:true,

            plugins:{

                legend:{

                    display:false

                }

            }

        }

    }

);



const statusChart = new Chart(

    document.getElementById('statusChart'),

    {

        type:'doughnut',

        data:{

            labels:[

                'Signalés',

                'En cours',

                'Résolus'

            ],

            datasets:[

                {

                    data:[

                        {{ $nouveaux }},

                        {{ $enCours }},

                        {{ $resolus }}

                    ]

                }

            ]

        },

        options:{

            responsive:true

        }

    }

);

// ==========================
// CARTE LEAFLET
// ==========================

var map = L.map('mapDashboard').setView([3.8480,11.5021],12);

L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
    attribution:'© OpenStreetMap'
}).addTo(map);

@foreach($incidentsCarte as $incident)

L.marker([
    {{ $incident->latitude }},
    {{ $incident->longitude }}
])

.addTo(map)

.bindPopup(`
<b>{{ $incident->titre }}</b><br>

Catégorie :
{{ $incident->categorie }}

<br>

Priorité :
{{ $incident->priorite }}

<br>

Service :
{{ $incident->service }}

`);

@endforeach
</script>
@endsection
