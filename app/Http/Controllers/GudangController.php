<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function index()
    {
        // Menggunakan get() agar semua data stok gudang muncul di tabel tanpa terpotong halaman
        $items = Gudang::latest()->get();

        return view('admin.gudang.index', compact('items'));
    }

    public function create()
    {
        return view('admin.gudang.create');
    }

    public function store(Request $request)
    {
        // Menambahkan validasi data (Sangat disukai dosen agar aplikasi tidak gampang crash)
        $request->validate([
            'nama_sampah' => 'required|string|max:255',
            'kategori'    => 'required|string',
            'berat'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|numeric|min:0',
        ]);

        // Menyimpan data ke database
        Gudang::create([
            'nama_sampah' => $request->nama_sampah,
            'kategori'    => $request->kategori,
            'berat'       => $request->berat,
            'stok'        => $request->stok,
            'harga'       => $request->harga,
            'status'      => $request->status ?? 'Tersedia', // Menjaga jika status kosong
        ]);

        // PERBAIKAN DI SINI: Diarahkan ke rute 'admin.gudang.index'
        return redirect()
            ->route('admin.gudang.index')
            ->with('success', 'Data gudang berhasil ditambahkan! 📦');
    }

    public function edit($id)
    {
        $item = Gudang::findOrFail($id);

        // Pastikan view ini ada atau nanti dibuat: resources/views/admin/gudang/edit.blade.php
        return view('admin.gudang.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Gudang::findOrFail($id);

        $request->validate([
            'nama_sampah' => 'required|string|max:255',
            'kategori'    => 'required|string',
            'berat'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'harga'       => 'required|numeric|min:0',
        ]);

        $item->update([
            'nama_sampah' => $request->nama_sampah,
            'kategori'    => $request->kategori,
            'berat'       => $request->berat,
            'stok'        => $request->stok,
            'harga'       => $request->harga,
            'status'      => $request->status ?? $item->status ?? 'Tersedia',
        ]);

        return redirect()
            ->route('admin.gudang.index')
            ->with('success', 'Data gudang berhasil diperbarui! ✅');
    }

    // Menambahkan fungsi hapus (destroy) agar sinkron dengan tombol hapus di view index
    public function destroy($id)
    {
        $item = Gudang::findOrFail($id);
        $item->delete();

        return redirect()
            ->route('admin.gudang.index')
            ->with('success', 'Data stok gudang berhasil dihapus! 🗑️');
    }
}

