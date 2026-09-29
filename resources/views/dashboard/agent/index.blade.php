@extends('layouts.app')

@section('content')

<div class="container-fluid px-0">

    {{-- HEADER --}}
    <div class="agent-hero mb-4">

        <div>
            <div class="agent-eyebrow">
                <i class="bi bi-shield-check"></i>
                ESPACE AGENT · CIVICPULSE AI
            </div>

            <h1>
                Centre opérationnel
            </h1>

            <p>
                Surveillez les incidents urbains, priorisez les interventions
                et suivez leur résolution depuis un seul espace.
            </p>
        </div>

        <div class="agent-status">
            <span class="status-pulse"></span>
            Système opérationnel
        </div>

    </div>


    {{-- STATISTIQUES --}}
    <div class="row g-3 mb-4">

        {{-- TOTAL --}}
        <div class="col-6 col-xl-3">

            <div class="agent-stat-card">

                <div class="agent-stat-top">
                    <div class="agent-stat-icon icon-green">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>

                    <span class="agent-stat-arrow">
                        <i class="bi bi-arrow-up-right"></i>
                    </span>
                </div>

                <div class="agent-stat-number">
                    {{ $totalIncidents }}
                </div>

                <div class="agent-stat-label">
                    Incidents enregistrés
                </div>

                <div class="agent-stat-description">
                    Signalements dans la plateforme
                </div>

            </div>

        </div>


        {{-- A TRAITER --}}
        <div class="col-6 col-xl-3">

            <div class="agent-stat-card urgent">

                <div class="agent-stat-top">

                    <div class="agent-stat-icon icon-red">
                        <i class="bi bi-exclamation-circle-fill"></i>
                    </div>

                    @if($aTraiter > 0)
                        <span class="stat-live">
                            Action requise
                        </span>
                    @endif

                </div>

                <div class="agent-stat-number">
                    {{ $aTraiter }}
                </div>

                <div class="agent-stat-label">
                    À traiter
                </div>

                <div class="agent-stat-description">
                    Incidents en attente de prise en charge
                </div>

            </div>

        </div>


        {{-- EN COURS --}}
        <div class="col-6 col-xl-3">

            <div class="agent-stat-card">

                <div class="agent-stat-top">

                    <div class="agent-stat-icon icon-orange">
                        <i class="bi bi-hourglass-split"></i>
                    </div>

                    <span class="agent-stat-arrow">
                        <i class="bi bi-arrow-right"></i>
                    </span>

                </div>

                <div class="agent-stat-number">
                    {{ $enCours }}
                </div>

                <div class="agent-stat-label">
                    Interventions en cours
                </div>

                <div class="agent-stat-description">
                    Incidents actuellement pris en charge
                </div>

            </div>

        </div>


        {{-- RESOLUS --}}
        <div class="col-6 col-xl-3">

            <div class="agent-stat-card">

                <div class="agent-stat-top">

                    <div class="agent-stat-icon icon-blue">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>

                    <span class="agent-stat-arrow">
                        <i class="bi bi-check-lg"></i>
                    </span>

                </div>

                <div class="agent-stat-number">
                    {{ $resolus }}
                </div>

                <div class="agent-stat-label">
                    Incidents résolus
                </div>

                <div class="agent-stat-description">
                    Signalements traités avec succès
                </div>

            </div>

        </div>

    </div>


    {{-- CONTENU PRINCIPAL --}}
    <div class="row g-4">

        {{-- INCIDENTS --}}
        <div class="col-xl-8">

            <div class="agent-panel">

                <div class="agent-panel-header">

                    <div>

                        <div class="panel-kicker">
                            SURVEILLANCE
                        </div>

                        <h3>
                            Derniers incidents
                        </h3>

                        <p>
                            Les signalements nécessitant votre attention.
                        </p>

                    </div>

                    <a href="{{ route('incidents.index') }}"
                       class="agent-outline-btn">

                        Voir tous

                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>


                @if($incidents->count())

                    {{-- MOBILE --}}
                    <div class="agent-mobile-list">

                        @foreach($incidents as $incident)

                            <a href="{{ route('incidents.edit', $incident) }}"
                               class="agent-incident-mobile">

                                <div class="incident-mobile-icon">

                                    @if($incident->priorite === 'Critique')
                                        <i class="bi bi-exclamation-octagon-fill"></i>
                                    @elseif(in_array($incident->priorite, ['Élevée', 'Haute']))
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                    @else
                                        <i class="bi bi-geo-alt-fill"></i>
                                    @endif

                                </div>

                                <div class="incident-mobile-content">

                                    <strong>
                                        {{ $incident->titre }}
                                    </strong>

                                    <small>
                                        {{ $incident->categorie ?? 'Non catégorisé' }}
                                    </small>

                                    <div class="incident-mobile-meta">

                                        @if($incident->statut === 'Signalé')
                                            <span class="status-badge status-danger">
                                                Signalé
                                            </span>
                                        @elseif($incident->statut === 'En cours')
                                            <span class="status-badge status-warning">
                                                En cours
                                            </span>
                                        @else
                                            <span class="status-badge status-success">
                                                Résolu
                                            </span>
                                        @endif

                                        <span>
                                            #{{ $incident->id }}
                                        </span>

                                    </div>

                                </div>

                                <i class="bi bi-chevron-right"></i>

                            </a>

                        @endforeach

                    </div>


                    {{-- DESKTOP --}}
                    <div class="agent-table-wrapper">

                        <table class="agent-table">

                            <thead>

                                <tr>
                                    <th>Incident</th>
                                    <th>Catégorie</th>
                                    <th>Priorité</th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                </tr>

                            </thead>

                            <tbody>

                            @foreach($incidents as $incident)

                                <tr>

                                    <td>

                                        <div class="incident-title">

                                            <div class="incident-mini-icon">
                                                <i class="bi bi-geo-alt-fill"></i>
                                            </div>

                                            <div>

                                                <strong>
                                                    {{ $incident->titre }}
                                                </strong>

                                                <small>
                                                    Incident #{{ $incident->id }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    <td>
                                        <span class="category-text">
                                            {{ $incident->categorie ?? '—' }}
                                        </span>
                                    </td>


                                    <td>

                                        @if($incident->priorite === 'Critique')

                                            <span class="priority-badge priority-critical">
                                                <span></span>
                                                Critique
                                            </span>

                                        @elseif(in_array($incident->priorite, ['Élevée', 'Haute']))

                                            <span class="priority-badge priority-high">
                                                <span></span>
                                                Haute
                                            </span>

                                        @elseif($incident->priorite === 'Moyenne')

                                            <span class="priority-badge priority-medium">
                                                <span></span>
                                                Moyenne
                                            </span>

                                        @else

                                            <span class="priority-badge priority-low">
                                                <span></span>
                                                Faible
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        @if($incident->statut === 'Signalé')

                                            <span class="status-badge status-danger">
                                                Signalé
                                            </span>

                                        @elseif($incident->statut === 'En cours')

                                            <span class="status-badge status-warning">
                                                En cours
                                            </span>

                                        @else

                                            <span class="status-badge status-success">
                                                Résolu
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        <a href="{{ route('incidents.edit', $incident) }}"
                                           class="agent-action-btn">

                                            Traiter

                                            <i class="bi bi-arrow-right"></i>

                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="agent-empty">

                        <div class="empty-icon">
                            <i class="bi bi-check2-circle"></i>
                        </div>

                        <h4>
                            Aucun incident à traiter
                        </h4>

                        <p>
                            Tous les signalements ont été pris en charge.
                        </p>

                    </div>

                @endif

            </div>

        </div>


        {{-- COLONNE DROITE --}}
        <div class="col-xl-4">

            {{-- ACTION RAPIDE --}}
            <div class="agent-panel quick-panel mb-4">

                <div class="panel-kicker">
                    ACTIONS RAPIDES
                </div>

                <h3>
                    Outils opérationnels
                </h3>

                <p>
                    Accédez rapidement aux fonctionnalités nécessaires
                    à votre intervention.
                </p>


                <a href="{{ route('incidents.index') }}"
                   class="quick-action">

                    <div class="quick-icon green">
                        <i class="bi bi-list-check"></i>
                    </div>

                    <div>
                        <strong>
                            Gérer les incidents
                        </strong>

                        <small>
                            Consulter et traiter les signalements
                        </small>
                    </div>

                    <i class="bi bi-chevron-right"></i>

                </a>


                <a href="{{ route('interventions.index') }}"
                   class="quick-action">

                    <div class="quick-icon orange">
                        <i class="bi bi-tools"></i>
                    </div>

                    <div>
                        <strong>
                            Interventions
                        </strong>

                        <small>
                            Suivre les opérations terrain
                        </small>
                    </div>

                    <i class="bi bi-chevron-right"></i>

                </a>


                <a href="{{ route('incidents.map') }}"
                   class="quick-action">

                    <div class="quick-icon blue">
                        <i class="bi bi-map-fill"></i>
                    </div>

                    <div>
                        <strong>
                            Carte des incidents
                        </strong>

                        <small>
                            Localiser les signalements
                        </small>
                    </div>

                    <i class="bi bi-chevron-right"></i>

                </a>

            </div>


            {{-- IA --}}
            <div class="ai-agent-card">

                <div class="ai-glow"></div>

                <div class="ai-agent-icon">
                    <i class="bi bi-stars"></i>
                </div>

                <div class="ai-agent-label">
                    CIVICPULSE AI
                </div>

                <h3>
                    Analyse intelligente
                </h3>

                <p>
                    Les signalements peuvent être analysés automatiquement
                    afin d'identifier leur catégorie, leur priorité et le
                    service concerné.
                </p>

                <div class="ai-agent-status">
                    <span></span>
                    Système IA actif
                </div>

            </div>

        </div>

    </div>

