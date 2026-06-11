<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Budidaya Magot - Pesan Green</title>
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
                <i class="fas fa-bug text-[#1B4332] text-xs"></i>
                <h1 class="text-sm font-bold text-gray-800 tracking-wide">Budidaya Magot > Mulai Siklus 🌱</h1>
            </div>
            <a href="{{ route('admin.maggot.index') }}" class="text-xs font-bold text-emerald-700 hover:underline flex items-center gap-1">
                <i class="fas fa-arrow-left text-[10px]"></i> Kembali ke Monitoring
            </a>
        </header>

        {{-- MAIN CONTENT --}}
        <main class="p-6 md:p-8 w-full max-w-2xl mx-auto flex-1 box-border">

            {{-- FORM CARD --}}
            <div class="bg-white rounded-3xl shadow-xs border border-gray-100 p-8">
                <div class="mb-6">
                    <h2 class="text-2xl font-black text-gray-800 tracking-tight">Mulai Siklus Baru 🐛</h2>
                    <p class="text-xs text-gray-500 mt-1">Daftarkan wadah biopond baru untuk mencatat perkembangan larva BSF dari awal tebar.</p>
                </div>

                {{-- NOTIFIKASI ERROR VALIDASI --}}
                @if ($errors->any())
                    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl text-xs font-medium space-y-1">
                        <p class="font-bold">Periksa kembali input data Anda 😲 :</p>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.maggot.store') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- NAMA BIOPOND / KOLONI --}}
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Nama Koloni / Kode Biopond 🏢</label>
                        <input type="text"
                               name="biopond_name"
                               value="{{ old('biopond_name') }}"
                               placeholder="Contoh: Biopond Rak Utama A-1"
                               class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm outline-none focus:border-green-600 transition" required>
                    </div>

                    {{-- BERAT AWAL BIBIT & SATUAN --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Jumlah / Berat Awal Bibit ⚖️</label>
                            <input type="number"
                                   step="0.01"
                                   name="initial_weight"
                                   value="{{ old('initial_weight') }}"
                                   placeholder="Contoh: 250"
                                   class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm outline-none focus:border-green-600 transition" required>
                        </div>

                        <div>
                            <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Satuan Berat</label>
                            <select name="unit" class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm bg-white outline-none focus:border-green-600 transition" required>
                                <option value="gram" {{ old('unit') == 'gram' ? 'selected' : '' }}>Gram (g) 🥚</option>
                                <option value="kg" {{ old('unit') == 'kg' ? 'selected' : '' }}>Kilogram (kg) 🐛</option>
                            </select>
                        </div>
                    </div>

                    {{-- TANGGAL TEBAR --}}
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Tanggal Tebar / Mulai Siklus 📅</label>
                        <input type="date"
                               name="start_date"
                               value="{{ old('start_date', '2026-05-21') }}"
                               class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm outline-none focus:border-green-600 transition" required>
                    </div>

                    {{-- CATATAN / DESKRIPSI --}}
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Catatan Awal (Pakan/Kondisi) 💬</label>
                        <textarea name="description"
                                  rows="4"
                                  placeholder="Contoh: Menggunakan sisa pakan buah organik basah dari gudang B..."
                                  class="w-full border border-gray-200 rounded-2xl px-4 py-3 text-sm outline-none focus:border-green-600 transition resize-none">{{ old('description') }}</textarea>
                    </div>

                    {{-- BUTTON SUBMIT --}}
                    <div class="pt-2">
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#1B4332] hover:bg-[#133024] text-white px-8 py-3.5 rounded-2xl font-bold text-xs shadow-md transition">
                            <i class="fas fa-save text-[10px]"></i> Simpan Siklus Baru ✨
                        </button>
                    </div>

                </form>
            </div>

        </main>
    </div>
</div>

</body>
</html>