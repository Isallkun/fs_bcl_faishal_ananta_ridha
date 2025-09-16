<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use App\Models\Pengiriman;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PengirimanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengiriman::query()->with('armada');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($w) use ($q) {
                $w->where('nomor_pengiriman','like',"%$q%")
                  ->orWhere('tujuan','like',"%$q%");
            });
        }

        $pengiriman = $query->latest()->paginate(10);
        return view('pengiriman.index', compact('pengiriman'));
    }

    public function create()
    {
        $armadas = Armada::where('status','tersedia')->get();
        return view('pengiriman.create', compact('armadas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor_pengiriman'  => ['required','string','max:50','unique:pengirimans,nomor_pengiriman'],
            'tanggal_pengiriman'=> ['required','date','after_or_equal:today'],
            'asal'              => ['required','string','max:100'],
            'tujuan'            => ['required','string','max:100'],
            'status'            => ['required', Rule::in(['tertunda','perjalanan','tiba'])],
            'detail_barang'     => ['required','string'],
            'armada_id'         => ['required','exists:armadas,id'],
        ]);

        // Pastikan armada tersedia
        $armada = Armada::findOrFail($data['armada_id']);
        if ($armada->status !== 'tersedia') {
            return back()->withInput()->with('err','Armada tidak tersedia.');
        }

        $pengiriman = Pengiriman::create($data);

        // Jika status bukan "tiba", set armada jadi tidak tersedia
        if (in_array($pengiriman->status, ['tertunda','perjalanan'])) {
            $armada->update(['status'=>'tidak tersedia']);
        }

        return redirect()->route('pengiriman.index')->with('ok','Pengiriman dibuat.');
    }

    public function track(Request $request)
    {
        $shipment = null;
        if ($request->filled('nomor_pengiriman')) {
            $shipment = Pengiriman::with('armada')->where('nomor_pengiriman', $request->nomor_pengiriman)->first();
        }
        return view('pengiriman.track', compact('shipment'));
    }

    public function updateStatus(Request $request, Pengiriman $pengiriman)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['tertunda','perjalanan','tiba'])],
        ]);

        $pengiriman->update($data);

        // Jika sudah tiba, bebaskan armada
        if ($data['status'] === 'tiba' && $pengiriman->armada) {
            $pengiriman->armada->update(['status'=>'tersedia']);
        }

        return back()->with('ok','Status pengiriman diperbarui.');
    }
}
