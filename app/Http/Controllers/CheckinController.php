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
}
