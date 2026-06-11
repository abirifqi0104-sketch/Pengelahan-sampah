<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - pesan green</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-green-50">

<div class="min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl p-8 border-t-8 border-green-600">
        
        <div class="text-center mb-4">
            <img src="{{ asset('image/pesan_green.png') }}" alt="Logo Pesan Green" class="h-20 mx-auto mb-2">
        </div>

        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800 italic">Daftar Akun</h2>
            <p class="text-gray-500 italic text-sm">Mulai langkah kecil untuk bumi hari ini</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 text-red-700 text-xs italic rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-bold text-gray-700 italic ml-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                        class="w-full px-4 py-3 mt-1 rounded-xl bg-gray-100 border-transparent focus:border-green-500 focus:bg-white focus:ring-0 text-sm transition" 
                        placeholder="John Doe" required>
                </div>

                <div>
                    <label class="text-sm font-bold text-gray-700 italic ml-1">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" 
                        class="w-full px-4 py-3 mt-1 rounded-xl bg-gray-100 border-transparent focus:border-green-500 focus:bg-white focus:ring-0 text-sm transition" 
                        placeholder="john@example.com" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-bold text-gray-700 italic ml-1">Password</label>
                        <input type="password" name="password" 
                            class="w-full px-4 py-3 mt-1 rounded-xl bg-gray-100 border-transparent focus:border-green-500 focus:bg-white focus:ring-0 text-sm transition" 
                            placeholder="••••••••" required>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-700 italic ml-1">Konfirmasi</label>
                        <input type="password" name="password_confirmation" 
                            class="w-full px-4 py-3 mt-1 rounded-xl bg-gray-100 border-transparent focus:border-green-500 focus:bg-white focus:ring-0 text-sm transition" 
                            placeholder="••••••••" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full mt-8 bg-green-600 text-white font-bold py-3 rounded-xl shadow-lg hover:bg-green-700 transform hover:-translate-y-1 transition duration-300">
                Buat Akun Sekarang <i class="fas fa-user-plus ml-2"></i>
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-green-600 font-bold hover:underline italic">Login di sini</a>
        </p>
    </div>
</div>

</body>
</html>