{{-- SIDEBAR --}}
<aside class="fixed top-0 left-0 z-50 h-screen w-[240px] bg-[#1B4332] text-white shadow-xl overflow-y-auto overflow-x-hidden">

    <div class="flex flex-col min-h-screen p-4">

        {{-- LOGO --}}
        <div class="flex items-center gap-2.5 mb-6 shrink-0 px-1">
            <div class="bg-white p-1.5 rounded-xl shadow-md shrink-0">
                <img
                    src="{{ asset('image/pesan_green.png') }}"
                    class="h-8 w-auto"
                    alt="Logo">
            </div>

            <div class="min-w-0">
                <h1 class="font-black text-lg leading-none tracking-tight">
                    PESAN GREEN
                </h1>
                <p class="text-[10px] text-green-200/80 italic mt-0.5 leading-tight">
                    merawat <span class="font-semibold text-[11px]">JAGAT</span>,
                    membina <span class="font-semibold text-[11px]">UMAT</span>
                </p>
            </div>
        </div>

        {{-- PROFILE --}}
        <div class="bg-[#2D6A4F]/60 rounded-2xl p-3 border border-white/5 mb-5 shrink-0">
            <div class="flex items-center gap-2.5">
                <img
                    src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=ffffff&color=1B4332"
                    class="w-10 h-10 rounded-full border border-white/20 shadow-sm shrink-0">

                <div class="min-w-0">
                    <h3 class="font-bold text-sm truncate leading-tight">
                        {{ Auth::user()->name }}
                    </h3>
                    <p class="text-[11px] text-green-200/90 mt-0.5">
                        Administrator
                    </p>
                </div>
            </div>
        </div>

        {{-- MENU --}}
        <nav class="flex-1 space-y-1">

            {{-- LABEL --}}
            <div class="text-[10px] uppercase tracking-[3px] text-green-200/50 px-2 pb-1 font-bold">
                Menu Utama
            </div>

            {{-- ITEM SETTING --}}
            @php
                $menuClass = 'group flex items-center gap-2.5 px-3 py-2 rounded-xl transition-all duration-200';
                $activeClass = 'bg-white text-[#1B4332] shadow-md font-bold';
                $normalClass = 'text-green-100/90 hover:bg-[#2D6A4F] hover:text-white';

                $iconActive = 'bg-[#1B4332] text-white';
                $iconNormal = 'bg-white/5 group-hover:bg-white/10';
            @endphp

            {{-- DASHBOARD --}}
            <a href="{{ route('admin.dashboard') }}"
               class="{{ $menuClass }} {{ request()->routeIs('admin.dashboard*') ? $activeClass : $normalClass }}">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 text-xs {{ request()->routeIs('admin.dashboard*') ? $iconActive : $iconNormal }}">
                    <i class="fas fa-chart-line"></i>
                </div>
                <span class="text-xs font-medium truncate">Dashboard</span>
            </a>

            {{-- SETORAN --}}
            <a href="{{ route('admin.transactions.index') }}"
                class="{{ $menuClass }} {{ request()->routeIs('admin.transactions.index') || request()->routeIs('admin.transactions.create') ? $activeClass : $normalClass }}">
                 <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 text-xs {{ request()->routeIs('admin.transactions.index') || request()->routeIs('admin.transactions.create') ? $iconActive : $iconNormal }}">
                     <i class="fas fa-list-alt"></i>
                 </div>
                <span class="text-xs font-medium truncate">Riwayat & Input Setoran</span>
            </a>
            {{-- VERIFIKASI (Diperbaiki: ditambah .index) --}}
            <a href="{{ route('admin.verifikasi.index') }}"
               class="{{ $menuClass }} {{ request()->routeIs('admin.verifikasi*') ? $activeClass : $normalClass }}">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 text-xs {{ request()->routeIs('admin.verifikasi*') ? $iconActive : $iconNormal }}">
                    <i class="fas fa-check-circle"></i>
                </div>
                <span class="text-xs font-medium truncate">Verifikasi Setoran</span>
            </a>

            {{-- NASABAH --}}
            <a href="{{ route('admin.nasabah') }}"
               class="{{ $menuClass }} {{ request()->routeIs('admin.nasabah*') ? $activeClass : $normalClass }}">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 text-xs {{ request()->routeIs('admin.nasabah*') ? $iconActive : $iconNormal }}">
                    <i class="fas fa-users"></i>
                </div>
                <span class="text-xs font-medium truncate">Data Nasabah</span>
            </a>

            {{-- SALDO --}}
            <a href="{{ route('admin.saldo') }}"
               class="{{ $menuClass }} {{ request()->routeIs('admin.saldo*') ? $activeClass : $normalClass }}">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 text-xs {{ request()->routeIs('admin.saldo*') ? $iconActive : $iconNormal }}">
                    <i class="fas fa-wallet"></i>
                </div>
                <span class="text-xs font-medium truncate">Saldo Nasabah</span>
            </a>

            {{-- GUDANG --}}
            <a href="{{ route('admin.gudang.index') }}" 
               class="{{ $menuClass }} {{ request()->routeIs('admin.gudang*') ? $activeClass : $normalClass }}">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 text-xs {{ request()->routeIs('admin.gudang*') ? $iconActive : $iconNormal }}">
                    <i class="fas fa-warehouse"></i>
                </div>
                <span class="text-xs font-medium truncate">Gudang Sampah</span>
            </a>

            {{-- MAGGOT --}}
            <a href="{{ route('admin.maggot.index') }}" 
               class="{{ $menuClass }} {{ request()->routeIs('admin.maggot*') ? $activeClass : $normalClass }}">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 text-xs {{ request()->routeIs('admin.maggot*') ? $iconActive : $iconNormal }}">
                    <i class="fas fa-bug"></i>
                </div>
                <span class="text-xs font-medium truncate">Budidaya Maggot</span>
            </a>

            {{-- LAPORAN --}}
            <a href="{{ route('admin.laporan.index') }}" 
               class="{{ $menuClass }} {{ request()->routeIs('admin.laporan*') ? $activeClass : $normalClass }}">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 text-xs {{ request()->routeIs('admin.laporan*') ? $iconActive : $iconNormal }}">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <span class="text-xs font-medium truncate">Laporan</span>
            </a>

            {{-- INFORMASI (Diperbaiki: diubah jadi .informasi.) --}}
             <a href="{{ route('admin.informasi.index') }}" 
               class="{{ $menuClass }} {{ request()->routeIs('admin.informasi*') ? $activeClass : $normalClass }}">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 text-xs {{ request()->routeIs('admin.informasi*') ? $iconActive : $iconNormal }}">
                    <i class="fas fa-info-circle"></i>
                </div>
                <span class="text-xs font-medium truncate">Informasi</span>
            </a>

        </nav>

        {{-- LOGOUT --}}
        <div class="pt-4 mt-auto shrink-0">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="group w-full flex items-center gap-2.5 px-3 py-2 rounded-xl
                        text-red-300 hover:bg-red-500/10 hover:text-red-200
                        transition-all duration-200">
                    <div class="w-8 h-8 rounded-lg bg-red-500/10 flex items-center justify-center shrink-0 text-xs">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <span class="text-xs font-medium">Logout</span>
                </button>
            </form>
        </div>

    </div>
</aside>