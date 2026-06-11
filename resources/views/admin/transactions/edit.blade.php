<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Sampah - Pesan Green</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    
    {{-- SWEETALERT2 INTEGRATION --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; }
        body { overflow-x: hidden; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #1B4332; border-radius: 10px; }
    </style>
</head>

<body class="bg-gray-50 antialiased">

<div class="flex min-h-screen relative w-full">

    {{-- SIDEBAR --}}
    <aside class="z-40">
        @include('admin.partials.sidebar')
    </aside>

    {{-- 
      SOLUSI FIX AGAR TIDAK TERTIMPA: md:pl-72 dan w-0 flex-1
      Memaksa area form bergeser aman ke kanan menjauhi sidebar fixed Anda secara presisi.
    --}}
    <div class="flex-1 flex flex-col min-w-0 w-0 md:pl-72 min-h-screen bg-gray-50">

        {{-- HEADER --}}
        <header class="bg-white border-b border-gray-100 h-16 px-6 flex items-center justify-between sticky top-0 z-30 shadow-sm">
            <div class="flex items-center gap-2.5">
                <button class="text-gray-500 text-lg md:hidden">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="flex items-center gap-2">
                    <i class="fas fa-pen text-[#1B4332] text-xs"></i>
                    <h1 class="text-sm font-bold text-gray-800 tracking-wide">
                        Update Data Sampah 📝
                    </h1>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-bold text-gray-800 leading-tight">
                        {{ Auth::user()->name ?? 'Admin' }}
                    </p>
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-0.5">
                        Administrator 🟢
                    </p>
                </div>

                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=1B4332&color=fff"
                    class="w-8 h-8 rounded-full shadow-sm border border-gray-100" alt="Avatar">
            </div>
        </header>

        {{-- CONTENT AREA --}}
        <main class="p-6 md:p-8 w-full max-w-5xl mx-auto flex-1 box-border">

            {{-- TITLE HEADER --}}
            <div class="mb-6">
                <h2 class="text-xl md:text-2xl font-black text-gray-800 tracking-tight">
                    Edit Data Sampah ♻️
                </h2>
                <p class="text-xs text-gray-500 mt-1">
                    Perbarui data sampah yang telah tersimpan di sistem bank sampah digital Pesan Green.
                </p>
            </div>

            {{-- ERROR BANNER (Jika validasi backend gagal) --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3.5 rounded-xl flex gap-3 items-start shadow-xs">
                    <i class="fas fa-exclamation-circle mt-0.5 text-sm animate-bounce"></i>
                    <div>
                        <p class="text-xs font-bold mb-1">Waduh, ada data yang belum sesuai! 😵</p>
                        <ul class="list-disc ml-4 text-xs space-y-1 font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- MAIN FORM CARD --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- BADGE HEADER --}}
                <div class="border-b border-gray-100 px-6 py-4 bg-gray-50/50 flex items-center justify-between">
                    <div class="inline-block px-3 py-1 rounded-lg bg-[#1B4332] text-white text-[10px] font-bold uppercase tracking-wider">
                        Formulir Perubahan Data
                    </div>
                    <span class="text-xs text-gray-400">ID: <b class="text-gray-700">{{ $transaction->data_id }}</b></span>
                </div>

                {{-- FORM START --}}
                <form id="formEditSampah" action="{{ route('admin.transactions.update', $transaction->id) }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="p-6 md:p-8 space-y-5">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        {{-- ID DATA (Readonly) --}}
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-2">
                                ID Data 🔒
                            </label>
                            <input type="text"
                                   value="{{ $transaction->data_id }}"
                                   readonly
                                   class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-xs font-semibold text-gray-400 cursor-not-allowed">
                        </div>

                        {{-- JENIS SAMPAH --}}
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-2">
                                Jenis Sampah 🏷️
                            </label>
                            <select name="trash_type"
                                    required
                                    class="w-full bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-xs text-gray-700 focus:ring-1 focus:ring-green-700 focus:border-green-700 outline-none transition font-medium">
                                        <option value="">Pilih jenis sampah</option>
                                     <option value="Sampah Organik">Sampah Organik - Rp 3.000/kg</option>
                                     <option value="Sampah Plastik">Sampah Plastik - Rp 5.000/kg</option>
                                     <option value="Sampah Kertas">Sampah Kertas - Rp 2.000/kg</option>
                                     <option value="Sampah Logam">Sampah Logam - Rp 8.000/kg</option>
                                     <option value="Sampah Kaca">Sampah Kaca - Rp 4.000/kg</option>
                            </select>
                        </div>

                        {{-- BERAT (KG) --}}
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-2">
                                Berat (KG) ⚖️
                            </label>
                            <input type="number"
                                   step="0.01"
                                   name="weight"
                                   value="{{ old('weight', $transaction->weight) }}"
                                   required
                                   class="w-full bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-xs text-gray-700 focus:ring-1 focus:ring-green-700 focus:border-green-700 outline-none transition font-semibold">
                        </div>

                        {{-- TANGGAL --}}
                        <div>
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-2">
                                Tanggal Input 📅
                            </label>
                            <input type="date"
                                   name="date"
                                   value="{{ old('date', \Carbon\Carbon::parse($transaction->date)->format('Y-m-d')) }}"
                                   required
                                   class="w-full bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-xs text-gray-700 focus:ring-1 focus:ring-green-700 focus:border-green-700 outline-none transition">
                        </div>

                        {{-- LOKASI TPS --}}
                        <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Lokasi Pengambilan *</label>
                    <input type="text" name="location" required 
                           class="w-full p-4 border-2 border-gray-200 rounded-2xl focus:border-green-500 focus:ring-2 focus:ring-green-200 transition"
                           placeholder="Alamat lengkap pengambilan">
                </div>

                        {{-- FOTO SAMPAH --}}
                        <div class="md:col-span-2">
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-2">
                                Foto Sampah 📸
                            </label>
                            <div class="border border-dashed border-gray-200 rounded-xl p-5 bg-gray-50/30 hover:bg-gray-50/80 transition">
                                <div class="flex flex-col sm:flex-row items-center gap-5">
                                    
                                    {{-- PREVIEW BOX --}}
                                    <div class="w-full sm:w-40 h-36 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center border border-gray-200 shadow-2xs shrink-0 relative group">
                                        @if($transaction->image)
                                            <img id="imgPreview" src="{{ asset('storage/' . $transaction->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div id="placeholderPreview" class="text-center text-gray-400 p-3">
                                                <i class="fas fa-image text-3xl mb-1.5 opacity-70"></i>
                                                <p class="text-[10px]">Belum ada foto</p>
                                            </div>
                                            <img id="imgPreview" class="w-full h-full object-cover hidden">
                                        @endif
                                    </div>

                                    {{-- ACTION UPLOAD --}}
                                    <div class="flex-1 w-full text-center sm:text-left">
                                        <label for="uploadFoto"
                                               class="inline-flex items-center gap-2 bg-[#1B4332] hover:bg-[#133024] text-white px-4 py-2 rounded-xl cursor-pointer transition text-xs font-bold shadow-2xs">
                                            <i class="fas fa-upload text-[10px]"></i>
                                            Pilih Foto Baru
                                        </label>
                                        <input type="file" name="image" id="uploadFoto" class="hidden" accept="image/*">
                                        
                                        <p id="fileName" class="mt-2 text-xs text-gray-500 font-medium truncate max-w-xs">
                                            Tidak ada file baru yang dipilih 📁
                                        </p>
                                        <p class="text-[10px] text-gray-400 mt-1">
                                            Format file valid: JPG, PNG (Maks. 2MB)
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- KETERANGAN / DESKRIPSI --}}
                        <div class="md:col-span-2">
                            <label class="block text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-2">
                                Keterangan Tambahan 💬
                            </label>
                            <textarea name="description"
                                      rows="4"
                                      placeholder="Masukkan keterangan tambahan jika diperlukan..."
                                      class="w-full bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-xs text-gray-700 focus:ring-1 focus:ring-green-700 focus:border-green-700 outline-none resize-none transition">{{ old('description', $transaction->description) }}</textarea>
                        </div>

                    </div>

                    {{-- FORM BUTTONS --}}
                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                        <a href="{{ route('admin.transactions.index') }}"
                           class="px-5 py-2 rounded-xl border border-gray-200 text-gray-500 text-xs font-bold hover:bg-gray-50 transition">
                            Batal ❌
                        </a>
                        <button type="submit"
                                class="px-5 py-2 rounded-xl bg-[#1B4332] hover:bg-[#133024] text-white text-xs font-bold transition shadow-sm flex items-center gap-2">
                            <i class="fas fa-save text-[10px]"></i>
                            Simpan Perubahan 💾
                        </button>
                    </div>

                </form>
                {{-- FORM END --}}

            </div>
        </main>
    </div>
</div>

{{-- SCRIPT INTERAKSI & SWEETALERT --}}
<script>
    // 1. Live Preview Gambar & Nama File saat diunggah
    document.getElementById('uploadFoto').addEventListener('change', function(e) {
        const fileName = document.getElementById('fileName');
        const imgPreview = document.getElementById('imgPreview');
        const placeholder = document.getElementById('placeholderPreview');

        if (this.files.length > 0) {
            const file = this.files[0];
            fileName.textContent = '👍 ' + file.name;
            fileName.className = 'mt-2 text-xs text-green-700 font-bold truncate max-w-xs';
            
            // Render file ke tag img preview
            const reader = new FileReader();
            reader.onload = function(event) {
                if(placeholder) placeholder.classList.add('hidden');
                imgPreview.src = event.target.result;
                imgPreview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            fileName.textContent = 'Tidak ada file baru yang dipilih 📁';
            fileName.className = 'mt-2 text-xs text-gray-500 font-medium truncate max-w-xs';
        }
    });

    // 2. Konfirmasi SweetAlert2 Sebelum Submit Simpan Data
    document.getElementById('formEditSampah').addEventListener('submit', function(e) {
        e.preventDefault(); // Tahan submit bawaan browser
        
        Swal.fire({
            title: 'Sudah Yakin? 🤔',
            text: "Perubahan data transaksi sampah akan langsung disimpan ke sistem database!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1B4332',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Simpan! 💾',
            cancelButtonText: 'Cek Lagi ❌',
            background: '#ffffff',
            borderRadius: '1rem'
        }).then((result) => {
            if (result.isConfirmed) {
                // Tampilkan loading sebentar lalu submit form
                Swal.fire({
                    title: 'Memproses data... ⏳',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });
                this.submit();
            }
        });
    });

    // 3. Notifikasi Berhasil Otomatis dari Session Laravel (Flash Message)
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil! 🎉',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonColor: '#1B4332',
            timer: 3000
        });
    @endif

    @if(session('error'))
        Swal.fire({
            title: 'Gagal! 😢',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonColor: '#ef4444'
        });
    @endif
</script>

</body>
</html>