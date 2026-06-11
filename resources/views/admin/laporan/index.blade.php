<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan - Pesan Green</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght=300;400;500;600;700;800&display=swap');
        * { font-family: 'Inter', sans-serif; }
        @media print {
            aside, header, .no-print { display: none !important; }
            .print-area { padding: 0 !important; margin: 0 !important; width: 100% !important; }
            body { background-color: #ffffff !important; }
        }
    </style>
</head>
<body class="bg-gray-50 antialiased">

<div class="flex min-h-screen relative w-full">

    {{-- SIDEBAR --}}
    <aside class="z-40 no-print">
        @include('admin.partials.sidebar')
    </aside>

    {{-- MAIN CONTENT AREA --}}
    <div class="flex-1 flex flex-col min-w-0 w-0 md:pl-72 min-h-screen bg-gray-50 print-area">
        
        {{-- HEADER --}}
        <header class="bg-white border-b border-gray-100 h-16 px-6 flex items-center justify-between sticky top-0 z-30 shadow-xs no-print">
            <div class="flex items-center gap-2">
                <i class="fas fa-file-alt text-[#1B4332] text-sm"></i>
                <h1 class="text-sm font-bold text-gray-800 tracking-wide">Rekapitulasi Laporan 📊</h1>
            </div>
            <button onclick="window.print()" class="bg-[#1B4332] hover:bg-[#133024] text-white px-4 py-2 rounded-xl text-xs font-bold transition flex items-center gap-2">
                <i class="fas fa-print"></i> Cetak Laporan (PDF)
            </button>
        </header>

        {{-- MAIN CONTENT --}}
        <main class="p-6 md:p-8 w-full max-w-6xl mx-auto flex-1 box-border">

            {{-- FILTER PANEL (NO PRINT) --}}
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-xs mb-8 no-print">
                <h3 class="text-sm font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-filter text-emerald-600"></i> Filter Parameter Laporan
                </h3>
                <form action="{{ route('admin.laporan.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-4 items-end">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ $startDate }}" class="w-full border border-gray-200 rounded-xl px-3 py-2 text-xs outline-none focus:border-green-600">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Tanggal Selesai</label>
                        <input type="date" name="end_date" value="{{ $endDate }}" class="w-full border border-gray-200 rounded-xl px-3 py-2 text-xs outline-none focus:border-green-600">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-400 uppercase mb-2">Jenis Sektor</label>
                        <select name="jenis_laporan" class="w-full border border-gray-200 rounded-xl px-3 py-2 text-xs bg-white outline-none focus:border-green-600">
                            <option value="semua" {{ $jenisLaporan == 'semua' ? 'selected' : '' }}>Semua Aktivitas</option>
                            <option value="setoran" {{ $jenisLaporan == 'setoran' ? 'selected' : '' }}>Setoran Nasabah</option>
                            <option value="maggot" {{ $jenisLaporan == 'maggot' ? 'selected' : '' }}>Budidaya Magot</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2 rounded-xl text-xs font-bold transition shadow-sm">
                            <i class="fas fa-sync-alt mr-1"></i> Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>

            {{-- RINGKASAN STATISTIK --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 no-print">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-4 border border-blue-200">
                    <p class="text-[11px] font-bold text-blue-600 uppercase tracking-wide">Total Setoran</p>
                    <p class="text-2xl font-black text-blue-900 mt-2">{{ $totalSetoran }}</p>
                    <p class="text-[10px] text-blue-700 mt-1">transaksi terverifikasi</p>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-4 border border-green-200">
                    <p class="text-[11px] font-bold text-green-600 uppercase tracking-wide">Total Berat</p>
                    <p class="text-2xl font-black text-green-900 mt-2">{{ round($totalBerat, 2) }} <span class="text-sm">Kg</span></p>
                    <p class="text-[10px] text-green-700 mt-1">sampah masuk</p>
                </div>
                <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-2xl p-4 border border-emerald-200">
                    <p class="text-[11px] font-bold text-emerald-600 uppercase tracking-wide">Total Panen</p>
                    <p class="text-2xl font-black text-emerald-900 mt-2">{{ $totalPanen }}</p>
                    <p class="text-[10px] text-emerald-700 mt-1">hasil panen magot</p>
                </div>
                <div class="bg-gradient-to-br from-amber-50 to-amber-100 rounded-2xl p-4 border border-amber-200">
                    <p class="text-[11px] font-bold text-amber-600 uppercase tracking-wide">Total Hasil</p>
                    <p class="text-2xl font-black text-amber-900 mt-2">{{ round($totalHasilPanen, 2) }} <span class="text-sm">Kg</span></p>
                    <p class="text-[10px] text-amber-700 mt-1">berat total magot</p>
                </div>
            </div>

            {{-- DOKUMEN KOP SURAT DINAS (HANYA MUNCUL SAAT DICETAK) --}}
            <div class="hidden print:block mb-8">
                <table class="w-full border-none">
                    <tr>
                        <td class="w-24 text-left align-middle pr-4">
                            <img src="{{ asset('image/pesan_green.png') }}" class="h-20 w-auto mx-auto" alt="Logo Pesan Green">
                        </td>
                        
                        <td class="text-center align-middle">
                            <h3 class="text-xs uppercase tracking-widest font-bold text-gray-600 leading-tight">SISTEM INTEGRASI KELOLA SAMPAH ORGANIK</h3>
                            <h1 class="text-xl font-black text-[#1B4332] tracking-wide mt-0.5">MANAJEMEN BANK SAMPAH PESAN GREEN</h1>
                            <p class="text-[10px] text-gray-500 italic mt-1 font-medium">
                                Jln. Raya Pesantren KH.ruhiat No. 45, Kompleks Kawasan Ramah Lingkungan | Telp: (021) 8892-2311
                            </p>
                            <p class="text-[10px] text-gray-400 font-medium">Email: info@pesangreen.or.id | Web: www.pesangreen.test</p>
                        </td>

                        <td class="w-24 text-right align-middle pl-4">
                            <img src={{ asset('image/logotasik.jpg') }}
                                 class="h-20 w-auto mx-auto" 
                                 alt="Logo kota tasikmalaya">
                        </td>
                    </tr>
                </table>
                
                <div class="border-b-4 border-gray-900 mt-4 w-full"></div>
                <div class="border-b border-gray-800 mt-0.5 w-full"></div>
                
                <div class="text-center mt-6">
                    <h2 class="text-sm font-extrabold text-gray-900 uppercase tracking-wider underline">SURAT LAPORAN REKAPITULASI OPERASIONAL</h2>
                    <p class="text-[11px] font-semibold text-gray-600 mt-1">
                        Periode Pemeriksaan: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}
                    </p>
                </div>

                {{-- RINGKASAN STATISTIK CETAK --}}
                <div class="mt-6 mb-6">
                    <h3 class="text-[10px] font-bold text-gray-900 uppercase tracking-wider mb-3">Ringkasan Data Operasional</h3>
                    <table class="w-full border-collapse border border-gray-400 text-[9px]">
                        <tr>
                            <td class="border border-gray-400 p-2 font-bold bg-gray-100">Total Setoran Sampah</td>
                            <td class="border border-gray-400 p-2 font-bold text-right">{{ $totalSetoran }} Transaksi</td>
                            <td class="border border-gray-400 p-2 font-bold bg-gray-100">Total Berat Sampah</td>
                            <td class="border border-gray-400 p-2 font-bold text-right">{{ round($totalBerat, 2) }} Kg</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 p-2 font-bold bg-gray-100">Total Panen Magot</td>
                            <td class="border border-gray-400 p-2 font-bold text-right">{{ $totalPanen }} Panen</td>
                            <td class="border border-gray-400 p-2 font-bold bg-gray-100">Total Hasil Panen</td>
                            <td class="border border-gray-400 p-2 font-bold text-right">{{ round($totalHasilPanen, 2) }} Kg</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 p-2 font-bold bg-gray-100">Total Revenue Setoran</td>
                            <td class="border border-gray-400 p-2 font-bold text-right">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
                            <td class="border border-gray-400 p-2 font-bold bg-gray-100">Siklus Budidaya</td>
                            <td class="border border-gray-400 p-2 font-bold text-right">{{ $totalMaggot }} Siklus</td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- DATA OUTPUT 1: LAPORAN BUDIDAYA MAGOT --}}
            @if($jenisLaporan == 'semua' || $jenisLaporan == 'maggot')
            <div class="mb-8">
                <h3 class="text-base font-bold text-gray-800 mb-3 flex items-center gap-2 print:text-xs print:mb-1">
                    <span>🐛</span> Laporan Siklus Budidaya Magot BSF
                </h3>
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-xs print:rounded-none print:border-gray-300">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 font-bold text-gray-400 uppercase tracking-wider print:bg-gray-100 print:text-gray-700 print:border-gray-300">
                                <th class="p-4 print:p-2">Kode Siklus</th>
                                <th class="p-4 print:p-2">Biopond</th>
                                <th class="p-4 print:p-2">Berat Awal</th>
                                <th class="p-4 print:p-2">Tanggal Mulai</th>
                                <th class="p-4 print:p-2">Status Akhir</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700 font-medium print:divide-gray-300">
                            @forelse($maggotData as $magot)
                                <tr class="print:break-inside-avoid">
                                    <td class="p-4 print:p-2 font-bold text-emerald-800 print:text-black">{{ $magot->cultivation_code }}</td>
                                    <td class="p-4 print:p-2">🏢 {{ $magot->biopond_name }}</td>
                                    <td class="p-4 print:p-2 font-semibold">{{ $magot->initial_weight }} {{ $magot->unit }}</td>
                                    <td class="p-4 print:p-2">{{ \Carbon\Carbon::parse($magot->start_date)->format('d-m-Y') }}</td>
                                    <td class="p-4 print:p-2"><span class="px-2 py-0.5 bg-amber-50 text-amber-700 border border-amber-200 rounded font-bold print:border-none print:p-0 print:text-black">{{ $magot->status }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-gray-400 italic print:p-4">Tidak ditemukan data siklus magot pada periode ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            {{-- DATA OUTPUT 1B: LAPORAN HASIL PANEN MAGOT --}}
            @if($jenisLaporan == 'semua' || $jenisLaporan == 'maggot')
            <div class="mb-8">
                <h3 class="text-base font-bold text-gray-800 mb-3 flex items-center gap-2 print:text-xs print:mb-1">
                    <span>📊</span> Laporan Hasil Panen Magot
                </h3>
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-xs print:rounded-none print:border-gray-300">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 font-bold text-gray-400 uppercase tracking-wider print:bg-gray-100 print:text-gray-700 print:border-gray-300">
                                <th class="p-4 print:p-2">Tanggal Panen</th>
                                <th class="p-4 print:p-2">Kode Siklus</th>
                                <th class="p-4 print:p-2">Hasil Panen (Kg)</th>
                                <th class="p-4 print:p-2">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700 font-medium print:divide-gray-300">
                            @forelse($panenData as $panen)
                                <tr class="print:break-inside-avoid">
                                    <td class="p-4 print:p-2">{{ \Carbon\Carbon::parse($panen->tanggal_panen)->format('d-m-Y') }}</td>
                                    <td class="p-4 print:p-2 font-bold text-emerald-800 print:text-black">{{ $panen->maggot->cultivation_code ?? '-' }}</td>
                                    <td class="p-4 print:p-2 font-bold text-gray-900 print:text-black">{{ $panen->hasil_kg }} Kg</td>
                                    <td class="p-4 print:p-2 text-gray-600">{{ $panen->keterangan ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-6 text-center text-gray-400 italic print:p-4">Tidak ditemukan data panen magot pada periode ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            {{-- DATA OUTPUT 2: LAPORAN SETORAN SAMPAH --}}
            @if($jenisLaporan == 'semua' || $jenisLaporan == 'setoran')
            <div>
                <h3 class="text-base font-bold text-gray-800 mb-3 flex items-center gap-2 print:text-xs print:mb-1">
                    <span>📥</span> Laporan Log Setoran Sampah Nasabah
                </h3>
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-xs print:rounded-none print:border-gray-300">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-100 font-bold text-gray-400 uppercase tracking-wider print:bg-gray-100 print:text-gray-700 print:border-gray-300">
                                <th class="p-4 print:p-2">Tanggal</th>
                                <th class="p-4 print:p-2">Nama Nasabah</th>
                                <th class="p-4 print:p-2">Jenis Sampah</th>
                                <th class="p-4 print:p-2">Volume (Kg)</th>
                                <th class="p-4 print:p-2">Nilai Tabungan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700 font-medium print:divide-gray-300">
                            @forelse($setoranData as $setoran)
                                <tr class="print:break-inside-avoid">
                                    <td class="p-4 print:p-2">{{ \Carbon\Carbon::parse($setoran['tanggal'])->format('d-m-Y') }}</td>
                                    <td class="p-4 print:p-2 font-bold text-gray-800 print:text-black">{{ $setoran['nasabah'] }}</td>
                                    <td class="p-4 print:p-2">{{ $setoran['sampah'] }}</td>
                                    <td class="p-4 print:p-2 font-bold text-gray-900 print:text-black">{{ $setoran['berat'] }} Kg</td>
<td class="p-4 print:p-2 text-emerald-600 font-black print:text-black">Rp {{ number_format($setoran['total'] ?? 0, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-gray-400 italic print:p-4">Tidak ditemukan data transaksi setoran sampah pada periode ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

        </main>
    </div>
</div>

</body>
</html>