@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('admin.informasi.index') }}" class="text-green-600 hover:text-green-700 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <h1 class="text-3xl font-bold text-gray-800 mt-4">Buat Informasi Baru</h1>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-3xl">
            <form action="{{ route('admin.informasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                        Judul <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        placeholder="Masukkan judul informasi"
                        class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        value="{{ old('title') }}"
                        required
                    >
                    @error('title')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="category" 
                        name="category" 
                        class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        required
                    >
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Tips" {{ old('category') === 'Tips' ? 'selected' : '' }}>Tips</option>
                        <option value="Promo" {{ old('category') === 'Promo' ? 'selected' : '' }}>Promo</option>
                        <option value="Edukasi" {{ old('category') === 'Edukasi' ? 'selected' : '' }}>Edukasi</option>
                        <option value="Berita" {{ old('category') === 'Berita' ? 'selected' : '' }}>Berita</option>
                        <option value="Panduan" {{ old('category') === 'Panduan' ? 'selected' : '' }}>Panduan</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                        Isi Informasi <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="content" 
                        name="content" 
                        rows="10"
                        placeholder="Tulis informasi lengkap di sini..."
                        class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition resize-vertical"
                        required
                    >{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                        Gambar (Opsional)
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-green-500 transition cursor-pointer">
                        <input 
                            type="file" 
                            id="image" 
                            name="image" 
                            accept="image/*"
                            class="hidden"
                            onchange="previewImage(event)"
                        >
                        <label for="image" class="cursor-pointer">
                            <i class="fas fa-image text-4xl text-gray-300 mb-2"></i>
                            <p class="text-gray-600 font-semibold">Klik untuk upload gambar</p>
                            <p class="text-gray-500 text-sm">Format: JPG, PNG, GIF (Max 2MB)</p>
                        </label>
                    </div>
                    <div id="imagePreview" class="mt-4"></div>
                    @error('image')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Publish Status -->
                <div class="flex items-center gap-4">
                    <label class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="is_published" 
                            value="1"
                            class="w-4 h-4 text-green-600 rounded focus:ring-2 focus:ring-green-200 cursor-pointer"
                            {{ old('is_published') ? 'checked' : '' }}
                        >
                        <span class="ml-2 text-gray-700 font-semibold">Publikasikan Sekarang</span>
                    </label>
                    <p class="text-sm text-gray-500">Jika tidak dicentang, informasi akan disimpan sebagai draft</p>
                </div>

                <!-- Submit Buttons -->
                <div class="flex gap-4 pt-4 border-t">
                    <button 
                        type="submit" 
                        class="flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-lg transition duration-200 flex items-center justify-center"
                    >
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>
                    <a 
                        href="{{ route('admin.informasi.index') }}" 
                        class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 rounded-lg transition duration-200 text-center flex items-center justify-center"
                    >
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <div class="relative w-32 h-32">
                        <img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover rounded-lg">
                        <button type="button" onclick="removeImage()" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
            };
            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        document.getElementById('image').value = '';
        document.getElementById('imagePreview').innerHTML = '';
    }
</script>
@endsection
