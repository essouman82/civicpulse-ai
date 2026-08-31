@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- En-tête -->

    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body d-flex justify-content-between align-items-center">

            <div>

                <h2 class="fw-bold mb-2">

                    Modifier un incident

                </h2>

                <p class="text-muted mb-0">

                    Mettez à jour les informations de cet incident.

                </p>

            </div>

            <a href="{{ route('incidents.index') }}"
               class="btn btn-outline-secondary rounded-pill">

                <i class="bi bi-arrow-left me-1"></i>

                Retour

            </a>

        </div>

    </div>

    @if ($errors->any())

        <div class="alert alert-danger rounded-4">

            <strong>

                <i class="bi bi-exclamation-triangle-fill me-2"></i>

                Veuillez corriger les erreurs suivantes :

            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('incidents.update',$incident) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="row g-4">

            <!-- Colonne gauche -->

            <div class="col-lg-6">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-header bg-white border-0">

                        <h5 class="fw-bold mb-0">

                            Informations générales

                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Titre

                            </label>

                            <input
                                type="text"
                                name="titre"
                                class="form-control rounded-3"
                                value="{{ old('titre',$incident->titre) }}"
                                required>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Description

                            </label>

                            <textarea
                                name="description"
                                rows="7"
                                class="form-control rounded-3"
                                required>{{ old('description',$incident->description) }}</textarea>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Catégorie

                            </label>

                            <select
                                name="categorie"
                                class="form-select rounded-3">

                                <option value="Route" {{ $incident->categorie=='Route' ? 'selected' : '' }}>Route</option>

                                <option value="Éclairage public" {{ $incident->categorie=='Éclairage public' ? 'selected' : '' }}>Éclairage public</option>

                                <option value="Déchets" {{ $incident->categorie=='Déchets' ? 'selected' : '' }}>Déchets</option>

                                <option value="Inondation" {{ $incident->categorie=='Inondation' ? 'selected' : '' }}>Inondation</option>

                                <option value="Autre" {{ $incident->categorie=='Autre' ? 'selected' : '' }}>Autre</option>

                            </select>

                        </div>

                                                <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Priorité

                            </label>

                            <select
                                name="priorite"
                                class="form-select rounded-3">

                                <option value="Faible" {{ $incident->priorite=='Faible' ? 'selected' : '' }}>
                                    Faible
                                </option>

                                <option value="Moyenne" {{ $incident->priorite=='Moyenne' ? 'selected' : '' }}>
                                    Moyenne
                                </option>

                                <option value="Haute" {{ $incident->priorite=='Haute' ? 'selected' : '' }}>
                                    Haute
                                </option>

                                <option value="Critique" {{ $incident->priorite=='Critique' ? 'selected' : '' }}>
                                    Critique
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Colonne droite -->

            <div class="col-lg-6">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-header bg-white border-0">

                        <h5 class="fw-bold mb-0">

                            Localisation et statut

                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Statut

                            </label>

                            <select
                                name="statut"
                                class="form-select rounded-3">

                                <option value="Signalé" {{ $incident->statut=='Signalé' ? 'selected' : '' }}>
                                    Signalé
                                </option>

                                <option value="En cours" {{ $incident->statut=='En cours' ? 'selected' : '' }}>
                                    En cours
                                </option>

                                <option value="Résolu" {{ $incident->statut=='Résolu' ? 'selected' : '' }}>
                                    Résolu
                                </option>

                            </select>

                        </div>

                        <label class="form-label fw-semibold">

                            Position de l'incident

                        </label>

                        <p class="text-muted small">

                            Cliquez sur la carte pour modifier l'emplacement.

                        </p>

                        <div id="map"
                             class="rounded-4 shadow-sm mb-4"
                             style="height:320px;">
                        </div>

                        <div class="row">

                            <div class="col-md-6">

                                <label class="form-label">

                                    Latitude

                                </label>

                                <input
                                    type="text"
                                    id="latitude"
                                    name="latitude"
                                    class="form-control rounded-3"
                                    value="{{ old('latitude',$incident->latitude) }}"
                                    readonly>

                            </div>

                            <div class="col-md-6">

                                <label class="form-label">

                                    Longitude

                                </label>

                                <input
                                    type="text"
                                    id="longitude"
                                    name="longitude"
                                    class="form-control rounded-3"
                                    value="{{ old('longitude',$incident->longitude) }}"
                                    readonly>

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

                Enregistrer les modifications

            </button>

            <a href="{{ route('incidents.show',$incident) }}"
               class="btn btn-outline-secondary rounded-pill px-4">

                Annuler

            </a>

        </div>

    </form>

</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const lat = parseFloat(document.getElementById('latitude').value) || 3.8480;
    const lng = parseFloat(document.getElementById('longitude').value) || 11.5021;

    const map = L.map('map').setView([lat, lng], 14);

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution:'&copy; OpenStreetMap',
            maxZoom:19
        }
    ).addTo(map);

    let marker = L.marker([lat, lng]).addTo(map);

    map.on('click', function(e){

        marker.setLatLng(e.latlng);

        document.getElementById('latitude').value =
            e.latlng.lat.toFixed(6);

        document.getElementById('longitude').value =
            e.latlng.lng.toFixed(6);

    });

});

</script>

@endsection