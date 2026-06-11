<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Informasi - Pesan Green</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">

<div class="min-h-screen flex">
    <!-- Sidebar -->
   @include('admin.partials.sidebar')

    <main class="flex-1 ml-64 overflow-y-auto">
        <!-- Header -->
        <header class="bg-white border-b h-16 flex items-center justify-between px-8 sticky top-0 z-10">
            <div class="flex items-center gap-2 text-sm font-semibold text-gray-700 italic">
                <i class="fas fa-bars mr-2 text-gray-400"></i> Kelola Informasi (Admin)
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="text-xs font-bold leading-none">Admin</p>
                    <p class="text-[10px] text-gray-500 italic">Administrator</p>
                </div>
                <img src="https://ui-avatars.com/api/?name=Admin&background=1B4332&color=fff" class="h-8 w-8 rounded-full">
            </div>
        </header>

        <!-- Form Content sesuai Mockup No 7 -->
        <div class="p-8 italic">
            <h2 class="text-2xl font-bold text-gray-800 uppercase mb-2 tracking-tighter leading-none">Kelola Informasi (Admin)</h2>
            <p class="text-xs text-gray-500 mb-8">Kelola informasi dan artikel pengelolaan sampah.</p>

            <div class="bg-white rounded-2xl border shadow-sm p-8">
                <!-- Tab Menu (Daftar / Tambah) -->
                <div class="flex gap-8 border-b mb-8 text-xs font-bold uppercase tracking-widest">
                    <button class="pb-4 text-gray-400 hover:text-green-700 transition">Daftar Informasi</button>
                    <button class="pb-4 border-b-2 border-green-700 text-green-700 transition">Tambah / Edit Informasi</button>
                </div>

                <form action="#" class="space-y-6">
                    <div class="grid grid-cols-2 gap-8">
                        <!-- Judul -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase text-gray-400 tracking-widest">Judul Informasi</label>
                            <input type="text" placeholder="Masukkan Judul" class="w-full bg-gray-50 border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                        </div>
                        <!-- Kategori -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold uppercase text-gray-400 tracking-widest">Kategori</label>
                            <select class="w-full bg-gray-50 border rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                                <option>Pilih Kategori</option>
                                <option selected>Edukasi</option>
                                <option>Tips</option>
                            </select>
                        </div>
                    </div>

                    <!-- Upload Gambar -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase text-gray-400 tracking-widest">Gambar</label>
                        <div class="flex items-center gap-6">
                            <div class="w-48 h-28 bg-gray-100 rounded-xl overflow-hidden border">
                                <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?auto=format&fit=crop&q=80&w=400" class="w-full h-full object-cover">
                            </div>
                            <div class="space-y-2">
                                <button type="button" class="bg-white border-2 border-green-700 text-green-700 px-6 py-2 rounded-lg text-[10px] font-bold uppercase hover:bg-green-50 transition">Ganti Gambar</button>
                                <p class="text-[9px] text-gray-400">JPG, PNG, max. 2MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Content Editor (Simplified) -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-bold uppercase text-gray-400 tracking-widest">Konten</label>
                        <div class="border rounded-xl overflow-hidden">
                            <!-- Fake Toolbar Editor -->
                            <div class="bg-gray-50 border-b p-2 flex gap-4 text-gray-400 text-xs">
                                <i class="fas fa-bold hover:text-gray-700 cursor-pointer"></i>
                                <i class="fas fa-italic hover:text-gray-700 cursor-pointer"></i>
                                <i class="fas fa-underline hover:text-gray-700 cursor-pointer"></i>
                                <i class="fas fa-list-ul hover:text-gray-700 cursor-pointer"></i>
                                <i class="fas fa-list-ol hover:text-gray-700 cursor-pointer"></i>
                                <i class="fas fa-link hover:text-gray-700 cursor-pointer"></i>
                            </div>
                            <textarea rows="6" class="w-full p-4 text-sm focus:outline-none italic">Pemilihan sampah adalah kegiatan memisahkan sampah berdasarkan jenisnya. Manfaat: 
- Mengurangi pencemaran lingkungan
- Memudahkan proses daur ulang
- Menambah nilai ekonomis sampah</textarea>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end gap-4 pt-4 border-t">
                        <button type="button" class="px-8 py-2 rounded-lg border text-[10px] font-bold uppercase text-gray-400 hover:bg-gray-50 transition">Batal</button>
                        <button type="submit" class="px-8 py-2 rounded-lg bg-[#2D6A4F] text-white text-[10px] font-bold uppercase hover:bg-[#1B4332] transition">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

</body>
</html>