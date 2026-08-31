@extends('layouts.app')

@section('title','Mon profil')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4 fw-bold">
        Mon profil
    </h2>

    <div class="row">

        <div class="col-lg-8">

            <div class="card shadow-sm mb-4">

                <div class="card-header">
                    Informations personnelles
                </div>

                <div class="card-body">

                    @include('profile.partials.update-profile-information-form')

                </div>

            </div>

            <div class="card shadow-sm mb-4">

                <div class="card-header">
                    Modifier le mot de passe
                </div>

                <div class="card-body">

                    @include('profile.partials.update-password-form')

                </div>

            </div>

            <div class="card shadow-sm border-danger">

                <div class="card-header bg-danger text-white">
                    Zone dangereuse
                </div>

                <div class="card-body">

                    @include('profile.partials.delete-user-form')

                </div>

            </div>

        </div>

    </div>

</div>

@endsection