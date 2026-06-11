@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Informasi & Tips</h1>
            <p class="text-gray-600">Pelajari tips pengelolaan sampah dan informasi penting lainnya</p>
        </div>

        <!-- Search & Filter -->
        <div class="mb-8 flex flex-col md:flex-row gap-4">
            <input 
                type="text" 
                placeholder="Cari informasi..."
                class="flex-1 px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none"
            >
            <select class="px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 outline-none">
                <option value="">Semua Kategori</option>
                <option value="tips">Tips</option>
                <option value="promo">Promo</option>
                <option value="edukasi">Edukasi</option>
                <option value="berita">Berita</option>
            </select>
        </div>

        <!-- Information Grid -->
        @if($information->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($information as $info)
                    <a href="{{ route('user.information.show', $info->id) }}" class="block bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                        @if($info->image)
                            <img src="{{ asset('storage/' . $info->image) }}" alt="{{ $info->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center">
                                <i class="fas fa-newspaper text-4xl text-white opacity-50"></i>
                            </div>
                        @endif
                        
                        <div class="p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                    {{ $info->category }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    <i class="fas fa-eye mr-1"></i>{{ $info->views }}
                                </span>
                            </div>
                            
                            <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2">{{ $info->title }}</h3>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-3">{{ strip_tags($info->content) }}</p>
                            
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>{{ $info->created_at->format('d M Y') }}</span>
                                <span class="text-green-600 hover:text-green-700 font-semibold">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $information->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-lg p-12 text-center">
                <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">Belum ada informasi tersedia</p>
            </div>
        @endif
    </div>
</div>
@endsection
