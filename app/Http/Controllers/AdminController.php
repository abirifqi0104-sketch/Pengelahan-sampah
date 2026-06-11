<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrashData;
use App\Models\User;
use Carbon\Carbon; // Wajib ditambahkan untuk memproses tanggal

class AdminController extends Controller
{
    // ==========================================
    // 1. DASHBOARD (GRAFIK DIHITUNG LANGSUNG DI SINI)
    // ==========================================
    public function dashboard()
    {
        // 1. STATISTIK KARTU ATAS
        // Pastikan menggunakan mapping trash_type yang benar (sesuai yang dipakai di chart)
        $totalOrganik = TrashData::where('status', 'approved')->where('trash_type', 'Sampah Organik')->sum('weight');
        $totalPlastik = TrashData::where('status', 'approved')->where('trash_type', 'Sampah Plastik')->sum('weight');
        $totalKertas  = TrashData::where('status', 'approved')->where('trash_type', 'Sampah Kertas')->sum('weight');
        $totalLogam   = TrashData::where('status', 'approved')->where('trash_type', 'Sampah Logam')->sum('weight');
        $totalKaca    = TrashData::where('status', 'approved')->where('trash_type', 'Sampah Kaca')->sum('weight');
        $pendingCount = TrashData::where('status', 'pending')->count();
        $approvedCount = TrashData::where('status', 'approved')->count();
        $rejectedCount = TrashData::where('status', 'rejected')->count();
        $totalRevenue = TrashData::where('status', 'approved')->sum('total_price');
        $totalUsers = User::where('role', 'user')->count();
        
        $recentActivities = TrashData::with('user')->latest()->take(10)->get();
        $recentTrashId = TrashData::latest()->first()?->id ?? null;

        // 2. HITUNG DATA GRAFIK LANGSUNG (PER JENIS) SUPAYA SESUAI EKSPETASI VIEW
        // View mengharapkan struktur:
        // $chartDay = ['labels'=>[], 'organik'=>[], 'plastik'=>[], 'kertas'=>[], 'logam'=>[], 'kaca'=>[]]

        $mapTypeToKey = [
            'Sampah Organik' => 'organik',
            'Sampah Plastik' => 'plastik',
            'Sampah Kertas'  => 'kertas',
            'Sampah Logam'   => 'logam',
            'Sampah Kaca'    => 'kaca',
        ];

        $initSeries = function(array $labels) {
            return [
                'labels' => array_values($labels),
                'organik' => array_fill(0, count($labels), 0),
                'plastik' => array_fill(0, count($labels), 0),
                'kertas' => array_fill(0, count($labels), 0),
                'logam' => array_fill(0, count($labels), 0),
                'kaca' => array_fill(0, count($labels), 0),
            ];
        };

        $pick = function($series, string $key, int $idx, float $val) {
            $series[$key][$idx] = (float)$series[$key][$idx] + (float)$val;
            return $series;
        };

        // PER HARI (7 hari terakhir)
        $dayLabels = TrashData::where('status', 'approved')
            ->where('date', '>=', now()->subDays(7))
            ->orderBy('date', 'asc')
            ->get()
            ->map(fn($item) => Carbon::parse($item->date)->format('d M Y'))
            ->unique()
            ->values()
            ->all();

        $chartDay = $initSeries($dayLabels);
        $dayData = TrashData::where('status', 'approved')
            ->where('date', '>=', now()->subDays(7))
            ->get(['trash_type', 'weight', 'date']);

        $dayIndex = array_flip($dayLabels);
        foreach ($dayData as $item) {
            $label = Carbon::parse($item->date)->format('d M Y');
            if (!isset($dayIndex[$label])) continue;
            if (!isset($mapTypeToKey[$item->trash_type])) continue;
            $key = $mapTypeToKey[$item->trash_type];
            $idx = (int)$dayIndex[$label];
            $chartDay = $pick($chartDay, $key, $idx, (float)$item->weight);
        }

        // PER MINGGU (4 minggu terakhir)
        $weekLabels = TrashData::where('status', 'approved')
            ->where('date', '>=', now()->subWeeks(4))
            ->orderBy('date', 'asc')
            ->get()
            ->map(fn($item) => 'Minggu ' . Carbon::parse($item->date)->weekOfMonth . ' (' . Carbon::parse($item->date)->format('M') . ')')
            ->unique()
            ->values()
            ->all();

        $chartWeek = $initSeries($weekLabels);
        $weekData = TrashData::where('status', 'approved')
            ->where('date', '>=', now()->subWeeks(4))
            ->get(['trash_type', 'weight', 'date']);

        $weekIndex = array_flip($weekLabels);
        foreach ($weekData as $item) {
            $label = 'Minggu ' . Carbon::parse($item->date)->weekOfMonth . ' (' . Carbon::parse($item->date)->format('M') . ')';
            if (!isset($weekIndex[$label])) continue;
            if (!isset($mapTypeToKey[$item->trash_type])) continue;
            $key = $mapTypeToKey[$item->trash_type];
            $idx = (int)$weekIndex[$label];
            $chartWeek = $pick($chartWeek, $key, $idx, (float)$item->weight);
        }

        // PER BULAN (12 bulan terakhir)
        $monthLabels = TrashData::where('status', 'approved')
            ->where('date', '>=', now()->subMonths(12))
            ->orderBy('date', 'asc')
            ->get()
            ->map(fn($item) => Carbon::parse($item->date)->format('M Y'))
            ->unique()
            ->values()
            ->all();

        $chartMonth = $initSeries($monthLabels);
        $monthData = TrashData::where('status', 'approved')
            ->where('date', '>=', now()->subMonths(12))
            ->get(['trash_type', 'weight', 'date']);

        $monthIndex = array_flip($monthLabels);
        foreach ($monthData as $item) {
            $label = Carbon::parse($item->date)->format('M Y');
            if (!isset($monthIndex[$label])) continue;
            if (!isset($mapTypeToKey[$item->trash_type])) continue;
            $key = $mapTypeToKey[$item->trash_type];
            $idx = (int)$monthIndex[$label];
            $chartMonth = $pick($chartMonth, $key, $idx, (float)$item->weight);
        }


        return view('admin.dashboard', compact(
            'totalOrganik', 'totalPlastik', 'recentActivities', 'recentTrashId',
            'pendingCount', 'approvedCount', 'rejectedCount', 'totalRevenue', 'totalUsers',
            'chartDay', 'chartWeek', 'chartMonth' // Data grafik dikirim langsung
        ));
    }

