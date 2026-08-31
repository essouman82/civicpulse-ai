@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- En-tête -->

    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body d-flex justify-content-between align-items-center">

            <div>

                <h2 class="fw-bold mb-2">

                    Détails de l'intervention

                </h2>

                <p class="text-muted mb-0">

                    Consultez toutes les informations concernant cette intervention.

                </p>

            </div>

            <div>

                <a href="{{ route('interventions.edit',$intervention) }}"
                   class="btn btn-warning rounded-pill me-2">

                    <i class="bi bi-pencil-square me-1"></i>

                    Modifier

                </a>

                <a href="{{ route('interventions.index') }}"
                   class="btn btn-outline-secondary rounded-pill">

                    <i class="bi bi-arrow-left me-1"></i>

                    Retour

                </a>

            </div>

        </div>

    </div>

    <div class="row g-4">

        <!-- Informations -->

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white border-0">

                    <h5 class="fw-bold mb-0">

                        Informations générales

                    </h5>

                </div>

                <div class="card-body">

                    <div class="mb-4">

                        <h6 class="text-muted">

                            Incident concerné

                        </h6>

                        <p class="fs-5 fw-semibold">

                            {{ $intervention->incident->titre }}

                        </p>

                    </div>

                    <div class="mb-4">

                        <h6 class="text-muted">

                            Agent responsable

                        </h6>

                        <span class="badge bg-primary rounded-pill px-3 py-2">

                            <i class="bi bi-person-fill me-1"></i>

                            {{ $intervention->agent }}

                        </span>

                    </div>

                    <div class="mb-4">

                        <h6 class="text-muted">

                            Description de l'intervention

                        </h6>

                        <div class="bg-light rounded-4 p-3">

                            {{ $intervention->description }}

                        </div>

                    </div>
                          <div class="mb-0">

                        <h6 class="text-muted">

                            Date d'intervention

                        </h6>

                        <p class="fs-6">

                            {{ \Carbon\Carbon::parse($intervention->date_intervention)->format('d/m/Y') }}

                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- Colonne droite -->

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-white border-0">

                    <h5 class="fw-bold mb-0">

                        Résumé

                    </h5>

                </div>

                <div class="card-body">

                    <div class="mb-4">

                        <small class="text-muted d-block">

                            Identifiant de l'incident

                        </small>

                        <span class="fw-bold">

                            #{{ $intervention->incident->id }}

                        </span>

                    </div>

                    <div class="mb-4">

                        <small class="text-muted d-block">

                            Statut actuel

                        </small>

                        @if($intervention->incident->statut=="Signalé")

                            <span class="badge bg-danger rounded-pill px-3 py-2">

                                {{ $intervention->incident->statut }}

                            </span>

                        @elseif($intervention->incident->statut=="En cours")

                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2">

                                {{ $intervention->incident->statut }}

                            </span>

                        @else

                            <span class="badge bg-success rounded-pill px-3 py-2">

                                {{ $intervention->incident->statut }}

                            </span>

                        @endif

                    </div>

                    <div class="mb-4">

                        <small class="text-muted d-block">

                            Créée le

                        </small>

                        <span>

                            {{ $intervention->created_at->format('d/m/Y H:i') }}

                        </span>

                    </div>

                    <div>

                        <small class="text-muted d-block">

                            Dernière modification

                        </small>

                        <span>

                            {{ $intervention->updated_at->format('d/m/Y H:i') }}

                        </span>

                    </div>

                </div>

            </div>

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body">

                    <h6 class="fw-bold mb-3">

                        Actions

                    </h6>

                    <div class="d-grid gap-2">

                        <a href="{{ route('interventions.edit',$intervention) }}"
                           class="btn btn-warning rounded-pill">

                            <i class="bi bi-pencil-square me-2"></i>

                            Modifier

                        </a>

                        <form action="{{ route('interventions.destroy',$intervention) }}"
                              method="POST"
                              onsubmit="return confirm('Supprimer définitivement cette intervention ?');">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger rounded-pill w-100">

                                <i class="bi bi-trash me-2"></i>

                                Supprimer

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection     