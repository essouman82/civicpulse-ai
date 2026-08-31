<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use App\Models\Intervention;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        // ==========================
        // STATISTIQUES GENERALES
        // ==========================

        $totalUsers = User::count();

        $totalIncidents = Incident::count();

        $totalInterventions = Intervention::count();

        // ==========================
        // INCIDENTS PAR CATEGORIE
        // ==========================

        $incidentsParCategorie = Incident::select(
            'categorie',
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('categorie')
        ->orderByDesc('total')
        ->get();

        // ==========================
        // INCIDENTS PAR STATUT
        // ==========================

        $incidentsParStatut = Incident::select(
            'statut',
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('statut')
        ->orderByDesc('total')
        ->get();

        // ==========================
        // INCIDENTS PAR PRIORITE
        // ==========================

        $incidentsParPriorite = Incident::select(
            'priorite',
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('priorite')
        ->orderByDesc('total')
        ->get();

        // ==========================
        // INCIDENTS PAR SERVICE
        // ==========================

        $incidentsParService = Incident::select(
            'service',
            DB::raw('COUNT(*) as total')
        )
        ->whereNotNull('service')
        ->groupBy('service')
        ->orderByDesc('total')
        ->get();

        // ==========================
        // INCIDENTS DES 7 DERNIERS JOURS
        // ==========================

        $incidentsRecents = Incident::where(
            'created_at',
            '>=',
            now()->subDays(7)
        )->count();

        // ==========================
        // INCIDENTS CRITIQUES
        // ==========================

        $incidentsCritiques = Incident::where(
            'priorite',
            'Critique'
        )->count();

        // ==========================
        // SCORE IA MOYEN
        // ==========================

        $scoreIAMoyen = round(
            Incident::whereNotNull('score_ia')->avg('score_ia') ?? 0,
            0
        );

        // ==========================
        // DONNEES POUR LES GRAPHIQUES
        // ==========================

        $evolutionIncidents = Incident::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total')
        )
        ->where(
            'created_at',
            '>=',
            now()->subDays(7)
        )
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('date')
        ->get();

        return view(
            'dashboard.admin.statistics',
            compact(
                'totalUsers',
                'totalIncidents',
                'totalInterventions',
                'incidentsParCategorie',
                'incidentsParStatut',
                'incidentsParPriorite',
                'incidentsParService',
                'incidentsRecents',
                'incidentsCritiques',
                'scoreIAMoyen',
                'evolutionIncidents'
            )
        );
    }
}