<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saldo Nasabah - Pesan Green</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; overflow-x: hidden; }
    </style>
</head>
<body class="bg-gray-50 antialiased">

<div class="flex min-h-screen relative w-full">

    {{-- SIDEBAR --}}
    @include('admin.partials.sidebar')

    {{-- MAIN CONTENT (Ditambahkan md:pl-72 agar tidak numpang) --}}
    <main class="flex-1 flex flex-col min-w-0 w-0 md:pl-72 min-h-screen bg-gray-50">

        {{-- HEADER --}}
        <header class="sticky top-0 z-30 bg-white border-b border-gray-100 h-16 px-6 md:px-8 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <i class="fas fa-wallet text-[#1B4332] text-lg"></i>
                <h1 class="text-base md:text-lg font-bold text-[#1B4332] tracking-tight">Rekapitulasi Saldo Nasabah</h1>
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

        {{-- CONTENT BODY --}}
        <div class="p-6 md:p-8 w-full box-border flex-1">

            {{-- TITLE --}}
            <div class="mb-6">
                <h2 class="text-xl md:text-2xl font-black text-gray-800 tracking-tight">Buku Saldo & Setoran Berhasil</h2>
                <p class="text-xs text-gray-500 mt-1">Daftar riwayat semua setoran sampah nasabah yang telah diverifikasi menjadi saldo.</p>
            </div>

            {{-- TABLE WRAPPER --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden w-full">
                <div class="overflow-x-auto w-full">
                    <table class="w-full text-left border-collapse min-w-[750px]">
                        <thead class="bg-[#1B4332] text-white">
                            <tr class="text-[11px] uppercase font-bold tracking-wider">
                                <th class="px-6 py-4 rounded-tl-lg">ID Setoran</th>
                                <th class="px-6 py-4">Nasabah</th>
                                <th class="px-6 py-4">Jenis Sampah</th>
                                <th class="px-6 py-4">Berat (Kg)</th>
                                <th class="px-6 py-4">Saldo Didapat</th>
                                <th class="px-6 py-4 rounded-tr-lg text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-xs text-gray-700">
                            
                            @forelse($transactions as $item)
                                <tr class="hover:bg-emerald-50/50 transition">
                                    <td class="px-6 py-4 font-bold text-gray-600">
                                        {{ $item->data_id ?? 'REQ-'.$item->id }}
                                        <div class="text-[10px] font-normal text-gray-400 mt-0.5">{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-800">
                                        {{ $item->user->name ?? 'User Dihapus' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded font-semibold text-[10px]">{{ $item->trash_type }}</span>
                                    </td>
                                    <td class="px-6 py-4 font-semibold">
                                        {{ $item->weight }} Kg
                                    </td>
                                    <td class="px-6 py-4 font-black text-emerald-600 text-sm">
                                        Rp {{ number_format($item->total_price ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-block bg-emerald-100 text-emerald-700 border border-emerald-200 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide">
                                            <i class="fas fa-check-circle mr-1"></i> Selesai
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                                            <i class="fas fa-wallet text-2xl text-gray-300"></i>
                                        </div>
                                        <h3 class="text-sm font-bold text-gray-600">Belum Ada Saldo Tercatat</h3>
                                        <p class="text-xs text-gray-400 mt-1">Lakukan verifikasi setoran nasabah untuk melihat rekapitulasi saldo di sini.</p>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

            {{-- PAGINATION --}}
            @if(isset($transactions) && $transactions->hasPages())
                <div class="mt-6">
                    {{ $transactions->links() }}
                </div>
            @endif

        </div>
    </main>

</div>

</body>
</html>