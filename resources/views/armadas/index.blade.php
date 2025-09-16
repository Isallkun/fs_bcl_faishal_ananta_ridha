@extends('layouts.app')
@section('content')
<div class="flex items-center justify-between mb-4">
  <h1 class="text-xl font-semibold">Daftar Armada</h1>
  <div class="flex gap-2">
    <form method="get" class="flex gap-2">
      <input name="jenis_kendaraan" placeholder="Jenis" value="{{ request('jenis_kendaraan') }}" class="border p-2 rounded">
      <select name="status" class="border p-2 rounded">
        <option value="">Status</option>
        @foreach(['tersedia','tidak tersedia'] as $s)
          <option value="{{ $s }}" @selected(request('status')===$s)>{{ ucfirst($s) }}</option>
        @endforeach
      </select>
      <button class="bg-indigo-600 text-white px-4 py-2 rounded">Filter</button>
    </form>
    <a href="{{ route('armadas.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">Tambah</a>
  </div>
</div>
<div class="bg-white rounded shadow overflow-x-auto">
  <table class="min-w-full">
    <thead class="bg-gray-50">
      <tr>
        <th class="p-2 text-left">Nomor</th>
        <th class="p-2 text-left">Jenis</th>
        <th class="p-2 text-left">Kapasitas</th>
        <th class="p-2 text-left">Status</th>
        <th class="p-2 text-left">Aksi</th>
      </tr>
    </thead>
    <tbody>
    @foreach($armadas as $a)
      <tr class="border-b">
        <td class="p-2">{{ $a->nomor_armada }}</td>
        <td class="p-2">{{ $a->jenis_kendaraan }}</td>
        <td class="p-2">{{ number_format($a->kapasitas) }}</td>
        <td class="p-2">{{ ucfirst($a->status) }}</td>
        <td class="p-2">
          <a href="{{ route('armadas.edit',$a) }}" class="px-3 py-1 bg-yellow-500 text-white rounded">Edit</a>
          <form action="{{ route('armadas.destroy',$a) }}" method="post" class="inline" onsubmit="return confirm('Hapus armada?')">
            @csrf @method('DELETE')
            <button class="px-3 py-1 bg-red-600 text-white rounded">Hapus</button>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
<div class="mt-4">{{ $armadas->withQueryString()->links() }}</div>
@endsection
