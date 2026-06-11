<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Pesan Green</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 antialiased">

<div class="flex min-h-screen relative w-full">

    {{-- SIDEBAR --}}
    @include('admin.partials.sidebar')

    {{-- MAIN CONTENT AREA --}}
    <div class="flex-1 flex flex-col min-w-0 w-0 md:pl-72 min-h-screen bg-gray-50">
        
        {{-- HEADER --}}
        <header class="sticky top-0 z-30 bg-white border-b border-gray-100 h-16 px-6 md:px-8 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-[#1B4332] text-white flex items-center justify-center">
                    <i class="fas fa-edit text-sm"></i>
                </div>
                <h1 class="text-base md:text-lg font-bold text-gray-800 tracking-tight">Edit Produk Penjualan</h1>
            </div>
            <a href="{{ url('admin/maggot/penjualan') }}" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-times text-xl"></i>
            </a>
        </header>

        {{-- TAB NAVIGASI --}}
        <div class="bg-white px-6 md:px-8 border-b border-gray-200">
            <nav class="flex gap-6 -mb-px overflow-x-auto">
                <a href="{{ url('admin/maggot') }}" class="py-4 text-sm font-bold text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-seedling"></i> Data Budidaya
                </a>
                <a href="{{ url('admin/maggot/panen') }}" class="py-4 text-sm font-bold text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-box-open"></i> Hasil Panen
                </a>
                <a href="{{ url('admin/maggot/penjualan') }}" class="py-4 text-sm font-bold border-b-2 border-[#1B4332] text-[#1B4332] flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-store"></i> Penjualan (Produk Olahan)
                </a>
            </nav>
        </div>

        {{-- MAIN CONTENT --}}
        <main class="p-6 md:p-8 w-full max-w-4xl mx-auto flex-1 box-border">
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

                <form action="{{ url('admin/maggot/penjualan/' . $produk->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- KIRI: FORM --}}
                        <div class="space-y-4">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Produk</h3>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Produk *</label>
                                <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" required class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100">
                                @error('nama_produk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Harga/Kg (Rp) *</label>
                                    <input type="number" name="harga" value="{{ $produk->harga }}" required min="0" step="1000" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100">
                                    @error('harga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Stok (Kg) *</label>
                                    <input type="number" name="stok" value="{{ $produk->stok }}" required min="0" step="0.01" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100">
                                    @error('stok') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Produk</label>
                                <textarea name="deskripsi" placeholder="Deskripsi produk..." rows="4" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 resize-none">{{ $produk->deskripsi }}</textarea>
                                @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- KANAN: FOTO --}}
                        <div class="space-y-4">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Foto Produk</h3>

                            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl border-2 border-dashed border-gray-300 p-6 flex flex-col items-center justify-center h-64 hover:border-blue-500 transition">
                                @if($produk->foto)
                                    <div class="w-full h-full rounded-xl overflow-hidden flex items-center justify-center">
                                        <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama_produk }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <i class="fas fa-image text-gray-300 text-4xl mb-3"></i>
                                    <p class="text-sm text-gray-600 font-semibold">Belum ada foto</p>
                                @endif
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Ganti Foto Produk</label>
                                <input type="file" name="foto" accept="image/*" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm outline-none focus:border-blue-600 file:bg-blue-500 file:text-white file:border-none file:py-2 file:px-4 file:rounded file:cursor-pointer file:text-sm file:font-bold">
                                <p class="text-xs text-gray-500 mt-2">Format: JPEG, PNG, JPG, GIF | Max: 2MB</p>
                                @error('foto') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                                <p class="text-xs text-blue-800">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Unggah foto baru untuk mengganti foto produk lama.
                                </p>
                            </div>
                        </div>

                    </div>

                    {{-- TOMBOL AKSI --}}
                    <div class="flex gap-3 pt-6 border-t border-gray-200">
                        <a href="{{ url('admin/maggot/penjualan') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 py-3 rounded-xl text-sm font-bold transition flex items-center justify-center gap-2">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl text-sm font-bold transition flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>

        </main>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#1B4332',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif

        @if($errors->any())
            Swal.fire({
                title: 'Error!',
                text: "Silakan periksa kembali form Anda.",
                icon: 'error',
                confirmButtonColor: '#1B4332',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif
    });
</script>

</body>
</html>
