<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pengelolaan - Pesan Green</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; }
        body { overflow-x: hidden; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-thumb { background: #1B4332; border-radius: 10px; }
    </style>
</head>
<body class="bg-gray-50 antialiased">

<div class="flex min-h-screen w-full relative">

    {{-- SIDEBAR --}}
    <aside class="z-40">
        @include('admin.partials.sidebar')
    </aside>

    {{-- 
      SOLUSI FIX AGAR TIDAK TERTIMPA: md:pl-72
      Menggeser area konten utama ke kanan selebar 18rem (288px) demi memberi ruang bagi sidebar yang 'fixed'.
    --}}
    <div class="flex-1 flex flex-col min-w-0 w-0 md:pl-72 min-h-screen bg-gray-50">

        {{-- HEADER --}}
        <header class="sticky top-0 z-30 bg-white border-b border-gray-100 h-16 px-6 lg:px-10 flex items-center justify-between shadow-sm">
            
            <div class="flex items-center gap-3">
                <button class="text-gray-500 text-lg md:hidden">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="flex items-center gap-2">
                    <i class="fas fa-info-circle text-[#1B4332] text-lg"></i>
                    <h1 class="text-base md:text-lg font-bold text-[#1B4332] tracking-tight">
                        Informasi Pengelolaan
                    </h1>
                </div>
            </div>

            <div class="flex items-center gap-5">
                {{-- SEARCH --}}
                <div class="relative hidden md:block">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                    <input
                        type="text"
                        placeholder="Cari informasi..."
                        class="w-64 bg-gray-50 border border-gray-200 focus:border-green-600 focus:ring-1 focus:ring-green-600 rounded-xl py-1.5 pl-10 pr-4 text-xs outline-none transition"
                    >
                </div>

                {{-- USER --}}
                <div class="flex items-center gap-3 border-l border-gray-100 pl-5">
                    <div class="text-right leading-tight hidden sm:block">
                        <p class="text-xs font-bold text-gray-800">
                            {{ Auth::user()->name ?? 'Admin' }}
                        </p>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-0.5">
                            Administrator
                        </p>
                    </div>

                    <img
                        src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=1B4332&color=fff"
                        class="w-8 h-8 rounded-full object-cover shadow-sm border border-gray-100"
                        alt="Avatar"
                    >
                </div>
            </div>
        </header>

        {{-- MAIN CONTENT BODY --}}
        <main class="w-full px-6 lg:px-10 py-8 box-border flex-1">

            {{-- TOP SECTION --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-5 mb-8">
                <div>
                    <h2 class="text-xl md:text-2xl font-black text-gray-800 tracking-tight">
                        Informasi Pengelolaan
                    </h2>
                    <p class="text-xs text-gray-500 mt-1">
                        Edukasi, berita, dan tips pengelolaan sampah modern.
                    </p>
                </div>

                {{-- FILTER & ACTION --}}
                <div class="flex items-center gap-3 flex-wrap">
                    <select class="bg-white border border-gray-200 rounded-xl px-4 py-2 text-xs shadow-sm outline-none focus:border-green-600 focus:ring-1 focus:ring-green-600 font-medium text-gray-700 transition">
                        <option>Semua Kategori</option>
                        <option>Edukasi</option>
                        <option>Tips</option>
                        <option>Berita</option>
                        <option>Bank Sampah</option>
                    </select>

                    <button class="bg-[#1B4332] hover:bg-[#2D6A4F] text-white px-4 py-2 rounded-xl text-xs font-bold transition shadow-sm flex items-center gap-2">
                        <i class="fas fa-plus text-[10px]"></i>
                        Tambah Info
                    </button>
                </div>
            </div>

            {{-- HERO BANNER --}}
            <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-[#1B4332] to-[#2D6A4F] p-8 md:p-10 mb-8 shadow-sm">
                <div class="relative z-10 max-w-2xl">
                    <span class="bg-white/20 text-white px-3 py-1 rounded-md text-[10px] font-bold tracking-wider uppercase">
                        PESAN GREEN
                    </span>

                    <h3 class="text-2xl lg:text-4xl font-black text-white mt-4 leading-tight tracking-tight">
                        Kelola Sampah Jadi Lebih Bernilai
                    </h3>

                    <p class="text-green-100/90 mt-3 text-xs lg:text-sm leading-relaxed max-w-xl">
                        Sistem manajemen bank sampah digital modern untuk membantu pengelolaan sampah organik, anorganik, budidaya maggot, dan peningkatan ekonomi masyarakat.
                    </p>

                    <button class="mt-5 bg-white text-[#1B4332] hover:bg-gray-50 px-5 py-2 rounded-xl font-bold text-xs transition shadow-sm">
                        Pelajari Sekarang
                    </button>
                </div>

                <div class="absolute right-[-20px] bottom-[-40px] opacity-10 text-[180px] lg:text-[220px] text-white pointer-events-none">
                    <i class="fas fa-recycle"></i>
                </div>
            </div>

            {{-- CARDS GRID --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 w-full">

                {{-- CARD 1 --}}
                <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition duration-300 group flex flex-col">
                    <div class="h-48 overflow-hidden relative bg-gray-100">
                        <img
                            src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&w=800&q=80"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                            alt="Edukasi"
                        >
                        <div class="absolute top-3 left-3">
                            <span class="bg-blue-600 text-white px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wider">
                                Edukasi
                            </span>
                        </div>
                    </div>

                    <div class="p-5 flex flex-col flex-1">
                        <h4 class="text-sm font-bold text-gray-800 leading-snug mb-2 group-hover:text-green-700 transition">
                            Pemilahan Sampah Rumah Tangga
                        </h4>
                        <p class="text-xs text-gray-500 leading-relaxed mb-4 flex-1">
                            Pelajari cara memilah sampah organik dan anorganik dengan benar untuk meningkatkan nilai daur ulang.
                        </p>
                        <div class="flex items-center justify-between pt-3 border-t border-gray-50">
                            <span class="text-[10px] text-gray-400 font-medium">12 Mei 2026</span>
                            <button class="text-[#2D6A4F] font-bold text-xs hover:translate-x-1 transition flex items-center gap-1">
                                Baca <i class="fas fa-arrow-right text-[9px]"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- CARD 2 --}}
                <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition duration-300 group flex flex-col">
                    <div class="h-48 overflow-hidden relative bg-gray-100">
                        <img
                            src="https://images.unsplash.com/photo-1595273670150-bd0c3c392e46?auto=format&fit=crop&w=800&q=80"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                            alt="Tips"
                        >
                        <div class="absolute top-3 left-3">
                            <span class="bg-emerald-600 text-white px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wider">
                                Tips
                            </span>
                        </div>
                    </div>

                    <div class="p-5 flex flex-col flex-1">
                        <h4 class="text-sm font-bold text-gray-800 leading-snug mb-2 group-hover:text-green-700 transition">
                            Budidaya Maggot Dari Sampah Organik
                        </h4>
                        <p class="text-xs text-gray-500 leading-relaxed mb-4 flex-1">
                            Sampah organik dapat diolah menjadi pakan maggot bernilai ekonomi tinggi.
                        </p>
                        <div class="flex items-center justify-between pt-3 border-t border-gray-50">
                            <span class="text-[10px] text-gray-400 font-medium">10 Mei 2026</span>
                            <button class="text-[#2D6A4F] font-bold text-xs hover:translate-x-1 transition flex items-center gap-1">
                                Baca <i class="fas fa-arrow-right text-[9px]"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- CARD 3 --}}
                <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition duration-300 group flex flex-col">
                    <div class="h-48 overflow-hidden relative bg-gray-100">
                        <img
                            src="https://images.unsplash.com/photo-1611284446314-60a58ac0deb9?auto=format&fit=crop&w=800&q=80"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                            alt="Informasi"
                        >
                        <div class="absolute top-3 left-3">
                            <span class="bg-yellow-500 text-white px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wider">
                                Informasi
                            </span>
                        </div>
                    </div>

                    <div class="p-5 flex flex-col flex-1">
                        <h4 class="text-sm font-bold text-gray-800 leading-snug mb-2 group-hover:text-green-700 transition">
                            Daur Ulang Plastik Modern
                        </h4>
                        <p class="text-xs text-gray-500 leading-relaxed mb-4 flex-1">
                            Mengenal proses pengolahan plastik menjadi produk baru yang lebih bermanfaat.
                        </p>
                        <div class="flex items-center justify-between pt-3 border-t border-gray-50">
                            <span class="text-[10px] text-gray-400 font-medium">08 Mei 2026</span>
                            <button class="text-[#2D6A4F] font-bold text-xs hover:translate-x-1 transition flex items-center gap-1">
                                Baca <i class="fas fa-arrow-right text-[9px]"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- CARD 4 --}}
                <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition duration-300 group flex flex-col">
                    <div class="h-48 overflow-hidden relative bg-gray-100">
                        <img
                            src="https://images.unsplash.com/photo-1528323273322-d81458248d40?auto=format&fit=crop&w=800&q=80"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                            alt="Bank Sampah"
                        >
                        <div class="absolute top-3 left-3">
                            <span class="bg-purple-600 text-white px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wider">
                                Bank Sampah
                            </span>
                        </div>
                    </div>

                    <div class="p-5 flex flex-col flex-1">
                        <h4 class="text-sm font-bold text-gray-800 leading-snug mb-2 group-hover:text-green-700 transition">
                            Cara Kerja Bank Sampah Digital
                        </h4>
                        <p class="text-xs text-gray-500 leading-relaxed mb-4 flex-1">
                            Nasabah dapat menyetor sampah dan mendapatkan saldo digital secara otomatis.
                        </p>
                        <div class="flex items-center justify-between pt-3 border-t border-gray-50">
                            <span class="text-[10px] text-gray-400 font-medium">05 Mei 2026</span>
                            <button class="text-[#2D6A4F] font-bold text-xs hover:translate-x-1 transition flex items-center gap-1">
                                Baca <i class="fas fa-arrow-right text-[9px]"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

            {{-- BOTTOM BUTTON --}}
            <div class="flex justify-center mt-10">
                <button class="bg-[#1B4332] hover:bg-[#2D6A4F] text-white px-8 py-2.5 rounded-xl font-bold text-xs shadow-sm transition">
                    Lihat Semua Informasi
                </button>
            </div>

        </main>
    </div>
</div>

</body>
</html>