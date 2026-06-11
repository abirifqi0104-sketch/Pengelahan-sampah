<?php

namespace App\Http\Controllers;

use App\Models\PanenMaggot;
use App\Models\MaggotCultivation; // Gunakan model ini, jangan Maggot!
use Illuminate\Http\Request;

class PanenMaggotController extends Controller
{
    // 1. Menampilkan daftar panen
    public function index()
    {
        $items = PanenMaggot::with('maggot') // Pastikan di Model PanenMaggot sudah ada relasi 'maggot' ke MaggotCultivation
                    ->latest()
                    ->paginate(10);

        return view('admin.magot.panen.index', compact('items'));
    }

    // 2. Menampilkan form input panen
    public function create()
    {
        // PENTING: Cari data berdasarkan status 'Larva', 'Prepupa', atau 'Pupa' (karena ini yang siap panen)
        $maggots = MaggotCultivation::whereIn('status', ['Larva', 'Prepupa', 'Pupa'])->get();

        return view('admin.magot.panen.create', compact('maggots'));
    }

    // 3. Menyimpan hasil panen
   public function store(Request $request)
    {
        $request->validate([
            'maggot_id'     => 'required',
            'tanggal_panen' => 'required',
            'hasil_kg'      => 'required',
        ]);

        // Pastikan kuncinya 'maggot_id' sesuai dengan nama kolom di database
        \App\Models\PanenMaggot::create([
            'maggot_id'     => $request->maggot_id, 
            'tanggal_panen' => $request->tanggal_panen,
            'hasil_kg'      => $request->hasil_kg,
            'keterangan'    => $request->keterangan,
        ]);

        // Update status biopond
        $maggot = \App\Models\MaggotCultivation::find($request->maggot_id);
        
        if ($maggot) {
            $maggot->update(['status' => 'Selesai']); // Sesuaikan dengan enum status di tabel maggot_cultivations
        }

        return redirect()
            ->route('admin.maggot.panen') 
            ->with('success', 'Panen berhasil dicatat! ⚖️');
    }
}