<?php

namespace App\Notifications;

use App\Models\Incident;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class IncidentStatusUpdated extends Notification
{
    use Queueable;

    public function __construct(
        public Incident $incident
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'incident_status_updated',
            'title' => 'Mise à jour de votre incident',
            'message' => "Le statut de votre incident « {$this->incident->titre} » est maintenant : {$this->incident->statut}.",
            'incident_id' => $this->incident->id,
            'statut' => $this->incident->statut,
            'url' => route('incidents.show', $this->incident),
        ];
    }
}