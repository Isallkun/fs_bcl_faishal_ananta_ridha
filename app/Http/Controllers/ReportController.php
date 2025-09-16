<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $stats = DB::table('armadas AS a')
            ->leftJoin('pengirimans AS p', 'p.armada_id', '=', 'a.id')
            ->select('a.nomor_armada', DB::raw("SUM(CASE WHEN p.status = 'perjalanan' THEN 1 ELSE 0 END) AS total_perjalanan"))
            ->groupBy('a.nomor_armada')
            ->orderBy('a.nomor_armada')
            ->get();

        return view('reports.index', compact('stats'));
    }
}
