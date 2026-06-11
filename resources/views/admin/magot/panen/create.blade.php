<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Panen Maggot - Pesan Green</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 antialiased overflow-x-hidden">

<div class="flex min-h-screen relative w-full">
    
    {{-- SIDEBAR --}}
    @include('admin.partials.sidebar')

    {{-- MAIN CONTENT (Pasti aman, tidak numpang sidebar) --}}
    <div class="flex-1 flex flex-col min-w-0 w-0 md:pl-72 min-h-screen bg-gray-50">
        
        <header class="sticky top-0 z-30 bg-white border-b border-gray-100 h-16 px-6 md:px-8 flex items-center gap-4 shadow-sm">
            <a href="{{ route('admin.maggot.panen') }}" class="w-8 h-8 rounded-full bg-gray-50 hover:bg-gray-100 border flex items-center justify-center text-gray-600 transition">
                <i class="fas fa-arrow-left text-sm"></i>
            </a>
            <h1 class="text-base md:text-lg font-bold text-gray-800 tracking-tight">Kembali ke Daftar Panen</h1>
        </header>

        <main class="p-6 md:p-8 w-full max-w-3xl mx-auto flex-1 box-border mt-4">
            
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                
                {{-- HEADER KARTU FORM --}}
                <div class="bg-[#1B4332] p-6 md:p-8 text-white text-center">
                    <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-3 backdrop-blur-sm border border-white/20">
                        <i class="fas fa-balance-scale text-2xl text-emerald-100"></i>
                    </div>
                    <h2 class="text-2xl font-black">Formulir Input Panen</h2>
                    <p class="text-xs md:text-sm text-emerald-100 mt-2">Catat hasil timbangan panen maggot dari biopond aktif.</p>
                </div>

                {{-- ISI FORM --}}
                <div class="p-6 md:p-8">
                    <form action="{{ route('admin.maggot.panen.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        {{-- PILIH BIOPOND --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                                Pilih Biopond (Siklus Aktif) <span class="text-red-500">*</span>
                            </label>
                            <select name="maggot_id" required class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm outline-none focus:border-emerald-600 focus:ring-1 focus:ring-emerald-600 bg-white shadow-sm transition">
                                <option value="">-- Silakan Pilih Lokasi Biopond --</option>
                                @foreach($maggots as $maggot)
                                    <option value="{{ $maggot->id }}">
                                        🏢 {{ $maggot->biopond_name }} (Kode: {{ $maggot->cultivation_code }})
                                    </option>
                                @endforeach
                            </select>
                            @if($maggots->isEmpty())
                                <p class="text-[10.5px] text-red-500 mt-2 font-semibold bg-red-50 p-2 rounded-lg border border-red-100">
                                    <i class="fas fa-exclamation-circle mr-1"></i> Tidak ada biopond yang berstatus "Aktif". Pastikan Anda sudah membuat siklus budidaya.
                                </p>
                            @endif
                        </div>

                        {{-- TANGGAL & HASIL TIMBANGAN --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                                    Tanggal Panen <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="tanggal_panen" value="{{ date('Y-m-d') }}" required class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm outline-none focus:border-emerald-600 shadow-sm transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                                    Hasil Panen <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="number" step="0.01" name="hasil_kg" placeholder="Contoh: 10.5" required class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm outline-none focus:border-emerald-600 shadow-sm transition">
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold text-sm bg-white pl-2">Kg</span>
                                </div>
                            </div>
                        </div>

                        {{-- KETERANGAN --}}
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">
                                Keterangan / Catatan Tambahan
                            </label>
                            <textarea name="keterangan" rows="3" placeholder="Contoh: Kondisi maggot sangat sehat, ukuran merata..." class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm outline-none focus:border-emerald-600 shadow-sm transition resize-none"></textarea>
                        </div>

                        {{-- TOMBOL SUBMIT --}}
                        <div class="pt-6 border-t border-gray-100 mt-2">
                            <button type="submit" class="w-full bg-[#1B4332] hover:bg-[#133024] text-white py-3.5 rounded-xl text-sm font-bold transition shadow-md flex justify-center items-center gap-2 group">
                                <i class="fas fa-save group-hover:scale-110 transition-transform"></i> Simpan Data Panen
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>
</div>

</body>
</html>