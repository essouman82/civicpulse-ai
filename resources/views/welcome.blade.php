<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CivicPulse AI — Une ville plus intelligente</title>

    <meta name="description"
          content="CivicPulse AI permet aux citoyens de signaler les incidents urbains et aux services municipaux de les gérer intelligemment.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap"
          rel="stylesheet">

    <style>
        :root {
            --green: #087f5b;
            --green-dark: #063d30;
            --green-light: #e8f7f1;
            --dark: #10231d;
            --muted: #70817b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            background: #f7faf9;
        }

        h1, h2, h3 {
            font-family: 'Poppins', sans-serif;
        }

        .hero {
            min-height: 100vh;
            background:
                radial-gradient(circle at 85% 15%, rgba(84,214,165,.22), transparent 28%),
                linear-gradient(135deg, #f7fcfa 0%, #eef8f4 50%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }

        .navbar {
            height: 82px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1180px;
            margin: auto;
            padding: 0 24px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--dark);
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            border-radius: 14px;
            background: var(--green);
            color: white;
            display: grid;
            place-items: center;
            font-size: 23px;
            box-shadow: 0 10px 25px rgba(8,127,91,.22);
        }

        .brand strong {
            font-family: 'Poppins', sans-serif;
            font-size: 19px;
        }

        .brand small {
            display: block;
            color: var(--muted);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .8px;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-login {
            text-decoration: none;
            color: var(--dark);
            font-weight: 700;
            padding: 11px 18px;
        }

        .btn-register {
            text-decoration: none;
            background: var(--green);
            color: white;
            padding: 12px 21px;
            border-radius: 30px;
            font-weight: 700;
            box-shadow: 0 10px 25px rgba(8,127,91,.18);
        }

        .hero-content {
            max-width: 1180px;
            margin: auto;
            min-height: calc(100vh - 82px);
            padding: 70px 24px 90px;
            display: grid;
            grid-template-columns: 1.05fr .95fr;
            align-items: center;
            gap: 70px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--green-light);
            color: var(--green);
            border-radius: 30px;
            padding: 8px 14px;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .badge span {
            width: 7px;
            height: 7px;
            background: #20b486;
            border-radius: 50%;
        }

        .hero h1 {
            font-size: clamp(42px, 6vw, 72px);
            line-height: 1.04;
            letter-spacing: -2.5px;
            margin: 0 0 22px;
        }

        .hero h1 span {
            color: var(--green);
        }

        .hero-text {
            font-size: 17px;
            line-height: 1.8;
            color: var(--muted);
            max-width: 600px;
            margin-bottom: 30px;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .primary-btn {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            text-decoration: none;
            background: var(--green);
            color: white;
            padding: 15px 24px;
            border-radius: 15px;
            font-weight: 800;
            box-shadow: 0 14px 30px rgba(8,127,91,.22);
        }

        .secondary-btn {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            text-decoration: none;
            background: white;
            color: var(--dark);
            padding: 15px 24px;
            border-radius: 15px;
            font-weight: 700;
            border: 1px solid #e3ebe7;
        }

        /* VISUAL */
        .visual {
            position: relative;
        }

        .dashboard-card {
            background: rgba(255,255,255,.88);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,.9);
            border-radius: 30px;
            padding: 22px;
            box-shadow: 0 30px 80px rgba(20,60,48,.14);
            transform: rotate(1.5deg);
        }

        .dashboard-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .dashboard-title {
            font-weight: 800;
        }

        .live {
            color: #16865f;
            background: #e9f8f2;
            border-radius: 30px;
            padding: 6px 10px;
            font-size: 10px;
            font-weight: 800;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }

        .stat {
            background: #f7faf9;
            border-radius: 17px;
            padding: 15px;
        }

        .stat small {
            color: var(--muted);
            font-size: 10px;
        }

        .stat strong {
            display: block;
            font-size: 24px;
            margin-top: 5px;
        }

        .incident {
            display: flex;
            align-items: center;
            gap: 13px;
            background: white;
            border: 1px solid #edf1ef;
            border-radius: 17px;
            padding: 13px;
            margin-top: 9px;
        }

        .incident-icon {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            background: #fff1f1;
            color: #dc3545;
            display: grid;
            place-items: center;
        }

        .incident strong {
            font-size: 13px;
        }

        .incident small {
            display: block;
            color: var(--muted);
            margin-top: 3px;
            font-size: 10px;
        }

        .ai-card {
            position: absolute;
            bottom: -35px;
            left: -35px;
            background: var(--green-dark);
            color: white;
            border-radius: 20px;
            padding: 17px 20px;
            width: 220px;
            box-shadow: 0 20px 45px rgba(6,61,48,.25);
        }

        .ai-card i {
            color: #58d9aa;
            font-size: 22px;
        }

        .ai-card strong {
            display: block;
            margin-top: 8px;
        }

        .ai-card small {
            color: rgba(255,255,255,.65);
            font-size: 10px;
        }

        .features {
            background: white;
            padding: 90px 24px;
        }

        .features-inner {
            max-width: 1180px;
            margin: auto;
        }

        .section-title {
            text-align: center;
            max-width: 650px;
            margin: 0 auto 45px;
        }

        .section-title h2 {
            font-size: 35px;
            margin-bottom: 12px;
        }

        .section-title p {
            color: var(--muted);
            line-height: 1.7;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .feature {
            padding: 30px;
            border: 1px solid #e9efec;
            border-radius: 24px;
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            background: var(--green-light);
            color: var(--green);
            font-size: 23px;
            margin-bottom: 20px;
        }

        .feature h3 {
            font-size: 18px;
        }

        .feature p {
            color: var(--muted);
            line-height: 1.7;
            font-size: 14px;
        }

        footer {
            background: var(--green-dark);
            color: rgba(255,255,255,.7);
            text-align: center;
            padding: 28px;
            font-size: 13px;
        }

        @media(max-width: 850px) {

            .navbar {
                height: 72px;
            }

            .nav-actions .btn-login {
                display: none;
            }

            .hero-content {
                grid-template-columns: 1fr;
                padding-top: 45px;
                gap: 55px;
            }

            .hero h1 {
                font-size: clamp(39px, 12vw, 58px);
                letter-spacing: -1.8px;
            }

            .hero-text {
                font-size: 15px;
            }

            .visual {
                max-width: 520px;
                width: 100%;
                margin: auto;
            }

            .feature-grid {
                grid-template-columns: 1fr;
            }

            .features {
                padding: 65px 20px;
            }
        }

        @media(max-width: 500px) {

            .brand small {
                display: none;
            }

            .btn-register {
                padding: 10px 14px;
                font-size: 12px;
            }

            .hero-content {
                padding: 40px 18px 80px;
            }

            .hero h1 {
                font-size: 42px;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .primary-btn,
            .secondary-btn {
                justify-content: center;
                width: 100%;
            }

            .dashboard-card {
                padding: 14px;
                border-radius: 22px;
            }

            .ai-card {
                position: relative;
                left: 15px;
                bottom: auto;
                margin-top: 15px;
                width: calc(100% - 30px);
            }
        }
    </style>
</head>

<body>

<section class="hero">

    <nav class="navbar">

        <a href="{{ url('/') }}" class="brand">

            <div class="brand-icon">
                <i class="bi bi-activity"></i>
            </div>

            <div>
                <strong>CivicPulse AI</strong>
                <small>SMART CITY PLATFORM</small>
            </div>

        </a>

        <div class="nav-actions">

            @auth
                <a href="{{ route('dashboard') }}"
                   class="btn-register">
                    Mon espace
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="btn-login">
                    Se connecter
                </a>

                <a href="{{ route('register') }}"
                   class="btn-register">
                    Créer un compte
                </a>
            @endauth

        </div>

    </nav>


    <div class="hero-content">

        <div>

            <div class="badge">
                <span></span>
                INTELLIGENCE CIVIQUE POUR UNE VILLE PLUS SÛRE
            </div>

            <h1>
                Votre ville.<br>
                Votre voix.<br>
                <span>Notre action.</span>
            </h1>

            <p class="hero-text">
                CivicPulse AI permet aux citoyens de signaler rapidement les
                incidents urbains et aide les services compétents à les
                analyser, les prioriser et les résoudre plus efficacement.
            </p>

            <div class="hero-buttons">

                @auth
                    <a href="{{ route('incidents.create') }}"
                       class="primary-btn">
                        <i class="bi bi-plus-circle-fill"></i>
                        Signaler un incident
                    </a>
                @else
                    <a href="{{ route('register') }}"
                       class="primary-btn">
                        <i class="bi bi-person-plus-fill"></i>
                        Commencer maintenant
                    </a>
                @endauth

                <a href="#fonctionnement"
                   class="secondary-btn">
                    <i class="bi bi-play-circle"></i>
                    Découvrir la plateforme
                </a>

            </div>

        </div>


        <div class="visual">

            <div class="dashboard-card">

                <div class="dashboard-top">

                    <div>
                        <small class="text-muted">
                            CivicPulse AI
                        </small>

                        <div class="dashboard-title">
                            Centre de supervision
                        </div>
                    </div>

                    <div class="live">
                        ● SYSTÈME ACTIF
                    </div>

                </div>

                <div class="stats">

                    <div class="stat">
                        <small>Incidents</small>
                        <strong>09</strong>
                    </div>

                    <div class="stat">
                        <small>En cours</small>
                        <strong>02</strong>
                    </div>

                    <div class="stat">
                        <small>Résolus</small>
                        <strong>04</strong>
                    </div>

                </div>

                <div class="incident">

                    <div class="incident-icon">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>

                    <div>
                        <strong>Incident urbain détecté</strong>
                        <small>Nid de poule · Priorité élevée</small>
                    </div>

                </div>

                <div class="incident">

                    <div class="incident-icon"
                         style="background:#fff8e6;color:#e49a00;">
                        <i class="bi bi-trash3-fill"></i>
                    </div>

                    <div>
                        <strong>Déchets sur la voie publique</strong>
                        <small>Analyse IA terminée</small>
                    </div>

                </div>

                <div class="incident">

                    <div class="incident-icon"
                         style="background:#e9f8f2;color:#087f5b;">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>

                    <div>
                        <strong>Incident résolu</strong>
                        <small>Intervention terminée</small>
                    </div>

                </div>

            </div>

            <div class="ai-card">

                <i class="bi bi-stars"></i>

                <strong>Analyse intelligente</strong>

                <small>
                    CivicPulse AI aide à catégoriser et prioriser
                    automatiquement les signalements.
                </small>

            </div>

        </div>

    </div>

</section>


<section class="features" id="fonctionnement">

    <div class="features-inner">

        <div class="section-title">

            <h2>
                Une plateforme pensée pour la ville de demain
            </h2>

            <p>
                Un espace unique pour connecter les citoyens,
                les agents et les responsables de la gestion urbaine.
            </p>

        </div>


        <div class="feature-grid">

            <div class="feature">

                <div class="feature-icon">
                    <i class="bi bi-camera-fill"></i>
                </div>

                <h3>
                    Signalez facilement
                </h3>

                <p>
                    Décrivez un problème, ajoutez une photo et
                    indiquez sa localisation directement depuis votre
                    téléphone.
                </p>

            </div>


            <div class="feature">

                <div class="feature-icon">
                    <i class="bi bi-stars"></i>
                </div>

                <h3>
                    Analyse assistée par IA
                </h3>

                <p>
                    Les signalements peuvent être catégorisés et
                    priorisés automatiquement afin de faciliter leur
                    traitement.
                </p>

            </div>


            <div class="feature">

                <div class="feature-icon">
                    <i class="bi bi-bell-fill"></i>
                </div>

                <h3>
                    Suivi en temps réel
                </h3>

                <p>
                    Suivez l'évolution de vos signalements et recevez
                    des notifications lorsque leur statut évolue.
                </p>

            </div>

        </div>

    </div>

</section>


<footer>

    © {{ date('Y') }} <strong>CivicPulse AI</strong>
    — Plateforme intelligente de gestion des incidents urbains.

</footer>


</body>
</html>