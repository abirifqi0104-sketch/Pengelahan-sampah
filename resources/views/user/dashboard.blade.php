<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Nasabah - Pesan Green</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 antialiased text-gray-800">

<div class="flex min-h-screen relative w-full">

    {{-- SIDEBAR --}}
    <aside class="z-40">
        @include('user.partials.sidebar')
    </aside>

    {{-- MAIN CONTENT AREA (Menyesuaikan dengan lebar Sidebar w-72) --}}
    <div class="flex-1 flex flex-col min-w-0 w-0 md:pl-72 min-h-screen bg-gray-50">
        {{-- BAGIAN KATALOG PRODUK OLAHAN --}}
            <div class="mt-8 bg-white rounded-3xl p-6 border border-gray-100 shadow-xs">
                <div class="flex items-center justify-between mb-6 border-b border-gray-50 pb-4">
                    <div>
                        <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2 uppercase tracking-wide">
                            <i class="fas fa-store text-emerald-600 text-lg"></i> Etalase Produk Olahan
                        </h3>
                        <p class="text-[11px] text-gray-500 mt-1">Hasil olahan sampah organik Anda yang diproses menjadi pakan dan pupuk.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse($produkOlahan as $produk)
                    {{-- KARTU PRODUK --}}
                    <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100 hover:shadow-md transition group">
                        <div class="aspect-square bg-white rounded-xl mb-4 overflow-hidden flex items-center justify-center relative">
                            {{-- Jika ada foto produk di DB, tampilkan. Jika tidak, pakai placeholder --}}
                            @if($produk->foto)
                                <img src="{{ asset('storage/'.$produk->foto) }}" alt="{{ $produk->nama_produk }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <i class="fas fa-box-open text-4xl text-gray-200"></i>
                            @endif
                            
                            {{-- Badge Stok --}}
                            <span class="absolute top-2 right-2 bg-[#1B4332] text-white text-[10px] font-bold px-2 py-1 rounded-lg">
                                Stok: {{ $produk->stok }}
                            </span>
                        </div>
                        <h4 class="font-bold text-gray-800 text-sm mb-1 truncate">{{ $produk->nama_produk }}</h4>
                        <div class="flex justify-between items-end mt-3">
                            <div>
                                <p class="text-[10px] text-gray-400 font-bold uppercase mb-0.5">Harga</p>
                                <p class="text-emerald-600 font-black text-sm">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                            </div>
                            <button class="bg-emerald-100 text-emerald-700 hover:bg-emerald-600 hover:text-white h-8 w-8 rounded-full flex items-center justify-center transition">
                                <i class="fas fa-shopping-cart text-xs"></i>
                            </button>
                        </div>
                    </div>
                    @empty
                    {{-- TAMPILAN JIKA BELUM ADA PRODUK --}}
                    <div class="col-span-full py-8 text-center bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                        <i class="fas fa-box-open text-4xl text-gray-300 mb-3 block"></i>
                        <p class="font-medium text-sm text-gray-500">Belum ada produk olahan yang tersedia saat ini.</p>
                        <p class="text-xs text-gray-400 mt-1">Admin sedang memproses budidaya maggot, tunggu ya! 🌱</p>
                    </div>
                    @endforelse
                </div>
            </div>
        
        {{-- HEADER --}}
        <header class="bg-white border-b border-gray-100 h-16 px-6 flex items-center justify-between sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-2">
                <i class="fas fa-leaf text-[#1B4332] text-sm"></i>
                <h1 class="text-sm font-bold text-gray-800 tracking-wide">Beranda Nasabah 👋</h1>
            </div>
            
            {{-- Info Saldo Ringkas di Header --}}
            <a href="{{ route('user.withdraw.index') }}" class="flex items-center gap-3 bg-emerald-50 px-4 py-1.5 rounded-full border border-emerald-100 hover:bg-emerald-100 transition">
                <i class="fas fa-wallet text-emerald-600 text-sm"></i>
                <span class="text-xs font-bold text-emerald-800">Rp {{ number_format($user->saldo, 0, ',', '.') }}</span>
            </a>
        </header>

        {{-- MAIN CONTENT --}}
        <main class="p-6 md:p-8 w-full max-w-6xl mx-auto flex-1 box-border">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- KOLOM KIRI: FORM SETORAN --}}
                <div class="lg:col-span-1 space-y-6">
                    
                    {{-- KARTU SALDO (Gaya Admin) --}}
                    <div class="bg-[#1B4332] rounded-3xl p-6 text-white shadow-md relative overflow-hidden">
                        <div class="absolute -right-4 -bottom-4 text-white/10 text-8xl"><i class="fas fa-coins"></i></div>
                        <h3 class="text-[11px] text-emerald-200 font-bold uppercase tracking-wider mb-1 relative z-10">Total Tabungan Anda</h3>
                        <h2 class="text-3xl font-black relative z-10 tracking-tight">Rp {{ number_format($user->saldo, 0, ',', '.') }}</h2>
                        <div class="mt-4 pt-4 border-t border-emerald-800 relative z-10">
                            <p class="text-[10px] text-emerald-100 leading-relaxed">Saldo akan otomatis bertambah setelah Admin melakukan penimbangan dan verifikasi setoran Anda.</p>
                        </div>
                    </div>

                    {{-- FORM SETORAN (Gaya Admin) --}}
                    <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-xs">
                        <h3 class="text-sm font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-recycle text-emerald-600"></i> Form Setor Sampah
                        </h3>
                        
                        <form action="{{ route('user.submit-waste.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            
                            <div>
                                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Jenis Sampah Organik</label>
                                <select name="trash_type" required class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-xs bg-white outline-none focus:border-emerald-600">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Sisa Makanan / Dapur">Sisa Makanan / Dapur</option>
                                    <option value="Sayuran / Buah Busuk">Sayuran / Buah Busuk</option>
                                    <option value="Daun Kering / Ranting">Daun Kering / Ranting</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Perkiraan Berat (Kg)</label>
                                <input type="number" step="0.1" name="weight" required placeholder="Cth: 2.5" class="w-full border border-gray-200 rounded-xl px-3 py-2.5 text-xs outline-none focus:border-emerald-600 bg-white">
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Upload Foto Fisik Sampah</label>
                                <input type="file" name="image" accept="image/*" required class="w-full border border-gray-200 rounded-xl px-3 py-2 text-xs bg-white file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer outline-none focus:border-emerald-600">
                            </div>

                            <button type="submit" class="w-full bg-[#1B4332] hover:bg-[#133024] text-white py-2.5 rounded-xl text-xs font-bold transition shadow-sm mt-2 flex justify-center items-center gap-2">
                                <i class="fas fa-paper-plane"></i> Kirim Setoran
                            </button>
                        </form>
                    </div>
                </div>

                {{-- KOLOM KANAN: RIWAYAT TABEL (Gaya Admin) --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-xs min-h-full overflow-hidden flex flex-col">
                        <div class="p-6 border-b border-gray-50 flex items-center justify-between">
                            <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                                <i class="fas fa-history text-emerald-600"></i> Riwayat Transaksi Anda
                            </h3>
                        </div>

                        <div class="flex-1 overflow-x-auto">
                            <table class="w-full text-left text-xs border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-100 font-bold text-gray-400 uppercase tracking-wider">
                                        <th class="p-4">ID Setoran</th>
                                        <th class="p-4">Tanggal</th>
                                        <th class="p-4">Jenis Sampah</th>
                                        <th class="p-4">Berat (Kg)</th>
                                        <th class="p-4">Pendapatan</th>
                                        <th class="p-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-gray-700 font-medium">
                                    @forelse($riwayatSetoran as $item)
                                    <tr class="hover:bg-gray-50/50 transition">
                                        <td class="p-4 font-bold text-gray-800">{{ $item->data_id }}</td>
                                        <td class="p-4">{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                                        <td class="p-4 font-bold text-gray-800">{{ $item->trash_type }}</td>
                                        <td class="p-4">{{ $item->weight }} Kg</td>
                                        <td class="p-4 font-black text-emerald-600">
                                            {{ $item->total_price ? 'Rp '.number_format($item->total_price, 0, ',', '.') : '-' }}
                                        </td>
                                        <td class="p-4">
                                            @if($item->status == 'pending')
                                                <span class="px-2 py-1 bg-amber-50 text-amber-600 border border-amber-200 rounded font-bold text-[10px] uppercase tracking-wide">⏳ Menunggu</span>
                                            @elseif($item->status == 'approved')
                                                <span class="px-2 py-1 bg-emerald-50 text-emerald-600 border border-emerald-200 rounded font-bold text-[10px] uppercase tracking-wide">✓ Disetujui</span>
                                            @else
                                                <span class="px-2 py-1 bg-red-50 text-red-600 border border-red-200 rounded font-bold text-[10px] uppercase tracking-wide">✕ Ditolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="p-10 text-center text-gray-400">
                                            <i class="fas fa-inbox text-3xl mb-3 opacity-30 block"></i>
                                            <p class="font-medium text-sm">Belum ada data setoran. <a href="{{ route('user.submit-waste') }}" class="text-emerald-600 font-bold">Mulai setor sekarang</a></p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        confirmButtonColor: '#1B4332',
        customClass: { popup: 'rounded-3xl' }
    });
</script>
@endif

</body>
</html>