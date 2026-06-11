<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Penyetoran - Pesan Green</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">

<div class="min-h-screen flex">
   @include('admin.partials.sidebar')

    <main class="flex-1 ml-64 overflow-y-auto">
        <header class="bg-white border-b h-16 flex items-center justify-between px-8 sticky top-0 z-10">
            <div class="flex items-center gap-2 text-sm font-semibold text-gray-700 italic">
                <i class="fas fa-bars mr-2 text-gray-400"></i> Riwayat Penyetoran
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="text-xs font-bold leading-none">Admin</p>
                    <p class="text-[10px] text-gray-500 italic">Administrator</p>
                </div>
                <img src="https://ui-avatars.com/api/?name=Admin&background=1B4332&color=fff" class="h-8 w-8 rounded-full">
            </div>
        </header>

        <div class="p-8 italic">
            <h2 class="text-2xl font-bold text-gray-800 uppercase mb-2 tracking-tighter leading-none">Riwayat Penyetoran</h2>
            <p class="text-xs text-gray-500 mb-8">Riwayat penyetoran sampah yang telah dilakukan.</p>

            <div class="space-y-4">
                @forelse($items as $item)
                    <div class="bg-white rounded-2xl border p-5 flex items-center justify-between hover:shadow-md transition group">
                        <div class="flex items-center gap-6">
                            <div class="text-[10px] font-bold text-gray-400 w-24">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y, H:i') }}
                            </div>
                            
                            @php
                                $iconClass = 'bg-gray-100 text-gray-700';
                                $icon = 'fas fa-trash';
                                
                                if(str_contains($item->trash_type, 'Organik')) {
                                    $iconClass = 'bg-green-100 text-green-700'; 
                                    $icon = 'fas fa-leaf';
                                } elseif(str_contains($item->trash_type, 'Plastik')) {
                                    $iconClass = 'bg-blue-100 text-blue-700'; 
                                    $icon = 'fas fa-recycle';
                                } elseif(str_contains($item->trash_type, 'Kertas')) {
                                    $iconClass = 'bg-yellow-100 text-yellow-700'; 
                                    $icon = 'fas fa-file-alt';
                                }
                            @endphp

                            <div class="w-10 h-10 {{ $iconClass }} rounded-full flex items-center justify-center">
                                <i class="{{ $icon }} text-sm"></i>
                            </div>

                            <div>
                                <p class="text-sm font-bold text-gray-800">
                                    {{ $item->user ? $item->user->name : 'User #' . $item->user_id }}
                                </p>
                                <p class="text-[10px] text-gray-500">Menyetor {{ $item->trash_type }}</p>
                            </div>
                        </div>

                        <div class="text-right">
                            <p class="text-sm font-bold text-green-700 uppercase">{{ $item->weight }} KG</p>
                            <p class="text-[9px] text-gray-400 uppercase tracking-widest">{{ $item->location }}</p>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-2xl border-2 border-dashed p-12 text-center">
                        <div class="bg-gray-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-history text-gray-400 text-xl"></i>
                        </div>
                        <h3 class="text-gray-800 font-bold uppercase text-sm">Belum ada riwayat</h3>
                        <p class="text-gray-400 text-[10px] mt-1">Data penyetoran yang masuk akan muncul secara otomatis di sini.</p>
                    </div>
                @endforelse
            </div>

            @if($items->hasPages())
                <div class="mt-6 flex justify-center">
                    {{ $items->links() }}
                </div>
            @endif
        </div>
    </main>
</div>

</body>
</html>
