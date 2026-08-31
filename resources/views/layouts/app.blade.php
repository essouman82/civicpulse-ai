<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CivicPulse AI</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>

:root{

    --primary:#198754;
    --primary-dark:#146c43;
    --secondary:#20c997;

    --bg:#f4f7fb;

    --white:#ffffff;

    --text:#1f2937;

    --muted:#6c757d;

    --border:#e8edf2;

    --shadow:0 10px 35px rgba(0,0,0,.08);

}

*{

margin:0;

padding:0;

box-sizing:border-box;

}

body{

background:var(--bg);

font-family:'Segoe UI',sans-serif;

overflow-x:hidden;

color:var(--text);

}

.sidebar{

position:fixed;

left:0;

top:0;

width:270px;

height:100vh;

background:linear-gradient(180deg,#146c43,#198754);

color:white;

box-shadow:var(--shadow);

display:flex;

flex-direction:column;

z-index:999;

}

.logo{

padding:28px;

font-size:25px;

font-weight:700;

display:flex;

align-items:center;

justify-content:center;

gap:12px;

border-bottom:1px solid rgba(255,255,255,.12);

letter-spacing:.5px;

}

.logo img{

width:45px;

height:45px;

object-fit:contain;

}

.logo i{

font-size:34px;

color:#b8ffd3;

}

.menu{

padding:20px 15px;

flex:1;

overflow-y:auto;

}

.menu-title{

font-size:12px;

text-transform:uppercase;

opacity:.65;

padding:12px 18px;

letter-spacing:1px;

}

.menu a{

display:flex;

align-items:center;

gap:14px;

padding:14px 18px;

margin-bottom:8px;

border-radius:14px;

color:white;

text-decoration:none;

transition:.25s;

font-weight:500;

}

.menu a i{

font-size:18px;

width:22px;

text-align:center;

}

.menu a:hover{

background:rgba(255,255,255,.15);

transform:translateX(5px);

}

.menu a.active{

background:white;

color:var(--primary);

font-weight:700;

box-shadow:0 8px 18px rgba(0,0,0,.15);

}

.logout{

padding:20px;

border-top:1px solid rgba(255,255,255,.12);

}

.logout button{

width:100%;

background:rgba(255,255,255,.10);

border:none;

padding:14px;

border-radius:12px;

color:white;

transition:.3s;

font-weight:600;

}

.logout button:hover{

background:white;

color:var(--primary);

}

.main{

margin-left:270px;

min-height:100vh;

display:flex;

flex-direction:column;

}

.topbar{

height:78px;

background:white;

display:flex;

justify-content:space-between;

align-items:center;

padding:0 35px;

box-shadow:0 3px 15px rgba(0,0,0,.05);

position:sticky;

top:0;

z-index:100;

}

.search-box{

position:relative;

width:360px;

}

.search-box input{

width:100%;

padding:12px 15px 12px 45px;

border:1px solid var(--border);

border-radius:50px;

background:#f7f9fc;

outline:none;

transition:.3s;

}

.search-box input:focus{

border-color:var(--primary);

background:white;

}

.search-box i{

position:absolute;

left:16px;

top:13px;

color:#999;

}
.user-area{

display:flex;

align-items:center;

gap:25px;

}

.notification{

position:relative;

cursor:pointer;

font-size:22px;

color:#555;

transition:.3s;

}

.notification:hover{

color:var(--primary);

}

.notification .badge{

position:absolute;

top:-6px;

right:-8px;

background:#dc3545;

color:white;

font-size:10px;

border-radius:50%;

width:18px;

height:18px;

display:flex;

justify-content:center;

align-items:center;

}

.user-card{

display:flex;

align-items:center;

gap:12px;

}

.avatar{

width:48px;

height:48px;

border-radius:50%;

background:linear-gradient(135deg,#198754,#20c997);

display:flex;

justify-content:center;

align-items:center;

font-size:20px;

font-weight:bold;

color:white;

box-shadow:0 5px 15px rgba(25,135,84,.35);

}

.user-info{

display:flex;

flex-direction:column;

line-height:1.2;

}

.user-info strong{

font-size:15px;

color:#222;

}

.user-info small{

color:#888;

font-size:13px;

}

.content{

padding:30px;

flex:1;

}

.page-title{

font-size:30px;

font-weight:700;

margin-bottom:25px;

}

.card{

border:none;

border-radius:18px;

box-shadow:0 8px 30px rgba(0,0,0,.06);

transition:.25s;

overflow:hidden;

}

.card:hover{

transform:translateY(-4px);

box-shadow:0 15px 35px rgba(0,0,0,.10);

}

.stat-card{

display:flex;

justify-content:space-between;

align-items:center;

padding:28px;

}

.stat-card h3{

font-size:34px;

font-weight:bold;

margin-bottom:5px;

}

.stat-card p{

margin:0;

color:#777;

font-size:15px;

}

.stat-icon{

width:70px;

height:70px;

border-radius:18px;

display:flex;

justify-content:center;

align-items:center;

font-size:30px;

color:white;

}

.bg-green{

background:#198754;

}

.bg-blue{

background:#0d6efd;

}

.bg-orange{

background:#fd7e14;

}

.bg-red{

background:#dc3545;

}

.table{

margin-bottom:0;

}

.table thead{

background:#f8fafc;

}

.table th{

font-weight:600;

color:#555;

border:none;

padding:16px;

}

.table td{

padding:16px;

vertical-align:middle;

}

.badge-role{

padding:8px 14px;

border-radius:50px;

font-size:12px;

font-weight:600;

}

.role-admin{

background:#ffe7d1;

color:#b45309;

}

.role-agent{

background:#d1fae5;

color:#047857;

}

.role-citoyen{

background:#dbeafe;

color:#1d4ed8;

}

.btn-modern{

border-radius:12px;

padding:10px 18px;

font-weight:600;

}

.footer{

padding:20px;

text-align:center;

color:#888;

font-size:14px;

}

@media(max-width:991px){

.sidebar{

left:-270px;

transition:.35s;

}

.sidebar.show{

left:0;

}

.main{

margin-left:0;

}

.search-box{

display:none;

}

.topbar{

padding:0 20px;

}

.content{

padding:20px;

}

}

</style>

</head>

<body>

<div class="sidebar">

<div class="logo">

@if(file_exists(public_path('images/logo.png')))

<img src="{{ asset('images/logo.png') }}" alt="Logo">

@else

<i class="bi bi-shield-check"></i>

@endif

<span>CivicPulse AI</span>

</div>

<div class="menu">

<div class="menu-title">

Navigation

</div>
{{-- ========================= --}}
{{-- MENU ADMINISTRATEUR --}}
{{-- ========================= --}}

@if(Auth::user()->isAdministrateur())

<a href="{{ route('admin.dashboard') }}"
   class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

    <i class="bi bi-speedometer2"></i>

    <span>Tableau de bord</span>

</a>

<a href="{{ route('users.index') }}"
   class="{{ request()->routeIs('users.*') ? 'active' : '' }}">

    <i class="bi bi-people-fill"></i>

    <span>Utilisateurs</span>

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

    <span>Carte interactive</span>

</a>

<a href="{{ route('admin.statistics') }}"
   class="{{ request()->routeIs('admin.statistics') ? 'active' : '' }}">

    <i class="bi bi-bar-chart-fill"></i>

    <span>Statistiques</span>

</a>

@endif


{{-- ========================= --}}
{{-- MENU AGENT --}}
{{-- ========================= --}}

@if(Auth::user()->isAgent())

<a href="{{ route('agent.dashboard') }}"
   class="{{ request()->routeIs('agent.dashboard') ? 'active' : '' }}">

    <i class="bi bi-speedometer2"></i>

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

    <span>Carte interactive</span>

</a>

@endif


{{-- ========================= --}}
{{-- MENU CITOYEN --}}
{{-- ========================= --}}

@if(Auth::user()->isCitoyen())

<a href="{{ route('citizen.dashboard') }}"
   class="{{ request()->routeIs('citizen.dashboard') ? 'active' : '' }}">

    <i class="bi bi-speedometer2"></i>

    <span>Tableau de bord</span>

</a>

<a href="{{ route('incidents.index') }}"
   class="{{ request()->routeIs('incidents.index') ? 'active' : '' }}">

    <i class="bi bi-folder2-open"></i>

    <span>Mes incidents</span>

</a>

<a href="{{ route('incidents.create') }}"
   class="{{ request()->routeIs('incidents.create') ? 'active' : '' }}">

    <i class="bi bi-plus-circle-fill"></i>

    <span>Signaler un incident</span>

</a>

<a href="{{ route('incidents.map') }}"
   class="{{ request()->routeIs('incidents.map') ? 'active' : '' }}">

    <i class="bi bi-map-fill"></i>

    <span>Carte interactive</span>

</a>

@endif


<hr class="text-white opacity-25 my-4">

<a href="{{ route('profile.edit') }}"
   class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">

    <i class="bi bi-person-circle"></i>

    <span>Mon profil</span>

</a>

</div>

<div class="logout">

<form action="{{ route('logout') }}" method="POST">

@csrf

<button type="submit">

<i class="bi bi-box-arrow-right me-2"></i>

Déconnexion

</button>

</form>

</div>

</div>

<div class="main">

<div class="topbar">
    <div class="search-box">

    <i class="bi bi-search"></i>

    <input
        type="text"
        placeholder="Rechercher un utilisateur, un incident...">

</div>

<div class="user-area">

    <div class="notification">

        <i class="bi bi-bell-fill"></i>

        <span class="badge">

            3

        </span>

    </div>

    <div class="user-card">

        <div class="user-info">

            <strong>

                {{ Auth::user()->name }}

            </strong>

            <small>

                @if(Auth::user()->isAdministrateur())

                    Administrateur

                @elseif(Auth::user()->isAgent())

                    Agent

                @else

                    Citoyen

                @endif

            </small>

        </div>

        <div class="avatar">

            {{ strtoupper(substr(Auth::user()->name,0,1)) }}

        </div>

    </div>

</div>

</div>

<div class="content">

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show shadow-sm border-0">

    <i class="bi bi-check-circle-fill me-2"></i>

    {{ session('success') }}

    <button
        class="btn-close"
        data-bs-dismiss="alert">
    </button>

</div>

@endif

@if(session('error'))

<div class="alert alert-danger alert-dismissible fade show shadow-sm border-0">

    <i class="bi bi-exclamation-triangle-fill me-2"></i>

    {{ session('error') }}

    <button
        class="btn-close"
        data-bs-dismiss="alert">
    </button>

</div>

@endif

@if($errors->any())

<div class="alert alert-warning shadow-sm border-0">

    <strong>

        <i class="bi bi-exclamation-circle-fill me-2"></i>

        Des erreurs ont été détectées :

    </strong>

    <ul class="mb-0 mt-2">

        @foreach($errors->all() as $error)

            <li>

                {{ $error }}

            </li>

        @endforeach

    </ul>

</div>

@endif

@if(isset($title))

<h2 class="page-title">

    {{ $title }}

</h2>

@endif

@yield('content')

</div>

<div class="footer">

    © {{ date('Y') }}

    <strong>

        CivicPulse AI

    </strong>

    — Plateforme intelligente de gestion des incidents urbains.

</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<script>

/* ===========================
   MENU ACTIF
=========================== */

document.addEventListener('DOMContentLoaded', function () {

    const currentUrl = window.location.href;

    document.querySelectorAll('.menu a').forEach(link => {

        if(link.href === currentUrl){

            link.classList.add('active');

        }

    });

});


/* ===========================
   DISPARITION AUTO DES ALERTES
=========================== */

setTimeout(() => {

    document.querySelectorAll('.alert').forEach(alert => {

        const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);

        bsAlert.close();

    });

},5000);


/* ===========================
   TOOLTIP BOOTSTRAP
=========================== */

const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));

