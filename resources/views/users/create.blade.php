@extends('layouts.app')

@section('title', 'Ajouter un utilisateur')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">Ajouter un utilisateur</h2>
            <p class="text-muted">
                Créer un nouveau compte administrateur, agent ou citoyen.
            </p>
        </div>

        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Retour
        </a>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form action="{{ route('users.store') }}" method="POST">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nom complet
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Adresse e-mail
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Mot de passe
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Confirmer le mot de passe
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            required>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="form-label">
                            Rôle
                        </label>

                        <select
                            name="role"
                            class="form-select"
                            required>

                            <option value="">Choisir...</option>

                            <option value="administrateur">
                                Administrateur
                            </option>

                            <option value="agent">
                                Agent
                            </option>

                            <option value="citoyen">
                                Citoyen
                            </option>

                        </select>

                    </div>

                </div>

                <button
                    type="submit"
                    class="btn btn-success">

                    <i class="bi bi-person-plus-fill"></i>

                    Créer l'utilisateur

                </button>

            </form>

        </div>

    </div>

</div>

@endsection
