@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- En-tête -->

    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body d-flex justify-content-between align-items-center">

            <div>

                <h2 class="fw-bold mb-2">
                    Tableau de bord Agent 👷
                </h2>

                <p class="text-muted mb-0">
                    Consultez les incidents à traiter et suivez l'évolution des interventions.
                </p>

            </div>

            <span class="badge bg-warning text-dark fs-6 px-3 py-2">
                Agent
            </span>

        </div>

    </div>

    <!-- Cartes -->

    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">Incidents</small>

                        <h2 class="fw-bold mt-2">
                            {{ $totalIncidents }}
                        </h2>

                    </div>

                    <div class="bg-primary bg-opacity-10 rounded-circle p-3">

                        <i class="bi bi-exclamation-octagon-fill text-primary fs-2"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">À traiter</small>

                        <h2 class="fw-bold text-danger mt-2">
                            {{ $aTraiter }}
                        </h2>

                    </div>

                    <div class="bg-danger bg-opacity-10 rounded-circle p-3">

                        <i class="bi bi-bell-fill text-danger fs-2"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">En cours</small>

                        <h2 class="fw-bold text-warning mt-2">
                            {{ $enCours }}
                        </h2>

                    </div>

                    <div class="bg-warning bg-opacity-10 rounded-circle p-3">

                        <i class="bi bi-hourglass-split text-warning fs-2"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">Résolus</small>

                        <h2 class="fw-bold text-success mt-2">
                            {{ $resolus }}
                        </h2>

                    </div>

                    <div class="bg-success bg-opacity-10 rounded-circle p-3">

                        <i class="bi bi-check-circle-fill text-success fs-2"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Tableau -->

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-header bg-white border-0 py-3">

            <h5 class="fw-bold mb-0">
                Derniers incidents
            </h5>

        </div>

        <div class="card-body table-responsive">

            <table class="table align-middle table-hover">

                <thead class="table-light">

                    <tr>

                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Priorité</th>
                        <th>Statut</th>
                        <th class="text-center">Action</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($incidents as $incident)

                    <tr>

                        <td>{{ $incident->titre }}</td>

                        <td>{{ $incident->categorie }}</td>

                        <td>

                            @if($incident->priorite=='Critique')

                                <span class="badge bg-danger">
                                    Critique
                                </span>

                            @elseif($incident->priorite=='Haute')

                                <span class="badge bg-warning text-dark">
                                    Haute
                                </span>

                            @elseif($incident->priorite=='Moyenne')

                                <span class="badge bg-info">
                                    Moyenne
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Faible
                                </span>

                            @endif

                        </td>

                        <td>

                            @if($incident->statut=='Signalé')

                                <span class="badge bg-danger">
                                    Signalé
                                </span>

                            @elseif($incident->statut=='En cours')

                                <span class="badge bg-warning text-dark">
                                    En cours
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Résolu
                                </span>

                            @endif

                        </td>

                        <td class="text-center">

                            <a href="{{ route('incidents.edit',$incident) }}"
                               class="btn btn-success btn-sm rounded-pill">

                                <i class="bi bi-tools"></i>

                                Traiter

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center text-muted py-4">

                            Aucun incident disponible.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection