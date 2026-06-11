<?php

namespace App\Http\Controllers;

use App\Models\MaggotCultivation;
use App\Models\ProdukOlahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaggotController extends Controller
{
    public function index()
    {
        $cultivations = MaggotCultivation::orderBy('created_at', 'desc')->get();
        
        $countPenetasan = MaggotCultivation::where('status', 'Penetasan')->count();
        $countLarva = MaggotCultivation::where('status', 'Larva')->count();
        $countPupa = MaggotCultivation::whereIn('status', ['Prepupa', 'Pupa'])->count();

        return view('admin.magot.index', compact('cultivations', 'countPenetasan', 'countLarva', 'countPupa'));
    }

    // PENJUALAN: Tampilkan etalase
    public function penjualan()
    {
        $etalase = ProdukOlahan::where('stok', '>', 0)
            ->orWhereNotNull('foto')
            ->orderByDesc('updated_at')
            ->get();

        return view('admin.magot.penjualan.index', compact('etalase'));
    }

    // PENJUALAN: Tambah produk ke etalase dengan harga dan foto
    public function tambahProduk(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->all();

        // Proses upload foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk-olahan', 'public');
        }

        ProdukOlahan::create($data);

        return back()->with('success', 'Produk berhasil ditambahkan ke etalase dengan harga dan foto! ✅');
    }

    // PENJUALAN: Edit produk
    public function editProduk($id)
    {
        $produk = ProdukOlahan::findOrFail($id);
        return view('admin.magot.penjualan.edit', compact('produk'));
    }

    // PENJUALAN: Update produk
    public function updateProduk(Request $request, $id)
    {
        $produk = ProdukOlahan::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $data = $request->all();

        // Proses upload foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('foto')->store('produk-olahan', 'public');
        }

        $produk->update($data);

        return back()->with('success', 'Produk berhasil diperbarui! ✅');
    }

    // PENJUALAN: Hapus produk
    public function hapusProduk($id)
    {
        $produk = ProdukOlahan::findOrFail($id);
        
        // Hapus foto dari storage jika ada
        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }
        
        $produk->delete();
        return back()->with('success', 'Produk berhasil dihapus dari etalase! ✅');
    }
}
