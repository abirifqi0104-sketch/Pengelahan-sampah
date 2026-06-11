<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setor Sampah - {{ Auth::user()->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-green-50 min-h-screen">
    <div class="max-w-2xl mx-auto p-6">
        <a href="{{ route('user.dashboard') }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-bold mb-8">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
        </a>
        
        <div class="bg-white rounded-3xl shadow-2xl p-10">
            <h1 class="text-3xl font-bold text-gray-800 text-center mb-2">Setor Sampah Baru</h1>
            <p class="text-center text-gray-600 mb-10">Isi form di bawah, tim akan verifikasi dalam 24 jam.</p>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-2xl mb-8">
                    {{ session('success') }}
                </div>
            @endif

<form action="{{ route('user.submit-waste.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Sampah *</label>
                    <select name="trash_type" required class="w-full p-4 border-2 border-gray-200 rounded-2xl focus:border-green-500 focus:ring-2 focus:ring-green-200 transition">
                        <option value="">Pilih jenis sampah</option>
                        <option value="Sampah Organik">Sampah Organik - Rp 3.000/kg</option>
                        <option value="Sampah Plastik">Sampah Plastik - Rp 5.000/kg</option>
                        <option value="Sampah Kertas">Sampah Kertas - Rp 2.000/kg</option>
                        <option value="Sampah Logam">Sampah Logam - Rp 8.000/kg</option>
                        <option value="Sampah Kaca">Sampah Kaca - Rp 4.000/kg</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Estimasi Berat (Kg) *</label>
                    <input type="number" name="weight" step="0.1" min="0.1" required 
                           class="w-full p-4 border-2 border-gray-200 rounded-2xl focus:border-green-500 focus:ring-2 focus:ring-green-200 transition text-2xl font-bold text-right"
                           placeholder="0.0">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Lokasi Pengambilan *</label>
                    <input type="text" name="location" required 
                           class="w-full p-4 border-2 border-gray-200 rounded-2xl focus:border-green-500 focus:ring-2 focus:ring-green-200 transition"
                           placeholder="Alamat lengkap pengambilan">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Foto Sampah (Opsional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full p-4 border-2 border-dashed border-gray-300 rounded-2xl hover:border-green-400 transition text-sm">
                    <p class="text-xs text-gray-500 mt-1">Max 2MB, JPG/PNG. Membantu verifikasi lebih cepat.</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Keterangan Tambahan (Opsional)</label>
                    <textarea name="description" rows="3" class="w-full p-4 border-2 border-gray-200 rounded-2xl focus:border-green-500 focus:ring-2 focus:ring-green-200 transition" placeholder="Catatan atau informasi tambahan..."></textarea>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-6 px-8 rounded-3xl font-bold text-xl shadow-2xl hover:from-green-700 transition transform hover:scale-[1.02]">
                    <i class="fas fa-paper-plane mr-3"></i>
                    Kirim Permintaan Setor
                </button>
            </form>
        </div>
    </div>
</body>
</html>

