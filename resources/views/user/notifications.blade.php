<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - Pengelolaan Sampah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

<div class="flex min-h-screen relative w-full">
    @include('user.partials.sidebar')

    <div class="flex-1 flex flex-col min-w-0 w-0 md:pl-72 min-h-screen bg-gray-50">
        
        <header class="bg-white border-b border-gray-100 h-16 px-6 flex items-center justify-between sticky top-0 z-30 shadow-xs">
            <h1 class="text-sm font-bold text-gray-800">📬 Notifikasi</h1>
            <form action="{{ route('user.notifications.markAllRead') }}" method="POST">
                @csrf
                <button type="submit" class="text-xs text-emerald-600 font-bold hover:text-emerald-700">
                    Tandai Semua Terbaca
                </button>
            </form>
        </header>

        <main class="p-6 md:p-8 w-full max-w-4xl mx-auto flex-1">
            
            @if($notifications->count() > 0)
                <div class="space-y-3">
                    @foreach($notifications as $notif)
                    <div class="bg-white rounded-xl p-4 border-l-4 
                        @if($notif->type == 'success') border-emerald-500 @elseif($notif->type == 'error') border-red-500 @elseif($notif->type == 'warning') border-amber-500 @else border-blue-500 @endif
                        hover:shadow-md transition flex items-start justify-between @if(!$notif->read_at) bg-opacity-80 @endif">
                        <div class="flex items-start gap-3 flex-1">
                            <div class="text-2xl mt-1
                                @if($notif->type == 'success') text-emerald-500 @elseif($notif->type == 'error') text-red-500 @elseif($notif->type == 'warning') text-amber-500 @else text-blue-500 @endif">
                                <i class="fas fa-{{ $notif->icon }}"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800 @if(!$notif->read_at) font-black @endif">{{ $notif->title }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $notif->message }}</p>
                                <p class="text-xs text-gray-400 mt-2">{{ $notif->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="flex gap-2 ml-4">
                            @if(!$notif->read_at)
                            <form action="{{ route('user.notification.read', $notif->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="text-xs text-gray-500 hover:text-gray-700 px-2 py-1 rounded hover:bg-gray-100">✓</button>
                            </form>
                            @endif
                            <form action="{{ route('user.notification.delete', $notif->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus notifikasi ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-xs text-red-500 hover:text-red-700 px-2 py-1 rounded hover:bg-red-50">✕</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- PAGINATION --}}
                @if($notifications->hasPages())
                <div class="mt-8">
                    {{ $notifications->links() }}
                </div>
                @endif
            @else
                <div class="text-center py-16">
                    <i class="fas fa-bell text-6xl text-gray-200 mb-4 block"></i>
                    <p class="text-gray-500 font-medium">Tidak ada notifikasi</p>
                </div>
            @endif

        </main>
    </div>
</div>

</body>
</html>
