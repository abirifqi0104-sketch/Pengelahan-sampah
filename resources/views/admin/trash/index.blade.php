@extends('layouts.admin') {{-- Asumsi Anda sudah buat layout --}}

@section('content')
<div class="p-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Data Sampah</h2>
            <p class="text-gray-500 text-sm">Kelola semua data sampah yang telah tercatat.</p>
        </div>
        <a href="{{ route('admin.trash.create') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-green-700 transition">
            + Tambah Data
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm overflow-hidden border">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-400 text-xs uppercase tracking-widest">
                <tr>
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Jenis Sampah</th>
                    <th class="px-6 py-4">Berat (Kg)</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Lokasi</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 italic">
                @foreach($trash_items as $index => $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 font-bold text-green-700">{{ $item->trash_type }}</td>
                    <td class="px-6 py-4">{{ $item->weight }} Kg</td>
                    <td class="px-6 py-4">{{ $item->date }}</td>
                    <td class="px-6 py-4">{{ $item->location }}</td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <button class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></button>
                        <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsectionya 