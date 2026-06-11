@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('user.information.index') }}" class="text-green-600 hover:text-green-700 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Informasi
            </a>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Article -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    @if($info->image)
                        <img src="{{ asset('storage/' . $info->image) }}" alt="{{ $info->title }}" class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-green-400 to-blue-500 flex items-center justify-center">
                            <i class="fas fa-newspaper text-6xl text-white opacity-50"></i>
                        </div>
                    @endif

                    <div class="p-8">
                        <!-- Meta Info -->
                        <div class="flex flex-wrap gap-4 mb-6 pb-6 border-b-2 border-gray-200">
                            <span class="inline-block px-4 py-2 bg-green-100 text-green-700 font-semibold rounded-full text-sm">
                                {{ $info->category }}
                            </span>
                            <span class="text-gray-500 flex items-center">
                                <i class="fas fa-calendar mr-2"></i>
                                {{ $info->created_at->format('d F Y') }}
                            </span>
                            <span class="text-gray-500 flex items-center">
                                <i class="fas fa-user mr-2"></i>
                                {{ $info->creator->name }}
                            </span>
                            <span class="text-gray-500 flex items-center ml-auto">
                                <i class="fas fa-eye mr-2"></i>
                                {{ $info->views }} views
                            </span>
                        </div>

                        <!-- Title -->
                        <h1 class="text-4xl font-bold text-gray-800 mb-6">{{ $info->title }}</h1>

                        <!-- Content -->
                        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed mb-8">
                            {!! nl2br(e($info->content)) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Related Info -->
                @if($relatedInfo->count() > 0)
                    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">
                            <i class="fas fa-link mr-2 text-green-600"></i>Informasi Terkait
                        </h3>
                        
                        <div class="space-y-4">
                            @foreach($relatedInfo as $related)
                                <a href="{{ route('user.information.show', $related->id) }}" class="block p-3 bg-gray-50 rounded-lg hover:bg-green-50 transition">
                                    <p class="font-semibold text-gray-700 text-sm line-clamp-2">{{ $related->title }}</p>
                                    <p class="text-xs text-gray-500 mt-2">{{ $related->created_at->format('d M Y') }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Category Info -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">
                        <i class="fas fa-info-circle mr-2 text-blue-600"></i>Tips Penting
                    </h3>
                    
                    <div class="space-y-3">
                        <div class="flex gap-3">
                            <i class="fas fa-check-circle text-green-600 mt-1 flex-shrink-0"></i>
                            <p class="text-sm text-gray-700">Pisahkan sampah sesuai jenisnya</p>
                        </div>
                        <div class="flex gap-3">
                            <i class="fas fa-check-circle text-green-600 mt-1 flex-shrink-0"></i>
                            <p class="text-sm text-gray-700">Bersihkan sampah sebelum disetor</p>
                        </div>
                        <div class="flex gap-3">
                            <i class="fas fa-check-circle text-green-600 mt-1 flex-shrink-0"></i>
                            <p class="text-sm text-gray-700">Timbang sampah dengan teliti</p>
                        </div>
                        <div class="flex gap-3">
                            <i class="fas fa-check-circle text-green-600 mt-1 flex-shrink-0"></i>
                            <p class="text-sm text-gray-700">Pastikan dokumentasi foto jelas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
