<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ArmadaController extends Controller
{
    public function index(Request $request)
    {
        $query = Armada::query();

        if ($request->filled('jenis_kendaraan')) {
            $query->where('jenis_kendaraan', $request->jenis_kendaraan);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $armadas = $query->latest()->paginate(10);
        return view('armadas.index', compact('armadas'));
    }

    public function create()
    {
        return view('armadas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor_armada'   => ['required','string','max:50','unique:armadas,nomor_armada'],
            'jenis_kendaraan'=> ['required','string','max:50'],
            'kapasitas'      => ['required','integer','min:1'],
            'status'         => ['required', Rule::in(['tersedia','tidak tersedia'])],
        ]);

        Armada::create($data);
        return redirect()->route('armadas.index')->with('ok','Armada ditambahkan.');
    }

    public function edit(Armada $armada)
    {
        return view('armadas.edit', compact('armada'));
    }

    public function update(Request $request, Armada $armada)
    {
        $data = $request->validate([
            'nomor_armada'   => ['required','string','max:50','unique:armadas,nomor_armada,'.$armada->id],
            'jenis_kendaraan'=> ['required','string','max:50'],
            'kapasitas'      => ['required','integer','min:1'],
            'status'         => ['required', Rule::in(['tersedia','tidak tersedia'])],
        ]);

        $armada->update($data);
        return redirect()->route('armadas.index')->with('ok','Armada diperbarui.');
    }

    public function destroy(Armada $armada)
    {
        if ($armada->pengiriman()->whereIn('status',['tertunda','perjalanan'])->exists()) {
            return back()->with('err','Armada sedang digunakan, tidak bisa dihapus.');
        }
        $armada->delete();
        return redirect()->route('armadas.index')->with('ok','Armada dihapus.');
    }

    // API Methods
    public function apiIndex(Request $request)
    {
        $query = Armada::query();

        if ($request->filled('jenis_kendaraan')) {
            $query->where('jenis_kendaraan', $request->jenis_kendaraan);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nomor_armada', 'like', "%$search%")
                  ->orWhere('jenis_kendaraan', 'like', "%$search%");
            });
        }

        $perPage = $request->get('per_page', 10);
        $armadas = $query->latest()->paginate($perPage);

        return response()->json([
            'ok' => true,
            'data' => $armadas->items(),
            'pagination' => [
                'current_page' => $armadas->currentPage(),
                'last_page' => $armadas->lastPage(),
                'per_page' => $armadas->perPage(),
                'total' => $armadas->total(),
                'from' => $armadas->firstItem(),
                'to' => $armadas->lastItem()
            ]
        ]);
    }

    public function apiStore(Request $request)
    {
        $data = $request->validate([
            'nomor_armada'   => ['required','string','max:50','unique:armadas,nomor_armada'],
            'jenis_kendaraan'=> ['required','string','max:50'],
            'kapasitas'      => ['required','integer','min:1'],
            'status'         => ['required', Rule::in(['tersedia','tidak tersedia'])],
        ]);

        $armada = Armada::create($data);

        return response()->json([
            'ok' => true,
            'data' => $armada,
            'message' => 'Armada created successfully'
        ], 201);
    }

    public function apiShow(Armada $armada)
    {
        return response()->json([
            'ok' => true,
            'data' => $armada->load(['pengiriman', 'pemesanan', 'checkins'])
        ]);
    }

    public function apiUpdate(Request $request, Armada $armada)
    {
        $data = $request->validate([
            'nomor_armada'   => ['required','string','max:50','unique:armadas,nomor_armada,'.$armada->id],
            'jenis_kendaraan'=> ['required','string','max:50'],
            'kapasitas'      => ['required','integer','min:1'],
            'status'         => ['required', Rule::in(['tersedia','tidak tersedia'])],
        ]);

        $armada->update($data);

        return response()->json([
            'ok' => true,
            'data' => $armada,
            'message' => 'Armada updated successfully'
        ]);
    }

    public function apiDestroy(Armada $armada)
    {
        if ($armada->pengiriman()->whereIn('status',['tertunda','perjalanan'])->exists()) {
            return response()->json([
                'ok' => false,
                'error' => 'Armada sedang digunakan, tidak bisa dihapus.'
            ], 422);
        }

        $armada->delete();

        return response()->json([
            'ok' => true,
            'message' => 'Armada deleted successfully'
        ]);
    }

    public function apiPengirimans(Armada $armada)
    {
        $pengirimans = $armada->pengiriman()->latest()->get();

        return response()->json([
            'ok' => true,
            'data' => $pengirimans
        ]);
    }

    public function apiPemesanans(Armada $armada)
    {
        $pemesanans = $armada->pemesanan()->latest()->get();

        return response()->json([
            'ok' => true,
            'data' => $pemesanans
        ]);
    }

    public function apiCheckins(Armada $armada)
    {
        $checkins = $armada->checkins()->latest()->get();

        return response()->json([
            'ok' => true,
            'data' => $checkins
        ]);
    }

    public function apiSearch(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return response()->json([
                'ok' => false,
                'error' => 'Search query is required'
            ], 400);
        }

        $armadas = Armada::where(function($q) use ($query) {
            $q->where('nomor_armada', 'like', "%$query%")
              ->orWhere('jenis_kendaraan', 'like', "%$query%");
        })->limit(10)->get();

        return response()->json([
            'ok' => true,
            'data' => $armadas
        ]);
    }
}
