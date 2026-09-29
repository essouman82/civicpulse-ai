<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use Illuminate\Http\Request;
use App\Services\IncidentAIService;
use App\Notifications\IncidentStatusUpdated;

class IncidentController extends Controller
{
    protected IncidentAIService $ai;

    public function __construct(IncidentAIService $ai)
    {
        $this->ai = $ai;
    }

    /**
     * Liste des incidents
     */
    public function index(Request $request)
{
   $query = Incident::with('user')->latest();

// Le citoyen ne voit que ses propres incidents
if (auth()->user()->role === 'citoyen') {
    $query->where('user_id', auth()->id());
}


    // Recherche
    if ($request->filled('recherche')) {
        $recherche = $request->recherche;

        $query->where(function ($q) use ($recherche) {
            $q->where('titre', 'like', '%' . $recherche . '%')
                ->orWhere('description', 'like', '%' . $recherche . '%')
                ->orWhere('categorie', 'like', '%' . $recherche . '%')
                ->orWhere('service', 'like', '%' . $recherche . '%');
        });
    }

    // Catégorie
    if ($request->filled('categorie')) {
        $query->where('categorie', $request->categorie);
    }

    // Priorité
    if ($request->filled('priorite')) {
        $query->where('priorite', $request->priorite);
    }

    // Statut
    if ($request->filled('statut')) {
        $query->where('statut', $request->statut);
    }

    $incidents = $query
        ->paginate(10)
        ->withQueryString();

    $total = Incident::count();

    $signales = Incident::where('statut', 'Signalé')->count();

    $encours = Incident::where('statut', 'En cours')->count();

    $resolus = Incident::where('statut', 'Résolu')->count();

    $critiques = Incident::where('priorite', 'Critique')->count();

    return view('incidents.index', compact(
        'incidents',
        'total',
        'signales',
        'encours',
        'resolus',
        'critiques'
    ));
}
    /**
     * Formulaire de création
     */
    public function create()
    {
        return view('incidents.create');
    }

    /**
     * Enregistrer un nouvel incident
     */
/**
 * Enregistrer un nouvel incident
 */
public function store(Request $request)
{
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'categorie' => 'nullable|string|max:255',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
    ]);

    // =====================================================
    // ANALYSE IA
    // =====================================================

    $analyse = $this->ai->analyser(
        $validated['titre'],
        $validated['description'],
        $validated['categorie'] ?? null
    );

    // =====================================================
    // PHOTO
    // =====================================================

    $photo = null;

    if ($request->hasFile('photo')) {
        $photo = $request->file('photo')->store('incidents', 'public');
    }

    // =====================================================
    // CRÉATION DE L'INCIDENT
    // =====================================================

    Incident::create([
        'user_id' => auth()->id(),
        'titre' => $validated['titre'],
        'description' => $validated['description'],

        'categorie' => $analyse['categorie'],
        'priorite' => $analyse['priorite'],
        'service' => $analyse['service'],

        'score_ia' => $analyse['score_ia'],
        'explication_ia' => $analyse['explication_ia'],

        'latitude' => $validated['latitude'] ?? null,
        'longitude' => $validated['longitude'] ?? null,

        'photo' => $photo,

        'statut' => 'Signalé',
    ]);

    return redirect()
        ->route('incidents.index')
        ->with(
            'success',
            'Incident signalé avec succès. Notre système IA a analysé automatiquement le signalement.'
        );
}
        /**
     * Afficher un incident
     */
   public function show(Incident $incident)
{
    if (
        auth()->user()->isCitoyen() &&
        $incident->user_id !== auth()->id()
    ) {
        abort(403, 'Vous n\'êtes pas autorisé à consulter cet incident.');
    }

    $incident->load([
        'user',
        'interventions'
    ]);

    return view(
        'incidents.show',
        compact('incident')
    );
}


/**
 * Formulaire de modification
 */
public function edit(Incident $incident)
{
    if (
        auth()->user()->isCitoyen() &&
        $incident->user_id !== auth()->id()
    ) {
        abort(403, 'Vous n\'êtes pas autorisé à modifier cet incident.');
    }

    return view(
        'incidents.edit',
        compact('incident')
    );
}


/**
 * Mise à jour d'un incident
 */
public function update(Request $request, Incident $incident)
{
    if (
        auth()->user()->isCitoyen() &&
        $incident->user_id !== auth()->id()
    ) {
        abort(403, 'Vous n\'êtes pas autorisé à modifier cet incident.');
    }

    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'categorie' => 'required|string|max:255',
        'priorite' => 'required|in:Faible,Moyenne,Élevée,Critique',
        'service' => 'nullable|string|max:255',
        'statut' => 'required|in:Signalé,En cours,Résolu',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
    ]);

    // On mémorise l'ancien statut avant la modification
    $ancienStatut = $incident->statut;

    // Mise à jour
    $incident->update($validated);

    // Notification uniquement si le statut a réellement changé
    if (
        $ancienStatut !== $incident->statut &&
        $incident->user
    ) {
        $incident->user->notify(
            new IncidentStatusUpdated($incident)
        );
    }

    return redirect()
        ->route('incidents.show', $incident)
        ->with(
            'success',
            'Incident mis à jour avec succès.'
        );
}
    /**
     * Suppression
     */
    public function destroy(Incident $incident)
{
    $this->authorize('delete', $incident);

    $incident->delete();

    return redirect()
        ->route('incidents.index')
        ->with(
            'success',
            'Incident supprimé avec succès.'
        );
}

    /**
 * Carte interactive
 */
public function map()
{
    $incidents = Incident::whereNotNull('latitude')
        ->whereNotNull('longitude')
        ->latest()
        ->get();

    return view(
        'incidents.map',
        compact('incidents')
    );
}
    
}