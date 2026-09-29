@extends('layouts.app')

@section('content')

<div class="container-fluid py-4 cp-create-page">

    {{-- EN-TÊTE --}}
    <div class="d-flex justify-content-between align-items-start gap-3 mb-4 flex-wrap">

        <div>
            <div class="text-uppercase fw-bold small mb-2" style="color:#087f5b;letter-spacing:2px;">
                <i class="bi bi-shield-check me-1"></i>
                CivicPulse AI
            </div>

            <h1 class="fw-bold mb-2">
                Signaler un incident
            </h1>

            <p class="text-muted mb-0">
                Signalez rapidement un problème urbain avec sa photo et sa localisation.
            </p>
        </div>

        <a href="{{ route('incidents.index') }}"
           class="btn btn-light border rounded-pill px-4">
            <i class="bi bi-arrow-left me-2"></i>
            Retour
        </a>

    </div>


    {{-- ERREURS --}}
    @if ($errors->any())

        <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4">

            <strong>
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Vérifiez les informations
            </strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif


    <form action="{{ route('incidents.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="row g-4">

            {{-- =====================================================
                 COLONNE GAUCHE
            ====================================================== --}}
            <div class="col-xl-5">

                {{-- PHOTO --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-body p-4">

                        <div class="d-flex align-items-center gap-3 mb-4">

                            <div class="cp-icon cp-green">
                                <i class="bi bi-camera-fill"></i>
                            </div>

                            <div>
                                <h5 class="fw-bold mb-1">
                                    Photo de l'incident
                                </h5>

                                <p class="text-muted small mb-0">
                                    Ajoutez une photo pour aider les agents.
                                </p>
                            </div>

                        </div>


                        <label for="photo" class="cp-photo-zone">

                            <div id="photoPlaceholder">

                                <div class="cp-camera">
                                    <i class="bi bi-camera-fill"></i>
                                </div>

                                <h5 class="fw-bold">
                                    Ajouter une photo
                                </h5>

                                <p class="text-muted small mb-3">
                                    Appuyez pour prendre une photo
                                    ou choisir une image.
                                </p>

                                <span class="badge rounded-pill px-3 py-2">
                                    JPG · PNG · WEBP — 5 Mo maximum
                                </span>

                            </div>


                            <img id="photoPreview"
                                 src=""
                                 alt="Aperçu de la photo"
                                 class="d-none">

                        </label>


                        <input
                            type="file"
                            id="photo"
                            name="photo"
                            class="d-none"
                            accept="image/*"
                            capture="environment">


                        <div class="text-muted small mt-3">
                            <i class="bi bi-info-circle me-1"></i>
                            Sur téléphone, vous pourrez utiliser directement la caméra.
                        </div>

                    </div>

                </div>


                {{-- INFORMATIONS --}}
                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body p-4">

                        <div class="d-flex align-items-center gap-3 mb-4">

                            <div class="cp-icon cp-blue">
                                <i class="bi bi-file-earmark-text-fill"></i>
                            </div>

                            <div>
                                <h5 class="fw-bold mb-1">
                                    Informations
                                </h5>

                                <p class="text-muted small mb-0">
                                    Décrivez le problème rencontré.
                                </p>
                            </div>

                        </div>


                        {{-- TITRE --}}
                        <div class="mb-4">

                            <label class="form-label fw-bold">
                                Titre
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="titre"
                                value="{{ old('titre') }}"
                                class="form-control cp-input"
                                placeholder="Ex : Nid-de-poule dangereux"
                                required>

                        </div>


                        {{-- CATEGORIE --}}
                        <div class="mb-4">

                            <label class="form-label fw-bold">
                                Catégorie
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="categorie"
                                class="form-select cp-input"
                                required>

                                <option value="">
                                    Choisir une catégorie
                                </option>

                                <option value="Route"
                                    {{ old('categorie') == 'Route' ? 'selected' : '' }}>
                                    Route
                                </option>

                                <option value="Éclairage public"
                                    {{ old('categorie') == 'Éclairage public' ? 'selected' : '' }}>
                                    Éclairage public
                                </option>

                                <option value="Déchets"
                                    {{ old('categorie') == 'Déchets' ? 'selected' : '' }}>
                                    Déchets
                                </option>

                                <option value="Inondation"
                                    {{ old('categorie') == 'Inondation' ? 'selected' : '' }}>
                                    Inondation
                                </option>

                                <option value="Autre"
                                    {{ old('categorie') == 'Autre' ? 'selected' : '' }}>
                                    Autre
                                </option>

                            </select>

                        </div>


                        {{-- DESCRIPTION --}}
                        <div class="mb-4">

                            <label class="form-label fw-bold">
                                Description
                                <span class="text-danger">*</span>
                            </label>

                            <textarea
                                name="description"
                                rows="6"
                                class="form-control cp-input"
                                placeholder="Décrivez précisément le problème, son emplacement et le danger éventuel..."
                                required>{{ old('description') }}</textarea>

                            <div class="text-muted small mt-2">
                                Plus votre description est précise,
                                meilleure sera l'analyse de CivicPulse AI.
                            </div>

                        </div>


                        {{-- IA --}}
                        <div class="cp-ai-box">

                            <div class="cp-ai-icon">
                                <i class="bi bi-stars"></i>
                            </div>

                            <div>

                                <strong>
                                    Analyse CivicPulse AI
                                </strong>

                                <p class="mb-0 small text-muted mt-1">
                                    Après l'envoi, notre système analysera
                                    automatiquement la catégorie, la priorité
                                    et le service concerné.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 COLONNE DROITE
            ====================================================== --}}
            <div class="col-xl-7">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body p-4">

                        <div class="d-flex align-items-center gap-3 mb-4">

                            <div class="cp-icon cp-red">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>

                            <div>
                                <h5 class="fw-bold mb-1">
                                    Localisation
                                </h5>

                                <p class="text-muted small mb-0">
                                    Indiquez précisément où se trouve l'incident.
                                </p>
                            </div>

                        </div>


                        {{-- BARRE LOCALISATION --}}
                        <div class="d-flex justify-content-between align-items-center gap-3 mb-3 flex-wrap">

                            <div>
                                <strong>
                                    Position de l'incident
                                </strong>

                                <div class="text-muted small">
                                    Cliquez sur la carte ou utilisez votre GPS.
                                </div>
                            </div>

                            <button
                                type="button"
                                id="locateBtn"
                                class="btn btn-success rounded-pill px-4">

                                <i class="bi bi-crosshair me-1"></i>
                                Ma position

                            </button>

                        </div>


                        {{-- CARTE --}}
                        <div id="incidentMap" class="cp-map"></div>


                        {{-- COORDONNEES --}}
                        <div class="row g-3 mt-3">

                            <div class="col-md-6">

                                <label class="form-label fw-bold">
                                    Latitude
                                </label>

                                <div class="cp-coordinate">

                                    <i class="bi bi-compass me-2"></i>

                                    <input
                                        type="text"
                                        id="latitude"
                                        name="latitude"
                                        value="{{ old('latitude') }}"
                                        readonly>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label fw-bold">
                                    Longitude
                                </label>

                                <div class="cp-coordinate">

                                    <i class="bi bi-compass me-2"></i>

                                    <input
                                        type="text"
                                        id="longitude"
                                        name="longitude"
                                        value="{{ old('longitude') }}"
                                        readonly>

                                </div>

                            </div>

                        </div>


                        {{-- INFO GPS --}}
                        <div class="cp-location-info mt-3">

                            <i class="bi bi-lightbulb-fill"></i>

                            <span>
                                La localisation permet aux agents de retrouver
                                rapidement l'incident sur la carte.
                            </span>

                        </div>


                        {{-- BOUTONS --}}
                        <div class="d-flex justify-content-end gap-2 mt-4 pt-4 border-top flex-wrap">

                            <a
                                href="{{ route('incidents.index') }}"
                                class="btn btn-light border rounded-pill px-4">

                                Annuler

                            </a>

                            <button
                                type="submit"
                                class="btn cp-submit-btn rounded-pill px-4">

                                <i class="bi bi-send-fill me-2"></i>
                                Signaler l'incident

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>


