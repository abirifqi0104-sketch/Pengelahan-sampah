@extends('layouts.app') {{-- Catatan: Sesuaikan nama 'layouts.admin' dengan nama file master layout admin Anda --}}

@section('content')
<div class="container mx-auto px-6 py-8">
    
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between pb-6 border-b border-gray-200 mb-6 gap-4">
        <div>
            <h3 class="text-gray-800 text-2xl font-bold flex items-center gap-2">
                <i class="fas fa-boxes text-green-600"></i>
                Input Setoran Manual (Offline)
            </h3>
            <p class="text-sm text-gray-500 mt-1">Gunakan form ini jika nasabah datang langsung membawa sampah ke gudang pusat.</p>
        </div>
        <a href="{{ route('admin.transactions.index') }}" class="inline-flex items-center bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow transition duration-200">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 max-w-2xl mx-auto">
        <form action="{{ route('admin.transactions.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Nasabah (Pemilik Sampah)</label>
                <div class="relative">
                    <select name="user_id" class="block w-full p-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 text-gray-800 font-medium" required>
                        <option value="">-- Silakan Pilih Nama Nasabah --</option>
                        @foreach($nasabah as $row)
                            <option value="{{ $row->id }}">{{ $row->name }} ({{ $row->email }})</option>
                        @endforeach
                    </select>
                </div>
                @error('user_id') 
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Sampah</label>
                    <select name="trash_type" class="block w-full p-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 text-gray-800" required>
                     <option value="">--  Pilih jenis sampah --</option>
                        <option value="Sampah Organik">Sampah Organik - Rp 3.000/kg</option>
                        <option value="Sampah Plastik">Sampah Plastik - Rp 5.000/kg</option>
                        <option value="Sampah Kertas">Sampah Kertas - Rp 2.000/kg</option>
                        <option value="Sampah Logam">Sampah Logam - Rp 8.000/kg</option>
                        <option value="Sampah Kaca">Sampah Kaca - Rp 4.000/kg</option>
                    </select>
                    @error('trash_type') 
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Berat Timbangan (Kg)</label>
                    <div class="relative rounded-xl shadow-sm">
                        <input type="number" step="0.1" name="weight" placeholder="0.0" class="block w-full p-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 text-gray-800 text-right pr-12" required>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm font-medium">Kg</span>
                        </div>
                    </div>
                    @error('weight') 
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Total Harga / Saldo yang Diberikan</label>
                <div class="relative rounded-xl shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm font-bold">Rp</span>
                    </div>
                    <input type="number" name="total_price" placeholder="0" class="block w-full p-3 pl-12 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 text-gray-800 font-semibold" required>
                </div>
                @error('total_price') 
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan / Lokasi Penyetoran (Opsional)</label>
                <textarea name="description" rows="3" placeholder="Contoh: Kondisi sampah bersih kering, diserahkan langsung di hanggar..." class="block w-full p-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 text-gray-800"></textarea>
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white font-bold px-6 py-3 rounded-xl shadow-md hover:shadow-lg transform active:scale-95 transition duration-150">
                    <i class="fas fa-save mr-2"></i> Simpan Transaksi & Beri Saldo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection