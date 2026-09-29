@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')

<div class="container-fluid py-4">

    {{-- En-tête --}}
    <div class="mb-4">
        <div class="d-flex align-items-center gap-3 mb-2">
            <div
                class="d-flex align-items-center justify-content-center rounded-4"
                style="width: 52px; height: 52px; background: rgba(5, 150, 105, .12); color: #059669;"
            >
                <i class="bi bi-person-fill fs-4"></i>
            </div>

            <div>
                <h2 class="fw-bold mb-1">Mon profil</h2>
                <p class="text-muted mb-0">
                    Gérez vos informations personnelles et la sécurité de votre compte.
                </p>
            </div>
        </div>
    </div>


    {{-- Messages --}}
    @if (session('status'))
        <div class="alert alert-success d-flex align-items-center gap-2 border-0 shadow-sm mb-4">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('status') }}</span>
        </div>
    @endif


    {{-- Erreurs --}}
    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4">
            <div class="fw-semibold mb-2">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Vérifiez les informations saisies.
            </div>

            <ul class="mb-0 ps-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row g-4">

        {{-- Colonne principale --}}
        <div class="col-xl-8">

            {{-- Informations personnelles --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center gap-3 mb-4">

                        <div
                            class="d-flex align-items-center justify-content-center rounded-3"
                            style="width: 44px; height: 44px; background: rgba(5, 150, 105, .10); color: #059669;"
                        >
                            <i class="bi bi-person-vcard fs-5"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">
                                Informations personnelles
                            </h5>

                            <p class="text-muted small mb-0">
                                Modifiez vos informations de compte.
                            </p>
                        </div>

                    </div>


                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        {{-- Nom --}}
                        <div class="mb-3">

                            <label for="name" class="form-label fw-semibold">
                                Nom
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                                required
                                autocomplete="name"
                            >

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Email --}}
                        <div class="mb-4">

                            <label for="email" class="form-label fw-semibold">
                                Adresse e-mail
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                class="form-control form-control-lg rounded-3 @error('email') is-invalid @enderror"
                                required
                                autocomplete="username"
                            >

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <button type="submit" class="btn btn-success px-4 py-2 rounded-3 fw-semibold">
                            <i class="bi bi-check-lg me-2"></i>
                            Enregistrer les modifications
                        </button>

                    </form>

                </div>
            </div>


            {{-- Sécurité --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center gap-3 mb-4">

                        <div
                            class="d-flex align-items-center justify-content-center rounded-3"
                            style="width: 44px; height: 44px; background: rgba(59, 130, 246, .10); color: #2563eb;"
                        >
                            <i class="bi bi-shield-lock fs-5"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1">
                                Sécurité du compte
                            </h5>

                            <p class="text-muted small mb-0">
                                Modifiez votre mot de passe pour protéger votre compte.
                            </p>
                        </div>

                    </div>


                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')


                        {{-- Mot de passe actuel --}}
                        <div class="mb-3">

                            <label for="current_password" class="form-label fw-semibold">
                                Mot de passe actuel
                            </label>

                            <input
                                type="password"
                                id="current_password"
                                name="current_password"
                                class="form-control form-control-lg rounded-3 @error('current_password', 'updatePassword') is-invalid @enderror"
                                autocomplete="current-password"
                                required
                            >

                            @error('current_password', 'updatePassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Nouveau mot de passe --}}
                        <div class="mb-3">

                            <label for="password" class="form-label fw-semibold">
                                Nouveau mot de passe
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control form-control-lg rounded-3 @error('password', 'updatePassword') is-invalid @enderror"
                                autocomplete="new-password"
                                required
                            >

                            @error('password', 'updatePassword')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Confirmation --}}
                        <div class="mb-4">

                            <label for="password_confirmation" class="form-label fw-semibold">
                                Confirmer le nouveau mot de passe
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="form-control form-control-lg rounded-3"
                                autocomplete="new-password"
                                required
                            >

                        </div>


                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 fw-semibold">
                            <i class="bi bi-lock me-2"></i>
                            Modifier le mot de passe
                        </button>

                    </form>

                </div>
            </div>


            {{-- Zone dangereuse --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center gap-3 mb-4">

                        <div
                            class="d-flex align-items-center justify-content-center rounded-3"
                            style="width: 44px; height: 44px; background: rgba(220, 53, 69, .10); color: #dc3545;"
                        >
                            <i class="bi bi-exclamation-triangle fs-5"></i>
                        </div>

                        <div>
                            <h5 class="fw-bold text-danger mb-1">
                                Zone dangereuse
                            </h5>

                            <p class="text-muted small mb-0">
                                La suppression du compte est définitive.
                            </p>
                        </div>

                    </div>


                    <div class="alert alert-danger bg-danger-subtle border-0 rounded-3 mb-4">
                        <i class="bi bi-info-circle me-2"></i>
                        Cette action supprimera définitivement votre compte et vos données associées.
                    </div>


                    <form method="POST"
                          action="{{ route('profile.destroy') }}"
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer définitivement votre compte ?');">

                        @csrf
                        @method('DELETE')

                        <div class="mb-3">

                            <label for="delete_password" class="form-label fw-semibold">
                                Votre mot de passe
                            </label>

                            <input
                                type="password"
                                id="delete_password"
                                name="password"
                                class="form-control form-control-lg rounded-3"
                                placeholder="Entrez votre mot de passe"
                                required
                            >

                        </div>


                        <button type="submit" class="btn btn-outline-danger px-4 py-2 rounded-3 fw-semibold">
                            <i class="bi bi-trash3 me-2"></i>
                            Supprimer définitivement mon compte
                        </button>

                    </form>

                </div>
            </div>

        </div>


        {{-- Colonne latérale --}}
        <div class="col-xl-4">

            {{-- Carte compte --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body p-4 text-center">

                    <div
                        class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle fw-bold text-white"
                        style="width: 80px; height: 80px; background: linear-gradient(135deg, #059669, #047857); font-size: 28px;"
                    >
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <h5 class="fw-bold mb-1">
                        {{ $user->name }}
                    </h5>

                    <p class="text-muted mb-3">
                        {{ $user->email }}
                    </p>

                    <span class="badge rounded-pill bg-success-subtle text-success px-3 py-2">
                        <i class="bi bi-person-check me-1"></i>
                        Citoyen
                    </span>

                </div>

            </div>


            {{-- Sécurité --}}
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <h6 class="fw-bold mb-3">
                        <i class="bi bi-shield-check text-success me-2"></i>
                        Votre sécurité
                    </h6>

                    <div class="d-flex gap-3 mb-3">
                        <i class="bi bi-check-circle-fill text-success"></i>
                        <small class="text-muted">
                            Vos informations sont protégées.
                        </small>
                    </div>

                    <div class="d-flex gap-3 mb-3">
                        <i class="bi bi-check-circle-fill text-success"></i>
                        <small class="text-muted">
                            Vous pouvez modifier votre mot de passe à tout moment.
                        </small>
                    </div>

                    <div class="d-flex gap-3">
                        <i class="bi bi-check-circle-fill text-success"></i>
                        <small class="text-muted">
                            Vous gardez le contrôle de votre compte.
                        </small>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection