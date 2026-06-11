<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Penyetoran - Pesan Green</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

<div class="min-h-screen flex">
    @include('admin.partials.sidebar')

    <main class="flex-1 ml-64 overflow-y-auto">
        <header class="bg-white border-b h-16 flex items-center justify-between px-8">
            <div class="flex items-center gap-2 text-sm font-semibold text-gray-700 italic">
                <i class="fas fa-bars mr-2 text-gray-400"></i> Riwayat Penyetoran
            </div>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                    <input type="text" placeholder="Cari riwayat..." class="bg-gray-100 border-none rounded-full py-1.5 pl-9 pr-4 text-xs focus:ring-2 focus:ring-green-500 w-64 italic">
                </div>
                <img src="https://ui-avatars.com/api/?name=Admin&background=1B4332&color=fff" class="h-8 w-8 rounded-full shadow-sm">
            </div>
        </header>

        <div class="p-8">
            <div class="mb-6 italic">
                <h2 class="text-xl font-bold text-gray-800">Riwayat Penyetoran</h2>
                <p class="text-sm text-gray-500">Riwayat penyetoran sampah yang telah dilakukan.</p>
            </div>

            <div class="space-y-4">
                
                <div class="bg-white p-6 rounded-2xl border shadow-sm flex justify-between items-center hover:bg-gray-50 transition italic">
                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-green-100 rounded-full">
                            <i class="fas fa-calendar-alt text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">12 Mei 2024, 10:30</p>
                            <h4 class="text-sm font-bold text-gray-800 mt-1">Budi Setiawan</h4>
                            <p class="text-xs text-gray-500">Menyetor Sampah Organik</p>
                            <p class="text-[10px] text-gray-400 mt-2 font-bold uppercase tracking-widest">Lokasi: TPS 1 - Blok A</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-black text-green-600">120 kg</p>
                        <span class="text-[10px] font-bold text-gray-400 uppercase">Selesai Diverifikasi</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border shadow-sm flex justify-between items-center hover:bg-gray-50 transition italic">
                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-green-100 rounded-full">
                            <i class="fas fa-calendar-alt text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">11 Mei 2024, 14:20</p>
                            <h4 class="text-sm font-bold text-gray-800 mt-1">Siti Nurhaliza</h4>
                            <p class="text-xs text-gray-500">Menyetor Sampah Plastik</p>
                            <p class="text-[10px] text-gray-400 mt-2 font-bold uppercase tracking-widest">Lokasi: TPS 2 - Blok B</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-black text-green-600">60 kg</p>
                        <span class="text-[10px] font-bold text-gray-400 uppercase">Selesai Diverifikasi</span>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border shadow-sm flex justify-between items-center hover:bg-gray-50 transition italic">
                    <div class="flex items-start gap-4">
                        <div class="p-3 bg-green-100 rounded-full">
                            <i class="fas fa-calendar-alt text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">10 Mei 2024, 09:15</p>
                            <h4 class="text-sm font-bold text-gray-800 mt-1">Andi Pratama</h4>
                            <p class="text-xs text-gray-500">Menyetor Sampah Kertas</p>
                            <p class="text-[10px] text-gray-400 mt-2 font-bold uppercase tracking-widest">Lokasi: TPS 1 - Blok A</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-black text-green-600">45 kg</p>
                        <span class="text-[10px] font-bold text-gray-400 uppercase">Selesai Diverifikasi</span>
                    </div>
                </div>

            </div>
            
            <div class="mt-8 flex justify-center italic">
                <p class="text-xs text-gray-400 font-medium">Menampilkan 3 riwayat terbaru</p>
            </div>
        </div>
    </main>
</div>

</body>
</html>