<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\Incident;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    /**
     * Liste des interventions
     */
    public function index()
    {
        $interventions = Intervention::with('incident')
            ->latest()
            ->get();

        return view('interventions.index', compact('interventions'));
    }


    /**
     * Formulaire de création
     */
    public function create()
    {
        $incidents = Incident::where('statut', '!=', 'Résolu')->get();

        return view('interventions.create', compact('incidents'));
    }


    /**
     * Enregistrer une intervention
     */
    public function store(Request $request)
    {
        $request->validate([
            'incident_id' => 'required|exists:incidents,id',
            'agent' => 'required|max:255',
            'description' => 'required',
            'date_intervention' => 'required|date',
        ]);

        // Création de l'intervention
        $intervention = Intervention::create([
            'incident_id' => $request->incident_id,
            'agent' => $request->agent,
            'description' => $request->description,
            'date_intervention' => $request->date_intervention,
            'statut' => 'En cours',
        ]);

        // L'incident passe automatiquement à "En cours"
        $incident = Incident::find($request->incident_id);

        if ($incident) {
            $incident->update([
                'statut' => 'En cours'
            ]);
        }

        return redirect()
            ->route('interventions.index')
            ->with('success', 'Intervention enregistrée avec succès.');
    }


    /**
     * Affichage d'une intervention
     */
    public function show(Intervention $intervention)
    {
        $intervention->load('incident');

        return view('interventions.show', compact('intervention'));
    }


    /**
     * Formulaire de modification
     */
    public function edit(Intervention $intervention)
    {
        $incidents = Incident::all();

        return view('interventions.edit', compact(
            'intervention',
            'incidents'
        ));
    }


    /**
     * Mise à jour d'une intervention
     */
    public function update(Request $request, Intervention $intervention)
    {
        $request->validate([
            'agent' => 'required|max:255',
            'description' => 'required',
            'date_intervention' => 'required|date',
            'statut' => 'required|in:En cours,Terminée,Annulée',
        ]);

        // Mise à jour de l'intervention
        $intervention->update([
            'agent' => $request->agent,
            'description' => $request->description,
            'date_intervention' => $request->date_intervention,
            'statut' => $request->statut,
        ]);


        // =====================================================
        // SYNCHRONISATION AVEC L'INCIDENT
        // =====================================================

        $incident = $intervention->incident;

        if ($incident) {

            if ($request->statut === 'Terminée') {

                // Intervention terminée
                // => Incident résolu
                $incident->update([
                    'statut' => 'Résolu'
                ]);

            } elseif ($request->statut === 'En cours') {

                // Intervention en cours
                // => Incident en cours
                $incident->update([
                    'statut' => 'En cours'
                ]);

            } elseif ($request->statut === 'Annulée') {

                // Intervention annulée
                // On remet l'incident en "Signalé"
                $incident->update([
                    'statut' => 'Signalé'
                ]);
            }
        }


        return redirect()
            ->route('interventions.index')
            ->with(
                'success',
                'Intervention modifiée et statut de l’incident mis à jour.'
            );
    }


    /**
     * Suppression d'une intervention
     */
    public function destroy(Intervention $intervention)
    {
        $incident = $intervention->incident;

        $intervention->delete();

        // Si l'intervention est supprimée,
        // l'incident retourne à "Signalé"
        if ($incident && $incident->statut !== 'Résolu') {

            $incident->update([
                'statut' => 'Signalé'
            ]);
        }

        return redirect()
            ->route('interventions.index')
            ->with(
                'success',
                'Intervention supprimée avec succès.'
            );
    }
}