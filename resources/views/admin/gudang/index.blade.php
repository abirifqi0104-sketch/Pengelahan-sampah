<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gudang Sampah - Pesan Green</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 antialiased">

<div class="flex min-h-screen relative w-full">

    {{-- SIDEBAR --}}
    <aside class="z-40">
        @include('admin.partials.sidebar')
    </aside>

    {{-- MAIN CONTENT AREA --}}
    <div class="flex-1 flex flex-col min-w-0 w-0 md:pl-72 min-h-screen bg-gray-50">
        
        {{-- HEADER --}}
        <header class="bg-white border-b border-gray-100 h-16 px-6 flex items-center justify-between sticky top-0 z-30 shadow-xs">
            <div class="flex items-center gap-2">
                <i class="fas fa-warehouse text-[#1B4332] text-sm"></i>
                <h1 class="text-sm font-bold text-gray-800 tracking-wide">Gudang Sampah Pesan Green 📦</h1>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-gray-700 hidden sm:block">{{ Auth::user()->name ?? 'Admin' }} 🟢</span>
                <img src="https://ui-avatars.com/api/?name=Admin&background=1B4332&color=fff" class="w-8 h-8 rounded-full border">
            </div>
        </header>

        {{-- MAIN CONTENT --}}
        <main class="p-6 md:p-8 w-full max-w-6xl mx-auto flex-1 box-border">

            {{-- HEADER FITUR --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-xl md:text-2xl font-black text-gray-800 tracking-tight">Stok Gudang Sampah 📊</h2>
                    <p class="text-xs text-gray-500 mt-1">Data akumulasi seluruh sampah organik & anorganik yang siap diproses atau dijual.</p>
                </div>
                <a href="{{ route('admin.gudang.create') }}" class="inline-flex items-center gap-2 bg-[#1B4332] hover:bg-[#133024] text-white px-5 py-3 rounded-2xl text-xs font-bold transition shadow-md self-start sm:self-auto">
                    <i class="fas fa-plus text-[10px]"></i> Tambah Data Stok 📥
                </a>
            </div>

            {{-- NOTIFIKASI BLADE SUCCESS --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl text-xs font-medium">
                    {{ session('success') }}
                </div>
            @endif

            {{-- MAIN TABLE CARD --}}
            <div class="bg-white rounded-3xl shadow-xs border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-[11px] font-bold uppercase tracking-wider text-gray-400">
                                <th class="px-6 py-4">Nama Sampah</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4">Total Berat</th>
                                <th class="px-6 py-4">Status Logistik</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-xs font-medium text-gray-700">
                            {{-- Gunakan $items atau ganti dengan $gudang jika di controller Anda memakai nama lain --}}
                            @forelse($items as $item)
                                <tr class="hover:bg-gray-50/80 transition">
                                    <td class="px-6 py-4 font-bold text-gray-800">
                                        {{ $item->nama_sampah ?? $item->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded-md bg-gray-100 text-gray-600 text-[10px] font-bold uppercase">
                                            {{ $item->kategori ?? ($item->category->name ?? 'Umum') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-emerald-600 text-sm">
                                        {{ $item->berat ?? $item->weight ?? 0 }} Kg
                                    </td>
                                    <td class="px-6 py-4">
                                        @php 
                                            $status = $item->status ?? 'Tersedia'; 
                                        @endphp
                                        @if($status == 'Tersedia' || $status == 'Penuh')
                                            <span class="px-2.5 py-1 rounded-lg bg-green-50 text-green-700 font-bold border border-green-200">🟢 {{ $status }}</span>
                                        @else
                                            <span class="px-2.5 py-1 rounded-lg bg-amber-50 text-amber-700 font-bold border border-amber-200">🟡 {{ $status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.gudang.edit', $item->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.gudang.destroy', $item->id) }}" method="POST" class="inline" id="delete-form-{{ $item->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="konfirmasiHapus({{ $item->id }})" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic bg-white">
                                        Gudang masih kosong. Klik "Tambah Data Stok" untuk mengisi logistik gudang sampah! 📦
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<script>
    function konfirmasiHapus(id) {
        Swal.fire({
            title: 'Hapus Stok Gudang? 🧐',
            text: "Data logistik sampah ini akan dihapus permanen dari sistem gudang!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus! 🗑️',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

</body>
</html>