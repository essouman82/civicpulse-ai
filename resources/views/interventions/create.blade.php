@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- En-tête -->

    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body d-flex justify-content-between align-items-center">

            <div>

                <h2 class="fw-bold mb-2">

                    Nouvelle intervention

                </h2>

                <p class="text-muted mb-0">

                    Planifiez et enregistrez une intervention sur un incident.

                </p>

            </div>

            <a href="{{ route('interventions.index') }}"
               class="btn btn-outline-secondary rounded-pill">

                <i class="bi bi-arrow-left me-2"></i>

                Retour

            </a>

        </div>

    </div>

    @if($errors->any())

        <div class="alert alert-danger rounded-4">

            <strong>

                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                Veuillez corriger les erreurs suivantes :

            </strong>

            <ul class="mt-2 mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('interventions.store') }}"
          method="POST">

        @csrf

        <div class="row g-4">

            <!-- Colonne gauche -->

            <div class="col-lg-6">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-header bg-white border-0">

                        <h5 class="fw-bold mb-0">

                            Informations de l'intervention

                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Incident concerné

                            </label>

                            <select
                                name="incident_id"
                                class="form-select rounded-3"
                                required>

                                <option value="">

                                    Sélectionner un incident

                                </option>

                                @foreach($incidents as $incident)

                                    <option
                                        value="{{ $incident->id }}"
                                        {{ old('incident_id') == $incident->id ? 'selected' : '' }}>

                                        #{{ $incident->id }} — {{ $incident->titre }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Agent responsable

                            </label>

                            <input
                                type="text"
                                name="agent"
                                class="form-control rounded-3"
                                value="{{ old('agent') }}"
                                placeholder="Nom de l'agent"
                                required>

                        </div>

                                  <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Description de l'intervention

                            </label>

                            <textarea
                                name="description"
                                rows="8"
                                class="form-control rounded-3"
                                placeholder="Décrivez les actions réalisées..."
                                required>{{ old('description') }}</textarea>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Colonne droite -->

            <div class="col-lg-6">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-header bg-white border-0">

                        <h5 class="fw-bold mb-0">

                            Planification

                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Date d'intervention

                            </label>

                            <input
                                type="date"
                                name="date_intervention"
                                class="form-control rounded-3"
                                value="{{ old('date_intervention', date('Y-m-d')) }}"
                                required>

                        </div>

                        <div class="alert alert-info rounded-4">

                            <h6 class="fw-bold">

                                <i class="bi bi-info-circle-fill me-2"></i>

                                Information

                            </h6>

                            <p class="mb-0">

                                Après l'enregistrement de cette intervention,
                                le statut de l'incident sera automatiquement
                                mis à <strong>« En cours »</strong>.

                            </p>

                        </div>

                        <div class="card border-0 bg-light rounded-4 mt-4">

                            <div class="card-body">

                                <h6 class="fw-bold mb-3">

                                    <i class="bi bi-lightbulb-fill text-warning me-2"></i>

                                    Conseil

                                </h6>

                                <p class="text-muted mb-0">

                                    Rédigez une description claire et précise
                                    afin de faciliter le suivi des opérations
                                    par les administrateurs et les autres agents.

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Boutons -->

        <div class="mt-4 d-flex gap-3">

            <button
                type="submit"
                class="btn btn-success rounded-pill px-4">

                <i class="bi bi-check-circle-fill me-2"></i>

                Enregistrer l'intervention

            </button>

            <a href="{{ route('interventions.index') }}"
               class="btn btn-outline-secondary rounded-pill px-4">

                Annuler

            </a>

        </div>

    </form>

</div>

@endsection         