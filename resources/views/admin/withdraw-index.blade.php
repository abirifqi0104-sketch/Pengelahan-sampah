@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Kelola Penarikan Saldo</h1>
            <p class="text-gray-600">Verifikasi dan proses permintaan penarikan saldo user</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">MENUNGGU</p>
                        <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $pendingCount }}</p>
                    </div>
                    <i class="fas fa-clock text-3xl text-yellow-200"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">DISETUJUI</p>
                        <p class="text-3xl font-bold text-blue-600 mt-2">{{ $approvedCount }}</p>
                    </div>
                    <i class="fas fa-check text-3xl text-blue-200"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">SELESAI</p>
                        <p class="text-3xl font-bold text-green-600 mt-2">{{ $processedCount }}</p>
                    </div>
                    <i class="fas fa-check-double text-3xl text-green-200"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">DITOLAK</p>
                        <p class="text-3xl font-bold text-red-600 mt-2">{{ $rejectedCount }}</p>
                    </div>
                    <i class="fas fa-times text-3xl text-red-200"></i>
                </div>
            </div>
        </div>

        <!-- Withdrawals Table -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-blue-600 px-6 py-4">
                <h3 class="text-white text-lg font-bold">Daftar Penarikan</h3>
            </div>

            @if($withdrawals->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">User</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Jumlah</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Bank</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Rekening</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($withdrawals as $withdrawal)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                        <div>
                                            <p class="font-semibold">{{ $withdrawal->user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $withdrawal->user->email }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-bold text-green-600">
                                        Rp {{ number_format($withdrawal->amount, 0) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">{{ $withdrawal->bank_name }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="font-mono">{{ str_repeat('*', 8) . substr($withdrawal->account_number, -4) }}</span>
                                        <p class="text-xs text-gray-500">{{ $withdrawal->account_holder }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        @if($withdrawal->status === 'pending')
                                            <span class="inline-block px-3 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full">
                                                <i class="fas fa-clock mr-1"></i> Menunggu
                                            </span>
                                        @elseif($withdrawal->status === 'approved')
                                            <span class="inline-block px-3 py-1 text-xs font-semibold text-blue-700 bg-blue-100 rounded-full">
                                                <i class="fas fa-check mr-1"></i> Disetujui
                                            </span>
                                        @elseif($withdrawal->status === 'processed')
                                            <span class="inline-block px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                                <i class="fas fa-check-double mr-1"></i> Selesai
                                            </span>
                                        @else
                                            <span class="inline-block px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                                                <i class="fas fa-times mr-1"></i> Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $withdrawal->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-6 py-4 text-center text-sm">
                                        @if($withdrawal->status === 'pending')
                                            <button onclick="showApproveModal({{ $withdrawal->id }})" class="text-blue-600 hover:text-blue-700 font-semibold">
                                                <i class="fas fa-check mr-1"></i> Setuju
                                            </button>
                                            <button onclick="showRejectModal({{ $withdrawal->id }})" class="text-red-600 hover:text-red-700 font-semibold ml-2">
                                                <i class="fas fa-times mr-1"></i> Tolak
                                            </button>
                                        @elseif($withdrawal->status === 'approved')
                                            <form action="{{ route('admin.withdraw.process', $withdrawal->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-700 font-semibold">
                                                    <i class="fas fa-arrow-right mr-1"></i> Proses
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-6 py-4 border-t">
                    {{ $withdrawals->links() }}
                </div>
            @else
                <div class="p-8 text-center">
                    <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Belum ada permintaan penarikan</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div id="approveModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full mx-4">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Setujui Penarikan Saldo</h3>
        <form id="approveForm" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan Admin (opsional)</label>
                <textarea name="admin_note" rows="3" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none" placeholder="Catatan..."></textarea>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded-lg transition">
                    Setujui
                </button>
                <button type="button" onclick="closeModal('approveModal')" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 rounded-lg transition">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full mx-4">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Tolak Penarikan Saldo</h3>
        <form id="rejectForm" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Alasan Penolakan <span class="text-red-500">*</span></label>
                <textarea name="admin_note" rows="3" class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-200 outline-none" placeholder="Jelaskan alasan penolakan..." required></textarea>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-red-500 hover:bg-red-600 text-white font-bold py-2 rounded-lg transition">
                    Tolak
                </button>
                <button type="button" onclick="closeModal('rejectModal')" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 rounded-lg transition">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function showApproveModal(id) {
        document.getElementById('approveForm').action = '{{ route("admin.withdraw.approve", ":id") }}'.replace(':id', id);
        document.getElementById('approveModal').classList.remove('hidden');
    }

    function showRejectModal(id) {
        document.getElementById('rejectForm').action = '{{ route("admin.withdraw.reject", ":id") }}'.replace(':id', id);
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
@endsection
