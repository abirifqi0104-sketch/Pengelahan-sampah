<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrashData;
use App\Models\MaggotCultivation;
use App\Models\Gudang;
use App\Models\User;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Filter tanggal
        $startDate = $request->get('start_date', Carbon::now()->subMonth()->toDateString());
        $endDate = $request->get('end_date', Carbon::now()->toDateString());
        $jenisLaporan = $request->get('jenis_laporan', 'semua');

        // REAL DATA - Setoran Sampah
        $setoranData = [];
        if ($jenisLaporan == 'semua' || $jenisLaporan == 'setoran') {
            $setoranData = TrashData::where('status', 'approved')
                ->whereBetween('date', [$startDate, $endDate])
                ->with('user')
                ->orderBy('date', 'desc')
                ->get()
                ->map(function ($item) {
                    return [
                        'tanggal' => $item->date->format('Y-m-d'),
                        'nasabah' => $item->user->name ?? 'Unknown',
                        'sampah' => $item->trash_type,
                        'berat' => $item->weight,
                        'harga' => $item->price_per_kg,
                        'total' => $item->total_price,
                    ];
                });
        }

        // REAL DATA - Maggot Cultivation
        $maggotData = [];
        if ($jenisLaporan == 'semua' || $jenisLaporan == 'maggot') {
            $maggotData = MaggotCultivation::whereBetween('start_date', [$startDate, $endDate])
                ->orderBy('start_date', 'desc')
                ->get();
        }

        // REAL DATA - Panen Maggot (Harvest)
        $panenData = [];
        if ($jenisLaporan == 'semua' || $jenisLaporan == 'maggot') {
            $panenData = \App\Models\PanenMaggot::whereBetween('tanggal_panen', [$startDate, $endDate])
                ->with('maggot')
                ->orderBy('tanggal_panen', 'desc')
                ->get();
        }

        // REAL DATA - Gudang Inventory
        $gudangData = [];
        if ($jenisLaporan == 'semua' || $jenisLaporan == 'gudang') {
            $gudangData = Gudang::orderBy('updated_at', 'desc')->get();
        }

        // SUMMARY STATS
        $totalSetoran = TrashData::where('status', 'approved')
            ->whereBetween('date', [$startDate, $endDate])
            ->count();

        $totalBerat = TrashData::where('status', 'approved')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('weight');

        $totalRevenue = TrashData::where('status', 'approved')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('total_price');

        $totalMaggot = MaggotCultivation::whereBetween('start_date', [$startDate, $endDate])->count();

        $totalPanen = \App\Models\PanenMaggot::whereBetween('tanggal_panen', [$startDate, $endDate])->count();

        $totalHasilPanen = \App\Models\PanenMaggot::whereBetween('tanggal_panen', [$startDate, $endDate])->sum('hasil_kg');

        return view('admin.laporan.index', compact(
            'setoranData', 'maggotData', 'panenData', 'gudangData',
            'startDate', 'endDate', 'jenisLaporan',
            'totalSetoran', 'totalBerat', 'totalRevenue', 'totalMaggot', 'totalPanen', 'totalHasilPanen'
        ));
    }
}