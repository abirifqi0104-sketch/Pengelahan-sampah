<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nasabah</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body{
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    @include('admin.partials.sidebar')

    {{-- MAIN --}}
    <main class="flex-1 ml-64">

        {{-- HEADER --}}
        <header class="bg-white border-b h-16 px-8 flex items-center justify-between sticky top-0 z-20">

            <div>
                <h1 class="text-xl font-bold text-[#1B4332] italic">
                    Data Nasabah
                </h1>
            </div>

            <div class="flex items-center gap-3">

                <div class="text-right">
                    <p class="text-sm font-bold">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="text-xs text-gray-400">
                        Administrator
                    </p>
                </div>

                <img
                    src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                    class="w-10 h-10 rounded-full"
                >
            </div>
        </header>

        {{-- CONTENT --}}
        <div class="p-8">

            {{-- CARD --}}
            <div class="bg-white rounded-3xl shadow-sm border overflow-hidden">

                {{-- TOP --}}
                <div class="p-6 border-b flex items-center justify-between">

                    <div>
                        <h2 class="text-xl font-bold text-gray-800">
                            Daftar Nasabah
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Seluruh pengguna bank sampah digital
                        </p>
                    </div>
                    
                     <div>
                        <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1.5 block">cari data nasabah</label>
                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                            <input type="text" id="filterSearch" placeholder="Cari nasabah" class="w-full border border-gray-100 rounded-xl pl-9 pr-3 py-2 text-xs bg-gray-50 focus:ring-1 focus:ring-green-700 focus:bg-white focus:outline-none transition">
                        </div>
                    </div>
                </div>

                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50">

                            <tr class="text-left text-xs uppercase text-gray-500">

                                <th class="px-6 py-4">Nasabah</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4">Transaksi</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>

                            </tr>

                        </thead>

                        <tbody id="nasabahTableBody">

                            @forelse($users as $user)

                            <tr class="border-t hover:bg-gray-50 transition" data-search="{{ strtolower($user->name . ' ' . $user->email . ' ' . $user->id) }}">

                                {{-- USER --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <img
                                            src="https://ui-avatars.com/api/?name={{ $user->name }}"
                                            class="w-11 h-11 rounded-full"
                                        >

                                        <div>

                                            <p class="font-bold text-gray-800">
                                                {{ $user->name }}
                                            </p>

                                            <p class="text-xs text-gray-400">
                                                ID #{{ $user->id }}
                                            </p>

                                        </div>

                                    </div>

                                </td>

                                {{-- EMAIL --}}
                                <td class="px-6 py-5 text-sm text-gray-600">
                                    {{ $user->email }}
                                </td>

                                {{-- TRANSAKSI --}}
                                <td class="px-6 py-5">

                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">
                                        {{ $user->transactions_count }} Setoran
                                    </span>

                                </td>

                                {{-- STATUS --}}
                                <td class="px-6 py-5">

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                                        Aktif
                                    </span>

                                </td>

                                {{-- AKSI --}}
                                <td class="px-6 py-5">

                                    <div class="flex justify-center gap-3">

                                        <button class="bg-[#2D6A4F] hover:bg-[#1B4332] text-white px-4 py-2 rounded-xl text-xs font-bold transition">
                                            Detail
                                        </button>

                                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-xs font-bold transition">
                                            Nonaktifkan
                                        </button>

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr id="noNasabahRow">

                                <td colspan="5"
                                    class="text-center py-10 text-gray-400">

                                    Belum ada nasabah

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- PAGINATION --}}
                <div class="p-5 border-t bg-gray-50">
                    {{ $users->links() }}
                </div>

            </div>

        </div>

    </main>

</div>

<script>
    (function () {
        const input = document.getElementById('filterSearch');
        const rows = document.querySelectorAll('#nasabahTableBody tr[data-search]');
        const emptyRow = document.getElementById('noNasabahRow');

        if (!input) return;

        function applyFilter() {
            const q = (input.value || '').toLowerCase().trim();

            let anyVisible = false;

            rows.forEach(function (row) {
                const text = row.getAttribute('data-search') || '';
                const match = q === '' || text.includes(q);
                row.style.display = match ? '' : 'none';
                if (match) anyVisible = true;
            });

            if (emptyRow) {
                emptyRow.style.display = anyVisible ? 'none' : '';
            }
        }

        input.addEventListener('input', applyFilter);
        applyFilter();
    })();
</script>

</body>
</html>