tooltipTriggerList.map(function (tooltipTriggerEl) {

    return new bootstrap.Tooltip(tooltipTriggerEl);

});


/* ===========================
   SIDEBAR MOBILE
=========================== */

function toggleSidebar(){

    document.querySelector('.sidebar').classList.toggle('show');

}


/* ===========================
   ANIMATION DES CARTES
=========================== */

const cards = document.querySelectorAll('.card');

const observer = new IntersectionObserver(entries=>{

    entries.forEach(entry=>{

        if(entry.isIntersecting){

            entry.target.animate(

                [

                    {

                        opacity:0,

                        transform:'translateY(20px)'

                    },

                    {

                        opacity:1,

                        transform:'translateY(0)'

                    }

                ],

                {

                    duration:500,

                    fill:'forwards'

                }

            );

        }

    });

});

cards.forEach(card=>{

    observer.observe(card);

});


/* ===========================
   BADGE NOTIFICATION
=========================== */

const badge=document.querySelector('.notification .badge');

if(badge){

    const total=parseInt(badge.innerText);

    if(total===0){

        badge.style.display='none';

    }

}


/* ===========================
   HEURE DANS LA TOPBAR
=========================== */

function updateClock(){

    const clock=document.getElementById('clock');

    if(clock){

        const now=new Date();

        clock.innerHTML=now.toLocaleTimeString('fr-FR');

    }

}

