<?php

namespace App\Http\Controllers;

use App\Models\Armada;
use App\Models\Checkin;
use Illuminate\Http\Request;

class CheckinController extends Controller
{
    public function index()
    {
        $checkins = Checkin::with('armada')->latest()->limit(100)->get();
        return view('checkins.index', compact('checkins'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'armada_id' => ['required','exists:armadas,id'],
            'lat' => ['required','numeric','between:-90,90'],
            'lng' => ['required','numeric','between:-180,180'],
        ]);

        $checkin = Checkin::create($data);
        return response()->json(['ok'=>true,'checkin'=>$checkin]);
    }

    // API Methods
    public function apiIndex(Request $request)
    {
        $query = Checkin::query()->with('armada');

        if ($request->filled('armada_id')) {
            $query->where('armada_id', $request->armada_id);
        }
        if ($request->filled('limit')) {
            $query->limit($request->limit);
        }

        $perPage = $request->get('per_page', 10);
        $checkins = $query->latest()->paginate($perPage);

        return response()->json([
            'ok' => true,
            'data' => $checkins->items(),
            'pagination' => [
                'current_page' => $checkins->currentPage(),
                'last_page' => $checkins->lastPage(),
                'per_page' => $checkins->perPage(),
                'total' => $checkins->total(),
                'from' => $checkins->firstItem(),
                'to' => $checkins->lastItem()
            ]
        ]);
    }

    public function apiStore(Request $request)
    {
        $data = $request->validate([
            'armada_id' => ['required','exists:armadas,id'],
            'lat' => ['required','numeric','between:-90,90'],
            'lng' => ['required','numeric','between:-180,180'],
        ]);

        $checkin = Checkin::create($data);

        return response()->json([
            'ok' => true,
            'data' => $checkin->load('armada'),
            'message' => 'Check-in recorded successfully'
        ], 201);
    }

    public function apiShow(Checkin $checkin)
    {
        return response()->json([
            'ok' => true,
            'data' => $checkin->load('armada')
        ]);
    }

    public function apiByArmada(Request $request, Armada $armada)
    {
        $perPage = $request->get('per_page', 10);
        $checkins = $armada->checkins()->latest()->paginate($perPage);

        return response()->json([
            'ok' => true,
            'data' => $checkins->items(),
            'armada' => $armada,
            'pagination' => [
                'current_page' => $checkins->currentPage(),
                'last_page' => $checkins->lastPage(),
                'per_page' => $checkins->perPage(),
                'total' => $checkins->total(),
                'from' => $checkins->firstItem(),
                'to' => $checkins->lastItem()
            ]
        ]);
    }

    public function apiLatest(Request $request)
    {
        $limit = $request->get('limit', 10);
        $checkins = Checkin::with('armada')->latest()->limit($limit)->get();

        return response()->json([
            'ok' => true,
            'data' => $checkins
        ]);
    }
}
