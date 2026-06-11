<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gudang - Pesan Green</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 antialiased overflow-x-hidden">

<div class="flex min-h-screen w-full relative">

    {{-- SIDEBAR --}}
    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col min-w-0 w-0 md:pl-72 min-h-screen bg-gray-50">

        {{-- HEADER --}}
        <header class="sticky top-0 z-30 bg-white border-b border-gray-100 h-16 px-6 md:px-8 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <i class="fas fa-warehouse text-[#1B4332] text-lg"></i>
                <h1 class="text-base md:text-lg font-bold text-[#1B4332] tracking-tight">Edit Gudang</h1>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-xs font-bold text-gray-700 hidden sm:block">{{ Auth::user()->name ?? 'Admin' }}</span>
                <img src="https://ui-avatars.com/api/?name=Admin&background=1B4332&color=fff" class="w-8 h-8 rounded-full border">
            </div>
        </header>

        <main class="p-6 md:p-8 w-full box-border">

            <div class="mb-6">
                <a href="{{ route('admin.gudang.index') }}" class="text-xs font-bold text-emerald-700 hover:underline flex items-center gap-1">
                    <i class="fas fa-arrow-left text-[10px]"></i> Kembali ke Gudang
                </a>
                <h2 class="text-2xl font-black text-gray-800 tracking-tight mt-2">Form Edit Logistik Gudang 📦</h2>
                <p class="text-xs text-gray-500 mt-1">Update data stok dan harga sesuai logistik gudang.</p>
            </div>

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded-xl text-xs font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-xs border border-gray-100 overflow-hidden p-6">

                <form action="{{ route('admin.gudang.update', $item->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Nama Sampah</label>
                        <input type="text" name="nama_sampah" value="{{ old('nama_sampah', $item->nama_sampah) }}" class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-white outline-none focus:border-green-600 transition" required>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Kategori</label>
                        <input type="text" name="kategori" value="{{ old('kategori', $item->kategori) }}" class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-white outline-none focus:border-green-600 transition" required>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Berat (Kg)</label>
                            <input type="number" step="0.01" name="berat" value="{{ old('berat', $item->berat) }}" class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-white outline-none focus:border-green-600 transition" required>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Stok</label>
                            <input type="number" name="stok" value="{{ old('stok', $item->stok) }}" class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-white outline-none focus:border-green-600 transition" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Harga</label>
                        <input type="number" step="0.01" name="harga" value="{{ old('harga', $item->harga) }}" class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-white outline-none focus:border-green-600 transition" required>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Status</label>
                        <select name="status" class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-white outline-none focus:border-green-600 transition" required>
                            <option value="Tersedia" {{ old('status', $item->status) == 'Tersedia' ? 'selected' : '' }}>🟢 Tersedia / Siap Proses</option>
                            <option value="Penuh" {{ old('status', $item->status) == 'Penuh' ? 'selected' : '' }}>🔴 Gudang Penuh</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-[#1B4332] hover:bg-[#133024] text-white py-3 rounded-2xl text-xs font-bold shadow-md transition">
                        <i class="fas fa-save text-[10px] mr-2"></i> Simpan Perubahan
                    </button>
                </form>

            </div>
        </main>

    </div>

</div>

</body>
</html>

