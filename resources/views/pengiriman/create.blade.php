@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-4">Buat Pengiriman</h1>
<form method="post" action="{{ route('pengiriman.store') }}" class="bg-white p-4 rounded shadow grid gap-3">
  @csrf
  <input name="nomor_pengiriman" class="border p-2 rounded" placeholder="Nomor Pengiriman" value="{{ old('nomor_pengiriman') }}">
  <input type="date" name="tanggal_pengiriman" class="border p-2 rounded" value="{{ old('tanggal_pengiriman') }}">
  <input name="asal" class="border p-2 rounded" placeholder="Asal" value="{{ old('asal') }}">
  <input name="tujuan" class="border p-2 rounded" placeholder="Tujuan" value="{{ old('tujuan') }}">
  <select name="status" class="border p-2 rounded">
    @foreach(['tertunda','perjalanan','tiba'] as $s)
      <option value="{{ $s }}" @selected(old('status')===$s)>{{ ucfirst($s) }}</option>
    @endforeach
  </select>
  <textarea name="detail_barang" class="border p-2 rounded" placeholder="Detail Barang">{{ old('detail_barang') }}</textarea>
  <select name="armada_id" class="border p-2 rounded">
    <option value="">Pilih Armada</option>
    @foreach($armadas as $a)
      <option value="{{ $a->id }}" @selected(old('armada_id')==$a->id)>{{ $a->nomor_armada }} - {{ $a->jenis_kendaraan }}</option>
    @endforeach
  </select>
  <button class="bg-indigo-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
