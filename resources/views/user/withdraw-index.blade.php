@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Tarik Saldo</h1>
            <p class="text-gray-600">Kelola permintaan penarikan saldo Anda</p>
        </div>

        <!-- Saldo Card -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-8 border-l-4 border-green-500">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-600 text-sm font-semibold uppercase tracking-wide">Saldo Tersedia</p>
                    <h2 class="text-4xl font-bold text-green-600 mt-2">Rp {{ number_format($saldo, 0) }}</h2>
                </div>
                <a href="{{ route('user.withdraw.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i> Tarik Saldo
                </a>
            </div>
        </div>

        <!-- Withdraw History -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-blue-600 px-6 py-4">
                <h3 class="text-white text-lg font-bold">Riwayat Penarikan</h3>
            </div>

            @if($withdrawals->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Jumlah</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Bank</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">No Rekening</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($withdrawals as $withdrawal)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm">{{ $withdrawal->created_at->format('d M Y H:i') }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-green-600">Rp {{ number_format($withdrawal->amount, 0) }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $withdrawal->bank_name }}</td>
                                    <td class="px-6 py-4 text-sm">{{ str_repeat('*', 8) . substr($withdrawal->account_number, -4) }}</td>
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
                    <p class="text-gray-500">Belum ada riwayat penarikan</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
