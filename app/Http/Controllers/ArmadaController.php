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
}
