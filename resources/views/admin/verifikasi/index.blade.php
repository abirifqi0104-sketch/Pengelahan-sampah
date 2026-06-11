<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Setoran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 antialiased overflow-x-hidden">

<div class="flex min-h-screen w-full relative">

    {{-- SIDEBAR --}}
    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col min-w-0 w-0 md:pl-72 min-h-screen bg-gray-50">
        
        <main class="flex-1 p-6 md:p-8 overflow-y-auto w-full box-border">

            {{-- HEADER TITLE --}}
            <div class="mb-6">
                <h1 class="text-xl md:text-2xl font-black text-gray-800 tracking-tight flex items-center gap-2">
                    <i class="fas fa-check-circle text-[#1B4332]"></i>
                    Verifikasi Setoran Sampah
                </h1>
                <p class="text-xs text-gray-500 mt-1">Setuju atau tolak permohonan setoran sampah dari nasabah</p>
            </div>

            {{-- STATS CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Menunggu Verifikasi</p>
                            <p class="text-2xl font-black text-amber-600 mt-1">{{ $pendingCount }}</p>
                        </div>
                        <i class="fas fa-hourglass-half text-3xl text-amber-100"></i>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Disetujui</p>
                            <p class="text-2xl font-black text-emerald-600 mt-1">{{ $approvedCount }}</p>
                        </div>
                        <i class="fas fa-check-circle text-3xl text-emerald-100"></i>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Ditolak</p>
                            <p class="text-2xl font-black text-red-600 mt-1">{{ $rejectedCount }}</p>
                        </div>
                        <i class="fas fa-times-circle text-3xl text-red-100"></i>
                    </div>
                </div>
            </div>

            {{-- FLASH NOTIFICATION --}}
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-xs font-semibold flex items-center gap-2 shadow-sm">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- TABLE WRAPPER CARD --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden w-full">
                <div class="overflow-x-auto w-full">
                    <table class="w-full text-left border-collapse min-w-[1000px]">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr class="text-gray-500 text-[11px] uppercase font-bold tracking-wider">
                                <th class="px-5 py-3.5 w-28">ID Setoran</th>
                                <th class="px-5 py-3.5">Nama User</th>
                                <th class="px-5 py-3.5">Jenis Sampah</th>
                                <th class="px-5 py-3.5">Berat (Kg)</th>
                                <th class="px-5 py-3.5">Lokasi</th>
                                <th class="px-5 py-3.5 text-center">Aksi Verifikasi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-50 text-xs text-gray-700">
                            @forelse($items as $item)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-5 py-4 font-bold text-gray-800">{{ $item->data_id }}</td>
                                <td class="px-5 py-4">
                                    <div class="font-semibold text-gray-800">{{ $item->user->name ?? 'N/A' }}</div>
                                    <div class="text-[10px] text-gray-500">{{ $item->user->email ?? 'N/A' }}</div>
                                </td>
                                <td class="px-5 py-4">
                                    @if(str_contains(strtolower($item->trash_type), 'organik'))
                                        <span class="bg-green-50 text-green-700 px-2.5 py-0.5 rounded-md font-bold text-[10px]">{{ $item->trash_type }}</span>
                                    @else
                                        <span class="bg-blue-50 text-blue-700 px-2.5 py-0.5 rounded-md font-bold text-[10px]">{{ $item->trash_type }}</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 font-bold text-gray-800">{{ $item->weight }} <span class="font-normal text-gray-400">kg</span></td>
                                <td class="px-5 py-4 text-gray-500 truncate max-w-[150px]">{{ $item->location }}</td>
                                <td class="px-5 py-3">
                                    <div class="flex gap-2 justify-center">
                                        {{-- APPROVE BUTTON --}}
                                        <button class="approve-btn bg-emerald-50 hover:bg-emerald-100 text-emerald-700 px-3 py-2 rounded-lg font-bold text-[10px] transition" 
                                                data-id="{{ $item->id }}" data-trash="{{ $item->trash_type }}" data-weight="{{ $item->weight }}">
                                            <i class="fas fa-check-circle mr-1"></i> Setujui
                                        </button>
                                        {{-- REJECT BUTTON --}}
                                        <button class="reject-btn bg-red-50 hover:bg-red-100 text-red-700 px-3 py-2 rounded-lg font-bold text-[10px] transition"
                                                data-id="{{ $item->id }}">
                                            <i class="fas fa-times-circle mr-1"></i> Tolak
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-5 py-10 text-center text-gray-400">
                                    <i class="fas fa-inbox text-4xl mb-3 opacity-30 block"></i>
                                    <p class="font-medium">Tidak ada setoran yang menunggu verifikasi</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- PAGINATION --}}
            @if($items->hasPages())
            <div class="mt-6">
                {{ $items->links() }}
            </div>
            @endif
        </main>
    </div>
