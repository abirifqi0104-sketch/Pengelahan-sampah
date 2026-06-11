<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Setoran - Pesan Green</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 antialiased overflow-x-hidden">

<div class="flex min-h-screen w-full relative">

    {{-- SIDEBAR --}}
    @include('admin.partials.sidebar')

    {{-- MAIN CONTENT --}}
    <div class="flex-1 flex flex-col min-w-0 w-0 md:pl-72 min-h-screen bg-gray-50">

        {{-- HEADER --}}
        <header class="sticky top-0 z-30 bg-white border-b border-gray-100 h-16 px-6 md:px-8 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <i class="fas fa-check-circle text-[#1B4332] text-lg"></i>
                <h1 class="text-base md:text-lg font-bold text-[#1B4332] tracking-tight">Verifikasi Setoran</h1>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3 border-l border-gray-100 pl-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-gray-800 leading-tight">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-0.5">Administrator</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-800 font-bold text-xs border border-emerald-200">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </header>

        {{-- KONTEN NOTIFIKASI --}}
        @if(session('success'))
            <div class="mx-6 md:mx-8 mt-6 p-4 bg-emerald-100 border border-emerald-200 text-emerald-700 rounded-lg text-sm font-bold flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mx-6 md:mx-8 mt-6 p-4 bg-red-100 border border-red-200 text-red-700 rounded-lg text-sm font-bold flex items-center gap-2">
                <i class="fas fa-times-circle"></i> {{ session('error') }}
            </div>
        @endif

        {{-- CONTENT BODY --}}
        <main class="p-6 md:p-8 w-full box-border flex-1">
            <div class="mb-6">
                <h2 class="text-xl md:text-2xl font-black text-gray-800 tracking-tight">Antrean Verifikasi Setoran</h2>
                <p class="text-xs text-gray-500 mt-1">Kelola dan tentukan harga setoran sampah dari nasabah secara real-time.</p>
            </div>

            {{-- TABLE WRAPPER --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden w-full">
                <div class="overflow-x-auto w-full">
                    <table class="w-full text-left border-collapse min-w-[750px]">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr class="text-gray-500 text-[11px] uppercase font-bold tracking-wider">
                                <th class="px-6 py-3.5">Nasabah</th>
                                <th class="px-6 py-3.5">Jenis Sampah</th>
                                <th class="px-6 py-3.5">Berat (Dari User)</th>
                                <th class="px-6 py-3.5">Foto Barang</th>
                                <th class="px-6 py-3.5">Status</th>
                                <th class="px-6 py-3.5 text-center w-64">Penilaian & Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-xs text-gray-700">
                            
                            {{-- LOOPING DATA DARI DATABASE --}}
                            @forelse($items as $item)
                                <tr class="hover:bg-gray-50/80 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold border shadow-sm">
                                                {{ strtoupper(substr($item->user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-800 text-xs">{{ $item->user->name }}</h4>
                                                <p class="text-[10px] text-gray-400">{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-green-50 text-green-700 px-2.5 py-1 rounded-md font-bold text-[10px]">{{ $item->trash_type }}</span>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-800">{{ $item->weight }} <span class="font-normal text-gray-400">Kg</span></td>
                                    <td class="px-6 py-4">
                                        @if($item->image)
                                            <a href="{{ asset('storage/' . $item->image) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $item->image) }}" class="w-12 h-12 rounded-lg object-cover border shadow-sm hover:scale-110 transition cursor-pointer">
                                            </a>
                                        @else
                                            <div class="w-12 h-12 rounded-lg bg-gray-100 border flex items-center justify-center text-gray-400">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-yellow-50 text-yellow-700 px-2.5 py-1 rounded-md font-bold text-[10px] inline-flex items-center gap-1">
                                            <span class="w-1 h-1 rounded-full bg-yellow-500"></span> Menunggu
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 bg-gray-50/30">
                                        {{-- FORM AKSI ADMIN (Tentukan Harga & Setujui) --}}
                                        <div class="flex flex-col gap-2">
                                            <form action="{{ route('admin.verifikasi.approve', $item->id) }}" method="POST" class="flex items-center gap-2">
                                                @csrf
                                                @method('PUT')
                                                <input type="number" name="total_price" placeholder="Harga Rp..." required 
                                                       class="w-full px-2 py-1.5 text-xs border border-gray-300 rounded-lg outline-none focus:border-emerald-500 bg-white">
                                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white py-1.5 px-3 rounded-lg text-[11px] font-bold shadow-sm transition whitespace-nowrap">
                                                    Terima
                                                </button>
                                            </form>
                                            
                                            <form action="{{ route('admin.verifikasi.reject', $item->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Tolak setoran sampah ini?')" class="w-full bg-white border border-red-200 hover:bg-red-50 text-red-600 py-1.5 px-3 rounded-lg text-[11px] font-bold transition">
                                                    Tolak Setoran
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                                            <i class="fas fa-check-double text-2xl text-emerald-500"></i>
                                        </div>
                                        <h3 class="text-sm font-bold text-gray-800">Semua Bersih!</h3>
                                        <p class="text-xs text-gray-500 mt-1">Tidak ada setoran sampah yang perlu diverifikasi saat ini.</p>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

            {{-- PAGINATION --}}
            @if(isset($items) && $items->hasPages())
                <div class="mt-6">
                    {{ $items->links() }}
                </div>
            @endif

        </main>
    </div>
</div>

</body>
</html>