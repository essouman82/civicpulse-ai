@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- En-tête -->

    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body d-flex justify-content-between align-items-center">

            <div>

                <h2 class="fw-bold mb-2">
                    Gestion des interventions
                </h2>

                <p class="text-muted mb-0">
                    Suivez et gérez toutes les interventions réalisées sur les incidents signalés.
                </p>

            </div>

            <a href="{{ route('interventions.create') }}"
               class="btn btn-success rounded-pill">

                <i class="bi bi-plus-circle-fill me-2"></i>

                Nouvelle intervention

            </a>

        </div>

    </div>

    @if(session('success'))

        <div class="alert alert-success rounded-4">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

        </div>

    @endif

    <!-- Statistiques -->

    <div class="row g-4 mb-4">

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Total des interventions
                        </small>

                        <h2 class="fw-bold">
                            {{ $interventions->count() }}
                        </h2>

                    </div>

                    <i class="bi bi-tools text-primary fs-1"></i>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Incidents concernés
                        </small>

                        <h2 class="fw-bold">
                            {{ $interventions->pluck('incident_id')->unique()->count() }}
                        </h2>

                    </div>

                    <i class="bi bi-exclamation-triangle-fill text-warning fs-1"></i>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Agents impliqués
                        </small>

                        <h2 class="fw-bold">
                            {{ $interventions->pluck('agent')->unique()->count() }}
                        </h2>

                    </div>

                    <i class="bi bi-person-badge-fill text-success fs-1"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- Tableau -->

<div class="card border-0 shadow-sm rounded-4">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th class="ps-4">Incident</th>

                        <th>Agent</th>

                        <th>Date</th>

                        <th>Statut</th>

                        <th class="text-center pe-4">Actions</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($interventions as $intervention)

                    <tr>

                        <td class="ps-4">

                            <div class="fw-semibold">

                                {{ $intervention->incident->titre }}

                            </div>

                            <small class="text-muted">

                                #{{ $intervention->incident->id }}

                            </small>

                        </td>

                        <td>

                            <span class="badge bg-primary rounded-pill px-3 py-2">

                                <i class="bi bi-person-fill me-1"></i>

                                {{ $intervention->agent }}

                            </span>

                        </td>

                        <td>

                            {{ \Carbon\Carbon::parse($intervention->date_intervention)->format('d/m/Y') }}

                        </td>

                        <td>

                            @php

                                $statut = $intervention->incident->statut;

                            @endphp

                            @if($statut=="Signalé")

                                <span class="badge bg-danger rounded-pill">

                                    {{ $statut }}

                                </span>

                            @elseif($statut=="En cours")

                                <span class="badge bg-warning text-dark rounded-pill">

                                    {{ $statut }}

                                </span>

                            @else

                                <span class="badge bg-success rounded-pill">

                                    {{ $statut }}

                                </span>

                            @endif

                        </td>

                        <td class="text-center pe-4">

                            <a href="{{ route('interventions.show',$intervention) }}"
                               class="btn btn-sm btn-outline-info rounded-pill">

                                <i class="bi bi-eye"></i>

                            </a>

                            <a href="{{ route('interventions.edit',$intervention) }}"
                               class="btn btn-sm btn-outline-warning rounded-pill">

                                <i class="bi bi-pencil-square"></i>

                            </a>

                            <form action="{{ route('interventions.destroy',$intervention) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Supprimer cette intervention ?');">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-outline-danger rounded-pill">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center py-5">

                            <i class="bi bi-tools display-5 text-muted"></i>

                            <h5 class="mt-3">

                                Aucune intervention enregistrée

                            </h5>

                            <p class="text-muted">

                                Commencez par créer votre première intervention.

                            </p>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>

@endsection