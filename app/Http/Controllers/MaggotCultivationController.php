<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\MaggotHarvest;
use App\Models\MaggotCultivation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MaggotCultivationController extends Controller
{
    // 1. Menampilkan halaman utama monitoring budidaya
    public function index()
    {
        $cultivations = MaggotCultivation::orderBy('created_at', 'desc')->get();
        
        // Menghitung statistik mini untuk dashboard atas
        $countPenetasan = MaggotCultivation::where('status', 'Penetasan')->count();
        $countLarva = MaggotCultivation::where('status', 'Larva')->count();
        // Memastikan yang dihitung adalah Prepupa dan Pupa (atau string 'Prepupa / Pupa' jika digabung)
        $countPupa = MaggotCultivation::whereIn('status', ['Prepupa', 'Pupa', 'Prepupa / Pupa'])->count();

        return view('admin.magot.index', compact('cultivations', 'countPenetasan', 'countLarva', 'countPupa'));
    }

    // 2. LOGIKA INTEGRASI: Proses Pembagian Hasil Panen Maggot
    public function prosesPanen(Request $request, $id)
    {
        $request->validate([
            'total_panen'    => 'required|numeric|min:0',
            'alokasi_kering' => 'required|numeric|min:0',
            'alokasi_pupuk'  => 'required|numeric|min:0',
            'alokasi_jual'   => 'required|numeric|min:0',
            'harga_per_kg'   => 'nullable|numeric|min:0',
        ]);

        $cultivation = MaggotCultivation::findOrFail($id);

        // A. Catat ke Tabel Panen Maggot
        $pendapatanJual = $request->alokasi_jual * ($request->harga_per_kg ?? 7000); 
        
        MaggotHarvest::create([
            'maggot_cultivation_id' => $id,
            'total_panen' => $request->total_panen,
            'alokasi_kering' => $request->alokasi_kering,
            'alokasi_pupuk' => $request->alokasi_pupuk,
            'alokasi_jual' => $request->alokasi_jual,
            'total_pendapatan' => $pendapatanJual,
        ]);

        // B. INTEGRASI 1: Jika dikeringkan, otomatis menambah stok di GUDANG
        if ($request->alokasi_kering > 0) {
            $beratKering = $request->alokasi_kering * 0.3; // Penyusutan basah ke kering (30%)
            
            Gudang::create([
                'nama_sampah' => 'Maggot Kering (Pakan)',
                'kategori'    => 'Produk Olahan',
                'berat'       => $beratKering,
                'stok'        => ceil($beratKering),
                'harga'       => 35000, 
                'status'      => 'Tersedia'
            ]);
        }

        // C. INTEGRASI 2: Jika diolah jadi pupuk, otomatis menambah stok di GUDANG
        if ($request->alokasi_pupuk > 0) {
            Gudang::create([
                'nama_sampah' => 'Pupuk Organik Bekasgot',
                'kategori'    => 'Produk Olahan',
                'berat'       => $request->alokasi_pupuk * 0.8, 
                'stok'        => ceil($request->alokasi_pupuk * 0.8),
                'harga'       => 15000, 
                'status'      => 'Tersedia'
            ]);
        }

        // D. Ubah status budidaya aktif menjadi Selesai (Panen Selesai)
        $cultivation->update(['status' => 'Panen Selesai']);

        return redirect()->route('admin.maggot.index')
            ->with('success', 'Batch Budidaya Berhasil Dipanen dan Dialokasikan ke Gudang & Penjualan! 🎉');
    }

    // 3. Menyimpan siklus budidaya baru (SUDAH DIPERBAIKI ANTI LAYAR PUTIH JSON)
    public function store(Request $request)
    {
        $request->validate([
            'biopond_name'   => 'required|string|max:250',
            'initial_weight' => 'required|numeric|min:0.01',
            'unit'           => 'required|in:gram,kg',
            'start_date'     => 'required|date',
            'description'    => 'nullable|string',
        ]);

        $year = Carbon::now()->format('Y');
        $lastRecord = MaggotCultivation::whereYear('created_at', $year)->latest()->first();
        $nextNumber = $lastRecord ? ((int) substr($lastRecord->cultivation_code, -4)) + 1 : 1;
        $cultivationCode = 'CULT-' . $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        MaggotCultivation::create([
            'cultivation_code' => $cultivationCode,
            'biopond_name'     => $request->biopond_name,
            'initial_weight'   => $request->initial_weight,
            'unit'             => $request->unit,
            'start_date'       => $request->start_date,
            'status'           => 'Penetasan', 
            'description'      => $request->description,
        ]);

        // PERBAIKAN: Menggunakan redirect back, bukan response json!
        return redirect()->back()->with('success', 'Siklus budidaya berhasil dimulai! 🌱');
    }

    // 4. Menghapus data siklus budidaya (SUDAH AMAN ANTI LAYAR PUTIH)
    public function destroy($id)
    {
        $cultivation = MaggotCultivation::findOrFail($id);
        $cultivation->delete();

        return redirect()->back()->with('success', 'Data siklus berhasil dihapus!');
    }

    // 5. Mengubah Fase Budidaya (SUDAH AMAN ANTI LAYAR PUTIH)
    public function updateFase(Request $request, $id)
    {
        $cultivation = MaggotCultivation::findOrFail($id);
        
        if ($request->has('status')) {
            $cultivation->status = $request->status;
            $cultivation->save();
        }

        return redirect()->back()->with('success', 'Fase biopond berhasil di-update! 🐛');
    }
}