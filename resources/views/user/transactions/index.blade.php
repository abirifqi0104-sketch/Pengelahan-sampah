<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Sampah Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-50">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    @include('user.partials.sidebar')

    <!-- MAIN -->
    <main class="flex-1 p-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 italic">Data Sampah Saya</h1>
                <p class="text-sm text-gray-500 italic">Lihat semua data sampah yang kamu setor</p>
            </div>

            <a href="{{ route('user.submit-waste') }}"
               class="bg-[#2D6A4F] text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 hover:bg-[#1B4332] transition">
                <i class="fas fa-plus"></i> Setor Sampah
            </a>
        </div>

        <!-- TABLE -->
        <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-[10px] uppercase tracking-widest border-b font-bold">
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Jenis</th>
                        <th class="px-6 py-4">Berat (kg)</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Lokasi</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 italic text-gray-700">

                @forelse ($items as $index => $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-xs font-bold">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-xs">{{ $item->trash_type }}</td>
                        <td class="px-6 py-4 text-xs font-bold">{{ $item->weight }}</td>
                        <td class="px-6 py-4 text-xs">{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-xs">{{ $item->location }}</td>

                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 text-[10px] rounded-full bg-green-100 text-green-700 font-bold">
                                Selesai
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-gray-400 text-sm italic">
                            Belum ada data sampah.
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        <div class="mt-4">
            {{ $items->links() }}
        </div>

    </main>
</div>

</body>
</html>