</div>

{{-- APPROVE MODAL --}}
<div id="approveModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
        <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4 text-white font-bold text-lg rounded-t-2xl flex items-center gap-2">
            <i class="fas fa-check-circle"></i> Setujui Setoran
        </div>
        <form id="approveForm" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Harga per Kilogram (Rp) *</label>
                <input type="number" name="price_per_kg" id="pricePerKg" step="0.01" min="0" required 
                       class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none text-lg font-bold"
                       placeholder="5000">
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Catatan Admin (Opsional)</label>
                <textarea name="admin_note" rows="3" class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 outline-none resize-none" 
                          placeholder="Catatan verifikasi..."></textarea>
            </div>
            <div class="bg-emerald-50 p-3 rounded-lg border border-emerald-200">
                <p class="text-xs text-gray-600"><span class="font-bold">Total yang akan diterima user:</span></p>
                <p class="text-2xl font-black text-emerald-600 mt-1" id="totalAmount">Rp 0</p>
            </div>
            <div class="flex gap-3">
                <button type="button" class="flex-1 cancel-btn px-4 py-3 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition">
                    Batal
                </button>
                <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-lg transition">
                    <i class="fas fa-save mr-2"></i> Simpan & Setujui
                </button>
            </div>
        </form>
    </div>
</div>

{{-- REJECT MODAL --}}
<div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full">
        <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4 text-white font-bold text-lg rounded-t-2xl flex items-center gap-2">
            <i class="fas fa-times-circle"></i> Tolak Setoran
        </div>
        <form id="rejectForm" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Alasan Penolakan *</label>
                <textarea name="admin_note" rows="4" required class="w-full p-3 border-2 border-gray-200 rounded-xl focus:border-red-500 focus:ring-2 focus:ring-red-200 outline-none resize-none" 
                          placeholder="Jelaskan alasan penolakan setoran ini..."></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" class="flex-1 cancel-btn px-4 py-3 bg-gray-200 text-gray-700 font-bold rounded-lg hover:bg-gray-300 transition">
                    Batal
                </button>
                <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg transition">
                    <i class="fas fa-ban mr-2"></i> Tolak Setoran
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Approve Modal
    document.querySelectorAll('.approve-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const modal = document.getElementById('approveModal');
            const form = document.getElementById('approveForm');
            const itemId = this.dataset.id;
            const weight = parseFloat(this.dataset.weight);
            
            form.action = `/admin/verifikasi/${itemId}/approve`;
            
            // Calculate total when price changes
            document.getElementById('pricePerKg').addEventListener('input', function() {
                const price = parseFloat(this.value) || 0;
                const total = weight * price;
                document.getElementById('totalAmount').textContent = 'Rp ' + total.toLocaleString('id-ID');
            });
            
            modal.classList.remove('hidden');
        });
    });

    // Reject Modal
    document.querySelectorAll('.reject-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const modal = document.getElementById('rejectModal');
            const form = document.getElementById('rejectForm');
            const itemId = this.dataset.id;
            
            form.action = `/admin/verifikasi/${itemId}/reject`;
            modal.classList.remove('hidden');
        });
    });

    // Close modals
    document.querySelectorAll('.cancel-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.fixed').classList.add('hidden');
            document.getElementById('approveForm').reset();
            document.getElementById('rejectForm').reset();
        });
    });
</script>

</body>
</html>