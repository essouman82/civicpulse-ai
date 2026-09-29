@extends('layouts.app')

@section('content')

<div class="container-fluid py-3">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-bell me-2 text-success"></i>
                Notifications
            </h2>

            <p class="text-muted mb-0">
                Consultez les dernières mises à jour de vos signalements.
            </p>
        </div>

        @if(auth()->user()->unreadNotifications->count() > 0)
            <form action="{{ route('notifications.readAll') }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-outline-success rounded-pill">
                    <i class="bi bi-check2-all me-1"></i>
                    Tout marquer comme lu
                </button>
            </form>
        @endif
    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            @forelse($notifications as $notification)

                @php
                    $data = $notification->data;
                    $isUnread = is_null($notification->read_at);
                @endphp

                <a href="{{ route('notifications.read', $notification->id) }}"
                   class="text-decoration-none text-dark d-block">

                    <div class="notification-item
                        {{ $isUnread ? 'notification-unread' : '' }}">

                        <div class="notification-icon">
                            <i class="bi bi-bell-fill"></i>
                        </div>

                        <div class="notification-content">

                            <div class="d-flex justify-content-between gap-3">

                                <div>
                                    <h6 class="fw-bold mb-1">
                                        {{ $data['title'] ?? 'Notification' }}

                                        @if($isUnread)
                                            <span class="notification-dot"></span>
                                        @endif
                                    </h6>

                                    <p class="text-muted mb-1">
                                        {{ $data['message'] ?? '' }}
                                    </p>
                                </div>

                                <small class="text-muted text-nowrap">
                                    {{ $notification->created_at?->diffForHumans() }}
                                </small>

                            </div>

                            @if(isset($data['statut']))
                                <span class="badge rounded-pill
                                    @if($data['statut'] === 'Signalé')
                                        bg-danger
                                    @elseif($data['statut'] === 'En cours')
                                        bg-warning text-dark
                                    @elseif($data['statut'] === 'Résolu')
                                        bg-success
                                    @else
                                        bg-secondary
                                    @endif
                                ">
                                    {{ $data['statut'] }}
                                </span>
                            @endif

                        </div>

                    </div>

                </a>

            @empty

                <div class="text-center py-5 px-3">

                    <div class="notification-empty-icon mb-3">
                        <i class="bi bi-bell-slash"></i>
                    </div>

                    <h5 class="fw-bold">
                        Aucune notification
                    </h5>

                    <p class="text-muted mb-0">
                        Vous êtes à jour. Les nouvelles notifications apparaîtront ici.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

    <div class="mt-4">
        {{ $notifications->links('pagination::bootstrap-5') }}
    </div>

</div>

<style>
    .notification-item {
        display: flex;
        gap: 15px;
        padding: 18px 20px;
        border-bottom: 1px solid #edf1ef;
        transition: background .2s ease;
    }

    .notification-item:hover {
        background: #f8fbfa;
    }

    .notification-unread {
        background: #eefaf5;
    }

    .notification-icon {
        flex: 0 0 44px;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #dff5eb;
        color: #087f5b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .notification-content {
        flex: 1;
        min-width: 0;
    }

    .notification-dot {
        display: inline-block;
        width: 8px;
        height: 8px;
        margin-left: 5px;
        border-radius: 50%;
        background: #dc3545;
        vertical-align: middle;
    }

    .notification-empty-icon {
        width: 70px;
        height: 70px;
        margin: auto;
        border-radius: 50%;
        background: #e8f7f1;
        color: #087f5b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
    }

    @media (max-width: 576px) {
        .notification-item {
            padding: 15px;
            gap: 12px;
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            flex-basis: 40px;
            font-size: 16px;
        }

        .notification-item .d-flex {
            display: block !important;
        }

        .notification-item small {
            display: block;
            margin-top: 5px;
        }

        .container-fluid > .d-flex {
            align-items: flex-start !important;
            gap: 12px;
        }

        .container-fluid > .d-flex h2 {
            font-size: 20px;
        }

        .container-fluid > .d-flex p {
            font-size: 12px;
        }

        .container-fluid > .d-flex form {
            flex-shrink: 0;
        }

        .container-fluid > .d-flex button {
            font-size: 0;
            width: 42px;
            height: 42px;
            padding: 0;
        }

        .container-fluid > .d-flex button i {
            font-size: 17px;
            margin: 0 !important;
        }
    }
</style>

@endsection