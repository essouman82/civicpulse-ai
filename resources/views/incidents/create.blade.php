@extends('layouts.app')

@section('content')

<div class="container-fluid py-4">

    {{-- ================================================= --}}
    {{-- EN-TÊTE --}}
    {{-- ================================================= --}}

    <div class="card border-0 shadow-sm rounded-4 mb-4">

        <div class="card-body d-flex justify-content-between align-items-center">

            <div>

                <h2 class="fw-bold mb-2">
                    <i class="bi bi-megaphone-fill text-success me-2"></i>
                    Signaler un incident
                </h2>

                <p class="text-muted mb-0">
                    Décrivez l'incident rencontré afin que les autorités puissent intervenir rapidement.
                </p>

            </div>

            <a href="{{ route('incidents.index') }}"
               class="btn btn-outline-secondary rounded-pill">

                <i class="bi bi-arrow-left me-1"></i>
                Retour

            </a>

        </div>

    </div>


    {{-- ================================================= --}}
    {{-- ERREURS --}}
    {{-- ================================================= --}}

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


    {{-- ================================================= --}}
    {{-- FORMULAIRE --}}
    {{-- ================================================= --}}

    <form action="{{ route('incidents.store') }}"
          method="POST">

        @csrf

        <div class="row g-4">


            {{-- ================================================= --}}
            {{-- INFORMATIONS --}}
            {{-- ================================================= --}}

            <div class="col-lg-5">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-header bg-white border-0 pt-4 px-4">

                        <h5 class="fw-bold mb-1">

                            <i class="bi bi-file-earmark-text-fill text-success me-2"></i>

                            Informations générales

                        </h5>

                        <small class="text-muted">

                            Décrivez précisément le problème rencontré.

                        </small>

                    </div>


                    <div class="card-body p-4">


                        {{-- TITRE --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Titre de l'incident
                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="titre"
                                class="form-control rounded-3"
                                value="{{ old('titre') }}"
                                placeholder="Ex : Nid-de-poule dangereux"
                                required>

                        </div>


                        {{-- CATEGORIE --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Catégorie
                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="categorie"
                                class="form-select rounded-3"
                                required>

                                <option value="">
                                    Choisir une catégorie
                                </option>

                                <option value="Route"
                                    {{ old('categorie') == 'Route' ? 'selected' : '' }}>
                                    🛣️ Route
                                </option>

                                <option value="Éclairage public"
                                    {{ old('categorie') == 'Éclairage public' ? 'selected' : '' }}>
                                    💡 Éclairage public
                                </option>

                                <option value="Déchets"
                                    {{ old('categorie') == 'Déchets' ? 'selected' : '' }}>
                                    🗑️ Déchets
                                </option>

                                <option value="Inondation"
                                    {{ old('categorie') == 'Inondation' ? 'selected' : '' }}>
                                    🌊 Inondation
                                </option>

                                <option value="Autre"
                                    {{ old('categorie') == 'Autre' ? 'selected' : '' }}>
                                    📌 Autre
                                </option>

                            </select>

                        </div>


                        {{-- DESCRIPTION --}}

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Description
                                <span class="text-danger">*</span>

                            </label>

                            <textarea
                                name="description"
                                rows="8"
                                class="form-control rounded-3"
                                placeholder="Décrivez précisément le problème : emplacement, gravité, danger éventuel..."
                                required>{{ old('description') }}</textarea>

                            <small class="text-muted">

                                Plus la description est précise, plus l'analyse de CivicPulse AI sera pertinente.

                            </small>

                        </div>


                        {{-- INFORMATION IA --}}

                        <div class="alert alert-success rounded-3 mb-0">

                            <i class="bi bi-robot me-2"></i>

                            <strong>CivicPulse AI</strong>

                            <p class="small mb-0 mt-1">

                                Les informations fournies pourront être analysées afin d'aider à déterminer la priorité du signalement.

                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- LOCALISATION --}}
            {{-- ================================================= --}}

            <div class="col-lg-7">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-header bg-white border-0 pt-4 px-4">

                        <h5 class="fw-bold mb-1">

                            <i class="bi bi-geo-alt-fill text-danger me-2"></i>

                            Localisation

                        </h5>

                        <small class="text-muted">

                            Cliquez sur la carte pour indiquer précisément l'emplacement.

                        </small>

                    </div>


                    <div class="card-body p-4">


                        {{-- BOUTON GPS --}}

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <span class="fw-semibold">

                                Position de l'incident

                            </span>

                            <button
                                type="button"
                                id="locateBtn"
                                class="btn btn-outline-success btn-sm rounded-pill">

                                <i class="bi bi-crosshair me-1"></i>

                                Ma position

                            </button>

                        </div>


                        {{-- CARTE --}}

                        <div
                            id="incidentMap"
                            style="
                                width:100%;
                                height:420px;
                                border-radius:15px;
                                overflow:hidden;
                            ">
                        </div>


                        {{-- COORDONNEES --}}

                        <div class="row mt-3">

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    Latitude

                                </label>

                                <input
                                    type="text"
                                    id="latitude"
                                    name="latitude"
                                    class="form-control rounded-3"
                                    readonly
                                    value="{{ old('latitude') }}">

                            </div>


                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    Longitude

                                </label>

                                <input
                                    type="text"
                                    id="longitude"
                                    name="longitude"
                                    class="form-control rounded-3"
                                    readonly
                                    value="{{ old('longitude') }}">

                            </div>

                        </div>


                        <div class="alert alert-info rounded-3 mt-3 mb-0">

                            <i class="bi bi-info-circle-fill me-2"></i>

                            Cliquez sur la carte pour sélectionner l'emplacement.
                            Vous pouvez également utiliser le bouton
                            <strong>Ma position</strong> pour utiliser votre GPS.

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- BOUTONS --}}
        {{-- ================================================= --}}

        <div class="mt-4 d-flex gap-3">

            <button
                type="submit"
                class="btn btn-success rounded-pill px-4">

                <i class="bi bi-check-circle-fill me-2"></i>

                Signaler l'incident

            </button>


            <a href="{{ route('incidents.index') }}"
               class="btn btn-outline-secondary rounded-pill px-4">

                <i class="bi bi-x-circle me-2"></i>

                Annuler

            </a>

        </div>

    </form>

