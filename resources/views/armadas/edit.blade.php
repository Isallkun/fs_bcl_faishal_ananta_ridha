@extends('layouts.app')
@section('content')
<h1 class="text-xl font-semibold mb-4">Edit Armada</h1>
<form method="post" action="{{ route('armadas.update',$armada) }}" class="bg-white p-4 rounded shadow grid gap-3 max-w-xl">
  @csrf @method('PUT')
  <input name="nomor_armada" class="border p-2 rounded" placeholder="Nomor Armada" value="{{ old('nomor_armada',$armada->nomor_armada) }}">
  <input name="jenis_kendaraan" class="border p-2 rounded" placeholder="Jenis Kendaraan" value="{{ old('jenis_kendaraan',$armada->jenis_kendaraan) }}">
  <input name="kapasitas" type="number" class="border p-2 rounded" placeholder="Kapasitas (kg)" value="{{ old('kapasitas',$armada->kapasitas) }}">
  <select name="status" class="border p-2 rounded">
    @foreach(['tersedia','tidak tersedia'] as $s)
      <option value="{{ $s }}" @selected(old('status',$armada->status)===$s)>{{ ucfirst($s) }}</option>
    @endforeach
  </select>
  <button class="bg-indigo-600 text-white px-4 py-2 rounded">Update</button>
</form>
@endsection
