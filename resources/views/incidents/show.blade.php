@extends('layouts.app')

@section('title','Analyse IA')

@section('content')

<div class="container-fluid">

<div class="row">

<div class="col-lg-8">

<div class="card shadow-sm mb-4">

<div class="card-header bg-success text-white">

<h4 class="mb-0">

<i class="bi bi-file-earmark-text"></i>

Détails de l'incident

</h4>

</div>

<div class="card-body">

<table class="table">

<tr>

<th width="220">Titre</th>

<td>{{ $incident->titre }}</td>

</tr>

<tr>

<th>Description</th>

<td>{{ $incident->description }}</td>

</tr>

<tr>

<th>Statut</th>

<td>

<span class="badge bg-primary">

{{ $incident->statut }}

</span>

</td>

</tr>

<tr>

<th>Latitude</th>

<td>{{ $incident->latitude }}</td>

</tr>

<tr>

<th>Longitude</th>

<td>{{ $incident->longitude }}</td>

</tr>

</table>

</div>

</div>

</div>

<div class="col-lg-4">

<div class="card border-0 shadow">

<div class="card-header bg-dark text-white">

<h5 class="mb-0">

🧠 Analyse CivicPulse AI

</h5>

</div>

<div class="card-body">

<div class="text-center mb-4">

<h1 class="display-4 text-success">

{{ $incident->score_ia }}%

</h1>

<p class="text-muted">

Confiance de l'IA

</p>

</div>

<hr>

<p>

<strong>Catégorie détectée</strong>

</p>

<span class="badge bg-primary fs-6">

{{ $incident->categorie }}

</span>

<hr>

<p>

<strong>Priorité</strong>

</p>

@if($incident->priorite=="Critique")

<span class="badge bg-danger fs-6">

🔴 Critique

</span>

@elseif($incident->priorite=="Élevée")

<span class="badge bg-warning fs-6">

🟠 Elevée

</span>

@elseif($incident->priorite=="Moyenne")

<span class="badge bg-info fs-6">

🟡 Moyenne

</span>

@else

<span class="badge bg-success fs-6">

🟢 Faible

</span>

@endif

<hr>

<p>

<strong>Service recommandé</strong>

</p>

<span class="badge bg-secondary fs-6">

{{ $incident->service }}

</span>

<hr>

<p>

<strong>Explication de l'IA</strong>

</p>

<div class="alert alert-success">

{{ $incident->explication_ia }}

</div>

<hr>

<p>

<strong>Mots-clés détectés</strong>

</p>

@if($incident->mots_cles)

@foreach($incident->mots_cles as $mot)

<span class="badge bg-dark">

{{ $mot }}

</span>

@endforeach

@endif

<hr>

<div class="alert alert-primary">

<strong>Décision IA</strong>

<br><br>

Cet incident a été automatiquement analysé par CivicPulse AI.

Le service recommandé est

<strong>{{ $incident->service }}</strong>

avec un niveau de confiance de

<strong>{{ $incident->score_ia }}%</strong>.

</div>

</div>

</div>

</div>

</div>

</div>

@endsection