{{-- =============================================================
     STYLE
============================================================= --}}

<style>

.cp-create-page {
    max-width: 1500px;
}

.cp-icon {
    width: 48px;
    height: 48px;
    min-width: 48px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.cp-green {
    background: #e4f7ef;
    color: #087f5b;
}

.cp-blue {
    background: #e8f1ff;
    color: #2563eb;
}

.cp-red {
    background: #fff0f0;
    color: #dc3545;
}

.cp-input {
    min-height: 48px;
    border-radius: 13px !important;
    border: 1px solid #dfe7e3;
    padding: 12px 14px;
}

textarea.cp-input {
    min-height: 145px;
    resize: vertical;
}

.cp-input:focus {
    border-color: #20c997;
    box-shadow: 0 0 0 4px rgba(32,201,151,.12);
}

.cp-photo-zone {
    min-height: 270px;
    border: 2px dashed #cfe5dc;
    border-radius: 20px;
    background: #f8fcfa;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    cursor: pointer;
    overflow: hidden;
    transition: .2s ease;
}

.cp-photo-zone:hover {
    border-color: #20c997;
    background: #f1fbf7;
}

.cp-camera {
    width: 68px;
    height: 68px;
    margin: 0 auto 15px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #dff7ed;
    color: #087f5b;
    font-size: 26px;
}

.cp-photo-zone .badge {
    background: #e8f5ef;
    color: #087f5b;
}

#photoPreview {
    width: 100%;
    height: 270px;
    object-fit: cover;
}

.cp-ai-box {
    display: flex;
    gap: 14px;
    padding: 17px;
    border-radius: 17px;
    background: linear-gradient(135deg, #edfdf7, #f5fbff);
    border: 1px solid #d7f1e6;
}

.cp-ai-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #087f5b;
    color: white;
}

