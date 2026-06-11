<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Stok Gudang - Pesan Green</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 antialiased">

<div class="flex min-h-screen relative w-full">

    {{-- SIDEBAR --}}
    <aside class="z-40">
        @include('admin.partials.sidebar')
    </aside>

    {{-- MAIN CONTENT AREA --}}
    <div class="flex-1 flex flex-col min-w-0 w-0 md:pl-72 min-h-screen bg-gray-50">
        
        {{-- HEADER --}}
        <header class="bg-white border-b border-gray-100 h-16 px-6 flex items-center justify-between sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-2">
                <i class="fas fa-warehouse text-[#1B4332] text-sm"></i>
                <h1 class="text-sm font-bold text-gray-800 tracking-wide">Gudang Sampah > Tambah Data 📦</h1>
            </div>
            <a href="{{ route('admin.gudang.index') }}" class="text-xs font-bold text-emerald-700 hover:underline flex items-center gap-1">
                <i class="fas fa-arrow-left text-[10px]"></i> Kembali ke Gudang
            </a>
        </header>

        {{-- MAIN CONTENT --}}
        <main class="p-6 md:p-8 w-full max-w-3xl mx-auto flex-1 box-border">

            {{-- FORM CARD --}}
            <div class="bg-white rounded-3xl shadow-xs border border-gray-100 p-8">
                <div class="mb-6">
                    <h2 class="text-2xl font-black text-gray-800 tracking-tight">Form Input Logistik Gudang 📥</h2>
                    <p class="text-xs text-gray-500 mt-1">Masukkan data penambahan pasokan atau stok sampah baru ke dalam sistem pergudangan.</p>
                </div>

                {{-- MENAMPILKAN ERROR VALIDASI JIKA ADA --}}
                @if ($errors->any())
                    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-xs font-medium space-y-1">
                        <p class="font-bold">Waduh, ada kesalahan input data 😲 :</p>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.gudang.store') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- INPUT NAMA SAMPAH --}}
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Nama Sampah / Material</label>
                        <input type="text"
                               name="nama_sampah"
                               value="{{ old('nama_sampah') }}"
                               placeholder="Contoh: Botol Plastik PET, Kardus Bekas, dll."
                               class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm outline-none focus:border-green-600 transition" required>
                    </div>

                    {{-- INPUT KATEGORI (UBAH JADI SELECT SUPAYA RAPI) --}}
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Kategori Sampah</label>
                        <select name="kategori" 
                                class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-white outline-none focus:border-green-600 transition" required>
                            <option value="" disabled selected>-- Pilih Kategori Sampah --</option>
                            <option value="Organik" {{ old('kategori') == 'Organik' ? 'selected' : '' }}>Organik 🥬 (Bahan Magot)</option>
                            <option value="Anorganik" {{ old('kategori') == 'Anorganik' ? 'selected' : '' }}>non organik 🍾 (Plastik/ketas/Besi/Kaca)</option>
                            <option value="B3" {{ old('kategori') == 'B3' ? 'selected' : '' }}>B3 ⚠️ (Bahan Berbahaya)</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- INPUT BERAT --}}
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Total Berat (Kg)</label>
                            <div class="relative flex items-center">
                                <input type="number"
                                       step="0.01"
                                       name="berat"
                                       value="{{ old('berat') }}"
                                       placeholder="0.00"
                                       class="w-full border border-gray-200 rounded-2xl pl-4 pr-12 py-3 text-sm outline-none focus:border-green-600 transition" required>
                                <span class="absolute right-4 text-xs font-bold text-gray-400">Kg</span>
                            </div>
                        </div>

                        {{-- INPUT STOK / JUMLAH WADAH --}}
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Jumlah Unit / Stok Koli</label>
                            <div class="relative flex items-center">
                                <input type="number"
                                       name="stok"
                                       value="{{ old('stok') }}"
                                       placeholder="Contoh: 5"
                                       class="w-full border border-gray-200 rounded-2xl pl-4 pr-14 py-3 text-sm outline-none focus:border-green-600 transition" required>
                                <span class="absolute right-4 text-xs font-bold text-gray-400">Karung</span>
                            </div>
                        </div>
                    </div>

                    {{-- INPUT HARGA ESTIMASI --}}
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Estimasi Nilai / Harga Per Kg (Rp)</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 text-xs font-bold text-gray-400">Rp</span>
                            <input type="number"
                                   step="0.01"
                                   name="harga"
                                   value="{{ old('harga') }}"
                                   placeholder="Contoh: 3500"
                                   class="w-full border border-gray-200 rounded-2xl pl-12 pr-4 py-3 text-sm outline-none focus:border-green-600 transition" required>
                        </div>
                    </div>

                    {{-- STATUS LOGISTIK GUDANG --}}
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Status Logistik</label>
                        <select name="status" class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-white outline-none focus:border-green-600 transition">
                            <option value="Tersedia" {{ old('status') == 'Tersedia' ? 'selected' : '' }}>🟢 Tersedia / Siap Proses</option>
                            <option value="Penuh" {{ old('status') == 'Penuh' ? 'selected' : '' }}>🔴 Gudang Penuh</option>
                        </select>
                    </div>

                    {{-- TOMBOL SUBMIT --}}
                    <div class="pt-2">
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#1B4332] hover:bg-[#133024] text-white px-8 py-3.5 rounded-2xl font-bold text-xs shadow-md transition">
                            <i class="fas fa-save text-[10px]"></i> Simpan Data Gudang ✨
                        </button>
                    </div>

                </form>
            </div>

        </main>
    </div>
</div>

</body>
</html>