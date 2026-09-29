<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'CivicPulse AI' }}</title>

    <meta name="description" content="CivicPulse AI - Plateforme intelligente de signalement et de gestion des incidents urbains">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --cp-primary: #087f5b;
            --cp-primary-dark: #056044;
            --cp-primary-soft: #e8f7f1;
            --cp-dark: #10231d;
            --cp-muted: #71817b;
            --cp-bg: #f5f8f7;
            --cp-border: #e6ece9;
            --cp-white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--cp-bg);
            color: var(--cp-dark);
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }

        .cp-shell {
            min-height: 100vh;
        }

        /* SIDEBAR */
        .cp-sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 260px;
            background: linear-gradient(180deg, #073f31 0%, #062f26 100%);
            color: white;
            padding: 24px 16px;
            z-index: 1100;
            display: flex;
            flex-direction: column;
        }

        .cp-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 4px 12px 28px;
            color: white;
            text-decoration: none;
        }

        .cp-brand-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: rgba(255,255,255,.13);
            display: grid;
            place-items: center;
            font-size: 22px;
        }

        .cp-brand strong {
            display: block;
            font-size: 18px;
            letter-spacing: -.4px;
        }

        .cp-brand small {
            color: rgba(255,255,255,.6);
            font-size: 11px;
        }

        .cp-section-label {
            color: rgba(255,255,255,.4);
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.4px;
            padding: 0 12px 8px;
            margin-top: 8px;
        }

        .cp-nav {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .cp-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 13px;
            color: rgba(255,255,255,.72);
            text-decoration: none;
            border-radius: 13px;
            font-size: 14px;
            font-weight: 600;
            transition: .2s ease;
        }

        .cp-nav a i {
            width: 22px;
            font-size: 17px;
            text-align: center;
        }

        .cp-nav a:hover,
        .cp-nav a.active {
            background: rgba(255,255,255,.11);
            color: white;
        }

        .cp-nav a.active {
            box-shadow: inset 3px 0 0 #56d6a5;
        }

        .cp-sidebar-bottom {
            margin-top: auto;
        }

        .cp-profile-mini {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            margin-bottom: 8px;
            background: rgba(255,255,255,.06);
            border-radius: 15px;
        }

        .cp-avatar {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: #56d6a5;
            color: #073f31;
            display: grid;
            place-items: center;
            font-weight: 800;
        }

        .cp-profile-mini strong {
            display: block;
            font-size: 13px;
        }

        .cp-profile-mini small {
            color: rgba(255,255,255,.55);
            font-size: 11px;
        }

        .cp-logout {
            width: 100%;
            border: 0;
            background: transparent;
            color: rgba(255,255,255,.65);
            padding: 11px 12px;
            border-radius: 12px;
            text-align: left;
            font-weight: 600;
        }

        .cp-logout:hover {
            background: rgba(255,255,255,.08);
            color: white;
        }

        /* MAIN */
        .cp-main {
            margin-left: 260px;
            min-height: 100vh;
        }

        .cp-topbar {
            height: 76px;
            background: rgba(255,255,255,.94);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--cp-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .cp-breadcrumb {
            color: var(--cp-muted);
            font-size: 13px;
        }

        .cp-breadcrumb strong {
            color: var(--cp-dark);
        }

        .cp-top-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .cp-icon-btn {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            border: 1px solid var(--cp-border);
            background: white;
            color: var(--cp-dark);
            display: grid;
            place-items: center;
            position: relative;
            text-decoration: none;
        }

        .cp-notification-dot {
            position: absolute;
            top: 7px;
            right: 7px;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #ef4444;
            border: 2px solid white;
        }

        .cp-content {
            padding: 30px 32px 45px;
            max-width: 1600px;
            margin: auto;
        }

        .cp-alert {
            border: 0;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(16,35,29,.06);
        }

        .cp-mobile-header {
            display: none;
        }

        /* MOBILE */
        @media (max-width: 991.98px) {
            .cp-sidebar {
                transform: translateX(-100%);
                transition: transform .25s ease;
                box-shadow: 20px 0 50px rgba(0,0,0,.15);
            }

            .cp-sidebar.open {
                transform: translateX(0);
            }

            .cp-main {
                margin-left: 0;
            }

            .cp-topbar {
                height: 68px;
                padding: 0 16px;
            }

            .cp-content {
                padding: 20px 15px 90px;
            }

            .cp-mobile-header {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .cp-mobile-menu {
                width: 42px;
                height: 42px;
                border: 0;
                border-radius: 12px;
                background: var(--cp-primary-soft);
                color: var(--cp-primary);
            }

            .cp-mobile-brand {
                font-family: 'Poppins', sans-serif;
                font-weight: 800;
            }

            .cp-breadcrumb {
                display: none;
            }

     .cp-mobile-bottom {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    height: 72px;
    padding: 5px 8px;
    background: rgba(255,255,255,.97);
    backdrop-filter: blur(18px);
    border-top: 1px solid var(--cp-border);
    display: flex;
    justify-content: space-around;
    align-items: center;
    z-index: 1050;
    box-shadow: 0 -8px 30px rgba(16,35,29,.08);
}

.cp-mobile-bottom a {
    min-width: 58px;
    color: var(--cp-muted);
    text-decoration: none;
    text-align: center;
    font-size: 10px;
    font-weight: 700;
    padding: 7px 4px;
    border-radius: 12px;
}

.cp-mobile-bottom a i {
    display: block;
    font-size: 19px;
    margin-bottom: 3px;
}

.cp-mobile-bottom a.active {
    color: var(--cp-primary);
}

.cp-mobile-report {
    width: 58px !important;
    height: 58px;
    min-width: 58px !important;
    margin-top: -27px;
    border-radius: 50% !important;
    background: linear-gradient(
        135deg,
        var(--cp-primary),
        var(--cp-secondary, #20c997)
    ) !important;
    color: white !important;
    display: flex !important;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border: 5px solid var(--cp-bg);
    box-shadow: 0 8px 20px rgba(8,127,91,.25);
}

.cp-mobile-report i {
    margin: 0 !important;
    font-size: 21px !important;
}

.cp-mobile-report span {
    font-size: 8px;
    margin-top: 1px;
}

@media (min-width: 992px) {
    .cp-mobile-bottom {
        display: none;
    }
}

               </style>

    @stack('styles')
</head>

<body>

<div class="cp-shell">

    <aside class="cp-sidebar" id="cpSidebar">

        <a href="{{ route('dashboard') }}" class="cp-brand">
            <div class="cp-brand-icon">
                <i class="bi bi-activity"></i>
            </div>
            <div>
                <strong>CivicPulse</strong>
                <small>AI · Smart City</small>
            </div>
        </a>

        <div class="cp-section-label">Navigation</div>

        <nav class="cp-nav">

            @if(Auth::user()->isAdministrateur())

                <a href="{{ route('admin.dashboard') }}"
                   class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Tableau de bord</span>
                </a>

                <a href="{{ route('incidents.index') }}"
                   class="{{ request()->routeIs('incidents.*') ? 'active' : '' }}">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <span>Incidents</span>
                </a>

                <a href="{{ route('interventions.index') }}"
                   class="{{ request()->routeIs('interventions.*') ? 'active' : '' }}">
                    <i class="bi bi-tools"></i>
                    <span>Interventions</span>
                </a>

                <a href="{{ route('incidents.map') }}"
                   class="{{ request()->routeIs('incidents.map') ? 'active' : '' }}">
                    <i class="bi bi-map-fill"></i>
                    <span>Carte</span>
                </a>

                <a href="{{ route('admin.statistics') }}"
                   class="{{ request()->routeIs('admin.statistics') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart-fill"></i>
                    <span>Statistiques</span>
                </a>

                @if(Route::has('users.index'))
                    <a href="{{ route('users.index') }}"
                       class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i>
                        <span>Utilisateurs</span>
                    </a>
                @endif

            @elseif(Auth::user()->isAgent())

                <a href="{{ route('agent.dashboard') }}"
                   class="{{ request()->routeIs('agent.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Tableau de bord</span>
                </a>

                <a href="{{ route('incidents.index') }}"
                   class="{{ request()->routeIs('incidents.index') ? 'active' : '' }}">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <span>Incidents</span>
                </a>

                <a href="{{ route('interventions.index') }}"
                   class="{{ request()->routeIs('interventions.*') ? 'active' : '' }}">
                    <i class="bi bi-tools"></i>
                    <span>Interventions</span>
                </a>

                <a href="{{ route('incidents.map') }}"
                   class="{{ request()->routeIs('incidents.map') ? 'active' : '' }}">
                    <i class="bi bi-map-fill"></i>
                    <span>Carte</span>
                </a>

            @else

                <a href="{{ route('citizen.dashboard') }}"
                   class="{{ request()->routeIs('citizen.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Accueil</span>
                </a>

                <a href="{{ route('incidents.index') }}"
                   class="{{ request()->routeIs('incidents.index') ? 'active' : '' }}">
                    <i class="bi bi-folder2-open"></i>
                    <span>Mes incidents</span>
                </a>

                <a href="{{ route('incidents.create') }}"
                   class="{{ request()->routeIs('incidents.create') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle-fill"></i>
                    <span>Signaler</span>
                </a>

                <a href="{{ route('incidents.map') }}"
                   class="{{ request()->routeIs('incidents.map') ? 'active' : '' }}">
                    <i class="bi bi-map-fill"></i>
                    <span>Carte</span>
                </a>

            @endif

            <div style="height:1px;background:rgba(255,255,255,.08);margin:14px 10px;"></div>

            <a href="{{ route('profile.edit') }}"
               class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i>
                <span>Mon profil</span>
            </a>

        </nav>

        <div class="cp-sidebar-bottom">

            <div class="cp-profile-mini">
                <div class="cp-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div>
                    <strong>{{ Auth::user()->name }}</strong>
                    <small>
                        {{ Auth::user()->isAdministrateur() ? 'Administrateur' : (Auth::user()->isAgent() ? 'Agent' : 'Citoyen') }}
                    </small>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="cp-logout">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Déconnexion
                </button>
            </form>

        </div>

    </aside>

    <main class="cp-main">

        <header class="cp-topbar">

            <div class="cp-mobile-header">
                <button class="cp-mobile-menu" onclick="toggleCivicSidebar()">
                    <i class="bi bi-list fs-5"></i>
                </button>

                <span class="cp-mobile-brand">CivicPulse AI</span>
            </div>

            <div class="cp-breadcrumb">
                CivicPulse AI
                <span class="mx-2">/</span>
                <strong>{{ $title ?? 'Tableau de bord' }}</strong>
            </div>

            <div class="cp-top-actions">

                <a href="{{ route('incidents.index') }}" class="cp-icon-btn" title="Incidents">
                    <i class="bi bi-bell"></i>
                    <span class="cp-notification-dot"></span>
                </a>

                <a href="{{ route('profile.edit') }}" class="cp-icon-btn" title="Mon profil">
                    <i class="bi bi-person"></i>
                </a>

            </div>

        </header>

        <div class="cp-content">

            @if(session('success'))
                <div class="alert alert-success cp-alert mb-4">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger cp-alert mb-4">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-warning cp-alert mb-4">
                    <strong><i class="bi bi-exclamation-circle-fill me-2"></i>Vérifiez les informations :</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </div>

    </main>

{{-- NAVIGATION MOBILE --}}
<nav class="cp-mobile-bottom">

    @if(Auth::user()->isAdministrateur())

        {{-- ADMIN --}}
        <a href="{{ route('admin.dashboard') }}"
           class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-fill"></i>
            <span>Accueil</span>
        </a>

        <a href="{{ route('incidents.index') }}"
           class="{{ request()->routeIs('incidents.*') ? 'active' : '' }}">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span>Incidents</span>
        </a>

        <a href="{{ route('admin.statistics') }}"
           class="{{ request()->routeIs('admin.statistics') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-fill"></i>
            <span>Stats</span>
        </a>

        <a href="{{ route('users.index') }}"
           class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i>
            <span>Utilisateurs</span>
        </a>

        <a href="{{ route('profile.edit') }}"
           class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <i class="bi bi-person-fill"></i>
            <span>Profil</span>
        </a>


    @elseif(Auth::user()->isAgent())

        {{-- AGENT --}}
        <a href="{{ route('agent.dashboard') }}"
           class="{{ request()->routeIs('agent.dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-fill"></i>
            <span>Accueil</span>
        </a>

        <a href="{{ route('incidents.index') }}"
           class="{{ request()->routeIs('incidents.*') ? 'active' : '' }}">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span>Incidents</span>
        </a>

        <a href="{{ route('interventions.index') }}"
           class="{{ request()->routeIs('interventions.*') ? 'active' : '' }}">
            <i class="bi bi-tools"></i>
            <span>Interventions</span>
        </a>

        <a href="{{ route('incidents.map') }}"
           class="{{ request()->routeIs('incidents.map') ? 'active' : '' }}">
            <i class="bi bi-map-fill"></i>
            <span>Carte</span>
        </a>

        <a href="{{ route('profile.edit') }}"
           class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <i class="bi bi-person-fill"></i>
            <span>Profil</span>
        </a>


    @else

        {{-- CITOYEN --}}
        <a href="{{ route('citizen.dashboard') }}"
           class="{{ request()->routeIs('citizen.dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-fill"></i>
            <span>Accueil</span>
        </a>

        <a href="{{ route('incidents.index') }}"
           class="{{ request()->routeIs('incidents.index') ? 'active' : '' }}">
            <i class="bi bi-folder2-open"></i>
            <span>Incidents</span>
        </a>

        <a href="{{ route('incidents.create') }}"
           class="cp-mobile-report"
           aria-label="Signaler un incident">
            <i class="bi bi-plus-lg"></i>
            <span>Signaler</span>
        </a>

        <a href="{{ route('incidents.map') }}"
           class="{{ request()->routeIs('incidents.map') ? 'active' : '' }}">
            <i class="bi bi-map-fill"></i>
            <span>Carte</span>
        </a>

        <a href="{{ route('profile.edit') }}"
           class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <i class="bi bi-person-fill"></i>
            <span>Profil</span>
        </a>

    @endif

</nav>
    
</div>

<script>
function toggleCivicSidebar() {
    document.getElementById('cpSidebar').classList.toggle('open');
}

document.addEventListener('click', function(e) {
    const sidebar = document.getElementById('cpSidebar');

    if (
        window.innerWidth < 992 &&
        sidebar.classList.contains('open') &&
        !sidebar.contains(e.target) &&
        !e.target.closest('.cp-mobile-menu')
    ) {
        sidebar.classList.remove('open');
    }
});

setTimeout(() => {
    document.querySelectorAll('.alert').forEach(el => {
        if (window.bootstrap) {
            const alert = bootstrap.Alert.getOrCreateInstance(el);
            alert.close();
        }
    });
}, 5000);
</script>

@stack('scripts')

</body>
</html>