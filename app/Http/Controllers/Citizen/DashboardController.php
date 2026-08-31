<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use App\Models\Incident;

class DashboardController extends Controller
{
    public function index()
    {
        $incidents = Incident::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('dashboard.citizen.index', [
            'totalIncidents' => $incidents->count(),
            'signales' => $incidents->where('statut', 'Signalé')->count(),
            'encours' => $incidents->where('statut', 'En cours')->count(),
            'resolus' => $incidents->where('statut', 'Résolu')->count(),
            'incidents' => $incidents,
        ]);
    }
}