<!-- Tambahkan style manual untuk memastikan z-index paling atas -->
<nav style="position: relative; z-index: 9999; background: white; border-bottom: 1px solid #e5e7eb;">
    <div style="max-width: 80rem; margin: 0 auto; padding: 0 1rem;">
        <div style="display: flex; justify-content: space-between; height: 4rem; align-items: center;">
            
            <div style="display: flex; gap: 20px; align-items: center;">
                <!-- Logo -->
                <a href="{{ route('admin.dashboard') }}" style="color: #2D6A4F; font-weight: bold; text-decoration: none;">
                    PESAN GREEN
                </a>

                <!-- Navigasi Utama -->
               <!-- MENU UTAMA -->
<div class="px-4 py-2 text-gray-400 text-xs font-bold uppercase italic">
    Menu Utama
</div>

<!-- 1. Dashboard -->
<a href="{{ route('admin.dashboard') }}" 
   class="flex items-center px-6 py-3 text-gray-300 hover:bg-[#1B4332] hover:text-white transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#1B4332] text-white' : '' }}">
    <span class="ms-3">Dashboard</span>
</a>

<!-- 2. Data Sampah -->
<a href="{{ route('admin.transactions.index') }}" 
   class="flex items-center px-6 py-3 text-gray-300 hover:bg-[#1B4332] hover:text-white transition {{ request()->routeIs('admin.transactions.index') ? 'bg-[#1B4332] text-white' : '' }}">
    <span class="ms-3">Data Sampah</span>
</a>

<!-- 3. Informasi Pengelolaan -->
<a href="{{ route('admin.transactions.informasi') }}" 
   class="flex items-center px-6 py-3 text-gray-300 hover:bg-[#1B4332] hover:text-white transition {{ request()->routeIs('admin.transactions.informasi') ? 'bg-[#1B4332] text-white' : '' }}">
    <span class="ms-3">Informasi Pengelolaan</span>
</a>

<!-- 4. Riwayat Penyetoran -->
<a href="{{ route('admin.transactions.archive') }}" 
   class="flex items-center px-6 py-3 text-gray-300 hover:bg-[#1B4332] hover:text-white transition {{ request()->routeIs('admin.transactions.archive') ? 'bg-[#1B4332] text-white' : '' }}">
    <span class="ms-3">Riwayat Penyetoran</span>
</a>

<div class="px-4 py-4 text-gray-400 text-xs font-bold uppercase italic">
    Admin Area
</div>

<!-- 5. Kelola Data -->
<a href="{{ route('admin.transactions.create') }}" 
   class="flex items-center px-6 py-3 text-gray-300 hover:bg-[#1B4332] hover:text-white transition {{ request()->routeIs('admin.transactions.create') ? 'bg-[#1B4332] text-white' : '' }}">
    <span class="ms-3">Kelola Data</span>
</a>

<!-- 6. Update Data -->
<a href="{{ route('admin.transactions.index') }}" 
   class="flex items-center px-6 py-3 text-gray-300 hover:bg-[#1B4332] hover:text-white transition">
    <span class="ms-3">Update Data</span>
</a>

<!-- 7. Kelola Informasi -->
<a href="{{ route('admin.transactions.kelola-informasi') }}" 
   class="flex items-center px-6 py-3 text-gray-300 hover:bg-[#1B4332] hover:text-white transition {{ request()->routeIs('admin.transactions.kelola-informasi') ? 'bg-[#1B4332] text-white' : '' }}">
    <span class="ms-3">Kelola Informasi</span>
</a>
            </div>

            <!-- Logout -->
            <div style="display: flex; align-items: center; gap: 10px;">
                <span style="font-size: 10px; color: gray;">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; padding: 4px 8px; border-radius: 4px; cursor: pointer; font-size: 10px; font-weight: bold;">
                        LOGOUT
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>