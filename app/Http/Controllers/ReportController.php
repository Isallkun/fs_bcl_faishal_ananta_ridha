<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

    // API Methods
    public function apiShipments()
    {
        $stats = DB::table('armadas AS a')
            ->leftJoin('pengirimans AS p', 'p.armada_id', '=', 'a.id')
            ->select('a.nomor_armada', DB::raw("SUM(CASE WHEN p.status = 'perjalanan' THEN 1 ELSE 0 END) AS total_perjalanan"))
            ->groupBy('a.nomor_armada')
            ->orderBy('a.nomor_armada')
            ->get();

        return response()->json([
            'ok' => true,
            'data' => $stats
        ]);
    }

    public function apiStatusSummary()
    {
        $summary = DB::table('pengirimans')
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        return response()->json([
            'ok' => true,
            'data' => [
                'tertunda' => $summary->get('tertunda', 0),
                'perjalanan' => $summary->get('perjalanan', 0),
                'tiba' => $summary->get('tiba', 0)
            ]
        ]);
    }

    public function apiArmadaUsage()
    {
        $usage = DB::table('armadas AS a')
            ->leftJoin('pengirimans AS p', function($join) {
                $join->on('p.armada_id', '=', 'a.id')
                     ->whereIn('p.status', ['tertunda', 'perjalanan']);
            })
            ->select(
                'a.id',
                'a.nomor_armada',
                'a.jenis_kendaraan',
                'a.status as armada_status',
                DB::raw('COUNT(p.id) as active_shipments'),
                DB::raw('CASE WHEN COUNT(p.id) > 0 THEN "digunakan" ELSE "tersedia" END as usage_status')
            )
            ->groupBy('a.id', 'a.nomor_armada', 'a.jenis_kendaraan', 'a.status')
            ->get();

        return response()->json([
            'ok' => true,
            'data' => $usage
        ]);
    }

    public function apiDashboard()
    {
        $stats = [
            'total_armadas' => DB::table('armadas')->count(),
            'total_pengirimans' => DB::table('pengirimans')->count(),
            'total_pemesanans' => DB::table('pemesanans')->count(),
            'total_checkins' => DB::table('checkins')->count(),
            'armadas_tersedia' => DB::table('armadas')->where('status', 'tersedia')->count(),
            'armadas_tidak_tersedia' => DB::table('armadas')->where('status', 'tidak tersedia')->count(),
            'pengirimans_perjalanan' => DB::table('pengirimans')->where('status', 'perjalanan')->count(),
            'pengirimans_tiba' => DB::table('pengirimans')->where('status', 'tiba')->count(),
        ];

        $recent_checkins = DB::table('checkins AS c')
            ->join('armadas AS a', 'a.id', '=', 'c.armada_id')
            ->select('c.*', 'a.nomor_armada')
            ->orderBy('c.created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'ok' => true,
            'data' => [
                'statistics' => $stats,
                'recent_checkins' => $recent_checkins
            ]
        ]);
    }

    public function apiGlobalSearch(Request $request)
    {
        $query = $request->get('q');
        $type = $request->get('type', 'all');

        if (!$query) {
            return response()->json([
                'ok' => false,
                'error' => 'Search query is required'
            ], 400);
        }

        $results = [];

        if ($type === 'all' || $type === 'armadas') {
            $armadas = DB::table('armadas')
                ->where('nomor_armada', 'like', "%$query%")
                ->orWhere('jenis_kendaraan', 'like', "%$query%")
                ->limit(5)
                ->get();
            $results['armadas'] = $armadas;
        }

        if ($type === 'all' || $type === 'pengirimans') {
            $pengirimans = DB::table('pengirimans')
                ->where('nomor_pengiriman', 'like', "%$query%")
                ->orWhere('asal', 'like', "%$query%")
                ->orWhere('tujuan', 'like', "%$query%")
                ->limit(5)
                ->get();
            $results['pengirimans'] = $pengirimans;
        }

        return response()->json([
            'ok' => true,
            'data' => $results
        ]);
    }
}
