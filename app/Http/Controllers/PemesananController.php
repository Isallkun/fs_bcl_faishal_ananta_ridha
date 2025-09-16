<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function create()
    {
        $armadas = Armada::where('status','tersedia')->get();
        return view('pemesanan.create', compact('armadas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'armada_id' => ['required','exists:armadas,id'],
            'tanggal_pemesanan' => ['required','date','after_or_equal:today'],
            'detail_barang' => ['required','string'],
        ]);

        $armada = Armada::findOrFail($data['armada_id']);
        if ($armada->status !== 'tersedia') {
            return back()->withInput()->with('err','Armada tidak tersedia.');
        }

        $booking = Pemesanan::create([
            'armada_id' => $armada->id,
            'tanggal_pemesanan' => $data['tanggal_pemesanan'],
            'detail_barang' => $data['detail_barang'],
            'status' => 'confirmed',
        ]);

        $armada->update(['status'=>'tidak tersedia']);

        return redirect()->route('pengiriman.index')->with('ok','Pemesanan berhasil.');
    }

    // API Methods
    public function apiIndex(Request $request)
    {
        $query = Pemesanan::query()->with('armada');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('armada_id')) {
            $query->where('armada_id', $request->armada_id);
        }

        $perPage = $request->get('per_page', 10);
        $pemesanans = $query->latest()->paginate($perPage);

        return response()->json([
            'ok' => true,
            'data' => $pemesanans->items(),
            'pagination' => [
                'current_page' => $pemesanans->currentPage(),
                'last_page' => $pemesanans->lastPage(),
                'per_page' => $pemesanans->perPage(),
                'total' => $pemesanans->total(),
                'from' => $pemesanans->firstItem(),
                'to' => $pemesanans->lastItem()
            ]
        ]);
    }

    public function apiStore(Request $request)
    {
        $data = $request->validate([
            'armada_id' => ['required','exists:armadas,id'],
            'tanggal_pemesanan' => ['required','date','after_or_equal:today'],
            'detail_barang' => ['required','string'],
        ]);

        $armada = Armada::findOrFail($data['armada_id']);
        if ($armada->status !== 'tersedia') {
            return response()->json([
                'ok' => false,
                'error' => 'Armada tidak tersedia.'
            ], 422);
        }

        $pemesanan = Pemesanan::create([
            'armada_id' => $armada->id,
            'tanggal_pemesanan' => $data['tanggal_pemesanan'],
            'detail_barang' => $data['detail_barang'],
            'status' => 'confirmed',
        ]);

        $armada->update(['status'=>'tidak tersedia']);

        return response()->json([
            'ok' => true,
            'data' => $pemesanan->load('armada'),
            'message' => 'Pemesanan berhasil dibuat'
        ], 201);
    }

    public function apiShow(Pemesanan $pemesanan)
    {
        return response()->json([
            'ok' => true,
            'data' => $pemesanan->load('armada')
        ]);
    }

    public function apiUpdate(Request $request, Pemesanan $pemesanan)
    {
        $data = $request->validate([
            'armada_id' => ['required','exists:armadas,id'],
            'tanggal_pemesanan' => ['required','date','after_or_equal:today'],
            'detail_barang' => ['required','string'],
            'status' => ['sometimes', 'in:pending,confirmed,selesai'],
        ]);

        $pemesanan->update($data);

        return response()->json([
            'ok' => true,
            'data' => $pemesanan->load('armada'),
            'message' => 'Pemesanan updated successfully'
        ]);
    }

    public function apiDestroy(Pemesanan $pemesanan)
    {
        // Bebaskan armada jika pemesanan dihapus
        if ($pemesanan->armada && $pemesanan->status !== 'selesai') {
            $pemesanan->armada->update(['status' => 'tersedia']);
        }

        $pemesanan->delete();

        return response()->json([
            'ok' => true,
            'message' => 'Pemesanan deleted successfully'
        ]);
    }
}