</div>


<style>

    .agent-hero {
        background:
            radial-gradient(circle at 85% 20%, rgba(86,214,165,.16), transparent 28%),
            linear-gradient(135deg, #073f31 0%, #087f5b 100%);
        border-radius: 26px;
        padding: 30px 32px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        position: relative;
        overflow: hidden;
    }

    .agent-hero::after {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        border: 45px solid rgba(255,255,255,.05);
        border-radius: 50%;
        right: -65px;
        bottom: -130px;
    }

    .agent-eyebrow {
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1.5px;
        color: rgba(255,255,255,.65);
        margin-bottom: 9px;
    }

    .agent-hero h1 {
        font-size: clamp(27px, 4vw, 39px);
        font-weight: 800;
        margin: 0 0 7px;
        position: relative;
        z-index: 2;
    }

    .agent-hero p {
        margin: 0;
        color: rgba(255,255,255,.7);
        max-width: 650px;
        font-size: 14px;
        line-height: 1.6;
        position: relative;
        z-index: 2;
    }

    .agent-status {
        background: rgba(255,255,255,.1);
        border: 1px solid rgba(255,255,255,.12);
        backdrop-filter: blur(10px);
        padding: 10px 14px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
        position: relative;
        z-index: 3;
    }

    .status-pulse {
        display: inline-block;
        width: 7px;
        height: 7px;
        background: #61e6b5;
        border-radius: 50%;
        margin-right: 7px;
        box-shadow: 0 0 0 4px rgba(97,230,181,.12);
    }


    /* STAT CARDS */

    .agent-stat-card {
        height: 100%;
        background: white;
        border: 1px solid #e9efec;
        border-radius: 21px;
        padding: 20px;
        box-shadow: 0 7px 25px rgba(16,35,29,.045);
        transition: .2s ease;
    }

    .agent-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(16,35,29,.08);
    }

    .agent-stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .agent-stat-icon {
        width: 45px;
        height: 45px;
        border-radius: 14px;
        display: grid;
        place-items: center;
        font-size: 18px;
    }

    .icon-green {
        background: #e8f7f1;
        color: #087f5b;
    }

    .icon-red {
        background: #fff0f1;
        color: #dc3545;
    }

    .icon-orange {
        background: #fff6df;
        color: #d99100;
    }

    .icon-blue {
        background: #edf4ff;
        color: #3976d2;
    }

    .agent-stat-arrow {
        width: 28px;
        height: 28px;
        border-radius: 9px;
        background: #f5f8f7;
        color: #7c8b86;
        display: grid;
        place-items: center;
        font-size: 12px;
    }

    .stat-live {
        background: #fff0f1;
        color: #dc3545;
        border-radius: 20px;
        padding: 5px 8px;
        font-size: 9px;
        font-weight: 800;
    }

    .agent-stat-number {
        font-family: 'Poppins', sans-serif;
        font-size: 34px;
        line-height: 1;
        font-weight: 800;
        color: #10231d;
    }

    .agent-stat-label {
        margin-top: 8px;
        font-weight: 800;
        font-size: 13px;
    }

    .agent-stat-description {
        margin-top: 5px;
        color: #8a9893;
        font-size: 10px;
        line-height: 1.5;
    }


    /* PANELS */

    .agent-panel {
        background: white;
        border: 1px solid #e9efec;
        border-radius: 23px;
        box-shadow: 0 7px 25px rgba(16,35,29,.045);
        overflow: hidden;
    }

    .agent-panel-header {
        padding: 23px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        border-bottom: 1px solid #edf1ef;
    }

    .panel-kicker {
        font-size: 9px;
        font-weight: 800;
        letter-spacing: 1.4px;
        color: #087f5b;
        margin-bottom: 5px;
    }

    .agent-panel h3 {
        font-size: 19px;
        font-weight: 800;
        margin: 0;
    }

    .agent-panel-header p {
        color: #8a9893;
        font-size: 11px;
        margin: 5px 0 0;
    }

    .agent-outline-btn {
        text-decoration: none;
        color: #087f5b;
        border: 1px solid #d7e7e1;
        border-radius: 30px;
        padding: 9px 13px;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .agent-outline-btn:hover {
        background: #e8f7f1;
        color: #056044;
    }


    /* TABLE */

    .agent-table-wrapper {
        overflow-x: auto;
    }

    .agent-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 700px;
    }

    .agent-table th {
        background: #fafcfb;
        color: #899690;
        text-transform: uppercase;
        font-size: 9px;
        letter-spacing: .8px;
        padding: 14px 18px;
        border-bottom: 1px solid #edf1ef;
        white-space: nowrap;
    }

    .agent-table td {
        padding: 15px 18px;
        border-bottom: 1px solid #f0f3f2;
        font-size: 12px;
        vertical-align: middle;
    }

    .agent-table tbody tr {
        transition: .15s ease;
    }

    .agent-table tbody tr:hover {
        background: #fbfdfc;
    }

    .incident-title {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .incident-mini-icon {
        width: 37px;
        height: 37px;
        flex: 0 0 37px;
        background: #e8f7f1;
        color: #087f5b;
        border-radius: 11px;
        display: grid;
        place-items: center;
    }

    .incident-title strong {
        display: block;
        font-size: 12px;
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .incident-title small {
        display: block;
        color: #9aa6a2;
        font-size: 9px;
        margin-top: 2px;
    }

    .category-text {
        color: #66756f;
        font-size: 11px;
    }


    /* BADGES */

    .priority-badge,
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 30px;
        padding: 5px 9px;
        font-size: 9px;
        font-weight: 800;
        white-space: nowrap;
    }

    .priority-badge > span {
        width: 5px;
        height: 5px;
        border-radius: 50%;
    }

    .priority-critical {
        background: #fff0f1;
        color: #d92d3a;
    }

    .priority-critical > span {
        background: #d92d3a;
    }

    .priority-high {
        background: #fff6df;
        color: #bd7c00;
    }

    .priority-high > span {
        background: #e4a11a;
    }

    .priority-medium {
        background: #edf8fc;
        color: #2387a4;
    }

    .priority-medium > span {
        background: #34a7c7;
    }

    .priority-low {
        background: #f0f2f2;
        color: #687772;
    }

    .priority-low > span {
        background: #87938f;
    }

    .status-danger {
        background: #fff0f1;
        color: #d92d3a;
    }

    .status-warning {
        background: #fff6df;
        color: #bd7c00;
    }

    .status-success {
        background: #e8f7f1;
        color: #087f5b;
    }

    .agent-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #087f5b;
        color: white;
        text-decoration: none;
        border-radius: 10px;
        padding: 8px 11px;
        font-size: 10px;
        font-weight: 800;
        transition: .2s ease;
    }

    .agent-action-btn:hover {
        background: #056044;
        color: white;
        transform: translateY(-1px);
    }


    /* MOBILE INCIDENTS */

    .agent-mobile-list {
        display: none;
    }

    .agent-incident-mobile {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 15px;
        border-bottom: 1px solid #edf1ef;
        text-decoration: none;
        color: #10231d;
    }

    .incident-mobile-icon {
        width: 42px;
        height: 42px;
        flex: 0 0 42px;
        border-radius: 13px;
        background: #e8f7f1;
        color: #087f5b;
        display: grid;
        place-items: center;
    }

    .incident-mobile-content {
        min-width: 0;
        flex: 1;
    }

    .incident-mobile-content strong {
        display: block;
        font-size: 12px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .incident-mobile-content small {
        display: block;
        color: #899690;
        font-size: 9px;
        margin-top: 3px;
    }

    .incident-mobile-meta {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-top: 7px;
        color: #a0aaa6;
        font-size: 9px;
    }


    /* QUICK ACTIONS */

    .quick-panel {
        padding: 23px;
    }

    .quick-panel > p {
        color: #8a9893;
        font-size: 11px;
        line-height: 1.6;
        margin-top: 7px;
        margin-bottom: 20px;
    }

    .quick-action {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 13px 0;
        border-top: 1px solid #edf1ef;
        text-decoration: none;
        color: #10231d;
    }

    .quick-action > div:nth-child(2) {
        flex: 1;
    }

    .quick-action strong {
        display: block;
        font-size: 11px;
    }

    .quick-action small {
        display: block;
        color: #8a9893;
        font-size: 9px;
        margin-top: 3px;
    }

    .quick-action > i {
        color: #a5b0ac;
        font-size: 12px;
    }

    .quick-icon {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        border-radius: 11px;
        display: grid;
        place-items: center;
    }

    .quick-icon.green {
        background: #e8f7f1;
        color: #087f5b;
    }

    .quick-icon.orange {
        background: #fff6df;
        color: #c48700;
    }

    .quick-icon.blue {
        background: #edf4ff;
        color: #3976d2;
    }


    /* IA */

    .ai-agent-card {
        position: relative;
        overflow: hidden;
        border-radius: 23px;
        padding: 25px;
        background: linear-gradient(145deg, #062f26, #087f5b);
        color: white;
    }

    .ai-glow {
        position: absolute;
        width: 180px;
        height: 180px;
        right: -70px;
        top: -90px;
        border: 35px solid rgba(255,255,255,.06);
        border-radius: 50%;
    }

    .ai-agent-icon {
        width: 43px;
        height: 43px;
        border-radius: 13px;
        background: rgba(255,255,255,.11);
        display: grid;
        place-items: center;
        font-size: 19px;
        margin-bottom: 15px;
    }

    .ai-agent-label {
        font-size: 9px;
        letter-spacing: 1.3px;
        font-weight: 800;
        color: #61e6b5;
    }

    .ai-agent-card h3 {
        font-size: 19px;
        margin: 5px 0 8px;
    }

    .ai-agent-card p {
        color: rgba(255,255,255,.67);
        font-size: 11px;
        line-height: 1.7;
        margin-bottom: 17px;
    }

    .ai-agent-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(255,255,255,.09);
        border-radius: 30px;
        padding: 7px 10px;
        font-size: 9px;
        font-weight: 700;
    }

    .ai-agent-status span {
        width: 6px;
        height: 6px;
        background: #61e6b5;
        border-radius: 50%;
    }


    /* EMPTY */

    .agent-empty {
        padding: 55px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 65px;
        height: 65px;
        border-radius: 20px;
        background: #e8f7f1;
        color: #087f5b;
        display: grid;
        place-items: center;
        margin: 0 auto 15px;
        font-size: 28px;
    }

    .agent-empty h4 {
        font-size: 16px;
        font-weight: 800;
    }

    .agent-empty p {
        color: #899690;
        font-size: 12px;
    }


    /* RESPONSIVE */

    @media (max-width: 1199px) {

        .agent-panel-header {
            padding: 20px;
        }

    }

    @media (max-width: 991px) {

        .agent-hero {
            padding: 25px;
        }

        .agent-status {
            display: none;
        }

    }

    @media (max-width: 767px) {

        .agent-hero {
            border-radius: 21px;
            padding: 23px 20px;
        }

        .agent-hero h1 {
            font-size: 27px;
        }

        .agent-hero p {
            font-size: 12px;
        }

        .agent-stat-card {
            padding: 16px;
            border-radius: 17px;
        }

        .agent-stat-number {
            font-size: 28px;
        }

        .agent-stat-label {
            font-size: 11px;
        }

        .agent-stat-description {
            font-size: 9px;
        }

        .agent-stat-icon {
            width: 39px;
            height: 39px;
        }

        .agent-panel {
            border-radius: 19px;
        }

        .agent-panel-header {
            padding: 18px;
        }

        .agent-panel-header h3 {
            font-size: 17px;
        }

        .agent-panel-header p {
            font-size: 10px;
        }

        .agent-outline-btn {
            padding: 8px 10px;
        }

        .agent-table-wrapper {
            display: none;
        }

        .agent-mobile-list {
            display: block;
        }

        .quick-panel {
            padding: 20px;
        }

        .ai-agent-card {
            border-radius: 19px;
        }

    }

    @media (max-width: 420px) {

        .agent-stat-card {
            padding: 13px;
        }

        .agent-stat-number {
            font-size: 25px;
        }

        .agent-stat-description {
            display: none;
        }

        .agent-stat-label {
            margin-top: 5px;
        }

    }

</style>

@endsection