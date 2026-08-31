@extends('layouts.app')

@section('content')

{{-- ========================================================= --}}
{{-- EN-TÊTE --}}
{{-- ========================================================= --}}

<div class="card border-0 shadow-sm rounded-4 mb-4">

    <div class="card-body d-flex justify-content-between align-items-center">

        <div>

            <h2 class="fw-bold mb-2">
                Modifier une intervention
            </h2>

            <p class="text-muted mb-0">
                Mettez à jour les informations de cette intervention.
            </p>

        </div>

        <a href="{{ route('interventions.index') }}"
           class="btn btn-outline-secondary rounded-pill">

            <i class="bi bi-arrow-left me-2"></i>

            Retour

        </a>

    </div>

</div>


{{-- ========================================================= --}}
{{-- ERREURS --}}
{{-- ========================================================= --}}

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


{{-- ========================================================= --}}
{{-- FORMULAIRE --}}
{{-- ========================================================= --}}

<form action="{{ route('interventions.update', $intervention) }}"
      method="POST">

    @csrf
    @method('PUT')


    <div class="row g-4">


        {{-- ================================================= --}}
        {{-- COLONNE GAUCHE --}}
        {{-- ================================================= --}}

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-header bg-white border-0">

                    <h5 class="fw-bold mb-0">

                        <i class="bi bi-clipboard-data me-2 text-success"></i>

                        Informations générales

                    </h5>

                </div>


                <div class="card-body">


                    {{-- INCIDENT --}}

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Incident concerné

                        </label>

                        <select class="form-select rounded-3" disabled>

                            @foreach($incidents as $incident)

                                <option
                                    {{ $incident->id == $intervention->incident_id ? 'selected' : '' }}>

                                    #{{ $incident->id }} — {{ $incident->titre }}

                                </option>

                            @endforeach

                        </select>

                        <small class="text-muted">

                            L'incident associé ne peut pas être modifié.

                        </small>

                    </div>


                    {{-- AGENT --}}

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Agent responsable

                        </label>

                        <input
                            type="text"
                            name="agent"
                            class="form-control rounded-3"
                            value="{{ old('agent', $intervention->agent) }}"
                            required>

                    </div>


                    {{-- DESCRIPTION --}}

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Description de l'intervention

                        </label>

                        <textarea
                            name="description"
                            rows="8"
                            class="form-control rounded-3"
                            placeholder="Décrivez les actions réalisées..."
                            required>{{ old('description', $intervention->description) }}</textarea>

                    </div>


                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- COLONNE DROITE --}}
        {{-- ================================================= --}}

        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4 h-100">

                <div class="card-header bg-white border-0">

                    <h5 class="fw-bold mb-0">

                        <i class="bi bi-gear me-2 text-success"></i>

                        Informations complémentaires

                    </h5>

                </div>


                <div class="card-body">


                    {{-- DATE --}}

                    <div class="mb-4">

                        <label class="form-label fw-semibold">

                            Date d'intervention

                        </label>

                        <input
                            type="date"
                            name="date_intervention"
                            class="form-control rounded-3"
                            value="{{ old('date_intervention', $intervention->date_intervention) }}"
                            required>

                    </div>


                    {{-- ================================================= --}}
                    {{-- STATUT --}}
                    {{-- ================================================= --}}

                    <div class="mb-4">

                        <label for="statut" class="form-label fw-semibold">

                            Statut de l'intervention

                        </label>

                        <select
                            name="statut"
                            id="statut"
                            class="form-select rounded-3"
                            required>

                            <option value="En cours"
                                {{ old('statut', $intervention->statut) === 'En cours' ? 'selected' : '' }}>

                                🟠 En cours

                            </option>

                            <option value="Terminée"
                                {{ old('statut', $intervention->statut) === 'Terminée' ? 'selected' : '' }}>

                                🟢 Terminée

                            </option>

                            <option value="Annulée"
                                {{ old('statut', $intervention->statut) === 'Annulée' ? 'selected' : '' }}>

                                🔴 Annulée

                            </option>

                        </select>

                        <small class="text-muted">

                            Mettez à jour l'état réel de l'intervention.

                        </small>

                    </div>


                    {{-- ================================================= --}}
                    {{-- AVERTISSEMENT --}}
                    {{-- ================================================= --}}

                    <div class="alert alert-warning rounded-4">

                        <h6 class="fw-bold">

                            <i class="bi bi-exclamation-triangle-fill me-2"></i>

                            Attention

                        </h6>

                        <p class="mb-0">

                            Les modifications apportées seront immédiatement
                            enregistrées dans le système et visibles par les
                            autres utilisateurs autorisés.

                        </p>

                    </div>


                    {{-- ================================================= --}}
                    {{-- INFORMATIONS --}}
                    {{-- ================================================= --}}

                    <div class="card border-0 bg-light rounded-4 mt-4">

                        <div class="card-body">

                            <h6 class="fw-bold mb-3">

                                <i class="bi bi-info-circle-fill text-primary me-2"></i>

                                Informations

                            </h6>

                            <ul class="mb-0">

                                <li>
                                    L'incident associé reste inchangé.
                                </li>

                                <li>
                                    L'agent responsable peut être modifié.
                                </li>

                                <li>
                                    La description doit refléter les actions réellement effectuées.
                                </li>

                                <li>
                                    La date doit correspondre à l'intervention réalisée.
                                </li>

                                <li>
                                    Le statut permet de suivre l'avancement de l'intervention.
                                </li>

                            </ul>

                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- BOUTONS --}}
    {{-- ========================================================= --}}

    <div class="mt-4 d-flex gap-3">

        <button
            type="submit"
            class="btn btn-success rounded-pill px-4">

            <i class="bi bi-check-circle-fill me-2"></i>

            Enregistrer les modifications

        </button>


        <a href="{{ route('interventions.show', $intervention) }}"
           class="btn btn-outline-secondary rounded-pill px-4">

            <i class="bi bi-x-circle me-2"></i>

            Annuler

        </a>

    </div>

</form>

@endsection