@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('user.withdraw.index') }}" class="text-green-600 hover:text-green-700 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            <h1 class="text-3xl font-bold text-gray-800 mt-4">Ajukan Penarikan Saldo</h1>
            <p class="text-gray-600 mt-2">Saldo tersedia: <span class="font-bold text-green-600">Rp {{ number_format($saldo, 0) }}</span></p>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl">
            <form action="{{ route('user.withdraw.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Amount -->
                <div>
                    <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">
                        Jumlah Penarikan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-gray-500">Rp</span>
                        <input 
                            type="number" 
                            id="amount" 
                            name="amount" 
                            placeholder="Minimal Rp 10,000"
                            min="10000"
                            max="{{ $saldo }}"
                            step="1000"
                            class="w-full pl-12 pr-4 py-2 border-2 border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                            value="{{ old('amount') }}"
                            required
                        >
                    </div>
                    @error('amount')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bank Name -->
                <div>
                    <label for="bank_name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Bank <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="bank_name" 
                        name="bank_name" 
                        class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        required
                    >
                        <option value="">-- Pilih Bank --</option>
                        <option value="BCA" {{ old('bank_name') === 'BCA' ? 'selected' : '' }}>BCA</option>
                        <option value="Mandiri" {{ old('bank_name') === 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
                        <option value="BRI" {{ old('bank_name') === 'BRI' ? 'selected' : '' }}>BRI</option>
                        <option value="BTN" {{ old('bank_name') === 'BTN' ? 'selected' : '' }}>BTN</option>
                        <option value="Danamon" {{ old('bank_name') === 'Danamon' ? 'selected' : '' }}>Danamon</option>
                        <option value="CIMB Niaga" {{ old('bank_name') === 'CIMB Niaga' ? 'selected' : '' }}>CIMB Niaga</option>
                        <option value="OVO" {{ old('bank_name') === 'OVO' ? 'selected' : '' }}>OVO</option>
                        <option value="DANA" {{ old('bank_name') === 'DANA' ? 'selected' : '' }}>DANA</option>
                        <option value="GCash" {{ old('bank_name') === 'GCash' ? 'selected' : '' }}>GCash</option>
                    </select>
                    @error('bank_name')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Account Number -->
                <div>
                    <label for="account_number" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nomor Rekening <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="account_number" 
                        name="account_number" 
                        placeholder="Masukkan nomor rekening"
                        class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        value="{{ old('account_number') }}"
                        required
                    >
                    @error('account_number')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Account Holder -->
                <div>
                    <label for="account_holder" class="block text-sm font-semibold text-gray-700 mb-2">
                        Atas Nama Rekening <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="account_holder" 
                        name="account_holder" 
                        placeholder="Nama sesuai rekening"
                        class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none transition"
                        value="{{ old('account_holder') }}"
                        required
                    >
                    @error('account_holder')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                    <p class="text-sm text-blue-700">
                        <i class="fas fa-info-circle mr-2"></i>
                        Proses penarikan saldo membutuhkan waktu 1-3 hari kerja setelah disetujui oleh admin.
                    </p>
                </div>

                <!-- Submit Button -->
                <div class="flex gap-4 pt-4">
                    <button 
                        type="submit" 
                        class="flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-lg transition duration-200 flex items-center justify-center"
                    >
                        <i class="fas fa-check mr-2"></i> Ajukan Penarikan
                    </button>
                    <a 
                        href="{{ route('user.withdraw.index') }}" 
                        class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 rounded-lg transition duration-200 text-center flex items-center justify-center"
                    >
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Format number with thousand separator
    document.getElementById('amount').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });
</script>
@endsection
