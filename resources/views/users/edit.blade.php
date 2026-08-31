@extends('layouts.app')

@section('title', 'Modifier un utilisateur')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header">
            <h3>Modifier un utilisateur</h3>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('users.update', $user) }}">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Nom</label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $user->name) }}"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Email</label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $user->email) }}"
                            required>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Rôle</label>

                        <select
                            name="role"
                            class="form-select"
                            required>

                            <option value="administrateur"
                                {{ $user->role == 'administrateur' ? 'selected' : '' }}>
                                Administrateur
                            </option>

                            <option value="agent"
                                {{ $user->role == 'agent' ? 'selected' : '' }}>
                                Agent
                            </option>

                            <option value="citoyen"
                                {{ $user->role == 'citoyen' ? 'selected' : '' }}>
                                Citoyen
                            </option>

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Nouveau mot de passe (facultatif)</label>

                        <input
                            type="password"
                            name="password"
                            class="form-control">

                    </div>

                    <div class="col-md-6 mb-4">

                        <label>Confirmer le mot de passe</label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control">

                    </div>

                </div>

                <button class="btn btn-success">
                    Enregistrer les modifications
                </button>

                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    Annuler
                </a>

            </form>

        </div>

    </div>

</div>

@endsection