@extends('layouts.app')

@section('title', 'Détails de l\'incident')

@section('content')

<div class="container-fluid">

    {{-- EN-TÊTE --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <span class="text-success fw-semibold">
                CivicPulse AI
            </span>

            <h1 class="fw-bold mb-1">
                Détails de l'incident
            </h1>

            <p class="text-muted mb-0">
                Consultez les informations et l'analyse intelligente du signalement.
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('incidents.index') }}"
               class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i>
                Retour
            </a>

            @if(auth()->user()->isAdministrateur() || auth()->user()->isAgent() || $incident->user_id === auth()->id())
                <a href="{{ route('incidents.edit', $incident) }}"
                   class="btn btn-success rounded-pill px-4">
                    <i class="bi bi-pencil me-2"></i>
                    Modifier
                </a>
            @endif
        </div>
    </div>


    <div class="row g-4">

        {{-- COLONNE PRINCIPALE --}}
        <div class="col-lg-8">

            {{-- PHOTO --}}
            @if($incident->photo)

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">

                    <div class="card-header bg-white border-0 px-4 pt-4">
                        <h5 class="fw-bold mb-0">
                            <i class="bi bi-image text-success me-2"></i>
                            Photo du signalement
                        </h5>
                    </div>

                    <div class="card-body p-4">

                        <div class="incident-photo-wrapper">
                            <img
                                src="{{ asset('storage/' . $incident->photo) }}"
                                alt="Photo de l'incident"
                                class="incident-photo"
                            >
                        </div>

                    </div>

                </div>

            @else

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">

                        <div class="no-photo">
                            <div class="no-photo-icon">
                                <i class="bi bi-camera"></i>
                            </div>

                            <h6 class="fw-bold mb-1">
                                Aucune photo
                            </h6>

                            <p class="text-muted mb-0">
                                Aucun fichier photo n'a été associé à ce signalement.
                            </p>
                        </div>

                    </div>
                </div>

            @endif


            {{-- INFORMATIONS INCIDENT --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-header bg-success text-white border-0 p-4">
                    <h4 class="fw-bold mb-0">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        Informations de l'incident
                    </h4>
                </div>

                <div class="card-body p-4">

                    <div class="incident-info">

                        <div class="info-row">
                            <div class="info-label">
                                <i class="bi bi-card-heading"></i>
                                Titre
                            </div>

                            <div class="info-value">
                                {{ $incident->titre }}
                            </div>
                        </div>


                        <div class="info-row">
                            <div class="info-label">
                                <i class="bi bi-chat-left-text"></i>
                                Description
                            </div>

                            <div class="info-value">
                                {{ $incident->description }}
                            </div>
                        </div>


                        <div class="info-row">
                            <div class="info-label">
                                <i class="bi bi-flag"></i>
                                Statut
                            </div>

                            <div class="info-value">

                                @if($incident->statut === 'Résolu')
                                    <span class="badge bg-success rounded-pill px-3 py-2">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Résolu
                                    </span>

                                @elseif($incident->statut === 'En cours')
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                                        <i class="bi bi-hourglass-split me-1"></i>
                                        En cours
                                    </span>

                                @else
                                    <span class="badge bg-primary rounded-pill px-3 py-2">
                                        <i class="bi bi-bell me-1"></i>
                                        Signalé
                                    </span>
                                @endif

                            </div>
                        </div>


                        <div class="info-row">
                            <div class="info-label">
                                <i class="bi bi-tag"></i>
                                Catégorie
                            </div>

                            <div class="info-value">
                                <span class="badge bg-primary rounded-pill px-3 py-2">
                                    {{ $incident->categorie }}
                                </span>
                            </div>
                        </div>


                        <div class="info-row">
                            <div class="info-label">
                                <i class="bi bi-geo-alt"></i>
                                Localisation
                            </div>

                            <div class="info-value">

                                @if($incident->latitude && $incident->longitude)

                                    <div class="small">
                                        <strong>Latitude :</strong>
                                        {{ $incident->latitude }}
                                    </div>

                                    <div class="small mt-1">
                                        <strong>Longitude :</strong>
                                        {{ $incident->longitude }}
                                    </div>

                                    <a href="https://www.google.com/maps?q={{ $incident->latitude }},{{ $incident->longitude }}"
                                       target="_blank"
                                       class="btn btn-sm btn-outline-success rounded-pill mt-2">
                                        <i class="bi bi-map me-1"></i>
                                        Voir sur la carte
                                    </a>

                                @else

                                    <span class="text-muted">
                                        Localisation non renseignée
                                    </span>

                                @endif

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>


        {{-- COLONNE IA --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                <div class="card-header bg-dark text-white border-0 p-4">

                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-robot text-warning me-2"></i>
                        Analyse CivicPulse AI
                    </h5>

                </div>


                <div class="card-body p-4">

                    {{-- SCORE IA --}}
                    <div class="text-center mb-4">

                        <div class="ai-score">
                            {{ $incident->score_ia }}%
                        </div>

                        <div class="text-muted">
                            Niveau de confiance de l'IA
                        </div>

                    </div>


                    <hr>


                    {{-- CATEGORIE --}}
                    <div class="ai-item">

                        <div class="ai-label">
                            <i class="bi bi-tag-fill"></i>
                            Catégorie détectée
                        </div>

                        <span class="badge bg-primary rounded-pill px-3 py-2">
                            {{ $incident->categorie }}
                        </span>

                    </div>


                    {{-- PRIORITE --}}
                    <div class="ai-item">

                        <div class="ai-label">
                            <i class="bi bi-lightning-charge-fill"></i>
                            Priorité
                        </div>

                        @if($incident->priorite === 'Critique')

                            <span class="badge bg-danger rounded-pill px-3 py-2">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                Critique
                            </span>

                        @elseif($incident->priorite === 'Élevée')

                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                                <i class="bi bi-arrow-up-circle-fill me-1"></i>
                                Élevée
                            </span>

                        @elseif($incident->priorite === 'Moyenne')

                            <span class="badge bg-info text-dark rounded-pill px-3 py-2">
                                <i class="bi bi-dash-circle-fill me-1"></i>
                                Moyenne
                            </span>

                        @else

                            <span class="badge bg-success rounded-pill px-3 py-2">
                                <i class="bi bi-check-circle-fill me-1"></i>
                                Faible
                            </span>

                        @endif

                    </div>


                    {{-- SERVICE --}}
                    <div class="ai-item">

                        <div class="ai-label">
                            <i class="bi bi-building"></i>
                            Service recommandé
                        </div>

                        <span class="badge bg-secondary rounded-pill px-3 py-2">
                            {{ $incident->service }}
                        </span>

                    </div>


                    {{-- EXPLICATION --}}
                    <div class="ai-item">

                        <div class="ai-label">
                            <i class="bi bi-info-circle-fill"></i>
                            Explication de l'IA
                        </div>

                        <div class="alert alert-success border-0 rounded-3 mb-0">
                            {{ $incident->explication_ia }}
                        </div>

                    </div>


                    {{-- MOTS CLES --}}
                    @if($incident->mots_cles)

                        <div class="ai-item">

                            <div class="ai-label">
                                <i class="bi bi-hash"></i>
                                Mots-clés détectés
                            </div>

                            <div class="d-flex flex-wrap gap-2">

                                @foreach($incident->mots_cles as $mot)

                                    <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                                        #{{ $mot }}
                                    </span>

                                @endforeach

                            </div>

                        </div>

                    @endif


                    {{-- DECISION --}}
                    <div class="alert alert-primary border-0 rounded-4 mt-4 mb-0">

                        <div class="fw-bold mb-2">
                            <i class="bi bi-cpu-fill me-2"></i>
                            Décision IA
                        </div>

                        <div class="small">
                            Cet incident a été automatiquement analysé par
                            <strong>CivicPulse AI</strong>.
                        </div>

                        <div class="small mt-2">
                            Service recommandé :
                            <strong>{{ $incident->service }}</strong>
                        </div>

                        <div class="small mt-1">
                            Confiance :
                            <strong>{{ $incident->score_ia }}%</strong>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<style>

.incident-photo-wrapper {
    width: 100%;
    max-height: 520px;
    border-radius: 18px;
    overflow: hidden;
    background: #eef3f1;
}

.incident-photo {
    width: 100%;
    height: auto;
    max-height: 520px;
    object-fit: cover;
    display: block;
}

.no-photo {
    text-align: center;
    padding: 35px 20px;
}

.no-photo-icon {
    width: 70px;
    height: 70px;
    margin: 0 auto 15px;
    border-radius: 20px;
    background: #e8f7f1;
    color: #087f5b;
    display: grid;
    place-items: center;
    font-size: 28px;
}

.info-row {
    display: grid;
    grid-template-columns: 190px 1fr;
    gap: 20px;
    padding: 17px 0;
    border-bottom: 1px solid #edf1ef;
}

.info-row:last-child {
    border-bottom: 0;
}

.info-label {
    font-weight: 700;
    color: #26352f;
}

.info-label i {
    color: #087f5b;
    width: 22px;
    display: inline-block;
}

.info-value {
    color: #374740;
}

.ai-score {
    font-size: 64px;
    line-height: 1;
    font-weight: 800;
    color: #087f5b;
    margin-bottom: 8px;
}

.ai-item {
    padding: 18px 0;
    border-bottom: 1px solid #edf1ef;
}

.ai-item:last-child {
    border-bottom: 0;
}

.ai-label {
    font-weight: 700;
    margin-bottom: 10px;
}

.ai-label i {
    color: #087f5b;
    margin-right: 7px;
}

@media (max-width: 767.98px) {

    .info-row {
        grid-template-columns: 1fr;
        gap: 8px;
    }

    .incident-photo-wrapper {
        max-height: 350px;
    }

    .incident-photo {
        max-height: 350px;
    }

    .ai-score {
        font-size: 52px;
    }

}

</style>

@endsection