setInterval(updateClock,1000);

updateClock();

</script>

</body>

</html>
{{-- ===========================
     MENU UTILISATEURS
     (Visible uniquement si la route existe)
=========================== --}}

@if(Auth::user()->isAdministrateur())

    @if(Route::has('users.index'))

        <script>

            document.addEventListener("DOMContentLoaded",function(){

                const menu=document.querySelector(".menu");

                if(menu){

                    const a=document.createElement("a");

                    a.href="{{ route('users.index') }}";

                    a.className="{{ request()->routeIs('users.*') ? 'active' : '' }}";

                    a.innerHTML=`
                        <i class="bi bi-people-fill"></i>
                        <span>Utilisateurs</span>
                    `;

                    const dashboard=menu.querySelector("a");

                    if(dashboard){

                        dashboard.insertAdjacentElement("afterend",a);

                    }

                }

            });

        </script>

    @endif

@endif


{{-- ===========================
     BOUTON MOBILE
=========================== --}}

<button
    class="btn btn-success d-lg-none position-fixed"
    onclick="toggleSidebar()"
    style="
        left:15px;
        top:15px;
        z-index:1200;
        border-radius:12px;
        width:48px;
        height:48px;
    ">

    <i class="bi bi-list fs-5"></i>

</button>


{{-- ===========================
     HORLOGE
=========================== --}}

<script>

document.addEventListener("DOMContentLoaded",()=>{

    const zone=document.querySelector(".user-area");

    if(zone){

        const div=document.createElement("div");

        div.id="clock";

        div.style.fontWeight="600";

        div.style.color="#198754";

        div.style.marginRight="15px";

        zone.prepend(div);

    }

});

</script>


{{-- ===========================
     FOOTER
=========================== --}}

<script>

console.log("%cCivicPulse AI","font-size:20px;color:#198754;font-weight:bold");

console.log("Layout version 2.0");

</script>
