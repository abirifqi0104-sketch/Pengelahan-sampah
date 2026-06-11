<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrashData;
use App\Models\User;

class VerifikasiController extends Controller
{
    // Menampilkan daftar setoran yang MENUNGGU verifikasi saja
    public function index()
    {
        $items = TrashData::with('user')
                ->where('status', 'pending')
                ->latest()
                ->paginate(10);

        // Catatan: sesuaikan nama view di bawah dengan nama file blade Anda
        // Jika nama filenya verifikasi-list.blade.php, ubah jadi 'admin.verifikasi-list'
        return view('admin.verifikasi', compact('items')); 
    }

    // Fungsi Tombol "Setujui / Approve"
    public function approve(Request $request, $id)
    {
        $data = TrashData::findOrFail($id);
        
        // Ubah status menjadi disetujui
        $data->status = 'approved';

        // Jika form admin mengirimkan 'total_price' (harga setelah ditimbang admin)
        if ($request->has('total_price')) {
            $data->total_price = $request->total_price;
        }
        
        $data->save();

        // OTOMATIS: Tambahkan saldo ke akun nasabah
        $user = User::find($data->user_id);
        if ($user) {
            $user->saldo += $data->total_price;
            $user->save();
        }

        return back()->with('success', 'Setoran berhasil diverifikasi! Status nasabah menjadi Disetujui & Saldo otomatis bertambah.');
    }

    // Fungsi Tombol "Tolak / Reject"
    public function reject($id)
    {
        $data = TrashData::findOrFail($id);
        
        // Ubah status menjadi ditolak
        $data->status = 'rejected';
        $data->save();

        return back()->with('error', 'Setoran sampah telah ditolak.');
    }
}