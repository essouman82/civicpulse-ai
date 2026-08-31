@extends('layouts.app')

@section('title', 'Gestion des utilisateurs')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">Gestion des utilisateurs</h2>
            <p class="text-muted">
                {{ $users->total() }} utilisateur(s) enregistré(s)
            </p>
        </div>

        <a href="{{ route('users.create') }}" class="btn btn-success">
            <i class="bi bi-person-plus-fill"></i>
            Ajouter un utilisateur
        </a>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form method="GET" action="{{ route('users.index') }}" class="mb-4">

                <div class="input-group">

                    <input
                        type="text"
                        class="form-control"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Rechercher un utilisateur...">

                    <button class="btn btn-primary">

                        <i class="bi bi-search"></i>

                    </button>

                </div>

            </form>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>#</th>

                            <th>Nom</th>

                            <th>Email</th>

                            <th>Rôle</th>

                            <th>Date</th>

                            <th width="150">Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($users as $user)

                        <tr>

                            <td>{{ $user->id }}</td>

                            <td>{{ $user->name }}</td>

                            <td>{{ $user->email }}</td>

                            <td>

                                @if($user->role == 'administrateur')
                                    <span class="badge bg-danger">
                                        Administrateur
                                    </span>

                                @elseif($user->role == 'agent')

                                    <span class="badge bg-primary">
                                        Agent
                                    </span>

                                @else

                                    <span class="badge bg-success">
                                        Citoyen
                                    </span>

                                @endif

                            </td>

                            <td>

                                {{ $user->created_at->format('d/m/Y') }}

                            </td>

                            <td>

                                <a
                                    href="{{ route('users.edit', $user) }}"
                                    class="btn btn-warning btn-sm">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                <form
                                    action="{{ route('users.destroy', $user) }}"
                                    method="POST"
                                    class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Voulez-vous vraiment Supprimer cet utilisateur ?')">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6" class="text-center">

                                Aucun utilisateur trouvé.

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">

                {{ $users->links() }}

            </div>

        </div>

    </div>

</div>

@endsection