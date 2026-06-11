<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Budidaya Maggot - Pesan Green</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #1B4332; border-radius: 10px; }
    </style>
</head>
<body class="bg-gray-50 antialiased overflow-x-hidden">

<div class="flex min-h-screen relative w-full">

    {{-- SIDEBAR --}}
    @include('admin.partials.sidebar')

    {{-- MAIN CONTENT AREA --}}
    <div class="flex-1 flex flex-col min-w-0 w-0 md:pl-72 min-h-screen bg-gray-50">
        
        {{-- HEADER --}}
        <header class="sticky top-0 z-30 bg-white border-b border-gray-100 h-16 px-6 md:px-8 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-[#1B4332] text-white flex items-center justify-center">
                    <i class="fas fa-bug text-sm"></i>
                </div>
                <h1 class="text-base md:text-lg font-bold text-gray-800 tracking-tight">Manajemen Maggot BSF</h1>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3 border-l border-gray-100 pl-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-gray-800 leading-tight">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-[10px] text-emerald-600 uppercase tracking-wider mt-0.5">🟢 Online</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'A' }}&background=1B4332&color=fff" class="w-8 h-8 rounded-full shadow-sm border border-gray-100">
                </div>
            </div>
        </header>

        {{-- TAB NAVIGASI --}}
        <div class="bg-white px-6 md:px-8 border-b border-gray-200">
            <nav class="flex gap-6 -mb-px overflow-x-auto">
                <a href="{{ url('admin/maggot') }}" class="py-4 text-sm font-bold border-b-2 border-[#1B4332] text-[#1B4332] flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-seedling"></i> Data Budidaya
                </a>
                <a href="{{ url('admin/maggot/panen') }}" class="py-4 text-sm font-bold text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-box-open"></i> Hasil Panen
                </a>
                <a href="{{ url('admin/maggot/penjualan') }}" class="py-4 text-sm font-bold text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-store"></i> Penjualan (Produk Olahan)
                </a>
            </nav>
        </div>

        {{-- MAIN CONTENT --}}
        <main class="p-6 md:p-8 w-full max-w-7xl mx-auto flex-1 box-border">
            
            {{-- DASHBOARD MINI CARDS --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 transition hover:shadow-md">
                    <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 text-xl border border-amber-100">🥚</div>
                    <div>
                        <p class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider">Masa Penetasan</p>
                        <h3 class="text-xl font-black text-gray-800">{{ $countPenetasan ?? 0 }} Biopond</h3>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 transition hover:shadow-md">
                    <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600 text-xl border border-green-100">🐛</div>
                    <div>
                        <p class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider">Fase Larva Aktif</p>
                        <h3 class="text-xl font-black text-gray-800">{{ $countLarva ?? 0 }} Biopond</h3>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 transition hover:shadow-md">
                    <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 text-xl border border-indigo-100">🪵</div>
                    <div>
                        <p class="text-[10px] font-extrabold text-gray-400 uppercase tracking-wider">Prepupa / Pupa</p>
                        <h3 class="text-xl font-black text-gray-800">{{ $countPupa ?? 0 }} Biopond</h3>
                    </div>
                </div>
            </div>

            {{-- HEADER FITUR --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-xl md:text-2xl font-black text-gray-800 tracking-tight">Monitoring Siklus Budidaya</h2>
                    <p class="text-xs text-gray-500 mt-1">Pantau perkembangan siklus hidup maggot dari telur hingga siap panen.</p>
                </div>
                
                <button onclick="bukaModalSiklus()" class="inline-flex items-center justify-center gap-2 bg-[#1B4332] hover:bg-[#133024] text-white px-5 py-2.5 rounded-xl text-xs font-bold transition shadow-sm whitespace-nowrap">
                    <i class="fas fa-plus"></i> Mulai Siklus Baru
                </button>
            </div>

            {{-- FORM TERSEMBUNYI UNTUK ADD SIKLUS --}}
            <form id="formMulaiSiklus" action="{{ url('admin/maggot/store') }}" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="biopond_name" id="hidden_biopond">
                <input type="hidden" name="initial_weight" id="hidden_weight">
                <input type="hidden" name="unit" id="hidden_unit">
                <input type="hidden" name="start_date" id="hidden_date">
                <input type="hidden" name="description" id="hidden_desc">
            </form>

            {{-- FORM TERSEMBUNYI UNTUK UPDATE FASE --}}
            <form id="formUpdateFase" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="status" id="hidden_status">
            </form>

            {{-- MAIN TABLE CARD --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[800px]">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 text-[11px] font-bold uppercase tracking-wider text-gray-500">
                                <th class="px-6 py-4">Kode Siklus</th>
                                <th class="px-6 py-4">Lokasi Biopond</th>
                                <th class="px-6 py-4">Berat Awal</th>
                                <th class="px-6 py-4">Tanggal Mulai</th>
                                <th class="px-6 py-4">Fase Perkembangan</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 text-xs font-medium text-gray-700">
                            @forelse($cultivations ?? [] as $item)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="px-6 py-4 font-bold text-[#1B4332]">{{ $item->cultivation_code }}</td>
                                    <td class="px-6 py-4 flex items-center gap-2">
                                        <div class="w-6 h-6 rounded bg-gray-100 flex items-center justify-center text-[10px]">🏢</div>
                                        {{ $item->biopond_name }}
                                    </td>
                                    <td class="px-6 py-4 font-bold">{{ $item->initial_weight }} <span class="font-normal text-gray-400">{{ $item->unit }}</span></td>
                                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->start_date)->translatedFormat('d M Y') }}</td>
                                    
                                    {{-- KOLOM FASE PERKEMBANGAN --}}
                                    <td class="px-6 py-4">
                                        @if($item->status == 'Penetasan')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-amber-50 text-amber-700 font-bold border border-amber-200">
                                                <span>🥚</span> Penetasan
                                            </span>
                                        @elseif($item->status == 'Larva')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-green-50 text-green-700 font-bold border border-green-200">
                                                <span>🐛</span> Larva Aktif
                                            </span>
                                        @elseif($item->status == 'Panen')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-blue-50 text-blue-700 font-bold border border-blue-200">
                                                 <span>📦</span> Panen
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-indigo-50 text-indigo-700 font-bold border border-indigo-200">
                                                <span>🪵</span> {{ $item->status }}
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            {{-- TOMBOL UPDATE FASE --}}
                                            <button type="button" onclick="bukaModalFase({{ $item->id }}, '{{ $item->status }}')" class="w-8 h-8 rounded-lg bg-blue-50 hover:bg-blue-100 flex items-center justify-center text-blue-600 transition shadow-sm" title="Ubah Fase Budidaya">
                                                <i class="fas fa-sync-alt text-[10px]"></i>
                                            </button>

                                            {{-- TOMBOL HAPUS --}}
                                            <form action="{{ url('admin/maggot/' . $item->id) }}" method="POST" class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="delete-btn w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 flex items-center justify-center text-red-600 transition shadow-sm" title="Hapus Siklus">
                                                    <i class="fas fa-trash text-[10px]"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4">
                                            <i class="fas fa-seedling text-2xl text-emerald-600/50"></i>
                                        </div>
                                        <h3 class="text-sm font-bold text-gray-800">Belum ada siklus budidaya aktif</h3>
                                        <p class="text-xs text-gray-500 mt-1">Silakan klik "Mulai Siklus Baru" untuk menambahkan data.</p>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#1B4332',
                background: '#ffffff',
                customClass: { popup: 'rounded-2xl' }
            });
        @endif

        // PROSES HAPUS
        document.addEventListener('click', function (e) {
            const button = e.target.closest('.delete-btn');
            if (button) {
                e.preventDefault();
                const form = button.closest('.delete-form');
                Swal.fire({
                    title: 'Hapus Siklus Ini?',
                    text: "Data perkembangan biopond ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#f3f4f6',
                    confirmButtonText: 'Ya, Hapus Data',
                    cancelButtonText: '<span class="text-gray-700 font-bold">Batal</span>',
                    customClass: {
                        confirmButton: 'rounded-xl shadow-sm',
                        cancelButton: 'rounded-xl shadow-sm border border-gray-200',
                        popup: 'rounded-2xl'
                    }
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            }
        });
    });

    const hariIni = new Date().toISOString().split('T')[0];

    // MODAL TAMBAH SIKLUS
    function bukaModalSiklus() {
        Swal.fire({
            title: '<h3 class="text-xl font-bold text-gray-800">Mulai Siklus Budidaya</h3>',
            html: `
                <div class="text-left space-y-4 p-1 mt-2">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Nama / Kode Biopond</label>
                        <input id="swal_biopond_name" type="text" placeholder="Contoh: Biopond Alfa-1" class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-xs outline-none focus:border-emerald-600">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Berat Awal Bibit</label>
                            <input id="swal_initial_weight" type="number" step="0.01" placeholder="Contoh: 15" class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-xs outline-none focus:border-emerald-600">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Satuan</label>
                            <select id="swal_unit" class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-xs outline-none focus:border-emerald-600 bg-white">
                                <option value="gram">Gram (g)</option>
                                <option value="kg">Kilogram (kg)</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-1">Tanggal Mulai</label>
                        <input id="swal_start_date" type="date" value="${hariIni}" class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-xs outline-none focus:border-emerald-600">
                    </div>
                    <input type="hidden" id="swal_description" value="">
                </div>
            `,
            showCancelButton: true,
            confirmButtonColor: '#1B4332',
            cancelButtonColor: '#f3f4f6',
            confirmButtonText: 'Simpan Siklus',
            cancelButtonText: '<span class="text-gray-700 font-bold px-2">Batal</span>',
            customClass: { confirmButton: 'rounded-xl shadow-sm', cancelButton: 'rounded-xl shadow-sm border border-gray-200', popup: 'rounded-2xl' },
            preConfirm: () => {
                const bName = document.getElementById('swal_biopond_name').value;
                const iWeight = document.getElementById('swal_initial_weight').value;
                if (!bName || !iWeight) {
                    Swal.showValidationMessage(`Lengkapi Nama Biopond dan Berat Awal.`);
                    return false;
                }
                document.getElementById('hidden_biopond').value = bName;
                document.getElementById('hidden_weight').value = iWeight;
                document.getElementById('hidden_unit').value = document.getElementById('swal_unit').value;
                document.getElementById('hidden_date').value = document.getElementById('swal_start_date').value;
                return true;
            }
        }).then((result) => {
            if (result.isConfirmed) document.getElementById('formMulaiSiklus').submit();
        });
    }

    // FITUR BARU: MODAL UPDATE FASE
    function bukaModalFase(id, statusSaatIni) {
        Swal.fire({
            title: '<h3 class="text-xl font-bold text-gray-800">Update Fase Budidaya</h3>',
            html: `
                <div class="text-left mt-4 mb-2">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Pindah ke Fase Selanjutnya</label>
                    <select id="swal_status" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm font-bold text-gray-700 outline-none focus:border-emerald-600 bg-white shadow-sm">
                        <option value="Penetasan" ${statusSaatIni === 'Penetasan' ? 'selected' : ''}>🥚 Penetasan (Telur)</option>
                        <option value="Larva" ${statusSaatIni === 'Larva' ? 'selected' : ''}>🐛 Fase Larva Aktif</option>
                        <option value="Prepupa" ${statusSaatIni === 'Prepupa' ? 'selected' : ''}>🪵 Prepupa (Siap Panen)</option>
                        <option value="Panen Selesai" ${statusSaatIni === 'Panen Selesai' ? 'selected' : ''} disabled>✅ Panen Selesai (Otomatis dari halaman panen)</option>
                    </select>
                </div>
                <p class="text-[10px] text-gray-400 mt-3 text-left">Pilih <b>"Prepupa / Pupa"</b> agar biopond muncul di halaman Input Panen.</p>
            `,
            showCancelButton: true,
            confirmButtonColor: '#1B4332',
            cancelButtonColor: '#f3f4f6',
            confirmButtonText: 'Update Fase',
            cancelButtonText: '<span class="text-gray-700 font-bold">Batal</span>',
            customClass: { confirmButton: 'rounded-xl shadow-sm px-4', cancelButton: 'rounded-xl shadow-sm border border-gray-200', popup: 'rounded-2xl' }
        }).then((result) => {
            if (result.isConfirmed) {
                const statusBaru = document.getElementById('swal_status').value;
                const form = document.getElementById('formUpdateFase');
                
                // PERBAIKAN FINAL: Menggunakan fungsi url() Laravel agar lokasi file 1000% akurat
                let baseUrl = "{{ url('admin/maggot/update-fase') }}";
                form.action = baseUrl + "/" + id;
                
                document.getElementById('hidden_status').value = statusBaru;
                form.submit();
            }
        });
    }
</script>

</body>
</html>