{{-- SIDEBAR USER --}}
<div class="fixed inset-y-0 left-0 w-72 bg-[#1B4332] text-white flex flex-col z-40 hidden md:flex transition-transform duration-300">

    {{-- Header Sidebar & Logo --}}
    <div class="h-16 flex items-center px-6 bg-[#133024] border-b border-emerald-900 shadow-sm">
        <div class="bg-white p-1 rounded-lg mr-3 shadow-sm">
            <img src="{{ asset('image/pesan_green.png') }}" class="h-7 w-auto" alt="Logo">
        </div>
        <span class="text-sm font-black tracking-widest uppercase text-white">Pesan Green</span>
    </div>

    {{-- Menu Navigasi --}}
    <div class="flex-1 overflow-y-auto py-6 px-4 space-y-2">
        <p class="px-2 text-[10px] font-bold text-emerald-400 uppercase tracking-widest mb-3">Panel Nasabah</p>

        <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('user.dashboard') ? 'bg-emerald-600' : 'text-emerald-100 hover:bg-emerald-800 hover:text-white' }} text-white rounded-xl text-xs font-bold transition shadow-sm">
            <i class="fas fa-home w-4 text-center"></i> Dashboard
        </a>

        <p class="px-2 text-[10px] font-bold text-emerald-300 uppercase tracking-widest mt-6 mb-3">Kelola Sampah</p>

        <a href="{{ route('user.submit-waste') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('user.submit-waste') ? 'bg-emerald-600' : 'text-emerald-100 hover:bg-emerald-800 hover:text-white' }} text-white rounded-xl text-xs font-bold transition">
            <i class="fas fa-trash w-4 text-center"></i> Setor Sampah
        </a>

        <a href="{{ route('user.history') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('user.history') ? 'bg-emerald-600' : 'text-emerald-100 hover:bg-emerald-800 hover:text-white' }} text-white rounded-xl text-xs font-bold transition">
            <i class="fas fa-history w-4 text-center"></i> Riwayat
        </a>

        <p class="px-2 text-[10px] font-bold text-emerald-300 uppercase tracking-widest mt-6 mb-3">Saldo & Penarikan</p>

        <a href="{{ route('user.withdraw.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('user.withdraw.*') ? 'bg-emerald-600' : 'text-emerald-100 hover:bg-emerald-800 hover:text-white' }} text-white rounded-xl text-xs font-bold transition">
            <i class="fas fa-money-bill w-4 text-center"></i> Tarik Saldo
        </a>

        <p class="px-2 text-[10px] font-bold text-emerald-300 uppercase tracking-widest mt-6 mb-3">Informasi</p>

        <a href="{{ route('user.information.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('user.information.*') ? 'bg-emerald-600' : 'text-emerald-100 hover:bg-emerald-800 hover:text-white' }} text-white rounded-xl text-xs font-bold transition">
            <i class="fas fa-newspaper w-4 text-center"></i> Informasi
        </a>

        @php($notifRouteExists = \Illuminate\Support\Facades\Route::has('user.notifications'))
        @if($notifRouteExists)
            <a href="{{ route('user.notifications') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('user.notifications') ? 'bg-emerald-600' : 'text-emerald-100 hover:bg-emerald-800 hover:text-white' }} text-white rounded-xl text-xs font-bold transition relative">
                <i class="fas fa-bell w-4 text-center"></i> Notifikasi
                @if(Auth::user() && Auth::user()->notifications()->where('read_at', null)->count() > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold rounded-full w-5 h-5 flex items-center justify-center">
                        {{ Auth::user()->notifications()->where('read_at', null)->count() }}
                    </span>
                @endif
            </a>
        @endif
    </div>

    {{-- Tombol Logout di Bawah --}}
    <div class="p-4 border-t border-emerald-900 bg-[#173A2A]">
        <div class="flex items-center gap-3 px-2 mb-4">
            <div class="h-8 w-8 bg-emerald-100 text-emerald-800 rounded-full flex items-center justify-center font-bold text-xs shadow-inner">
                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name ?? 'User' }}</p>
                <p class="text-[10px] text-emerald-300">Saldo: Rp {{ number_format(Auth::user()->saldo ?? 0, 0) }}</p>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-xl text-xs font-bold transition shadow-md">
                <i class="fas fa-sign-out-alt"></i> Keluar Sistem
            </button>
        </form>
    </div>
</div>

