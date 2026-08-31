<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Incident;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.agent.index', [
            'totalIncidents' => Incident::count(),
            'aTraiter' => Incident::where('statut', 'Signalé')->count(),
            'enCours' => Incident::where('statut', 'En cours')->count(),
            'resolus' => Incident::where('statut', 'Résolu')->count(),
            'incidents' => Incident::latest()->take(10)->get(),
        ]);
    }
}