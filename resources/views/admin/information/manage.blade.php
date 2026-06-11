<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Informasi - Pesan Green</title>
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
                <i class="fas fa-bars mr-2 text-gray-400"></i> Kelola Informasi (Admin)
            </div>
            <img src="https://ui-avatars.com/api/?name=Admin&background=1B4332&color=fff" class="h-8 w-8 rounded-full">
        </header>

        <div class="p-8">
            <div class="flex justify-between items-start mb-8 italic">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Kelola Informasi</h2>
                    <p class="text-sm text-gray-500">Buat dan atur artikel edukasi pengelolaan sampah.</p>
                </div>
                <button class="bg-[#2D6A4F] text-white px-5 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 hover:bg-[#1B4332] transition shadow-lg shadow-green-900/20 uppercase tracking-wider">
                    <i class="fas fa-plus-circle"></i> Buat Info Baru
                </button>
            </div>

            <div class="bg-white rounded-2xl border shadow-sm overflow-hidden italic">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-gray-50 text-gray-400 text-[10px] uppercase tracking-widest border-b font-bold">
                            <th class="px-6 py-4 w-16 text-center">No</th>
                            <th class="px-6 py-4">Judul Informasi</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Tanggal Rilis</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-center font-bold text-xs">1</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                        <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?w=100" class="w-full h-full object-cover">
                                    </div>
                                    <span class="font-bold text-xs">Pemilahan Sampah: Cara mudah memilah...</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-[10px] font-bold text-green-600 bg-green-50 px-2 py-1 rounded uppercase tracking-tighter border border-green-100">Edukasi</span>
                            </td>
                            <td class="px-6 py-4 text-xs">12 Mei 2024</td>
                            <td class="px-6 py-4">
                                <span class="flex items-center gap-1.5 text-[10px] font-bold text-blue-500 uppercase tracking-tighter">
                                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-pulse"></span> Published
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <button class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-[10px] font-bold hover:bg-blue-600 hover:text-white transition">EDIT</button>
                                    <button class="bg-red-50 text-red-600 px-3 py-1.5 rounded-lg text-[10px] font-bold hover:bg-red-600 hover:text-white transition">HAPUS</button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-center font-bold text-xs">2</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                        <img src="https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?w=100" class="w-full h-full object-cover">
                                    </div>
                                    <span class="font-bold text-xs">Komposting Sampah Organik: Mengolah...</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded uppercase tracking-tighter border border-blue-100">Tips</span>
                            </td>
                            <td class="px-6 py-4 text-xs">11 Mei 2024</td>
                            <td class="px-6 py-4">
                                <span class="flex items-center gap-1.5 text-[10px] font-bold text-blue-500 uppercase tracking-tighter">
                                    <span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-pulse"></span> Published
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <button class="bg-blue-50 text-blue-600 px-3 py-1.5 rounded-lg text-[10px] font-bold hover:bg-blue-600 hover:text-white transition">EDIT</button>
                                    <button class="bg-red-50 text-red-600 px-3 py-1.5 rounded-lg text-[10px] font-bold hover:bg-red-600 hover:text-white transition">HAPUS</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-between items-center italic">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Halaman 1 dari 10</p>
                <div class="flex gap-2">
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg border bg-white text-gray-400 hover:bg-gray-50 transition"><i class="fas fa-chevron-left text-xs"></i></button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#2D6A4F] text-white text-xs font-bold">1</button>
                    <button class="w-8 h-8 flex items-center justify-center rounded-lg border bg-white text-gray-400 hover:bg-gray-50 transition"><i class="fas fa-chevron-right text-xs"></i></button>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>