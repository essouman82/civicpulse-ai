<?php

namespace App\Policies;

use App\Models\Incident;
use App\Models\User;

class IncidentPolicy
{
    /**
     * Qui peut consulter la liste des incidents ?
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [
            'administrateur',
            'agent',
            'citoyen',
        ]);
    }

    /**
     * Qui peut consulter un incident précis ?
     */
    public function view(User $user, Incident $incident): bool
    {
        // Administrateur et agent peuvent voir tous les incidents
        if (in_array($user->role, ['administrateur', 'agent'])) {
            return true;
        }

        // Le citoyen ne peut voir que ses propres incidents
        return $user->role === 'citoyen'
            && $incident->user_id === $user->id;
    }

    /**
     * Qui peut créer un incident ?
     */
    public function create(User $user): bool
    {
        return in_array($user->role, [
            'administrateur',
            'agent',
            'citoyen',
        ]);
    }

    /**
     * Qui peut modifier un incident ?
     */
    public function update(User $user, Incident $incident): bool
    {
        // Admin et agent peuvent modifier tous les incidents
        if (in_array($user->role, ['administrateur', 'agent'])) {
            return true;
        }

        // Un citoyen peut modifier uniquement son propre
        // incident tant qu'il n'a pas encore été traité
        return $user->role === 'citoyen'
            && $incident->user_id === $user->id
            && $incident->statut === 'Signalé';
    }

    /**
     * Qui peut supprimer un incident ?
     */
    public function delete(User $user, Incident $incident): bool
    {
        // Seul l'administrateur peut supprimer n'importe quel incident
        if ($user->role === 'administrateur') {
            return true;
        }

        // Le citoyen peut supprimer son propre signalement
        // uniquement lorsqu'il est encore "Signalé"
        return $user->role === 'citoyen'
            && $incident->user_id === $user->id
            && $incident->statut === 'Signalé';
    }
}