    // ==========================================
    // FUNGSI LAINNYA (TETAP SAMA SEPERTI SEBELUMNYA)
    // ==========================================
    public function index() {
        $items = TrashData::latest()->paginate(10);
        $recentTrashId = TrashData::withTrashed()->latest()->first()?->id ?? null;
        return view('admin.transactions.index', compact('items', 'recentTrashId'));
    }

    public function informasi() { 
        $recentTrashId = TrashData::latest()->first()?->id ?? null;
        return view('admin.transactions.informasi', compact('recentTrashId')); 
    }

    public function archive() {
        $items = TrashData::onlyTrashed()->latest()->paginate(10);
        return view('admin.transactions.archive', compact('items'));
    }

    public function riwayat() {
        $items = TrashData::with('user')->latest()->paginate(10);
        $recentTrashId = TrashData::latest()->first()?->id ?? null;
        return view('admin.transactions.riwayat_penyetoran', compact('items', 'recentTrashId'));
    }

    public function create() {
        $recentTrashId = TrashData::withTrashed()->latest()->first()?->id ?? null;
        return view('admin.transactions.create', compact('recentTrashId'));
    }

    public function store(Request $request) {
        $request->validate(['trash_type' => 'required', 'weight' => 'required|numeric', 'date' => 'required|date', 'location' => 'required']);
        $data = new TrashData();
        $data->data_id = '#DATA-' . rand(10000, 99999);
        $data->trash_type = $request->trash_type; $data->weight = $request->weight;
        $data->date = $request->date; $data->location = $request->location;
        $data->save();
        return redirect()->route('admin.transactions.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id) {
        $transaction = TrashData::findOrFail($id);
        $recentTrashId = TrashData::latest()->first()?->id ?? null;
        return view('admin.transactions.edit', compact('transaction', 'recentTrashId'));
    }

    public function update(Request $request, $id) {
        $request->validate(['trash_type' => 'required', 'weight' => 'required|numeric', 'date' => 'required|date', 'location' => 'required']);
        TrashData::findOrFail($id)->update(['trash_type' => $request->trash_type, 'weight' => $request->weight, 'date' => $request->date, 'location' => $request->location]);
        return redirect()->route('admin.transactions.index')->with('success', 'Data diperbarui!');
    }

    public function kelolaInformasi() { 
        $recentTrashId = TrashData::latest()->first()?->id ?? null;
        return view('admin.transactions.kelola_informasi', compact('recentTrashId')); 
    }

    public function destroy($id) {
        TrashData::destroy($id);
        return back()->with('success', 'Dipindahkan ke riwayat!');
    }

    // NOTE:
    // Route POST /admin/verifikasi/{id}/reject pada web.php mengarah ke AdminController@reject,
    // jadi method reject ini wajib ada.
    public function reject($id)
    {
        $data = TrashData::findOrFail($id);
        $data->status = 'rejected';
        $data->save();

        return back()->with('error', 'Setoran sampah telah ditolak.');
    }

    public function forceDelete($id) {
        TrashData::onlyTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success', 'Dihapus permanen!');
    }

    public function restore($id) {
        TrashData::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.transactions.index')->with('success', 'Dipulihkan!');
    }

    public function nasabah() {
        $users = User::where('role', 'user')->latest()->paginate(10);
        return view('admin.nasabah', compact('users'));
    }

    public function saldo() {
        $transactions = TrashData::with('user')->where('status', 'approved')->latest()->paginate(10);
        return view('admin.saldo', compact('transactions'));
    }
}