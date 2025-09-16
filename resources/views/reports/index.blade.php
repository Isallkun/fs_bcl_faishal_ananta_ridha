@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-4">Laporan: Pengiriman Dalam Perjalanan per Armada</h1>
<div class="bg-white rounded shadow overflow-x-auto">
  <table class="min-w-full">
    <thead class="bg-gray-50">
      <tr>
        <th class="p-2 text-left">Nomor Armada</th>
        <th class="p-2 text-left">Total Dalam Perjalanan</th>
      </tr>
    </thead>
    <tbody>
      @foreach($stats as $row)
      <tr class="border-b">
        <td class="p-2">{{ $row->nomor_armada }}</td>
        <td class="p-2">{{ $row->total_perjalanan ?? 0 }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
