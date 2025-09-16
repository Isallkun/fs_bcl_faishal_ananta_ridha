@extends('layouts.app')
@section('content')
<div class="flex items-center justify-between mb-4">
  <h1 class="text-xl font-semibold">Daftar Pengiriman</h1>
  <form method="get" class="flex gap-2">
    <input name="q" value="{{ request('q') }}" placeholder="Cari nomor / tujuan" class="border rounded p-2">
    <button class="bg-indigo-600 text-white px-4 py-2 rounded">Cari</button>
  </form>
</div>
<div class="bg-white rounded shadow overflow-x-auto">
  <table class="min-w-full">
    <thead class="bg-gray-50">
      <tr>
        <th class="p-2 text-left">Nomor</th>
        <th class="p-2 text-left">Tanggal</th>
        <th class="p-2 text-left">Asal</th>
        <th class="p-2 text-left">Tujuan</th>
        <th class="p-2 text-left">Status</th>
        <th class="p-2 text-left">Armada</th>
      </tr>
    </thead>
    <tbody>
    @foreach($pengiriman as $p)
      <tr class="border-b">
        <td class="p-2">{{ $p->nomor_pengiriman }}</td>
        <td class="p-2">{{ $p->tanggal_pengiriman->format('Y-m-d') }}</td>
        <td class="p-2">{{ $p->asal }}</td>
        <td class="p-2">{{ $p->tujuan }}</td>
        <td class="p-2">{{ ucfirst($p->status) }}</td>
        <td class="p-2">{{ $p->armada?->nomor_armada }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
<div class="mt-4">{{ $pengiriman->withQueryString()->links() }}</div>
@endsection
