<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Sampah - EcoAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">

<div class="flex min-h-screen">
    <aside class="w-64 bg-slate-900 text-white hidden md:block">
        <div class="p-6 text-2xl font-bold text-green-400">EcoAdmin.</div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center py-3 px-4 hover:bg-slate-800 rounded-xl transition text-slate-400 font-medium">
                <i class="fas fa-chart-line mr-3"></i> Dashboard
            </a>
            <a href="{{ route('admin.trash.index') }}" class="flex items-center py-3 px-4 bg-green-600 text-white rounded-xl transition">
                <i class="fas fa-trash-alt mr-3"></i> Data Sampah
            </a>
        </nav>
    </aside>

    <main class="flex-1 p-8">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center mb-8">
                <a href="{{ route('admin.trash.index') }}" class="mr-4 text-gray-400 hover:text-green-600 transition">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Tambah Data Sampah</h2>
                    <p class="text-sm text-gray-500 italic">Input data setoran sampah baru ke sistem.</p>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8">
                    <form action="{{ route('admin.trash.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2 italic">Jenis Sampah</label>
                                <select name="trash_type" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-green-500 focus:ring-0 transition" required>
                                    <option value="" disabled selected>Pilih jenis sampah</option>
                                    <option value="Organik">Sampah Organik</option>
                                    <option value="Anorganik">Sampah Anorganik</option>
                                    <option value="Kertas">Sampah Kertas</option>
                                    <option value="Plastik">Sampah Plastik</option>
                                    <option value="B3">Sampah B3</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2 italic">Berat (Kg)</label>
                                <input type="number" step="0.01" name="weight" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-green-500 transition" placeholder="Contoh: 12.5" required>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2 italic">Tanggal Setor</label>
                                <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-green-500 transition" required>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2 italic">Lokasi TPS</label>
                                <select name="location" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-green-500 transition" required>
                                    <option value="TPS 1 - Blok A">TPS 1 - Blok A</option>
                                    <option value="TPS 2 - Blok B">TPS 2 - Blok B</option>
                                    <option value="TPS 3 - Pusat">TPS 3 - Pusat</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2 italic">Keterangan (Opsional)</label>
                                <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-green-500 transition" placeholder="Tambahkan catatan jika perlu..."></textarea>
                            </div>
                        </div>

                        <div class="mt-8 flex items-center justify-end space-x-4 border-t pt-8">
                            <a href="{{ route('admin.trash.index') }}" class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 transition">Batal</a>
                            <button type="submit" class="bg-green-600 text-white px-10 py-3 rounded-xl font-bold shadow-lg shadow-green-100 hover:bg-green-700 transform hover:-translate-y-1 transition duration-300">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>