@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-4">Lokasi Check-in Armada</h1>
<div id="map" class="w-full h-96 mb-4 rounded shadow"></div>
<div class="bg-white p-4 rounded shadow">
  <h2 class="font-semibold mb-2">Riwayat Check-in Terbaru</h2>
  <ul class="list-disc pl-5">
    @foreach($checkins as $c)
      <li>{{ $c->created_at }} — {{ $c->armada?->nomor_armada }} ({{ $c->lat }}, {{ $c->lng }})</li>
    @endforeach
  </ul>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
  const map = L.map('map').setView([ -6.2, 106.8 ], 5);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; OpenStreetMap'
  }).addTo(map);

  @foreach($checkins as $c)
    L.marker([{{ $c->lat }}, {{ $c->lng }}]).addTo(map)
      .bindPopup("{{ $c->armada?->nomor_armada }}<br>{{ $c->created_at }}");
  @endforeach
</script>
@endsection
