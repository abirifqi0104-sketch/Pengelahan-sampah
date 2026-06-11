@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8 flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Kelola Informasi</h1>
                <p class="text-gray-600">Buat dan kelola informasi untuk pengguna</p>
            </div>
            <a href="{{ route('admin.informasi.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-semibold transition flex items-center">
                <i class="fas fa-plus mr-2"></i> Buat Informasi
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">TOTAL</p>
                        <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalInfo }}</p>
                    </div>
                    <i class="fas fa-newspaper text-3xl text-blue-200"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">DIPUBLIKASIKAN</p>
                        <p class="text-3xl font-bold text-green-600 mt-2">{{ $publishedInfo }}</p>
                    </div>
                    <i class="fas fa-check-circle text-3xl text-green-200"></i>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-gray-500">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-600 text-sm font-semibold">DRAFT</p>
                        <p class="text-3xl font-bold text-gray-600 mt-2">{{ $draftInfo }}</p>
                    </div>
                    <i class="fas fa-file-alt text-3xl text-gray-200"></i>
                </div>
            </div>
        </div>

        <!-- Information Table -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-blue-600 px-6 py-4">
                <h3 class="text-white text-lg font-bold">Daftar Informasi</h3>
            </div>

            @if($information->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Judul</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Kategori</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Pembuat</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Views</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($information as $info)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                        <div class="max-w-xs">
                                            <p class="font-semibold line-clamp-1">{{ $info->title }}</p>
                                            <p class="text-xs text-gray-500 line-clamp-1">{{ strip_tags($info->content) }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                                            {{ $info->category }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $info->creator->name }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        @if($info->is_published)
                                            <span class="inline-block px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                                <i class="fas fa-check mr-1"></i> Publikasi
                                            </span>
                                        @else
                                            <span class="inline-block px-3 py-1 text-xs font-semibold text-gray-700 bg-gray-100 rounded-full">
                                                <i class="fas fa-file-alt mr-1"></i> Draft
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        <i class="fas fa-eye mr-1"></i>{{ $info->views }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $info->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 text-center text-sm space-x-2">
                                        <a href="{{ route('admin.informasi.edit', $info->id) }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.informasi.destroy', $info->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus informasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700 font-semibold">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-white px-6 py-4 border-t">
                    {{ $information->links() }}
                </div>
            @else
                <div class="p-8 text-center">
                    <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 mb-4">Belum ada informasi</p>
                    <a href="{{ route('admin.informasi.create') }}" class="text-green-600 hover:text-green-700 font-semibold">
                        <i class="fas fa-plus mr-2"></i> Buat Informasi Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
