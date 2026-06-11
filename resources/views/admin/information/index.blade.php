<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Pengelolaan - Pesan Green</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-slate-800">

<div class="min-h-screen flex">
    @include('admin.partials.sidebar')

    <main class="flex-1 ml-64 overflow-y-auto">
        <header class="bg-white border-b h-16 flex items-center justify-between px-8">
            <div class="flex items-center gap-2 text-sm font-semibold text-gray-600 italic">
                <i class="fas fa-bars mr-2 text-gray-400"></i> Informasi Pengelolaan
            </div>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                    <input type="text" placeholder="Cari informasi..." class="bg-gray-100 border-none rounded-full py-1.5 pl-9 pr-4 text-xs focus:ring-2 focus:ring-green-500 w-64 italic">
                </div>
                <img src="https://ui-avatars.com/api/?name=Admin&background=1B4332&color=fff" class="h-8 w-8 rounded-full shadow-sm">
            </div>
        </header>

        <div class="p-8">
            <div class="flex justify-between items-start mb-6">
                <div class="italic">
                    <h2 class="text-xl font-bold text-gray-800">Informasi Pengelolaan</h2>
                    <p class="text-sm text-gray-500">Dapatkan informasi dan edukasi seputar pengelolaan sampah.</p>
                </div>
                <div class="flex gap-2">
                    <select class="bg-white border border-gray-200 text-xs rounded-lg px-4 py-2 italic outline-none focus:ring-2 focus:ring-green-500">
                        <option>Filter Kategori</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                
                <div class="bg-white rounded-2xl border shadow-sm overflow-hidden hover:shadow-md transition group">
                    <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&q=80&w=400" alt="Pemilahan Sampah" class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="p-5 italic">
                        <span class="text-[10px] font-bold text-white bg-green-500 px-2 py-0.5 rounded uppercase">Edukasi</span>
                        <h3 class="text-sm font-bold text-gray-800 mt-3 leading-snug">Pemilahan Sampah: Cara mudah memilah sampah berdasarkan jenisnya.</h3>
                        <div class="flex justify-between items-center mt-6 text-[10px] text-gray-400 font-bold">
                            <span>Admin</span>
                            <span>12 Mei 2024</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border shadow-sm overflow-hidden hover:shadow-md transition group">
                    <img src="https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?auto=format&fit=crop&q=80&w=400" alt="Komposting" class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="p-5 italic">
                        <span class="text-[10px] font-bold text-white bg-blue-500 px-2 py-0.5 rounded uppercase">Tips</span>
                        <h3 class="text-sm font-bold text-gray-800 mt-3 leading-snug">Komposting Sampah Organik: Mengolah sampah menjadi pupuk kompos.</h3>
                        <div class="flex justify-between items-center mt-6 text-[10px] text-gray-400 font-bold">
                            <span>Admin</span>
                            <span>11 Mei 2024</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border shadow-sm overflow-hidden hover:shadow-md transition group">
                    <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&q=80&w=400" alt="Daur Ulang" class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="p-5 italic">
                        <span class="text-[10px] font-bold text-white bg-green-500 px-2 py-0.5 rounded uppercase">Edukasi</span>
                        <h3 class="text-sm font-bold text-gray-800 mt-3 leading-snug">Daur Ulang Sampah: Proses daur ulang berbagai jenis sampah plastik.</h3>
                        <div class="flex justify-between items-center mt-6 text-[10px] text-gray-400 font-bold">
                            <span>Admin</span>
                            <span>10 Mei 2024</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border shadow-sm overflow-hidden hover:shadow-md transition group">
                    <img src="https://images.unsplash.com/photo-1611284446314-60a58ac0deb9?auto=format&fit=crop&q=80&w=400" alt="Bank Sampah" class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="p-5 italic">
                        <span class="text-[10px] font-bold text-white bg-yellow-500 px-2 py-0.5 rounded uppercase">Informasi</span>
                        <h3 class="text-sm font-bold text-gray-800 mt-3 leading-snug">Bank Sampah: Manfaat dan cara kerja bank sampah untuk masyarakat.</h3>
                        <div class="flex justify-between items-center mt-6 text-[10px] text-gray-400 font-bold">
                            <span>Admin</span>
                            <span>09 Mei 2024</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-10 flex justify-center">
                <button class="border-2 border-green-600 text-green-600 px-8 py-2 rounded-full text-xs font-bold hover:bg-green-600 hover:text-white transition italic shadow-sm">
                    Lihat Semua Informasi
                </button>
            </div>
        </div>
    </main>
</div>

</body>
</html>