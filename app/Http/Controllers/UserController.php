<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrashData;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    // 1. Menampilkan Dashboard User (Saldo, Form, Riwayat)
    public function index()
    {
        $user = Auth::user();
        
        // Mengambil riwayat setoran user yang sedang login
        $riwayatSetoran = Transaksi::where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('user.dashboard', compact('user', 'riwayatSetoran'));
    }

    // 2. Memproses form setoran sampah dari User
    public function storeSetoran(Request $request)
    {
        $request->validate([
            'jenis_sampah'    => 'required|string',
            'perkiraan_berat' => 'required|numeric|min:0.1',
            'foto_bukti'      => 'required|image|mimes:jpeg,png,jpg|max:5120', // Maksimal 5MB
        ]);

        // Simpan foto ke folder storage/app/public/bukti_setoran
        $path = $request->file('foto_bukti')->store('bukti_setoran', 'public');

        // Simpan ke database dengan status default 'pending'
        // Sistem saat ini menggunakan tabel trash_data sebagai sumber setoran.
        $trashType = $request->jenis_sampah;

        TrashData::create([
            'user_id'    => Auth::id(),
            'data_id'    => '#SETOR-' . rand(10000, 99999),
            'trash_type' => $trashType,
            'weight'     => $request->perkiraan_berat,
            'date'       => now()->toDateString(),
            'location'   => 'upload_user',
            'status'     => 'pending',
            'photo'      => $path,
        ]);


        return redirect()->back()->with('success', 'Data setoran terkirim! Silakan bawa sampah fisik Anda ke Basecamp Pesan Green untuk ditimbang Admin. 🌱');
    }
}