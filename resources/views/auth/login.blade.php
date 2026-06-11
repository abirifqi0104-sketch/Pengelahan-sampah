<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pesan green Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center p-6">
    <div class="max-w-4xl w-full bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row">
        
        <div class="md:w-1/2 bg-green-600 p-12 flex flex-col justify-center items-center text-white text-center">
            <h2 class="text-4xl font-bold mb-4 italic">pesan green.</h2>
             <h2 class="text-3xl font-bold mb-3 italic">pengelolaan sampah.</h2>
            <p class="text-green-100 italic">"merawat jagat untuk umat!"</p>
           <div class="mt-8">
    <img src="{{ asset('image/foto1.png') }}" 
         alt="Recycle Illustration" 
         class="w-64 opacity-90 transition-transform hover:scale-105 duration-300">
</div>
        </div>

        <div class="md:w-1/2 p-8 md:p-12">
            <div class="mb-6">
                <img src="{{ asset('image/pesan_green.png') }}" alt="Logo Pesan Green" class="h-16 w-auto">
            </div>

            <h3 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang Kembali!</h3>
            <p class="text-gray-500 mb-8 font-medium">Silahkan masuk ke akun Anda.</p>

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-100 border-l-4 border-red-500 text-red-700 text-sm italic">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2 italic">
                        <i class="fas fa-envelope mr-1"></i> Alamat Email
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" 
                        class="w-full px-4 py-3 rounded-lg bg-gray-50 border @error('email') border-red-500 @enderror focus:border-green-500 focus:bg-white focus:outline-none transition duration-200" 
                        placeholder="nama@email.com" required autocomplete="email">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2 italic">
                        <i class="fas fa-lock mr-1"></i> Password
                    </label>
                    <input type="password" name="password" 
                        class="w-full px-4 py-3 rounded-lg bg-gray-50 border focus:border-green-500 focus:bg-white focus:outline-none transition duration-200" 
                        placeholder="••••••••" required>
                </div>

                <div class="flex items-center justify-between mb-8 text-sm">
                    <label class="flex items-center text-gray-600 cursor-pointer">
                        <input type="checkbox" name="remember" class="mr-2 leading-tight accent-green-600"> 
                        Ingat Saya
                    </label>
                    <a href="#" class="text-green-600 hover:underline font-semibold italic">Lupa Password?</a>
                </div>

                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow-lg hover:shadow-green-200 transform active:scale-95 transition duration-300">
                    Masuk Sekarang <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-gray-600 italic">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-green-600 font-bold hover:underline">Daftar sebagai Nasabah</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>