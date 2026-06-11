<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TrashData; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Default nilai jika data kosong atau tabel belum ada
        $totalWeight = 0;
        $totalPoints = 0;
        $recentTransactions = collect();

        // Cek apakah tabel 'trash_data' benar-benar ada di database
        if (Schema::hasTable('trash_data')) {
            // 1. Hitung Total Berat Sampah
            $totalWeight = TrashData::where('user_id', $user->id)->sum('weight') ?? 0;

            // 2. Hitung Total Poin (Simulasi Rp 1.000 / Kg)
            $totalPoints = $totalWeight * 1000;

            // 3. Ambil 5 transaksi terakhir
            $recentTransactions = TrashData::where('user_id', $user->id)
                                    ->latest()
                                    ->limit(5)
                                    ->get();
        }

        return view('user.dashboard', compact(
            'totalWeight', 
            'totalPoints', 
            'recentTransactions'
        ));
    }
}