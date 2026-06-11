<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Pesan Green</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-thumb { background: #1B4332; border-radius: 10px; }
    </style>
</head>

<body class="bg-gray-50 antialiased">

<div class="flex min-h-screen relative w-full">

    {{-- SIDEBAR --}}
    @include('admin.partials.sidebar')

    {{-- MAIN CONTENT --}}
    <div class="flex-1 pl-[240px] flex flex-col min-w-0 w-full bg-gray-50">

        {{-- TOPBAR --}}
        <header class="bg-white h-16 border-b border-gray-100 flex items-center justify-between px-6 sticky top-0 z-30 shadow-sm/50">
            <div class="flex items-center gap-3">
                <button class="text-gray-500 text-lg hover:text-[#1B4332] transition md:hidden">
                    <i class="fas fa-bars"></i>
                </button>
                <div>
                    <h1 class="font-bold text-gray-800 text-base leading-tight">Dashboard Admin</h1>
                    <p class="text-[11px] text-gray-400">Sistem Manajemen Bank Sampah</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2.5 border-l border-gray-100 pl-4">
                    <div class="text-right hidden sm:block">
                        <h2 class="font-bold text-xs text-gray-800 leading-tight">{{ Auth::user()->name }}</h2>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wider mt-0.5">Admin</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=1B4332&color=fff" class="w-8 h-8 rounded-full shadow-sm border border-gray-100">
                </div>
            </div>
        </header>

        {{-- CONTENT AREA --}}
        <main class="p-6 md:p-8 w-full block space-y-6">

            {{-- WELCOME MESSAGE --}}
            <div>
                <h2 class="text-xl md:text-2xl font-black text-gray-800 tracking-tight">Selamat Datang, {{ Auth::user()->name }} 👋</h2>
                <p class="text-xs text-gray-500 mt-1">Pantau setoran sampah, verifikasi nasabah, dan data grafik secara realtime.</p>
            </div>

            {{-- STATS KARTU MINI --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4">
                {{-- ORGANIK --}}
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <p class="text-[10px] text-gray-400 font-extrabold uppercase tracking-wider">Sampah Organik</p>
                        <h2 class="text-2xl font-black text-gray-800 mt-1">{{ number_format($totalOrganik ?? 0, 1) }} <span class="text-xs font-normal text-gray-400">kg</span></h2>
                    </div>
                    <div class="bg-green-50 w-11 h-11 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-leaf text-lg text-green-700"></i>
                    </div>
                </div>

                {{-- PLASTIK --}}
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <p class="text-[10px] text-gray-400 font-extrabold uppercase tracking-wider">Sampah Plastik</p>
                        <h2 class="text-2xl font-black text-gray-800 mt-1">{{ number_format($totalPlastik ?? 0, 1) }} <span class="text-xs font-normal text-gray-400">kg</span></h2>
                    </div>
                    <div class="bg-blue-50 w-11 h-11 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-recycle text-lg text-blue-700"></i>
                    </div>
                </div>

                {{-- KERTAS --}}
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <p class="text-[10px] text-gray-400 font-extrabold uppercase tracking-wider">Sampah Kertas</p>
                        <h2 class="text-2xl font-black text-gray-800 mt-1">{{ number_format($totalKertas ?? 0, 1) }} <span class="text-xs font-normal text-gray-400">kg</span></h2>
                    </div>
                    <div class="bg-amber-50 w-11 h-11 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-file-alt text-lg text-amber-700"></i>
                    </div>
                </div>

                {{-- LOGAM --}}
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <p class="text-[10px] text-gray-400 font-extrabold uppercase tracking-wider">Sampah Logam</p>
                        <h2 class="text-2xl font-black text-gray-800 mt-1">{{ number_format($totalLogam ?? 0, 1) }} <span class="text-xs font-normal text-gray-400">kg</span></h2>
                    </div>
                    <div class="bg-slate-50 w-11 h-11 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-tools text-lg text-slate-700"></i>
                    </div>
                </div>

                {{-- KACA --}}
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <p class="text-[10px] text-gray-400 font-extrabold uppercase tracking-wider">Sampah Kaca</p>
                        <h2 class="text-2xl font-black text-gray-800 mt-1">{{ number_format($totalKaca ?? 0, 1) }} <span class="text-xs font-normal text-gray-400">kg</span></h2>
                    </div>
                    <div class="bg-purple-50 w-11 h-11 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-wine-bottle text-lg text-purple-700"></i>
                    </div>
                </div>
            </div>

            {{-- STATS BARIS KEDUA --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                {{-- PENDING VERIFIKASI --}}
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <p class="text-[10px] text-gray-400 font-extrabold uppercase tracking-wider">Menunggu Verifikasi</p>
                        <h2 class="text-2xl font-black text-amber-600 mt-1">{{ $pendingCount ?? 0 }}</h2>
                        <a href="{{ route('admin.verifikasi.index') }}" class="text-amber-600 text-[10px] font-bold mt-1 underline">Lihat Detail →</a>
                    </div>
                    <div class="bg-amber-50 w-11 h-11 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-hourglass-half text-lg text-amber-600"></i>
                    </div>
                </div>

                {{-- DISETUJUI --}}
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <p class="text-[10px] text-gray-400 font-extrabold uppercase tracking-wider">Disetujui</p>
                        <h2 class="text-2xl font-black text-emerald-600 mt-1">{{ $approvedCount ?? 0 }}</h2>
                    </div>
                    <div class="bg-emerald-50 w-11 h-11 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-check-circle text-lg text-emerald-700"></i>
                    </div>
                </div>

                {{-- TOTAL NASABAH --}}
                <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 flex justify-between items-center hover:shadow-md transition">
                    <div>
                        <p class="text-[10px] text-gray-400 font-extrabold uppercase tracking-wider">Total Nasabah</p>
                        <h2 class="text-2xl font-black text-indigo-600 mt-1">{{ $totalUsers ?? 0 }}</h2>
                    </div>
                    <div class="bg-indigo-50 w-11 h-11 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-users text-lg text-indigo-700"></i>
                    </div>
                </div>

                {{-- REVENUE --}}
                <div class="bg-gradient-to-br from-[#1B4332] to-[#2D6A4F] rounded-xl p-4 shadow-sm text-white flex justify-between items-center">
                    <div>
                        <p class="text-[10px] text-green-200 font-extrabold uppercase tracking-wider">Total Pendapatan</p>
                        <h2 class="text-2xl font-black mt-1">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</h2>
                    </div>
                    <div class="bg-white/10 w-11 h-11 rounded-lg flex items-center justify-center shrink-0">
                        <i class="fas fa-coins text-lg text-green-200"></i>
                    </div>
                </div>
            </div>

            {{-- GRID GRAFIK & AKTIVITAS --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

                {{-- BLOK GRAFIK DINAMIS --}}
                <div class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col">
                    <div class="flex items-center justify-between mb-6 border-b border-gray-50 pb-4">
                        <div>
                            <h2 class="font-bold text-gray-800 text-sm">Statistik Setoran Sampah</h2>
                            <p class="text-[11px] text-gray-400">Grafik akumulasi berat sampah (Kg)</p>
                        </div>
                        {{-- FILTER GRAFIK --}}
                        <select id="chartFilter" onchange="updateChart()" class="bg-gray-50 border border-gray-200 rounded-lg text-xs font-bold text-gray-600 px-3 py-1.5 outline-none focus:border-[#1B4332]">
                            <option value="day">Per Hari (7 Hari Terakhir)</option>
                            <option value="week">Per Minggu (Bulan Ini)</option>
                            <option value="month" selected>Per Bulan (Tahun Ini)</option>
                        </select>
                    </div>
                    
                    {{-- PERBAIKAN: Memberikan min-h-[280px] agar grafik punya ruang untuk tampil --}}
                    <div class="flex-1 w-full relative min-h-[280px]">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>

                {{-- BLOK AKTIVITAS TERBARU (SINKRON DENGAN VERIFIKASI) --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col">
                    <div class="flex items-center justify-between mb-4 border-b border-gray-50 pb-4">
                        <div>
                            <h2 class="font-bold text-gray-800 text-sm">Aktivitas Setoran Terbaru</h2>
                            <p class="text-[11px] text-gray-400">Update realtime dari Nasabah</p>
                        </div>
                        <span class="bg-green-50 text-green-700 px-2 py-0.5 rounded-md text-[10px] font-black tracking-wider animate-pulse">LIVE</span>
                    </div>

                    <div class="space-y-4 max-h-[300px] overflow-y-auto pr-2">
                        @forelse($recentActivities ?? [] as $activity)
                            <div class="flex gap-3 border-b border-gray-50 pb-3 last:border-0 last:pb-0 items-start">
                                
                                {{-- Ikon Berubah Sesuai Status --}}
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0 
                                    {{ $activity->status == 'pending' ? 'bg-amber-50 text-amber-600' : 'bg-emerald-50 text-emerald-600' }}">
                                    <i class="fas {{ $activity->status == 'pending' ? 'fa-hourglass-half' : 'fa-check' }} text-xs"></i>
                                </div>
                                
                                <div class="min-w-0 flex-1">
                                    <div class="flex justify-between items-start mb-0.5">
                                        <h3 class="font-bold text-gray-800 text-xs truncate">Setoran {{ $activity->trash_type }}</h3>
                                        
                                        {{-- LABEL PENDING AGAR ADMIN TAHU --}}
                                        @if($activity->status == 'pending')
                                            <span class="text-[8px] bg-amber-100 text-amber-700 px-1.5 py-0.5 rounded font-bold uppercase">Pending</span>
                                        @else
                                            <span class="text-[8px] bg-emerald-100 text-emerald-700 px-1.5 py-0.5 rounded font-bold uppercase">Selesai</span>
                                        @endif
                                    </div>
                                    <p class="text-[11px] text-gray-500 truncate">{{ $activity->weight }} kg - {{ $activity->location }}</p>
                                    <p class="text-[9px] text-gray-400 mt-0.5">{{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-300 my-auto">
                                <i class="fas fa-inbox text-4xl mb-2 text-gray-200"></i>
                                <p class="text-xs">Belum ada setoran terbaru</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

<script>
    // Pastikan Chart.js sudah ter-load
    if (typeof Chart === 'undefined') {
        console.error('Chart.js belum ter-load.');
    }

    const chartData = {
        day: {!! json_encode($chartDay) !!},
        week: {!! json_encode($chartWeek) !!},
        month: {!! json_encode($chartMonth) !!},
    };

    // Warna solid untuk setiap jenis sampah (kartun brutalist flat colors)
    const trashColors = {
        organik: { bg: '#22C55E', border: '#166534' },
        plastik: { bg: '#3B82F6', border: '#1E40AF' },
        kertas:  { bg: '#F59E0B', border: '#B45309' },
        logam:   { bg: '#64748B', border: '#334155' },
        kaca:    { bg: '#A855F7', border: '#7E22CE' },
    };

    let myChart;

    function updateChart() {
        if (typeof Chart === 'undefined') return;

        const filterEl = document.getElementById('chartFilter');
        const canvasEl = document.getElementById('myChart');
        if (!filterEl || !canvasEl) return;

        const filter = filterEl.value;
        let labels = chartData[filter].labels;

        if (!labels || labels.length === 0) {
            labels = ['Belum ada data'];
            chartData[filter].organik = [0];
            chartData[filter].plastik = [0];
            chartData[filter].kertas = [0];
            chartData[filter].logam = [0];
            chartData[filter].kaca = [0];
        }

        if (myChart) myChart.destroy();

        const ctx = canvasEl.getContext('2d');

        myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Organik',
                        data: chartData[filter].organik,
                        backgroundColor: trashColors.organik.bg,
                        borderColor: trashColors.organik.border,
                        borderWidth: 2,
                        borderRadius: 4,
                        borderSkipped: false,
                    },
                    {
                        label: 'Plastik',
                        data: chartData[filter].plastik,
                        backgroundColor: trashColors.plastik.bg,
                        borderColor: trashColors.plastik.border,
                        borderWidth: 2,
                        borderRadius: 4,
                        borderSkipped: false,
                    },
                    {
                        label: 'Kertas',
                        data: chartData[filter].kertas,
                        backgroundColor: trashColors.kertas.bg,
                        borderColor: trashColors.kertas.border,
                        borderWidth: 2,
                        borderRadius: 4,
                        borderSkipped: false,
                    },
                    {
                        label: 'Logam',
                        data: chartData[filter].logam,
                        backgroundColor: trashColors.logam.bg,
                        borderColor: trashColors.logam.border,
                        borderWidth: 2,
                        borderRadius: 4,
                        borderSkipped: false,
                    },
                    {
                        label: 'Kaca',
                        data: chartData[filter].kaca,
                        backgroundColor: trashColors.kaca.bg,
                        borderColor: trashColors.kaca.border,
                        borderWidth: 2,
                        borderRadius: 4,
                        borderSkipped: false,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { size: 11, weight: 'bold' },
                            generateLabels: function(chart) {
                                const datasets = chart.data.datasets;
                                return datasets.map(function(ds, i) {
                                    return {
                                        text: ds.label,
                                        fillStyle: ds.backgroundColor,
                                        strokeStyle: ds.borderColor,
                                        lineWidth: 2,
                                        hidden: !chart.isDatasetVisible(i),
                                        index: i,
                                        pointStyle: 'rectRounded',
                                        pointStyleWidth: 16,
                                    };
                                });
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1F2937',
                        titleColor: '#F9FAFB',
                        bodyColor: '#F9FAFB',
                        titleFont: { weight: 'bold', size: 13 },
                        bodyFont: { size: 12 },
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                const val = context.parsed.y;
                                return ' ' + context.dataset.label + ': ' + val.toFixed(1) + ' kg';
                            }
                        }
                    }
                },
                animation: {
                    duration: 800,
                    easing: 'easeOutQuart',
                },
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    x: {
                        stacked: false,
                        grid: { display: false, drawBorder: false },
                        ticks: {
                            autoSkip: true,
                            maxTicksLimit: labels.length,
                            font: { size: 10, weight: '600' },
                            color: '#6B7280',
                        },
                    },
                    y: {
                        stacked: false,
                        beginAtZero: true,
                        grid: { color: '#F3F4F6', drawBorder: false },
                        ticks: {
                            callback: function(value) { return value + ' kg'; },
                            font: { size: 10 },
                            color: '#9CA3AF',
                        },
                    }
                }
            }
        });
    }

    // Pastikan updateChart dipanggil setelah DOM siap
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', updateChart);
    } else {
        updateChart();
    }

    window.updateChart = updateChart;
</script>

</body>
</html>
