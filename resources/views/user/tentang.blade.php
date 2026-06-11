<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tentang Pesan Green</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Hilangin scrollbar */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="bg-gray-50">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    @include('user.partials.sidebar')

    <!-- MAIN -->
    <main class="flex-1 p-8">

        <!-- HEADER -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 italic">
                Tentang Pesan Green
            </h1>
            <p class="text-sm text-gray-500 italic">
                Informasi tentang sistem pengelolaan sampah
            </p>
        </div>

        <!-- GALERI -->
        <div class="mt-10">
            <h2 class="text-xl font-bold text-gray-800 mb-4 italic">
                Dokumentasi Kegiatan
            </h2>

            <!-- WRAPPER -->
            <div class="relative">

                <!-- BUTTON -->
                <button onclick="scrollSlider(-1)" 
                    class="absolute left-0 top-1/2 -translate-y-1/2 bg-white shadow px-3 py-2 rounded-full z-10">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <button onclick="scrollSlider(1)" 
                    class="absolute right-0 top-1/2 -translate-y-1/2 bg-white shadow px-3 py-2 rounded-full z-10">
                    <i class="fas fa-chevron-right"></i>
                </button>

                <!-- SLIDER -->
                <div id="slider"
                    class="flex gap-4 overflow-x-auto no-scrollbar scroll-smooth px-10">

                    <!-- ITEM -->
                    @foreach([
                        ['img'=>'https://images.unsplash.com/photo-1604187351574-c75ca79f5807','text'=>'Pemilahan sampah'],
                        ['img'=>'https://images.unsplash.com/photo-1595273670150-bd0c3c392e46','text'=>'Bank sampah'],
                        ['img'=>'https://images.unsplash.com/photo-1581578731548-c64695cc6952','text'=>'Pengolahan plastik'],
                        ['img'=>'https://images.unsplash.com/photo-1503596476-1c12a8ba09a9','text'=>'Lokasi TPS'],
                        ['img'=>'https://images.unsplash.com/photo-1621452773781-0f992fd1f6b6','text'=>'Edukasi lingkungan']
                    ] as $item)

                    <div class="min-w-[250px] bg-white rounded-xl shadow overflow-hidden cursor-pointer"
                         onclick="openModal('{{ $item['img'] }}')">

                        <img src="{{ $item['img'] }}"
                             class="w-full h-40 object-cover hover:scale-110 transition duration-300">

                        <div class="p-3 text-xs text-gray-500 italic">
                            {{ $item['text'] }}
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>

        <!-- MODAL ZOOM -->
        <div id="modal" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center z-50">
            <span onclick="closeModal()" 
                class="absolute top-5 right-8 text-white text-3xl cursor-pointer">&times;</span>

            <img id="modalImg" class="max-h-[80%] rounded-xl shadow-lg">
        </div>

        <!-- CARD -->
        <div class="bg-white rounded-2xl shadow p-8 my-8">
            <h2 class="text-xl font-bold mb-4 text-green-700">
                Apa itu Pesan Green?
            </h2>

            <p class="text-gray-600 leading-relaxed">
                <strong>Pesan Green</strong> adalah platform digital untuk membantu 
                pengelolaan sampah secara modern dan ramah lingkungan.
            </p>
        </div>

        <!-- VISI MISI -->
        <div class="grid grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="font-bold text-green-700 mb-3">Visi</h3>
                <p class="text-sm text-gray-600">
                    Mendorong masyarakat peduli lingkungan.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="font-bold text-green-700 mb-3">Misi</h3>
                <ul class="text-sm text-gray-600 list-disc ml-4">
                    <li>Edukasi lingkungan</li>
                    <li>Digitalisasi sampah</li>
                    <li>Daur ulang</li>
                </ul>
            </div>
        </div>

        <!-- FITUR -->
        <div class="bg-white rounded-2xl shadow p-8">
            <h3 class="text-lg font-bold mb-6 text-green-700">Fitur</h3>

            <div class="grid grid-cols-3 gap-6 text-center">
                <div>
                    <i class="fas fa-trash text-3xl text-green-600 mb-2"></i>
                    <p>Setor Sampah</p>
                </div>

                <div>
                    <i class="fas fa-history text-3xl text-green-600 mb-2"></i>
                    <p>Riwayat</p>
                </div>

                <div>
                    <i class="fas fa-leaf text-3xl text-green-600 mb-2"></i>
                    <p>Edukasi</p>
                </div>
            </div>
        </div>

    </main>
</div>

<!-- SCRIPT -->
<script>
    const slider = document.getElementById('slider');

    function scrollSlider(direction) {
        slider.scrollBy({
            left: direction * 300,
            behavior: 'smooth'
        });
    }

    // AUTO SLIDE
    setInterval(() => {
        slider.scrollBy({ left: 300, behavior: 'smooth' });
    }, 3000);

    // MODAL
    function openModal(src) {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modalImg').src = src;
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
</script>

</body>
</html>