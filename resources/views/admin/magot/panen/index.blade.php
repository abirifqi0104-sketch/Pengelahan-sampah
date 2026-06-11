<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Panen Maggot - Pesan Green</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 antialiased overflow-x-hidden">

<div class="flex min-h-screen relative w-full">
    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col min-w-0 w-0 md:pl-72 min-h-screen bg-gray-50">
        
        {{-- HEADER --}}
        <header class="sticky top-0 z-30 bg-white border-b border-gray-100 h-16 px-6 md:px-8 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-[#1B4332] text-white flex items-center justify-center"><i class="fas fa-bug text-sm"></i></div>
                <h1 class="text-base md:text-lg font-bold text-gray-800 tracking-tight">Manajemen Maggot BSF</h1>
            </div>
        </header>

        {{-- TAB NAVIGASI --}}
        <div class="bg-white px-6 md:px-8 border-b border-gray-200">
            <nav class="flex gap-6 -mb-px">
                <a href="{{ route('admin.maggot.index') }}" class="py-4 text-sm font-bold text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition flex items-center gap-2">
                    <i class="fas fa-seedling"></i> Data Budidaya
                </a>
                <a href="{{ route('admin.maggot.panen') }}" class="py-4 text-sm font-bold border-b-2 border-[#1B4332] text-[#1B4332] flex items-center gap-2">
                    <i class="fas fa-box-open"></i> Hasil Panen
                </a>
                <a href="{{ url('admin/maggot/penjualan') }}" class="py-4 text-sm font-bold text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition flex items-center gap-2">
                    <i class="fas fa-store"></i> Penjualan (Produk Olahan)
                </a>
            </nav>
        </div>

        {{-- MAIN CONTENT --}}
        <main class="p-6 md:p-8 w-full max-w-7xl mx-auto flex-1 box-border">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-xl md:text-2xl font-black text-gray-800 tracking-tight">Data Hasil Panen 📦</h2>
                    <p class="text-xs text-gray-500 mt-1">Daftar riwayat seluruh panen maggot dari biopond Anda.</p>
                </div>
                <a href="{{ route('admin.maggot.panen.create') }}" class="inline-flex items-center justify-center gap-2 bg-[#1B4332] hover:bg-[#133024] text-white px-5 py-2.5 rounded-xl text-xs font-bold transition shadow-sm whitespace-nowrap">
                    <i class="fas fa-plus"></i> Tambah Panen
                </a>
            </div>

            {{-- TABLE CARD --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[700px]">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-[11px] font-bold uppercase tracking-wider text-gray-500">
                                <th class="px-6 py-4">Tanggal Panen</th>
                                <th class="px-6 py-4">Lokasi Biopond</th>
                                <th class="px-6 py-4">Kode Siklus</th>
                                <th class="px-6 py-4">Hasil Panen (Kg)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-xs font-medium text-gray-700">
                            @forelse($items as $item)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="px-6 py-4 font-bold text-gray-800">
                                        <i class="fas fa-calendar-check text-emerald-600 mr-2"></i> 
                                        {{ \Carbon\Carbon::parse($item->tanggal_panen)->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="px-6 py-4 flex items-center gap-2 font-bold">
                                        <div class="w-6 h-6 rounded bg-gray-100 flex items-center justify-center text-[10px]">🏢</div>
                                        {{ $item->maggot->biopond_name ?? 'Biopond Dihapus' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-500">{{ $item->maggot->cultivation_code ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-emerald-50 text-emerald-700 px-3 py-1.5 rounded-lg font-black text-sm border border-emerald-100">
                                            {{ $item->hasil_kg }} Kg
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center">
                                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                                            <i class="fas fa-box-open text-2xl text-emerald-600/50"></i>
                                        </div>
                                        <h3 class="text-sm font-bold text-gray-800">Belum ada hasil panen</h3>
                                        <p class="text-xs text-gray-500 mt-1">Silakan klik "Tambah Panen" jika maggot sudah siap diangkat.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            @if($items->hasPages())
                <div class="mt-6">{{ $items->links() }}</div>
            @endif

        </main>
    </div>
</div>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        confirmButtonColor: '#1B4332',
        customClass: { popup: 'rounded-2xl' }
    });
</script>
@endif

</body>
</html>