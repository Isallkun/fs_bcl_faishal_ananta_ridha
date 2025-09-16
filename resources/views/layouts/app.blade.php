<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logistik App</title>
  <!-- Quick Tailwind via CDN for demo; replace with Vite in production -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<nav class="bg-indigo-600 text-white p-4">
  <div class="container mx-auto flex gap-4">
    <a href="/" class="font-semibold">Dashboard</a>
    <a href="{{ route('pengiriman.index') }}">Pengiriman</a>
    <a href="{{ route('armadas.index') }}">Armada</a>
    <a href="{{ route('pemesanan.create') }}">Pemesanan</a>
    <a href="{{ route('checkins.index') }}">Check-in</a>
    <a href="{{ route('reports.index') }}">Laporan</a>
  </div>
</nav>
<main class="container mx-auto p-4">
  @if(session('ok'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('ok') }}</div>
  @endif
  @if(session('err'))
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('err') }}</div>
  @endif
  {{ $slot ?? '' }}
  @yield('content')
</main>
</body>
</html>
