@extends('layouts.app')

@section('content')

<style>
    /* =========================================================
       CIVICPULSE — CITIZEN DASHBOARD
       Mobile-first / Responsive
    ========================================================= */

    .citizen-dashboard {
        width: 100%;
    }

    /* HERO */
    .citizen-hero {
        position: relative;
        overflow: hidden;
        border-radius: 28px;
        padding: 32px;
        color: #fff;
        background: linear-gradient(
            135deg,
            #073f31 0%,
            #087f5b 60%,
            #16a579 100%
        );
        box-shadow: 0 15px 35px rgba(8, 127, 91, .16);
    }

    .citizen-hero-content {
        position: relative;
        z-index: 2;
        max-width: 700px;
    }

    .citizen-hero-label {
        font-size: .78rem;
        letter-spacing: .08em;
        text-transform: uppercase;
        font-weight: 700;
        opacity: .75;
    }

    .citizen-hero h1 {
        font-size: clamp(26px, 4vw, 42px);
        line-height: 1.15;
    }

    .citizen-hero-description {
        max-width: 560px;
        line-height: 1.6;
    }

    .hero-decoration {
        position: absolute;
        border: 35px solid rgba(255,255,255,.06);
        border-radius: 50%;
        pointer-events: none;
    }

    .hero-decoration.one {
        width: 260px;
        height: 260px;
        right: -50px;
        top: -80px;
        border-width: 45px;
    }

    .hero-decoration.two {
        width: 220px;
        height: 220px;
        right: 80px;
        bottom: -100px;
    }

    /* STATS */
    .citizen-stat {
        border: 0;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 8px 25px rgba(16, 35, 29, .06);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .citizen-stat:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 30px rgba(16, 35, 29, .09);
    }

    .citizen-stat-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        flex-shrink: 0;
    }

    .citizen-stat-number {
        font-size: 1.8rem;
        line-height: 1;
    }

    /* MAIN CARD */
    .citizen-main-card {
        border: 0;
        border-radius: 24px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 8px 25px rgba(16, 35, 29, .06);
    }

    /* MOBILE INCIDENT CARD */
    .mobile-incident {
        display: block;
        color: inherit;
        text-decoration: none;
        border: 1px solid #e6ece9;
        border-radius: 18px;
        padding: 15px;
        background: #fff;
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .mobile-incident:active {
        transform: scale(.985);
    }

    .mobile-incident:hover {
        color: inherit;
        box-shadow: 0 8px 20px rgba(16, 35, 29, .07);
    }

    .mobile-incident-image {
        width: 58px;
        height: 58px;
        border-radius: 14px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .mobile-incident-placeholder {
        width: 58px;
        height: 58px;
        border-radius: 14px;
        background: #e8f7f1;
        color: #087f5b;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .incident-title {
        font-size: .96rem;
        line-height: 1.3;
    }

    .incident-meta {
        font-size: .78rem;
    }

    .status-badge {
        font-size: .70rem;
        padding: .42rem .65rem;
        white-space: nowrap;
    }

    /* EMPTY STATE */
    .empty-icon {
        width: 70px;
        height: 70px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #e8f7f1;
        color: #087f5b;
    }

    /* TABLE */
    .citizen-table th {
        font-size: .75rem;
        text-transform: uppercase;
        letter-spacing: .04em;
        color: #71817b;
        font-weight: 700;
        border-bottom: 1px solid #e6ece9;
    }

    .citizen-table td {
        border-bottom: 1px solid #eef2f0;
    }

    /* MOBILE */
    @media (max-width: 767.98px) {

        .citizen-hero {
            padding: 24px 20px;
            border-radius: 22px;
            margin-bottom: 18px !important;
        }

        .citizen-hero-label {
            font-size: .68rem;
        }

        .citizen-hero h1 {
            font-size: 27px;
            margin-bottom: 10px !important;
        }

        .citizen-hero-description {
            font-size: .88rem;
            line-height: 1.5;
            margin-bottom: 18px !important;
        }

        .citizen-hero .btn {
            width: 100%;
            min-height: 48px;
            font-size: .9rem;
        }

        .hero-decoration.one {
            width: 170px;
            height: 170px;
            right: -80px;
            top: -70px;
            border-width: 28px;
        }

        .hero-decoration.two {
            width: 130px;
            height: 130px;
            right: -20px;
            bottom: -75px;
            border-width: 22px;
        }

        .citizen-stat {
            border-radius: 17px;
        }

        .citizen-stat .card-body {
            padding: 15px !important;
        }

        .citizen-stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
        }

        .citizen-stat-icon i {
            font-size: 1rem !important;
        }

        .citizen-stat-number {
            font-size: 1.45rem;
            margin-top: 7px !important;
        }

        .citizen-stat small {
            font-size: .72rem;
        }

        .citizen-main-card {
            border-radius: 20px;
        }

        .citizen-main-header {
            padding: 18px !important;
        }

        .citizen-main-header h4 {
            font-size: 1rem;
        }

        .citizen-main-header p {
            font-size: .78rem;
        }

        .citizen-main-header .btn {
            width: 100%;
            min-height: 43px;
        }

        .mobile-incident {
            padding: 13px;
            border-radius: 16px;
        }

        .mobile-incident-image,
        .mobile-incident-placeholder {
            width: 52px;
            height: 52px;
        }

        .incident-title {
            font-size: .88rem;
        }

        .incident-meta {
            font-size: .72rem;
        }

        .status-badge {
            font-size: .65rem;
            padding: .35rem .5rem;
        }
    }

    @media (max-width: 380px) {

        .citizen-hero {
            padding: 21px 16px;
        }

        .citizen-hero h1 {
            font-size: 24px;
        }

        .citizen-stat .card-body {
            padding: 12px !important;
        }

        .citizen-stat-number {
            font-size: 1.3rem;
        }

        .citizen-stat-icon {
            width: 36px;
            height: 36px;
        }

        .mobile-incident {
            padding: 11px;
        }
    }
</style>

<div class="citizen-dashboard container-fluid px-0">

    {{-- =====================================================
         HERO
    ====================================================== --}}
    <div class="citizen-hero mb-4">

        <div class="citizen-hero-content">

            <div class="citizen-hero-label mb-2">
                CivicPulse AI · Espace citoyen
            </div>

            <h1 class="fw-bold mb-2">
                Bonjour {{ Auth::user()->name }} 👋
            </h1>

            <p class="citizen-hero-description mb-4 text-white-50">
                Signalez un problème dans votre ville, ajoutez une photo
                et laissez CivicPulse AI analyser automatiquement votre signalement.
            </p>

            <a href="{{ route('incidents.create') }}"
               class="btn btn-light btn-lg rounded-pill px-4 fw-bold">
                <i class="bi bi-camera-fill me-2"></i>
                Signaler un incident
            </a>

        </div>

        <div class="hero-decoration one"></div>
        <div class="hero-decoration two"></div>

    </div>


    {{-- =====================================================
         STATISTIQUES
    ====================================================== --}}
    <div class="row g-3 mb-4">

        {{-- TOTAL --}}
        <div class="col-6 col-xl-3">
            <div class="card citizen-stat h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start gap-2">

                        <div>
                            <small class="text-muted fw-semibold">
                                Mes incidents
                            </small>

                            <h2 class="citizen-stat-number fw-bold mt-2 mb-0">
                                {{ $totalIncidents }}
                            </h2>
                        </div>

                        <div class="citizen-stat-icon"
                             style="background:#e8f7f1;color:#087f5b;">
                            <i class="bi bi-folder2-open fs-4"></i>
                        </div>

                    </div>

                    <small class="text-muted d-block mt-2">
                        Total signalé
                    </small>

                </div>
            </div>
        </div>


        {{-- SIGNALES --}}
        <div class="col-6 col-xl-3">
            <div class="card citizen-stat h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start gap-2">

                        <div>
                            <small class="text-muted fw-semibold">
                                Signalés
                            </small>

                            <h2 class="citizen-stat-number fw-bold mt-2 mb-0">
                                {{ $signales }}
                            </h2>
                        </div>

                        <div class="citizen-stat-icon bg-danger bg-opacity-10 text-danger">
                            <i class="bi bi-exclamation-triangle fs-4"></i>
                        </div>

                    </div>

                    <small class="text-muted d-block mt-2">
                        En attente
                    </small>

                </div>
            </div>
        </div>


        {{-- EN COURS --}}
        <div class="col-6 col-xl-3">
            <div class="card citizen-stat h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start gap-2">

                        <div>
                            <small class="text-muted fw-semibold">
                                En cours
                            </small>

                            <h2 class="citizen-stat-number fw-bold mt-2 mb-0">
                                {{ $encours }}
                            </h2>
                        </div>

                        <div class="citizen-stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-hourglass-split fs-4"></i>
                        </div>

                    </div>

                    <small class="text-muted d-block mt-2">
                        Pris en charge
                    </small>

                </div>
            </div>
        </div>


        {{-- RESOLUS --}}
        <div class="col-6 col-xl-3">
            <div class="card citizen-stat h-100">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start gap-2">

                        <div>
                            <small class="text-muted fw-semibold">
                                Résolus
                            </small>

                            <h2 class="citizen-stat-number fw-bold mt-2 mb-0">
                                {{ $resolus }}
                            </h2>
                        </div>

                        <div class="citizen-stat-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-check-circle fs-4"></i>
                        </div>

                    </div>

                    <small class="text-muted d-block mt-2">
                        Incidents terminés
                    </small>

                </div>
            </div>
        </div>

    </div>


    {{-- =====================================================
         MES SIGNALEMENTS
    ====================================================== --}}
    <div class="citizen-main-card">

        <div class="citizen-main-header p-4 d-flex flex-column flex-sm-row
                    justify-content-between align-items-sm-center gap-3">

            <div>
                <h4 class="fw-bold mb-1">
                    Mes signalements
                </h4>

                <p class="text-muted mb-0">
                    Suivez l'évolution de vos incidents.
                </p>
            </div>

            <a href="{{ route('incidents.index') }}"
               class="btn btn-outline-success rounded-pill px-4">

                Voir tout
                <i class="bi bi-arrow-right ms-2"></i>

            </a>

        </div>


        @if($incidents->count())

            {{-- =================================================
                 MOBILE
            ================================================== --}}
            <div class="d-lg-none px-3 pb-3">

                @foreach($incidents as $incident)

                    <a href="{{ route('incidents.show', $incident) }}"
                       class="mobile-incident mb-3">

                        <div class="d-flex align-items-start gap-3">

                            {{-- PHOTO --}}
                            @if($incident->photo)

                                <img src="{{ asset('storage/' . $incident->photo) }}"
                                     alt="Photo de {{ $incident->titre }}"
                                     class="mobile-incident-image">

                            @else

                                <div class="mobile-incident-placeholder">
                                    <i class="bi bi-image fs-5"></i>
                                </div>

                            @endif


                            {{-- CONTENU --}}
                            <div class="flex-grow-1 min-width-0">

                                <div class="d-flex justify-content-between
                                            align-items-start gap-2">

                                    <div class="min-width-0">

                                        <div class="incident-title fw-bold text-truncate">
                                            {{ $incident->titre }}
                                        </div>

                                        <div class="incident-meta text-muted mt-1">
                                            {{ $incident->categorie ?? 'Non catégorisé' }}
                                        </div>

                                    </div>


                                    {{-- STATUT --}}
                                    @if($incident->statut === 'Signalé')

                                        <span class="status-badge badge rounded-pill bg-danger">
                                            Signalé
                                        </span>

                                    @elseif($incident->statut === 'En cours')

                                        <span class="status-badge badge rounded-pill bg-warning text-dark">
                                            En cours
                                        </span>

                                    @elseif($incident->statut === 'Résolu')

                                        <span class="status-badge badge rounded-pill bg-success">
                                            Résolu
                                        </span>

                                    @else

                                        <span class="status-badge badge rounded-pill bg-secondary">
                                            {{ $incident->statut }}
                                        </span>

                                    @endif

                                </div>


                                <div class="d-flex justify-content-between
                                            align-items-center mt-3">

                                    <small class="incident-meta text-muted">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ $incident->created_at?->format('d/m/Y') }}
                                    </small>

                                    <span class="incident-meta text-success fw-semibold">
                                        Voir
                                        <i class="bi bi-arrow-right ms-1"></i>
                                    </span>

                                </div>

                            </div>

                        </div>

                    </a>

                @endforeach

            </div>


            {{-- =================================================
                 DESKTOP
            ================================================== --}}
            <div class="table-responsive d-none d-lg-block">

                <table class="table citizen-table align-middle mb-0">

                    <thead>

                        <tr>

                            <th class="px-4 py-3">
                                Incident
                            </th>

                            <th>
                                Catégorie
                            </th>

                            <th>
                                Priorité
                            </th>

                            <th>
                                Statut
                            </th>

                            <th>
                                Date
                            </th>

                            <th></th>

                        </tr>

                    </thead>


                    <tbody>

                    @foreach($incidents as $incident)

                        <tr>

                            <td class="px-4">

                                <div class="fw-bold">
                                    {{ $incident->titre }}
                                </div>

                                <small class="text-muted">
                                    #{{ $incident->id }}
                                </small>

                            </td>


                            <td>
                                {{ $incident->categorie ?? '—' }}
                            </td>


                            {{-- PRIORITE --}}
                            <td>

                                @if($incident->priorite === 'Critique')

                                    <span class="badge rounded-pill bg-danger">
                                        Critique
                                    </span>

                                @elseif(in_array($incident->priorite, ['Élevée', 'Haute']))

                                    <span class="badge rounded-pill bg-warning text-dark">
                                        Haute
                                    </span>

                                @elseif($incident->priorite === 'Moyenne')

                                    <span class="badge rounded-pill bg-info">
                                        Moyenne
                                    </span>

                                @else

                                    <span class="badge rounded-pill bg-secondary">
                                        Faible
                                    </span>

                                @endif

                            </td>


                            {{-- STATUT --}}
                            <td>

                                @if($incident->statut === 'Signalé')

                                    <span class="badge rounded-pill bg-danger">
                                        Signalé
                                    </span>

                                @elseif($incident->statut === 'En cours')

                                    <span class="badge rounded-pill bg-warning text-dark">
                                        En cours
                                    </span>

                                @elseif($incident->statut === 'Résolu')

                                    <span class="badge rounded-pill bg-success">
                                        Résolu
                                    </span>

                                @else

                                    <span class="badge rounded-pill bg-secondary">
                                        {{ $incident->statut }}
                                    </span>

                                @endif

                            </td>


                            <td class="text-muted">
                                {{ $incident->created_at?->format('d/m/Y') }}
                            </td>


                            <td class="text-end pe-4">

                                <a href="{{ route('incidents.show', $incident) }}"
                                   class="btn btn-sm btn-light rounded-pill">

                                    Voir
                                    <i class="bi bi-arrow-right ms-1"></i>

                                </a>

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>


        @else

            {{-- =================================================
                 EMPTY STATE
            ================================================== --}}
            <div class="text-center py-5 px-4">

                <div class="empty-icon mb-3">
                    <i class="bi bi-clipboard2-plus fs-2"></i>
                </div>

                <h5 class="fw-bold">
                    Aucun signalement
                </h5>

                <p class="text-muted mb-4">
                    Vous n'avez encore signalé aucun incident.
                </p>

                <a href="{{ route('incidents.create') }}"
                   class="btn btn-success rounded-pill px-4">

                    <i class="bi bi-plus-lg me-2"></i>
                    Créer mon premier signalement

                </a>

            </div>

        @endif

    </div>

</div>

@endsection