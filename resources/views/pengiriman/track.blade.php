@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-4">Pelacakan Pengiriman</h1>
<form method="get" class="flex gap-2 mb-4">
  <input name="nomor_pengiriman" placeholder="Masukkan nomor pengiriman" value="{{ request('nomor_pengiriman') }}" class="border p-2 rounded w-80">
  <button class="bg-indigo-600 text-white px-4 py-2 rounded">Lacak</button>
</form>
@if(isset($shipment) && $shipment)
  <div class="bg-white p-4 rounded shadow">
    <div class="font-semibold mb-2">Nomor: {{ $shipment->nomor_pengiriman }}</div>
    <div>Tanggal: {{ $shipment->tanggal_pengiriman->format('Y-m-d') }}</div>
    <div>Asal: {{ $shipment->asal }}</div>
    <div>Tujuan: {{ $shipment->tujuan }}</div>
    <div>Status: <span class="font-semibold">{{ ucfirst($shipment->status) }}</span></div>
    <div>Armada: {{ $shipment->armada?->nomor_armada }}</div>
    <div>Detail: {{ $shipment->detail_barang }}</div>
  </div>
@elseif(request()->filled('nomor_pengiriman'))
  <div class="bg-yellow-100 text-yellow-800 p-3 rounded">Nomor tidak ditemukan.</div>
@endif
@endsection
