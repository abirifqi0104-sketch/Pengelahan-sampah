<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrashData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // =========================================================
    // 1. DASHBOARD USER (Tetap Khusus Nasabah)
    // =========================================================
   public function userDashboard()
    {
        $user = Auth::user();

        $totalOrganik = TrashData::where('user_id', $user->id)->where('trash_type', 'Sampah Organik')->where('status', 'approved')->sum('weight');
        $totalPlastik = TrashData::where('user_id', $user->id)->where('trash_type', 'Sampah Plastik')->where('status', 'approved')->sum('weight');
        $recentActivities = TrashData::where('user_id', $user->id)->latest()->take(5)->get();
        
        // PENTING: Menarik data produk olahan yang stoknya masih tersedia
        $produkOlahan = \App\Models\ProdukOlahan::where('stok', '>', 0)->latest()->get(); 

        $riwayatSetoran = TrashData::where('user_id', $user->id)->latest()->take(10)->get();

        return view('user.dashboard', compact('user', 'totalOrganik', 'totalPlastik', 'recentActivities', 'riwayatSetoran', 'produkOlahan'));
    }

    // =========================================================
    // 2. HALAMAN INDEX (Dibuat Dinamis: Admin vs User)
    // =========================================================
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            // Admin: Melihat SEMUA riwayat setoran dari seluruh nasabah
            $items = TrashData::with('user')->latest()->paginate(10);
            return view('admin.transactions.index', compact('items')); 
        } else {
            // User: Hanya melihat riwayat milik dirinya sendiri
            $items = TrashData::where('user_id', Auth::id())->latest()->paginate(10);
            return view('user.transactions.index', compact('items'));
        }
    }

    // =========================================================
    // 3. HALAMAN FORM INPUT (Dibuat Dinamis: Admin vs User)
    // =========================================================
    public function create()
    {
        if (Auth::user()->role === 'admin') {
            // Admin: Menginput setoran offline, butuh data daftar nasabah untuk Dropdown
            $nasabah = User::where('role', 'user')->get();
            return view('admin.transactions.create', compact('nasabah'));
        } else {
            // User: Form setor sampah mandiri lewat hp
            return view('user.submit-waste');
        }
    }

    // =========================================================
    // 4. PROSES SIMPAN DATA (Dibuat Dinamis: Admin vs User)
    // =========================================================
    public function store(Request $request)
    {
        if (Auth::user()->role === 'admin') {
            // -------------------------------------------------
            // LOGIKA ADMIN: INPUT MANUAL/OFFLINE (LANGSUNG ACC)
            // -------------------------------------------------
            $request->validate([
                'user_id' => 'required|exists:users,id', // Harus pilih nasabah
                'trash_type' => 'required',
                'weight' => 'required|numeric|min:0.1',
                'total_price' => 'required|numeric|min:0', // Admin langsung tentukan harga di tempat
                'location' => 'nullable|string',
                'description' => 'nullable|string|max:500',
            ]);

            $data = new TrashData();
            $data->user_id = $request->user_id; // Disimpan atas nama nasabah yang dipilih
            $data->data_id = '#OFFLINE-' . time() . '-' . rand(1000, 9999);
            $data->trash_type = $request->trash_type;
            $data->weight = $request->weight;
            $data->date = now()->toDateString();
            $data->location = $request->location ?? 'Gudang Pusat';
            $data->description = $request->description;
            $data->status = 'approved'; // Langsung Berstatus DISETUJUI karena admin yang input
            $data->total_price = $request->total_price;
            $data->save();

            // Otomatis tambahkan nominal uang ke saldo nasabah tersebut
            $userNasabah = User::find($request->user_id);
            if ($userNasabah) {
                $userNasabah->saldo = $userNasabah->saldo + $request->total_price;
                $userNasabah->save();
            }

            return redirect()->route('admin.transactions.index')->with('success', 'Setoran offline nasabah berhasil dicatat & saldo otomatis bertambah!');
        } else {
            // -------------------------------------------------
            // LOGIKA USER: SETOR MANDIRI (MENUNGGU VERIFIKASI)
            // -------------------------------------------------
            $request->validate([
                'trash_type' => 'required',
                'weight' => 'required|numeric|min:0.1',
                'location' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description' => 'nullable|string|max:500',
            ]);

            $data = new TrashData();
            $data->user_id = Auth::id();
            $data->data_id = '#SETOR-' . time() . '-' . rand(1000, 9999);
            $data->trash_type = $request->trash_type;
            $data->weight = $request->weight;
            $data->date = now()->toDateString();
            $data->location = $request->location;
            $data->description = $request->description;
            $data->status = 'pending'; // Berstatus PENDING, harus lewat verifikasi admin dulu
            $data->total_price = 0;

            // PERBAIKAN: Menghapus baris $data->foto = $data->image; yang memicu error
            if ($request->hasFile('image')) {
                $data->image = $request->file('image')->store('trash-data', 'public');
            }

            $data->save();

            return redirect()->route('user.dashboard')->with('success', 'Permintaan setor sampah berhasil dikirim! Menunggu verifikasi admin.');
        }
    }

    // Fungsi tambahan pencocokan nama route store baru
    public function storeSetoran(Request $request)
    {
        return $this->store($request);
    }

    // Riwayat User
    public function userHistory()
    {
        $items = TrashData::where('user_id', Auth::id())->latest()->paginate(10);
        return view('user.history', compact('items'));
    }
}