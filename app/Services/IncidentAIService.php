<?php

namespace App\Services;

class IncidentAIService
{
    /**
     * Analyse automatiquement un incident.
     */
    public function analyser(string $titre, string $description, ?string $categorie = null): array
    {
        $texte = strtolower(
            $titre . ' ' . $description
        );

        // =====================================================
        // CATÉGORIE
        // =====================================================

        $categorieIA = $categorie ?: 'Autre';

        if (
            $this->contient($texte, [
                'route',
                'nid de poule',
                'nid-de-poule',
                'chaussée',
                'route cassée',
                'trou',
                'trottoir',
                'pont'
            ])
        ) {
            $categorieIA = 'Route';

        } elseif (
            $this->contient($texte, [
                'lampadaire',
                'éclairage',
                'eclairage',
                'lumière',
                'lumiere',
                'électrique',
                'electrique'
            ])
        ) {
            $categorieIA = 'Éclairage public';

        } elseif (
            $this->contient($texte, [
                'ordure',
                'ordures',
                'déchet',
                'déchets',
                'dechet',
                'poubelle',
                'insalubre'
            ])
        ) {
            $categorieIA = 'Déchets';

        } elseif (
            $this->contient($texte, [
                'inondation',
                'inondé',
                'inonde',
                'eau',
                'fuite',
                'canalisation',
                'égout',
                'egout'
            ])
        ) {
            $categorieIA = 'Inondation';
        }


        // =====================================================
        // PRIORITÉ
        // =====================================================

        $priorite = 'Faible';

        if (
            $this->contient($texte, [
                'mort',
                'décès',
                'deces',
                'accident grave',
                'danger immédiat',
                'danger immediat',
                'urgence',
                'incendie',
                'effondrement',
                'bloque complètement',
                'bloqué complètement',
                'bloque completement'
            ])
        ) {
            $priorite = 'Critique';

        } elseif (
            $this->contient($texte, [
                'grave',
                'important',
                'dangereux',
                'danger',
                'forte fuite',
                'grosse fuite',
                'route impraticable',
                'circulation bloquée',
                'circulation bloquee'
            ])
        ) {
            $priorite = 'Élevée';

        } elseif (
            $this->contient($texte, [
                'panne',
                'cassé',
                'casse',
                'problème',
                'probleme',
                'fuite',
                'dégradation',
                'degradation'
            ])
        ) {
            $priorite = 'Moyenne';
        }


        // =====================================================
        // SERVICE COMPÉTENT
        // =====================================================

        $service = 'Services municipaux';

        if ($categorieIA === 'Route') {

            $service = 'Service de la voirie';

        } elseif ($categorieIA === 'Éclairage public') {

            $service = 'Service de l’éclairage public';

        } elseif ($categorieIA === 'Déchets') {

            $service = 'Service de propreté urbaine';

        } elseif ($categorieIA === 'Inondation') {

            $service = 'Service des eaux et assainissement';
        }


        // =====================================================
        // SCORE DE CONFIANCE
        // =====================================================

        $score = 70;

        if ($categorie) {
            $score += 10;
        }

        if ($priorite === 'Critique') {
            $score += 10;
        }

        if (strlen(trim($description)) >= 80) {
            $score += 5;
        }

        if (strlen(trim($titre)) >= 10) {
            $score += 5;
        }

        $score = min($score, 99);


        // =====================================================
        // RECOMMANDATION
        // =====================================================

        $recommandation = $this->genererRecommandation(
            $priorite,
            $categorieIA,
            $service
        );


        return [
            'categorie' => $categorieIA,
            'priorite' => $priorite,
            'service' => $service,
            'score_ia' => $score,
            'explication_ia' => $recommandation,
        ];
    }


    /**
     * Vérifie si le texte contient un des mots recherchés.
     */
    private function contient(string $texte, array $mots): bool
    {
        foreach ($mots as $mot) {

            if (str_contains($texte, strtolower($mot))) {
                return true;
            }
        }

        return false;
    }


    /**
     * Génère une recommandation automatique.
     */
    private function genererRecommandation(
        string $priorite,
        string $categorie,
        string $service
    ): string {

        if ($priorite === 'Critique') {

            return "Intervention urgente recommandée. "
                . "Le signalement présente un niveau de risque élevé "
                . "et doit être traité rapidement par le {$service}.";

        }

        if ($priorite === 'Élevée') {

            return "Une intervention prioritaire est recommandée "
                . "afin de limiter l'aggravation du problème.";

        }

        if ($priorite === 'Moyenne') {

            return "Une intervention doit être planifiée "
                . "dans un délai raisonnable afin d'éviter "
                . "une aggravation de la situation.";

        }

        return "Le signalement peut être surveillé et traité "
            . "selon les priorités opérationnelles du {$service}.";
    }
}