.cp-map {
    width: 100%;
    height: 470px;
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid #e3ebe7;
}

.cp-coordinate {
    height: 48px;
    display: flex;
    align-items: center;
    padding: 0 13px;
    background: #f7faf8;
    border: 1px solid #e0e9e4;
    border-radius: 13px;
    color: #087f5b;
}

.cp-coordinate input {
    border: 0;
    outline: 0;
    background: transparent;
    width: 100%;
    font-weight: 600;
}

.cp-location-info {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    padding: 14px 16px;
    border-radius: 14px;
    background: #eef8ff;
    color: #39647a;
    font-size: .82rem;
}

.cp-location-info i {
    color: #0d6efd;
}

.cp-submit-btn {
    color: white;
    border: 0;
    background: linear-gradient(135deg, #087f5b, #20c997);
    box-shadow: 0 8px 20px rgba(8,127,91,.2);
    font-weight: 700;
    padding: 12px 22px;
}

.cp-submit-btn:hover {
    color: white;
    transform: translateY(-1px);
}

@media (max-width: 991.98px) {

    .cp-map {
        height: 400px;
    }

}

@media (max-width: 575.98px) {

    .cp-create-page {
        padding-bottom: 85px;
    }

    .cp-create-page .card-body {
        padding: 18px !important;
    }

    .cp-map {
        height: 330px;
        border-radius: 16px;
    }

    .cp-photo-zone {
        min-height: 230px;
    }

    .cp-submit-btn,
    .cp-submit-btn + a {
        width: 100%;
    }

}

</style>


{{-- =============================================================
     JAVASCRIPT
============================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    /* =========================================================
       PHOTO
    ========================================================= */

    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photoPreview');
    const photoPlaceholder = document.getElementById('photoPlaceholder');

    if (photoInput) {

        photoInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                return;
            }

            if (!file.type.startsWith('image/')) {

                alert('Veuillez sélectionner une image.');

                this.value = '';

                return;
            }

            if (file.size > 5 * 1024 * 1024) {

                alert('La photo ne doit pas dépasser 5 Mo.');

                this.value = '';

                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {

                photoPreview.src = event.target.result;

                photoPreview.classList.remove('d-none');

                photoPlaceholder.classList.add('d-none');

            };

            reader.readAsDataURL(file);

        });

    }


    /* =========================================================
       CARTE
    ========================================================= */

    const defaultLatitude = 3.8480;
    const defaultLongitude = 11.5021;

    const map = L.map('incidentMap').setView(
        [defaultLatitude, defaultLongitude],
        13
    );


    L.tileLayer(
        'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            attribution: '&copy; OpenStreetMap contributors'
        }
    ).addTo(map);


    let marker = null;


    function setLocation(latitude, longitude, label = 'Emplacement sélectionné') {

        document.getElementById('latitude').value =
            latitude.toFixed(6);

        document.getElementById('longitude').value =
            longitude.toFixed(6);


        map.setView(
            [latitude, longitude],
            16
        );


        if (marker) {

            marker.setLatLng([
                latitude,
                longitude
            ]);

        } else {

            marker = L.marker([
                latitude,
                longitude
            ]).addTo(map);

        }


        marker.bindPopup(
            '<strong>' +
            label +
            '</strong><br>' +
            latitude.toFixed(6) +
            ', ' +
            longitude.toFixed(6)
        ).openPopup();

    }


    /* CLIC SUR LA CARTE */

    map.on('click', function (event) {

        setLocation(
            event.latlng.lat,
            event.latlng.lng
        );

    });


    /* =========================================================
       GPS
    ========================================================= */

    const locateBtn = document.getElementById('locateBtn');

    locateBtn.addEventListener('click', function () {

        if (!navigator.geolocation) {

            alert(
                'La géolocalisation n’est pas disponible sur ce navigateur.'
            );

            return;
        }


        locateBtn.disabled = true;

        locateBtn.innerHTML =
            '<span class="spinner-border spinner-border-sm me-1"></span>' +
            'Localisation...';


        navigator.geolocation.getCurrentPosition(

            function (position) {

                setLocation(
                    position.coords.latitude,
                    position.coords.longitude,
                    'Votre position'
                );


                locateBtn.disabled = false;

                locateBtn.innerHTML =
                    '<i class="bi bi-check-circle me-1"></i>' +
                    'Position trouvée';

            },


            function () {

                alert(
                    'Impossible de récupérer votre position. Vérifiez les autorisations de localisation.'
                );


                locateBtn.disabled = false;

                locateBtn.innerHTML =
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


    /* =========================================================
       RESTAURATION DES COORDONNEES
    ========================================================= */

    const oldLatitude =
        document.getElementById('latitude').value;

    const oldLongitude =
        document.getElementById('longitude').value;


    if (oldLatitude && oldLongitude) {

        setLocation(
            parseFloat(oldLatitude),
            parseFloat(oldLongitude)
        );

    }

});

</script>

@endsection