</div>


{{-- ================================================= --}}
{{-- LEAFLET --}}
{{-- ================================================= --}}

<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>

<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
</script>


<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | INITIALISATION DE LA CARTE
    |--------------------------------------------------------------------------
    */

    const defaultLatitude = 3.8480;
    const defaultLongitude = 11.5021;

    const map = L.map('incidentMap')
        .setView(
            [defaultLatitude, defaultLongitude],
            13
        );


    /*
    |--------------------------------------------------------------------------
    | OPENSTREETMAP
    |--------------------------------------------------------------------------
    */

    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution: '&copy; OpenStreetMap contributors'
        }
    ).addTo(map);


    let marker = null;


    /*
    |--------------------------------------------------------------------------
    | SELECTION SUR LA CARTE
    |--------------------------------------------------------------------------
    */

    map.on('click', function (event) {

        const latitude = event.latlng.lat.toFixed(6);
        const longitude = event.latlng.lng.toFixed(6);


        document.getElementById('latitude').value =
            latitude;

        document.getElementById('longitude').value =
            longitude;


        if (marker) {

            marker.setLatLng(event.latlng);

        } else {

            marker = L.marker(event.latlng)
                .addTo(map);

        }


        marker
            .bindPopup(
                '<strong>Emplacement sélectionné</strong><br>' +
                latitude +
                ', ' +
                longitude
            )
            .openPopup();

    });


    /*
    |--------------------------------------------------------------------------
    | GEOLOCALISATION
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('locateBtn')
        .addEventListener('click', function () {


            if (!navigator.geolocation) {

                alert(
                    'La géolocalisation n’est pas supportée par votre navigateur.'
                );

                return;

            }


            const button = this;

            button.disabled = true;

            button.innerHTML =
                '<span class="spinner-border spinner-border-sm me-1"></span>' +
                'Localisation...';


            navigator.geolocation.getCurrentPosition(

                function (position) {

                    const latitude =
                        position.coords.latitude;

                    const longitude =
                        position.coords.longitude;


                    document.getElementById('latitude').value =
                        latitude.toFixed(6);

                    document.getElementById('longitude').value =
                        longitude.toFixed(6);


                    map.setView(
                        [latitude, longitude],
                        16
                    );


                    if (marker) {

                        marker.setLatLng(
                            [latitude, longitude]
                        );

                    } else {

                        marker = L.marker(
                            [latitude, longitude]
                        ).addTo(map);

                    }


                    marker
                        .bindPopup(
                            '<strong>Votre position</strong>'
                        )
                        .openPopup();


                    button.disabled = false;

                    button.innerHTML =
                        '<i class="bi bi-check-circle me-1"></i>' +
                        'Position trouvée';

                },


                function () {

                    alert(
                        'Impossible de récupérer votre position. Vérifiez que la localisation est autorisée dans votre navigateur.'
                    );


                    button.disabled = false;

                    button.innerHTML =
                        '<i class="bi bi-crosshair me-1"></i>' +
                        'Ma position';

                },

                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }

            );

        });


    /*
    |--------------------------------------------------------------------------
    | RESTAURATION APRÈS ERREUR DE VALIDATION
    |--------------------------------------------------------------------------
    */

    const oldLatitude =
        document.getElementById('latitude').value;

    const oldLongitude =
        document.getElementById('longitude').value;


    if (oldLatitude && oldLongitude) {

        const oldPosition = [
            parseFloat(oldLatitude),
            parseFloat(oldLongitude)
        ];


        map.setView(
            oldPosition,
            16
        );


        marker = L.marker(oldPosition)
            .addTo(map);

    }

});

</script>

@endsection