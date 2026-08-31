@extends('layouts.main')

@section('content')

<div class="container">

    <h2 class="mb-4">
        🗺️ Carte des incidents
    </h2>

    <div class="card shadow">

        <div class="card-body">

            <div id="map" style="height:600px;"></div>

        </div>

    </div>

</div>

<script>

document.addEventListener("DOMContentLoaded", function () {

    var map = L.map('map').setView([3.8480, 11.5021], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    @foreach($incidents as $incident)

        @if($incident->latitude && $incident->longitude)

        L.marker([
            {{ $incident->latitude }},
            {{ $incident->longitude }}
        ]).addTo(map)
        .bindPopup(`
            <strong>{{ $incident->titre }}</strong><br>
            {{ $incident->categorie }}<br>
            Statut : {{ $incident->statut }}
        `);

        @endif

    @endforeach

});

</script>

@endsection