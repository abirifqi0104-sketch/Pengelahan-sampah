<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Arsip - Pesan Green</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
    </style>
</head>

<body class="bg-gray-50 antialiased">

<div class="flex min-h-screen relative w-full">

    {{-- SIDEBAR --}}
    @include('admin.partials.sidebar')

    {{-- 
      MAIN CONTENT 
      KUNCI PERBAIKAN: Menggunakan `pl-[240px]` agar seluruh layout tabel arsip bergeser 
      ke kanan secara presisi dan sejajar sempurna dengan sidebar.
    --}}
    <div class="flex-1 pl-[240px] flex flex-col min-w-0 w-full">

        {{-- TOPBAR / HEADER (Lebih Ringkas & Simetris) --}}
        <header class="bg-white h-16 border-b flex items-center justify-between px-6 sticky top-0 z-30 shadow-sm/50">

            <div class="flex items-center gap-3">
                <button class="text-gray-500 text-lg hover:text-[#1B4332] transition md:hidden">
                    <i class="fas fa-bars"></i>
                </button>

                <div>
                    <h1 class="font-bold text-gray-800 text-base leading-tight">
                        Data Arsip Sampah
                    </h1>
                    <p class="text-[11px] text-gray-400">
                        Kelola data sampah yang telah dihapus
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-4">

                {{-- SEARCH BAR --}}
                <div class="relative hidden md:block">
                    <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                    <input type="text"
                        placeholder="Cari data arsip..."
                        class="bg-gray-50 border border-gray-200 rounded-xl pl-9 pr-4 py-1.5 text-xs w-60 focus:outline-none focus:ring-1 focus:ring-green-700 focus:bg-white transition">
                </div>

                {{-- PROFILE --}}
                <div class="flex items-center gap-2.5 border-l border-gray-100 pl-4">
                    <div class="text-right hidden sm:block">
                        <h2 class="font-bold text-xs text-gray-800 leading-tight">
                            {{ Auth::user()->name }}
                        </h2>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-0.5">
                            Administrator
                        </p>
                    </div>

                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1B4332&color=fff"
                        class="w-8 h-8 rounded-full shadow-sm border border-gray-100">
                </div>

            </div>
        </header>

        {{-- CONTENT AREA --}}
        <main class="p-6 md:p-8 w-full block">

            {{-- TITLE (Menghapus teks italic agar tampilan lebih profesional dan bersih) --}}
            <div class="mb-6">
                <h2 class="text-xl md:text-2xl font-black text-gray-800 tracking-tight">
                    Data Arsip
                </h2>
                <p class="text-xs text-gray-500 mt-1">
                    Data sampah yang telah dihapus sementara dan masih dapat dipulihkan kembali ke sistem.
                </p>
            </div>

            {{-- NAVIGATION TAB-STYLE (Lebih Mini, Konsisten, & Padat) --}}
            <div class="flex flex-wrap gap-2 mb-6">
                <a href="{{ route('admin.transactions.create') }}"
                    class="bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2">
                    <i class="fas fa-plus-circle text-[10px]"></i>
                    Tambah Data
                </a>

                <a href="{{ route('admin.transactions.index') }}"
                    class="bg-white text-gray-600 border border-gray-200 hover:bg-gray-50 px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2">
                    <i class="fas fa-database text-[10px]"></i>
                    Data Aktif
                </a>

                <a href="{{ route('admin.transactions.archive') }}"
                    class="bg-[#1B4332] text-white shadow-sm px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2">
                    <i class="fas fa-box-archive text-[10px]"></i>
                    Data Arsip
                </a>
            </div>

            {{-- TABLE CARD COMPONENT --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- HEADER CARD (Menggunakan Solid Color #1B4332 & Tata Letak Rapi) --}}
                <div class="px-6 py-4 bg-[#1B4332] flex items-center justify-between flex-wrap gap-3">
                    <div>
                        <h3 class="text-sm font-bold text-white tracking-wide">
                            Arsip Setoran Sampah
                        </h3>
                        <p class="text-green-200/80 text-[11px] mt-0.5">
                            Restore atau hapus permanen data arsip di bawah ini
                        </p>
                    </div>

                    <div class="bg-white/10 border border-white/10 px-3 py-1 rounded-lg text-white text-xs font-medium">
                        Total Arsip : <span class="font-bold text-green-300">{{ $items->count() }}</span>
                    </div>
                </div>

                {{-- TABLE SECTION --}}
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[800px] table-fixed">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr class="text-left">
                                <th class="w-16 px-4 py-3.5 text-[11px] font-bold uppercase tracking-wider text-gray-400 text-center">No</th>
                                <th class="w-40 px-4 py-3.5 text-[11px] font-bold uppercase tracking-wider text-gray-400">ID Data</th>
                                <th class="w-44 px-4 py-3.5 text-[11px] font-bold uppercase tracking-wider text-gray-400">Jenis Sampah</th>
                                <th class="w-32 px-4 py-3.5 text-[11px] font-bold uppercase tracking-wider text-gray-400">Berat</th>
                                <th class="px-4 py-3.5 text-[11px] font-bold uppercase tracking-wider text-gray-400">Tanggal Hapus</th>
                                <th class="w-32 px-4 py-3.5 text-[11px] font-bold uppercase tracking-wider text-gray-400 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse ($items as $item)
                                <tr class="hover:bg-gray-50/70 transition-colors duration-150">
                                    
                                    {{-- NO --}}
                                    <td class="px-4 py-3 text-center">
                                        <span class="text-xs font-bold text-gray-600">{{ $loop->iteration }}</span>
                                    </td>

                                    {{-- ID DATA --}}
                                    <td class="px-4 py-3">
                                        <span class="text-xs font-bold text-gray-700 tracking-wide block truncate">{{ $item->data_id }}</span>
                                    </td>

                                    {{-- JENIS SAMPAH (Badge Lebih Kecil & Rapi) --}}
                                    <td class="px-4 py-3">
                                        @if($item->trash_type == 'Organik')
                                            <span class="bg-green-50 text-green-700 border border-green-100 px-2.5 py-0.5 rounded-md text-[11px] font-bold inline-block">
                                                {{ $item->trash_type }}
                                            </span>
                                        @elseif($item->trash_type == 'Plastik')
                                            <span class="bg-blue-50 text-blue-700 border border-blue-100 px-2.5 py-0.5 rounded-md text-[11px] font-bold inline-block">
                                                {{ $item->trash_type }}
                                            </span>
                                        @else
                                            <span class="bg-gray-50 text-gray-700 border border-gray-200 px-2.5 py-0.5 rounded-md text-[11px] font-bold inline-block">
                                                {{ $item->trash_type }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- BERAT --}}
                                    <td class="px-4 py-3">
                                        <span class="text-xs font-semibold text-gray-700">{{ $item->weight }} kg</span>
                                    </td>

                                    {{-- TANGGAL HAPUS --}}
                                    <td class="px-4 py-3">
                                        <div class="text-xs font-semibold text-red-600">
                                            {{ $item->deleted_at->format('d M Y') }}
                                        </div>
                                        <div class="text-[10px] text-gray-400 mt-0.5">
                                            {{ $item->deleted_at->diffForHumans() }}
                                        </div>
                                    </td>

                                    {{-- AKSI (Tombol Diperkecil Agar Lebih Proporsional) --}}
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-center gap-2">

                                            {{-- RESTORE --}}
                                            <a href="{{ route('admin.transactions.restore', $item->id) }}"
                                               class="w-7 h-7 rounded-lg bg-green-50 hover:bg-green-100 text-green-700 border border-green-200 flex items-center justify-center transition shadow-2xs"
                                               title="Pulihkan Data">
                                                <i class="fas fa-rotate-left text-xs"></i>
                                            </a>

                                            {{-- DELETE PERMANENT --}}
                                            <form action="{{ route('admin.transactions.forceDelete', $item->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus permanen data ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="w-7 h-7 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 flex items-center justify-center transition shadow-2xs"
                                                    title="Hapus Permanen">
                                                    <i class="fas fa-trash text-xs"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @empty
                                {{-- EMPTY STATE (Tampilan Bersih Saat Data Kosong) --}}
                                <tr>
                                    <td colspan="6" class="py-16 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <div class="w-14 h-14 rounded-full bg-gray-50 flex items-center justify-center border border-gray-100 mb-3 text-gray-400 shadow-2xs">
                                                <i class="fas fa-box-archive text-xl"></i>
                                            </div>
                                            <h3 class="font-bold text-sm text-gray-700 mb-0.5">
                                                Arsip Kosong
                                            </h3>
                                            <p class="text-xs text-gray-400">
                                                Belum ada data setoran sampah yang dihapus.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                    {{ $items->links() }}
                </div>

            </div>

        </main>
    </div>

</div>

</body>
</html>