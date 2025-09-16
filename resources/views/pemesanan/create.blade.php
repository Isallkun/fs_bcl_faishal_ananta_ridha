@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-4">Form Pemesanan Armada</h1>
<form method="post" action="{{ route('pemesanan.store') }}" class="bg-white p-4 rounded shadow grid gap-3 max-w-xl">
  @csrf
  <label class="block">
    <span class="text-sm">Armada</span>
    <select name="armada_id" class="border p-2 rounded w-full">
      <option value="">Pilih Armada Tersedia</option>
      @foreach($armadas as $a)
        <option value="{{ $a->id }}">{{ $a->nomor_armada }} - {{ $a->jenis_kendaraan }}</option>
      @endforeach
    </select>
  </label>
  <label class="block">
    <span class="text-sm">Tanggal Pemesanan</span>
    <input type="date" name="tanggal_pemesanan" class="border p-2 rounded w-full">
  </label>
  <label class="block">
    <span class="text-sm">Detail Barang</span>
    <textarea name="detail_barang" class="border p-2 rounded w-full" placeholder="Deskripsikan barang"></textarea>
  </label>
  <button class="bg-indigo-600 text-white px-4 py-2 rounded">Pesan</button>
</form>
@endsection
