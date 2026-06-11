<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setoran Sampah - Pesan Green</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-thumb { background: #1B4332; border-radius: 10px; }
    </style>
</head>

<body class="bg-gray-50 antialiased">

<div class="flex min-h-screen relative w-full">

    {{-- SIDEBAR --}}
    @include('admin.partials.sidebar')

    {{-- MAIN CONTENT --}}
    <div class="flex-1 pl-[240px] flex flex-col min-w-0 w-full">

        {{-- TOPBAR --}}
        <header class="bg-white h-16 border-b flex items-center justify-between px-6 sticky top-0 z-30 shadow-sm/50">
            <div class="flex items-center gap-3">
                <button class="text-gray-500 text-lg hover:text-[#1B4332] transition md:hidden">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <h1 class="font-bold text-gray-800 text-base leading-tight">Setoran Sampah</h1>
                    <p class="text-[11px] text-gray-400">Manajemen setoran bank sampah</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                {{-- SEARCH BAR ATAS --}}
                <div class="relative hidden md:block">
                    <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                    <input type="text" id="topSearch" placeholder="Cari cepat..."
                        class="bg-gray-50 border border-gray-200 rounded-xl pl-9 pr-4 py-1.5 text-xs w-60 focus:outline-none focus:ring-1 focus:ring-green-700 focus:bg-white transition">
                </div>

                {{-- PROFILE --}}
                <div class="flex items-center gap-2.5 border-l border-gray-100 pl-4">
                    <div class="text-right hidden sm:block">
                        <h2 class="font-bold text-xs text-gray-800 leading-tight">{{ Auth::user()->name }}</h2>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-0.5">Admin</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=1B4332&color=fff"
                        class="w-8 h-8 rounded-full shadow-sm border border-gray-100">
                </div>
            </div>
        </header>

        {{-- CONTENT AREA --}}
        <main class="p-6 md:p-8 w-full block">

            {{-- HEADER HALAMAN & TOMBOL TAMBAH --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-xl md:text-2xl font-black text-gray-800 tracking-tight">Data Setoran Sampah</h2>
                    <p class="text-xs text-gray-500 mt-1">Kelola seluruh data setoran nasabah bank sampah.</p>
                </div>

                <a href="{{ route('admin.transactions.create') }}"
                    class="bg-[#1B4332] hover:bg-[#2D6A4F] transition text-white px-4 py-2.5 rounded-xl text-xs font-bold shadow-md flex items-center gap-2 w-fit">
                    <i class="fas fa-plus text-[10px]"></i>
                    Tambah Setoran
                </a>
            </div>

            {{-- CARD STATISTIK MINI --}}
           {{-- CARD STATISTIK (DIBUAT DALAM SATU GRID UNIFIED) --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-6">
    
    {{-- 1. TOTAL SETORAN --}}
    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex justify-between items-center hover:shadow-md transition">
        <div>
            <p class="text-[9px] text-gray-400 font-extrabold uppercase tracking-wider">Total</p>
            <h2 class="text-xl font-black text-gray-800 mt-1">{{ $items->count() }} <span class="text-[10px] font-normal text-gray-400">data</span></h2>
        </div>
        <div class="w-9 h-9 rounded-lg bg-green-50 flex items-center justify-center shrink-0">
            <i class="fas fa-trash text-sm text-green-700"></i>
        </div>
    </div>

    {{-- 2. ORGANIK --}}
    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex justify-between items-center hover:shadow-md transition">
        <div>
            <p class="text-[9px] text-gray-400 font-extrabold uppercase tracking-wider">Organik</p>
            <h2 class="text-xl font-black text-gray-800 mt-1">{{ $items->where('trash_type','Sampah Organik')->count() }} <span class="text-[10px] font-normal text-gray-400">data</span></h2>
        </div>
        <div class="w-9 h-9 rounded-lg bg-green-50 flex items-center justify-center shrink-0">
            <i class="fas fa-leaf text-sm text-green-700"></i>
        </div>
    </div>

    {{-- 3. PLASTIK --}}
    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex justify-between items-center hover:shadow-md transition">
        <div>
            <p class="text-[9px] text-gray-400 font-extrabold uppercase tracking-wider">Plastik</p>
            <h2 class="text-xl font-black text-gray-800 mt-1">{{ $items->where('trash_type', 'Sampah Plastik')->count() }} <span class="text-[10px] font-normal text-gray-400">data</span></h2>
        </div>
        <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">
            <i class="fas fa-recycle text-sm text-blue-700"></i>
        </div>
    </div>

    {{-- 4. KERTAS --}}
    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex justify-between items-center hover:shadow-md transition">
        <div>
            <p class="text-[9px] text-gray-400 font-extrabold uppercase tracking-wider">Kertas</p>
            <h2 class="text-xl font-black text-gray-800 mt-1">{{ $items->where('trash_type', 'Sampah Kertas')->count() }} <span class="text-[10px] font-normal text-gray-400">data</span></h2>
        </div>
        <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center shrink-0">
            <i class="fas fa-file-alt text-sm text-amber-700"></i>
        </div>
    </div>

    {{-- 5. LOGAM --}}
    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex justify-between items-center hover:shadow-md transition">
        <div>
            <p class="text-[9px] text-gray-400 font-extrabold uppercase tracking-wider">Logam</p>
            <h2 class="text-xl font-black text-gray-800 mt-1">{{ $items->where('trash_type', 'Sampah Logam')->count() }} <span class="text-[10px] font-normal text-gray-400">data</span></h2>
        </div>
        <div class="w-9 h-9 rounded-lg bg-slate-50 flex items-center justify-center shrink-0">
            <i class="fas fa-tools text-sm text-slate-700"></i>
        </div>
    </div>

    {{-- 6. KACA --}}
    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex justify-between items-center hover:shadow-md transition">
        <div>
            <p class="text-[9px] text-gray-400 font-extrabold uppercase tracking-wider">Kaca</p>
            <h2 class="text-xl font-black text-gray-800 mt-1">{{ $items->where('trash_type', 'Sampah Kaca')->count() }} <span class="text-[10px] font-normal text-gray-400">data</span></h2>
        </div>
        <div class="w-9 h-9 rounded-lg bg-purple-50 flex items-center justify-center shrink-0">
            <i class="fas fa-wine-bottle text-sm text-purple-700"></i>
        </div>
    </div>
</div>

            {{-- BOX UTAMA FILTER --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5 block">Jenis Sampah</label>
                        <select id="filterType" class="w-full border border-gray-200 rounded-xl px-3 py-2 text-xs bg-gray-50 focus:ring-1 focus:ring-green-700 focus:bg-white focus:outline-none transition">
                            <option value="">Semua Jenis</option>
                            <option value="Organik">Sampah Organik</option>
                            <option value="Plastik">Sampah Plastik</option>
                            <option value="kertas">Sampah kertas</option>
                            <option value="logam">Sampah logam</option>
                            <option value="kaca">Sampah kaca</option>
                        
                        </select>
                    </div>

                    <div>
                        <label class="text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1.5 block">Cari Data (ID / Lokasi / Status)</label>
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                            <input type="text" id="filterSearch" placeholder="Cari ID transaksi, lokasi, atau status..." class="w-full border border-gray-200 rounded-xl pl-9 pr-3 py-2 text-xs bg-gray-50 focus:ring-1 focus:ring-green-700 focus:bg-white focus:outline-none transition">
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODERN TABLE CONTAINER --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse" id="dataTable">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr class="text-gray-500 text-[11px] uppercase font-bold tracking-wider">
                                <th class="px-5 py-3 w-12 text-center">No</th>
                                <th class="px-5 py-3">ID</th>
                                <th class="px-5 py-3">Jenis</th>
                                <th class="px-5 py-3">Berat</th>
                                <th class="px-5 py-3">Tanggal</th>
                                <th class="px-5 py-3">Lokasi</th>
                                <th class="px-5 py-3">Status</th>
                                <th class="px-5 py-3 text-center w-28">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-xs text-gray-700" id="tableBody">

                            @forelse($items as $item)
                            <tr class="hover:bg-gray-50/80 transition data-row">
                                <td class="px-5 py-3 text-center font-medium text-gray-400">{{ $loop->iteration }}</td>
                                <td class="px-5 py-3 font-bold text-gray-800">{{ $item->data_id }}</td>
                               <td class="px-5 py-3 col-type">
                                     @if(str_contains($item->trash_type, 'Organik'))
                                         <span class="bg-green-50 text-green-700 px-2.5 py-0.5 rounded-md font-bold text-[10px]">Organik</span>
    
                                     @elseif(str_contains($item->trash_type, 'Kertas'))
                                          <span class="bg-amber-50 text-amber-700 px-2.5 py-0.5 rounded-md font-bold text-[10px]">Kertas</span>
    
                                     @elseif(str_contains($item->trash_type, 'Logam'))
                                        <span class="bg-gray-100 text-gray-700 px-2.5 py-0.5 rounded-md font-bold text-[10px]">Logam</span>
    
                                     @elseif(str_contains($item->trash_type, 'Kaca'))
                                        <span class="bg-purple-50 text-purple-700 px-2.5 py-0.5 rounded-md font-bold text-[10px]">Kaca</span>
    
                                      @else
        {{-- Ini untuk Plastik atau tipe lain sebagai default --}}
                                    <span class="bg-blue-50 text-blue-700 px-2.5 py-0.5 rounded-md font-bold text-[10px]">Plastik</span>
                                    @endif
                                </td>
                                <td class="px-5 py-3 font-bold text-gray-800">
                                    {{ $item->weight }} <span class="font-normal text-gray-400">Kg</span>
                                </td>
                                <td class="px-5 py-3 text-gray-500">
                                    {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                </td>
                                <td class="px-5 py-3 text-gray-500 truncate max-w-[150px]">{{ $item->location }}</td>
                                
                                {{-- PERBAIKAN: STATUS DINAMIS MENGIKUTI DATABASE --}}
                                <td class="px-5 py-3">
                                    @if($item->status == 'pending')
                                        <span class="bg-amber-50 text-amber-700 px-2.5 py-0.5 rounded-md font-bold text-[10px] inline-flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Menunggu
                                        </span>
                                    @elseif($item->status == 'approved')
                                        <span class="bg-emerald-50 text-emerald-700 px-2.5 py-0.5 rounded-md font-bold text-[10px] inline-flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Disetujui
                                        </span>
                                    @else
                                        <span class="bg-red-50 text-red-700 px-2.5 py-0.5 rounded-md font-bold text-[10px] inline-flex items-center gap-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Ditolak
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        {{-- EDIT --}}
                                        <a href="{{ route('admin.transactions.edit', $item->id) }}"
                                           class="w-7 h-7 rounded-lg bg-blue-50 hover:bg-blue-100 flex items-center justify-center text-blue-600 transition shadow-sm"
                                           title="Edit Data">
                                            <i class="fas fa-pen text-[10px]"></i>
                                        </a>

                                        {{-- DELETE FORM --}}
                                        <form action="{{ route('admin.transactions.destroy', $item->id) }}" method="POST" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                    class="delete-btn w-7 h-7 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center text-red-600 transition shadow-sm"
                                                    title="Hapus Data">
                                                <i class="fas fa-trash text-[10px]"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr id="emptyRow">
                                <td colspan="8" class="text-center py-14 text-gray-400">
                                    <div class="max-w-xs mx-auto">
                                        <i class="fas fa-box-open text-4xl mb-3 text-gray-200"></i>
                                        <p class="text-xs font-semibold text-gray-400">Belum ada data setoran sampah</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="px-5 py-3 border-t border-gray-50 bg-gray-50/50">
                    {{ $items->links() }}
                </div>
            </div>

        </main>
    </div>
</div>

{{-- SWEETALERT DEPENDENCY --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- SCRIPT PENCARIAN REAL-TIME & SWEETALERT --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // -----------------------------------------------------------------
        // 1. FITUR FILTER & PENCARIAN (REAL-TIME)
        // -----------------------------------------------------------------
        const filterType = document.getElementById('filterType');
        const filterSearch = document.getElementById('filterSearch');
        const topSearch = document.getElementById('topSearch'); // Search bar di atas
        const tableRows = document.querySelectorAll('.data-row');

        function filterTable() {
            const typeValue = filterType.value.toLowerCase();
            const searchValue = filterSearch.value.toLowerCase();
            
            tableRows.forEach(row => {
                // Ambil text dari seluruh baris (untuk kolom pencarian bebas)
                const rowText = row.innerText.toLowerCase();
                // Ambil spesifik text jenis sampah
                const typeText = row.querySelector('.col-type').innerText.toLowerCase();
                
                // Cek kecocokan
                const matchType = typeValue === "" || typeText.includes(typeValue);
                const matchSearch = rowText.includes(searchValue);
                
                // Tampilkan atau Sembunyikan
                if (matchType && matchSearch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Jalankan filter saat user mengetik atau memilih opsi
        if(filterType) filterType.addEventListener('change', filterTable);
        if(filterSearch) filterSearch.addEventListener('input', filterTable);
        
        // Sinkronkan top search bar (header) dengan filter table
        if(topSearch) {
            topSearch.addEventListener('input', function() {
                filterSearch.value = this.value;
                filterTable();
            });
        }


        // -----------------------------------------------------------------
        // 2. NOTIFIKASI TAMBAH DATA (Membaca session flash)
        // -----------------------------------------------------------------
        @if(session('success'))
            Swal.fire({
                title: 'Yess berhasil! 🎉🥳',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#1B4332', 
                confirmButtonText: 'Mantap!',
                background: '#ffffff',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif


        // -----------------------------------------------------------------
        // 3. PROSES HAPUS DATA (Konfirmasi -> Animasi Sedih -> Submit)
        // -----------------------------------------------------------------
        document.addEventListener('click', function (e) {
            const button = e.target.closest('.delete-btn');
            
            if (button) {
                e.preventDefault();
                const form = button.closest('.delete-form');

                Swal.fire({
                    title: 'Hapus Data?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444', 
                    cancelButtonColor: '#6b7280',  
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    background: '#ffffff',
                    customClass: { popup: 'rounded-2xl' }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Yah dihapus... 😢',
                            text: 'Data setoran sampah sedang diproses untuk dihapus.',
                            icon: 'info',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            background: '#ffffff',
                            customClass: { popup: 'rounded-2xl' }
                        });

                        setTimeout(() => {
                            form.submit();
                        }, 1500);
                    }
                });
            }
        });
    });
</script>

</body>
</html>