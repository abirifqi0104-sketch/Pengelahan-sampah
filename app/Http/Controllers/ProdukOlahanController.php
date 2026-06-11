<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukOlahan;
use Illuminate\Support\Facades\Storage;

class ProdukOlahanController extends Controller
{
    public function index()
    {
        $items = ProdukOlahan::latest()->paginate(10);
        return view('admin.magot.penjualan.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        // Proses simpan foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk-olahan', 'public');
        }

        ProdukOlahan::create($data);

        return back()->with('success', 'Produk Olahan berhasil ditambahkan ke Etalase!');
    }

    public function destroy($id)
    {
        $produk = ProdukOlahan::findOrFail($id);
        
        // Hapus foto dari storage jika ada
        if($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }
        
        $produk->delete();
        return back()->with('success', 'Produk berhasil dihapus!');
    }

    // Tambahkan di dalam class ProdukOlahanController
    public function konversiPanen(Request $request)
    {
        // form di blade: sumber_produk, jumlah_kg, tujuan_produk
        $request->validate([
            'sumber_produk'  => 'required|string',
            'tujuan_produk'  => 'required|string',
            'jumlah_kg'      => 'required|numeric|min:0',
        ]);

        $jumlahKg = (float) $request->jumlah_kg;
        if ($jumlahKg <= 0) {
            return back()->with('success', 'Jumlah kg harus lebih dari 0.');
        }

        // 1) update stok produk (produk_olahan.stok)
        // tujuan_produk di blade: Maggot Kering | Pelet Pakan Ikan | Pupuk Kasgot (Kemasan)
        $tujuan = $request->tujuan_produk;

        $produk = \App\Models\ProdukOlahan::where('nama_produk', $tujuan)->first();

        if ($produk) {
            $produk->stok = (float) $produk->stok + $jumlahKg;
            $produk->save();
        } else {
            // fallback: jika belum ada produk di database, buat otomatis supaya stok masuk
            \App\Models\ProdukOlahan::create([
                'nama_produk' => $tujuan,
                'harga' => 0,
                'stok' => $jumlahKg,
                'foto' => null,
            ]);
        }

        // Setelah update, kirim ulang etalase ke blade supaya langsung tampil
        $etalase = \App\Models\ProdukOlahan::where('stok', '>', 0)->orderByDesc('updated_at')->get();

        return view('admin.magot.penjualan.index', [
            'etalase' => $etalase,
            'items' => $etalase, // biar tidak error jika blade mengandalkan variabel lain
        ])->with('success', 'Konversi berhasil: stok etalase penjualan masuk!');
    }
}