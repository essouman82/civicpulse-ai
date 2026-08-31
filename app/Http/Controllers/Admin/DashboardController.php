<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use App\Models\Intervention;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ==========================
        // UTILISATEURS
        // ==========================

        $totalUsers = User::count();

        $administrateurs = User::where('role', 'administrateur')->count();

        $agents = User::where('role', 'agent')->count();

        $citoyens = User::where('role', 'citoyen')->count();


        // ==========================
        // INCIDENTS
        // ==========================

        $totalIncidents = Incident::count();

        $nouveaux = Incident::where('statut', 'Signalé')->count();

        $enCours = Incident::where('statut', 'En cours')->count();

        $resolus = Incident::where('statut', 'Résolu')->count();

        $critiques = Incident::where('priorite', 'Critique')->count();


        // ==========================
        // INTERVENTIONS
        // ==========================

        $totalInterventions = Intervention::count();


        // ==========================
        // DERNIERS INCIDENTS
        // ==========================

        $derniersIncidents = Incident::latest()
            ->take(5)
            ->get();


        // ==========================
        // INCIDENTS CRITIQUES
        // ==========================

        $incidentsCritiques = Incident::where('priorite', 'Critique')
            ->latest()
            ->take(5)
            ->get();


        // ==========================
        // REPARTITION PAR CATEGORIE
        // ==========================

        $categories = Incident::select(
                'categorie',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('categorie')
            ->get();


        // ==========================
        // REPARTITION PAR STATUT
        // ==========================

        $statuts = Incident::select(
                'statut',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('statut')
            ->get();


        // ==========================
        // REPARTITION PAR PRIORITE
        // ==========================

        $priorites = Incident::select(
                'priorite',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('priorite')
            ->get();


        // ==========================
        // SCORE IA
        // ==========================

        $scoreIAMoyen = round(
            Incident::avg('score_ia'),
            0
        );


        // ==========================
        // ANALYSE INTELLIGENTE
        // ==========================

        // Service le plus sollicité

        $servicePrincipal = Incident::select(
                'service',
                DB::raw('COUNT(*) as total')
            )
            ->whereNotNull('service')
            ->groupBy('service')
            ->orderByDesc('total')
            ->first();

        $servicePrincipalNom = $servicePrincipal
            ? $servicePrincipal->service
            : 'Aucun service';

        $servicePrincipalTotal = $servicePrincipal
            ? $servicePrincipal->total
            : 0;


        // ==========================
        // PRIORITE PRINCIPALE
        // ==========================

        $prioritePrincipale = Incident::select(
                'priorite',
                DB::raw('COUNT(*) as total')
            )
            ->whereNotNull('priorite')
            ->groupBy('priorite')
            ->orderByDesc('total')
            ->first();

        $prioritePrincipaleNom = $prioritePrincipale
            ? $prioritePrincipale->priorite
            : 'Aucune';


        // ==========================
        // INCIDENTS DES 7 DERNIERS JOURS
        // ==========================

        $incidentsRecents = Incident::where(
                'created_at',
                '>=',
                now()->subDays(7)
            )
            ->count();


        // ==========================
        // RECOMMANDATION IA
        // ==========================

        if ($critiques > 0) {

            $recommandationIA =
                'Attention : plusieurs incidents critiques sont actuellement enregistrés. '
                . 'Il est recommandé de prioriser leur traitement et de mobiliser rapidement '
                . 'les équipes d’intervention concernées.';

        } elseif ($servicePrincipalTotal >= 3) {

            $recommandationIA =
                'Le service '
                . $servicePrincipalNom
                . ' concentre actuellement le plus grand nombre d’incidents. '
                . 'Il serait pertinent de renforcer temporairement ses capacités d’intervention.';

        } elseif ($totalIncidents > 0) {

            $recommandationIA =
                'Les incidents actuellement enregistrés restent sous surveillance. '
                . 'Un traitement régulier permettra d’éviter leur accumulation.';

        } else {

            $recommandationIA =
                'Aucun incident n’est actuellement enregistré. '
                . 'CivicPulse AI continuera de surveiller la situation urbaine.';

        }


        // ==========================
        // INCIDENTS POUR LA CARTE
        // ==========================

        $incidentsCarte = Incident::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();


        // ==========================
        // ENVOI DES DONNEES A LA VUE
        // ==========================

        return view(
            'dashboard.admin.index',
            compact(

                'totalUsers',
                'administrateurs',
                'agents',
                'citoyens',

                'totalIncidents',
                'nouveaux',
                'enCours',
                'resolus',
                'critiques',

                'totalInterventions',

                'derniersIncidents',

                'incidentsCritiques',

                'categories',

                'statuts',

                'priorites',

                'scoreIAMoyen',

                'incidentsCarte',

                'servicePrincipalNom',

                'servicePrincipalTotal',

                'prioritePrincipaleNom',

                'incidentsRecents',

                'recommandationIA'

            )
        );
    }
}