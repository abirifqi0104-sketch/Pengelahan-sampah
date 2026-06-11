<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan Maggot - Pesan Green</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #1B4332; border-radius: 10px; }
    </style>
</head>
<body class="bg-gray-50 antialiased overflow-x-hidden">

<div class="flex min-h-screen relative w-full">

    {{-- SIDEBAR --}}
    @include('admin.partials.sidebar')

    {{-- MAIN CONTENT AREA --}}
    <div class="flex-1 flex flex-col min-w-0 w-0 md:pl-72 min-h-screen bg-gray-50">
        
        {{-- HEADER --}}
        <header class="sticky top-0 z-30 bg-white border-b border-gray-100 h-16 px-6 md:px-8 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-[#1B4332] text-white flex items-center justify-center">
                    <i class="fas fa-store text-sm"></i>
                </div>
                <h1 class="text-base md:text-lg font-bold text-gray-800 tracking-tight">Manajemen Maggot BSF</h1>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3 border-l border-gray-100 pl-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-gray-800 leading-tight">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-[10px] text-emerald-600 uppercase tracking-wider mt-0.5">🟢 Online</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'A' }}&background=1B4332&color=fff" class="w-8 h-8 rounded-full shadow-sm border border-gray-100">
                </div>
            </div>
        </header>

        {{-- TAB NAVIGASI --}}
        <div class="bg-white px-6 md:px-8 border-b border-gray-200">
            <nav class="flex gap-6 -mb-px overflow-x-auto">
                <a href="{{ url('admin/maggot') }}" class="py-4 text-sm font-bold text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-seedling"></i> Data Budidaya
                </a>
                <a href="{{ url('admin/maggot/panen') }}" class="py-4 text-sm font-bold text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-box-open"></i> Hasil Panen
                </a>
                {{-- TAB PENJUALAN AKTIF --}}
                <a href="{{ url('admin/maggot/penjualan') }}" class="py-4 text-sm font-bold border-b-2 border-[#1B4332] text-[#1B4332] flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-store"></i> Penjualan (Produk Olahan)
                </a>
            </nav>
        </div>

        {{-- MAIN CONTENT --}}
        <main class="p-6 md:p-8 w-full max-w-7xl mx-auto flex-1 box-border">
            
            <div class="mb-6">
                <h2 class="text-xl md:text-2xl font-black text-gray-800 tracking-tight">Penjualan & Konversi Maggot</h2>
                <p class="text-xs text-gray-500 mt-1">Olah hasil panen menjadi produk bernilai jual, tentukan harga, dan unggah foto produk.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- KIRI: FORM TAMBAH PRODUK --}}
                <div class="lg:col-span-1">
                    {{-- FORM KONVERSI PANEN --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative overflow-hidden mb-6">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-50 rounded-bl-full -z-0 opacity-50"></div>
                        <h3 class="text-sm font-bold text-gray-800 mb-4 flex items-center gap-2 relative z-10">
                            <i class="fas fa-exchange-alt text-emerald-600"></i> Konversi Hasil Panen
                        </h3>
                        
                        <form action="{{ url('admin/maggot/penjualan/konversi') }}" method="POST" class="space-y-4 relative z-10">
                            @csrf
                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Pilih Produk Asal</label>
                                <select name="sumber_produk" class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-xs outline-none focus:border-emerald-600 bg-white">
                                    <option value="">-- Pilih Hasil Panen --</option>
                                    <option value="Maggot Fresh">Maggot Fresh (Basah)</option>
                                    <option value="Kasgot">Kasgot (Pupuk)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Jumlah Diproses (Kg)</label>
                                <input type="number" step="0.01" name="jumlah_kg" placeholder="Contoh: 10.5" class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-xs outline-none focus:border-emerald-600">
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Konversi Menjadi</label>
                                <select name="tujuan_produk" class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-xs outline-none focus:border-emerald-600 bg-white">
                                    <option value="Maggot Kering">Maggot Kering (Dry)</option>
                                    <option value="Pelet Maggot">Pelet Pakan Ikan</option>
                                    <option value="Pupuk Kasgot Kemasan">Pupuk Kasgot (Kemasan)</option>
                                </select>
                            </div>

                            <button type="submit" class="w-full bg-[#1B4332] hover:bg-[#133024] text-white py-3 rounded-xl text-xs font-bold transition shadow-sm flex items-center justify-center gap-2 mt-2">
                                <i class="fas fa-box"></i> Proses Jadi Stok
                            </button>
                        </form>
                    </div>

                    {{-- FORM TAMBAH PRODUK DENGAN HARGA DAN FOTO --}}
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl shadow-sm border border-blue-200 p-6 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-200 rounded-bl-full -z-0 opacity-30"></div>
                        <h3 class="text-sm font-bold text-gray-800 mb-4 flex items-center gap-2 relative z-10">
                            <i class="fas fa-plus-circle text-blue-600"></i> Tambah Produk Penjualan
                        </h3>
                        
                        <form action="{{ url('admin/maggot/penjualan/tambah') }}" method="POST" enctype="multipart/form-data" class="space-y-3 relative z-10">
                            @csrf
                            
                            <div>
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wider mb-1">Nama Produk *</label>
                                <input type="text" name="nama_produk" placeholder="Cth: Maggot Kering Premium" required class="w-full border border-blue-300 rounded-xl px-3 py-2.5 text-xs outline-none focus:border-blue-600 bg-white">
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wider mb-1">Harga/Kg (Rp) *</label>
                                    <input type="number" name="harga" placeholder="50000" required min="0" step="1000" class="w-full border border-blue-300 rounded-xl px-3 py-2.5 text-xs outline-none focus:border-blue-600 bg-white">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wider mb-1">Stok (Kg) *</label>
                                    <input type="number" name="stok" placeholder="10.5" required min="0" step="0.01" class="w-full border border-blue-300 rounded-xl px-3 py-2.5 text-xs outline-none focus:border-blue-600 bg-white">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wider mb-1">Upload Foto Produk</label>
                                <input type="file" name="foto" accept="image/*" class="w-full border border-blue-300 rounded-xl px-3 py-2.5 text-xs outline-none focus:border-blue-600 bg-white file:bg-blue-500 file:text-white file:border-none file:py-1 file:px-2 file:rounded file:cursor-pointer file:text-xs file:font-bold">
                                <p class="text-[10px] text-gray-600 mt-1">Max: 2MB (JPEG, PNG, JPG, GIF)</p>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wider mb-1">Deskripsi (Opsional)</label>
                                <textarea name="deskripsi" placeholder="Cth: Maggot berkualitas premium dari panen terbaru..." rows="2" class="w-full border border-blue-300 rounded-xl px-3 py-2.5 text-xs outline-none focus:border-blue-600 bg-white resize-none"></textarea>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl text-xs font-bold transition shadow-sm flex items-center justify-center gap-2">
                                <i class="fas fa-save"></i> Tambahkan ke Etalase
                            </button>
                        </form>
                    </div>
                </div>

                {{-- KANAN: ETALASE SIAP JUAL --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden h-full flex flex-col">
                        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                            <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                                <i class="fas fa-store-alt text-emerald-600"></i> Etalase Siap Jual
                            </h3>
                            <button class="bg-emerald-50 text-emerald-700 px-3 py-1.5 rounded-lg text-xs font-bold border border-emerald-100 hover:bg-emerald-100 transition">
                                <i class="fas fa-print mr-1"></i> Cetak Katalog
                            </button>
                        </div>
                        
                        <div class="overflow-x-auto flex-1 p-6">
                            @if($etalase && count($etalase) > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($etalase as $item)
                                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl border border-gray-200 p-4 hover:shadow-md transition">

                                        {{-- Foto Produk --}}
                                        @if($item->foto)
                                            <div class="mb-3 rounded-xl overflow-hidden h-40 bg-gray-200 flex items-center justify-center">
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_produk }}" class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div class="mb-3 rounded-xl overflow-hidden h-40 bg-gray-300 flex items-center justify-center">
                                                <i class="fas fa-image text-gray-500 text-3xl opacity-50"></i>
                                            </div>
                                        @endif

                                        {{-- Nama & Info Produk --}}
                                        <h4 class="text-sm font-bold text-gray-800 mb-2">{{ $item->nama_produk }}</h4>
                                        
                                        @if($item->deskripsi)
                                            <p class="text-[11px] text-gray-600 mb-3 line-clamp-2">{{ $item->deskripsi }}</p>
                                        @endif

                                        {{-- Harga & Stok --}}
                                        <div class="flex items-center justify-between mb-3 p-2 bg-white rounded-lg">
                                            <div>
                                                <p class="text-[10px] text-gray-500 uppercase font-bold">Harga/Kg</p>
                                                <p class="text-sm font-bold text-emerald-600">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                            </div>
                                            <div>
                                                <p class="text-[10px] text-gray-500 uppercase font-bold">Stok</p>
                                                <p class="text-sm font-bold text-blue-600">{{ number_format($item->stok, 2) }} Kg</p>
                                            </div>
                                        </div>

                                        {{-- Aksi Tombol --}}
                                        <div class="flex gap-2">
                                            <a href="{{ url('admin/maggot/penjualan/' . $item->id . '/edit') }}" class="flex-1 text-center bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg text-xs font-bold transition flex items-center justify-center gap-1">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ url('admin/maggot/penjualan/' . $item->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg text-xs font-bold transition flex items-center justify-center gap-1">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @else
                                <div class="text-center py-12">
                                    <i class="fas fa-box-open text-5xl text-gray-300 mb-3"></i>
                                    <p class="text-sm text-gray-500 font-semibold">Belum ada produk di etalase.</p>
                                    <p class="text-xs text-gray-400">Silakan tambahkan produk penjualan terlebih dahulu.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#1B4332',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif
    });
</script>

</body>
</html>