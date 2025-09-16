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
}
