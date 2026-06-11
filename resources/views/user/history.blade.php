<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Penyetoran - Pesan Green</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-50 antialiased text-gray-800">

<div class="flex min-h-screen relative w-full">

    <aside class="z-40">
        @include('user.partials.sidebar')
    </aside>

    <main class="flex-1 flex flex-col min-w-0 w-0 md:pl-72 min-h-screen bg-gray-50 p-6 md:p-8">

        <div class="max-w-4xl mx-auto w-full">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Riwayat Penyetoran</h1>
                <p class="text-sm text-gray-500 mt-1">Semua aktivitas penyetoran sampah yang pernah kamu lakukan</p>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 shadow-xs p-6 md:p-8">

                @forelse ($items as $item)
                    <div class="flex items-start gap-5 pb-6 mb-6 border-b border-gray-100 last:border-none last:pb-0 last:mb-0">
                        
                        <div class="w-12 h-12 rounded-full flex-shrink-0 flex items-center justify-center 
                            {{ $item->status === 'approved' ? 'bg-emerald-100 text-emerald-600' : 
                               ($item->status === 'rejected' ? 'bg-red-100 text-red-600' : 'bg-amber-100 text-amber-600') }}">
                            <i class="fas fa-recycle text-lg"></i>
                        </div>

                        <div class="flex-1">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
                                <h3 class="font-bold text-gray-800 text-sm">
                                    {{ $item->trash_type }} ({{ $item->weight }} kg)
                                </h3>
                                <span class="text-xs font-semibold text-gray-400 bg-gray-50 px-3 py-1 rounded-full w-fit">
                                    <i class="fas fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                </span>
                            </div>

                            <p class="text-xs text-gray-500 mt-2 flex items-center gap-1.5">
                                <i class="fas fa-map-marker-alt text-gray-400"></i> {{ $item->location }}
                            </p>
                            
                            @if($item->description)
                                <p class="text-xs text-gray-500 mt-1 flex items-center gap-1.5">
                                    <i class="fas fa-align-left text-gray-400"></i> {{ $item->description }}
                                </p>
                            @endif

                            <div class="mt-3">
                                @if($item->status === 'pending')
                                    <span class="inline-block px-3 py-1 text-[10px] rounded-full bg-amber-50 text-amber-600 border border-amber-200 font-bold uppercase tracking-wide">
                                        <i class="fas fa-clock mr-1"></i> Menunggu Verifikasi
                                    </span>
                                @elseif($item->status === 'approved')
                                    <span class="inline-block px-3 py-1 text-[10px] rounded-full bg-emerald-50 text-emerald-600 border border-emerald-200 font-bold uppercase tracking-wide">
                                        <i class="fas fa-check-circle mr-1"></i> Disetujui
                                    </span>
                                @elseif($item->status === 'rejected')
                                    <span class="inline-block px-3 py-1 text-[10px] rounded-full bg-red-50 text-red-600 border border-red-200 font-bold uppercase tracking-wide">
                                        <i class="fas fa-times-circle mr-1"></i> Ditolak
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="text-center py-12">
                        <i class="fas fa-inbox text-4xl text-gray-300 mb-3 block"></i>
                        <p class="font-medium text-gray-500">Belum ada riwayat penyetoran.</p>
                        <p class="text-xs text-gray-400 mt-1">Mulai setorkan sampahmu dan kumpulkan saldo!</p>
                    </div>
                @endforelse

            </div>

            @if($items->hasPages())
                <div class="mt-6">
                    {{ $items->links() }}
                </div>
            @endif

        </div>

    </main>
</div>

</body>
</html>