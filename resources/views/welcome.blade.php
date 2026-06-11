<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pesan green - Pengolahan Sampah Pintar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    {{-- Tambahkan CDN SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gradient-to-br from-green-50 to-emerald-50">

    <header class="relative min-h-[500px] flex items-center justify-center text-white py-20 px-4 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('image/pesan_green.png') }}" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/50"></div> 
        </div>

        <div class="max-w-6xl mx-auto text-center relative z-10">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 drop-shadow-lg">
                pesan green
            </h1>
            <p class="text-xl md:text-2xl mb-10 max-w-2xl mx-auto leading-relaxed drop-shadow-md">
                Platform pengolahan sampah modern. Setor sampah Anda, dapatkan poin & uang tunai. 
                Ramah lingkungan, mudah, dan menguntungkan! 🌿
            </p>
            <div class="flex flex-col md:flex-row justify-center gap-4">
                <a href="{{ route('login') }}" class="bg-white text-green-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-green-50 transition shadow-2xl">
                    Mulai Setor Sampah 💰
                </a>
                <a href="#produk-magot" class="bg-emerald-600 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-emerald-700 transition shadow-2xl">
                    Belanja Produk Magot 🛒
                </a>
                <a href="#daftar-sampah" class="border-2 border-white text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white hover:text-green-600 transition">
                    Lihat Harga Sampah 📊
                </a>
            </div>
        </div>
    </header>

    <section class="py-20 px-4 bg-white">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-16">Tentang pesan green ✨</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-green-100 rounded-3xl mx-auto mb-6 flex items-center justify-center">
                        <i class="fas fa-recycle text-3xl text-green-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Daur Ulang Pintar ♻️</h3>
                    <p class="text-gray-600 leading-relaxed">Sampah Anda berubah menjadi uang. Kami kelola dengan teknologi modern untuk lingkungan lebih bersih.</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-emerald-100 rounded-3xl mx-auto mb-6 flex items-center justify-center">
                        <i class="fas fa-wallet text-3xl text-emerald-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Bayaran Langsung 💵</h3>
                    <p class="text-gray-600 leading-relaxed">Harga kompetitif per kg, pembayaran instan setelah verifikasi tim kami.</p>
                </div>
                <div class="text-center">
                    <div class="w-20 h-20 bg-blue-100 rounded-3xl mx-auto mb-6 flex items-center justify-center">
                        <i class="fas fa-mobile-alt text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Aplikasi Mudah 📱</h3>
                    <p class="text-gray-600 leading-relaxed">Daftar, foto sampah, kirim permintaan. Verifikasi cepat oleh admin.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="produk-magot" class="py-20 px-4 bg-white border-t border-gray-100">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800">Toko Produk Hasil Magot BSF 🐛</h2>
                <p class="text-gray-500 mt-3 max-w-xl mx-auto text-sm">
                    Pilih produk turunan budidaya Magot berkualitas tinggi hasil olahan sampah organik premium kami.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $products = [
                        ['id' => 1, 'name' => 'Magot Segar Premium', 'desc' => 'Pakan hidup tinggi protein untuk ikan & unggas.', 'price' => 15000, 'unit' => 'kg', 'img' => 'https://images.unsplash.com/photo-1599599810688-96ef8e854897?w=500', 'badge' => '🔥 Terlaris'],
                        ['id' => 2, 'name' => 'Telur / Bibit Magot', 'desc' => 'Bibit berkualitas tinggi siap tetas untuk budidaya.', 'price' => 8000, 'unit' => 'gram', 'img' => 'https://images.unsplash.com/photo-1530595467537-0b5996c41f2d?w=500', 'badge' => '⭐ Super Unggul'],
                        ['id' => 3, 'name' => 'Pupuk Organik Bekasgot', 'desc' => 'Pupuk organik super subur hasil konversi residu magot.', 'price' => 7500, 'unit' => 'kg', 'img' => 'https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?w=500', 'badge' => '🌱 Ramah Lingkungan'],
                        ['id' => 4, 'name' => 'Magot Kering Oven', 'desc' => 'Pakan awet kaya nutrisi, sangat disukai ikan hias.', 'price' => 45000, 'unit' => 'pack', 'img' => 'https://images.unsplash.com/photo-1583337130417-3346a1be7dee?w=500', 'badge' => '🐟 Khusus Ikan']
                    ];
                @endphp

                @foreach($products as $product)
                    <div class="bg-gray-50 rounded-3xl border border-gray-100 shadow-lg p-5 flex flex-col justify-between hover:scale-105 transition duration-300">
                        <div>
                            <div class="relative w-full h-40 bg-gray-200 rounded-2xl overflow-hidden mb-4">
                                <span class="absolute top-2 left-2 z-10 bg-yellow-400 text-gray-900 text-[10px] font-black px-2 py-1 rounded-lg uppercase tracking-wide">
                                    {{ $product['badge'] }}
                                </span>
                                <img src="{{ $product['img'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover">
                            </div>
                            <h3 class="font-extrabold text-gray-800 text-lg mb-1">{{ $product['name'] }}</h3>
                            <p class="text-xs text-gray-500 min-h-[40px] leading-relaxed mb-3">{{ $product['desc'] }}</p>
                        </div>

                        <div>
                            <div class="text-emerald-600 font-black text-xl mb-4">
                                Rp {{ number_format($product['price'], 0, ',', '.') }} <span class="text-xs font-normal text-gray-400">/ {{ $product['unit'] }}</span>
                            </div>

                            @auth
                                {{-- Jika user sudah login --}}
                                <a href="#" class="block w-full text-center bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 text-white font-bold py-3 px-4 rounded-xl text-xs transition shadow-md">
                                    🛒 Beli Sekarang
                                </a>
                            @else
                                {{-- Jika user BELUM login, arahkan ke fungsi SweetAlert --}}
                                <button type="button" onclick="pemberitahuanHarusLogin()" class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 px-4 rounded-xl text-xs transition">
                                     Beli
                                </button>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="daftar-sampah" class="py-20 px-4 bg-gradient-to-r from-green-50 to-emerald-50">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-16">Daftar Jenis Sampah & Harga 📊</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white rounded-3xl shadow-2xl">
                    <thead>
                        <tr class="bg-gradient-to-r from-green-600 to-emerald-600 text-white">
                            <th class="px-8 py-6 text-left rounded-tl-3xl font-bold">Jenis Sampah</th>
                            <th class="px-6 py-6 text-center font-bold">Harga per Kg</th>
                            <th class="px-6 py-6 text-center font-bold">Contoh</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse(\App\Models\Category::orderBy('price_per_kg', 'desc')->take(6)->get() as $category)
                            <tr class="hover:bg-green-50 transition">
                                <td class="px-8 py-6 font-bold text-gray-800">{{ $category->name }}</td>
                                <td class="px-6 py-6 text-center font-bold text-2xl text-green-600">
                                    Rp {{ number_format($category->price_per_kg, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-6 text-gray-600 italic">Botol, kantong, dll.</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-8 py-12 text-center text-gray-500 italic">Jalankan migrations & seed untuk daftar harga.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <p class="text-center mt-8 text-gray-600">* Harga dapat berubah sewaktu-waktu. Minimal setoran 1kg.</p>
        </div>
    </section>

    <section class="py-20 px-4">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-4xl font-bold text-gray-800 mb-8">Informasi Penting 📌</h2>
                <div class="space-y-6">
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt text-green-600 text-2xl mt-1 mr-4 flex-shrink-0"></i>
                        <div>
                            <h3 class="font-bold text-xl mb-2">Lokasi Pengolahan</h3>
                            <p class="text-gray-600">Jl. cipasung tasikmalaya No.123, tasikmalaya. Buka 08.00-17.00 WIB.</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-phone text-green-600 text-2xl mt-1 mr-4 flex-shrink-0"></i>
                        <div>
                            <h3 class="font-bold text-xl mb-2">Kontak</h3>
                            <p class="text-gray-600"><strong>Telp:</strong> 0812-3456-7890 | <strong>Email:</strong> info@Pesangreen.com | <strong>WA:</strong> 0812-3456-7890</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-clock text-green-600 text-2xl mt-1 mr-4 flex-shrink-0"></i>
                        <div>
                            <h3 class="font-bold text-xl mb-2">Cara Kerja</h3>
                            <ol class="text-gray-600 space-y-1 ml-4 list-decimal">
                                <li class="list-decimal list-inside">Pisahkan sampah bersih</li>
                                <li class="list-decimal list-inside">Timbang & foto</li>
                                <li class="list-decimal list-inside">Kirim permintaan via app</li>
                                <li class="list-decimal list-inside">Verifikasi & bayar tunai</li>
                                <li class="list-decimal list-inside">pelihara magot dan jual magot</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-green-100 to-emerald-100 p-12 rounded-3xl shadow-2xl">
                <h3 class="text-3xl font-bold text-gray-800 mb-6 text-center">Siap Setor Sampah? 👋</h3>
                <div class="space-y-4">
                    <a href="{{ route('register') }}" class="block w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-4 px-8 rounded-2xl font-bold text-center hover:from-green-700 transition shadow-xl">
                        Daftar Sekarang Gratis
                    </a>
                    <p class="text-center text-sm text-gray-600 italic">Atau login jika sudah punya akun</p>
                    <a href="{{ route('login') }}" class="block w-full text-green-600 font-bold text-center hover:underline">Masuk Akun →</a>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white py-12 px-4">
        <div class="max-w-6xl mx-auto text-center">
            <div class="flex justify-center mb-8">
                <img src="{{ asset('image/foto1.png') }}" alt="EcoWaste" class="w-32 h-32 rounded-full shadow-2xl mx-4" onerror="this.style.display='none'">
            </div>
            <p class="text-xl font-bold mb-6">&copy; 2026 Pesan green. Selamatkan Bumi Mulai Dari Sampah Anda. 🌍</p>
            <p class="text-gray-400">Jl. universitas kh ruhiat No.123 | tasikmalaya | info@Pesangreen.com</p>
        </div>
    </footer>

    {{-- SCRIPT SWEETALERT UNTUK NOTIFIKASI BELUM LOGIN --}}
    <script>
        function pemberitahuanHarusLogin() {
            Swal.fire({
                title: 'Eits, Login Dulu Yuk! 🔐',
                text: 'Kamu harus masuk ke akun Pesan Green terlebih dahulu sebelum melakukan transaksi pembelian produk magot.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#10b981', // emerald-600
                cancelButtonColor: '#6b7280', // gray-500
                confirmButtonText: 'Login Sekarang 🚀',
                cancelButtonText: 'Nanti Saja ❌',
                borderRadius: '1.25rem'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('login') }}";
                }
            });
        }
    </script>
</body>
</html>