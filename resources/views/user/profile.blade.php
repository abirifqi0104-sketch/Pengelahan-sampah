<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profile User</title>
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
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 italic">Profile Saya</h1>
            <p class="text-sm text-gray-500 italic">Kelola informasi akun kamu</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- PROFILE CARD -->
            <div class="bg-white rounded-xl shadow p-6 text-center">
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=1B4332&color=fff"
                     class="w-24 h-24 rounded-full mx-auto mb-4">

                <h2 class="font-bold text-lg text-gray-800">
                    {{ auth()->user()->name }}
                </h2>

                <p class="text-sm text-gray-500">
                    {{ auth()->user()->email }}
                </p>
            </div>

            <!-- FORM EDIT -->
            <div class="md:col-span-2 bg-white rounded-xl shadow p-6">
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="text-xs text-gray-500">Nama</label>
                        <input type="text" name="name" value="{{ auth()->user()->name }}"
                               class="w-full border rounded-lg p-2 mt-1">
                    </div>

                    <div>
                        <label class="text-xs text-gray-500">Email</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}"
                               class="w-full border rounded-lg p-2 mt-1">
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                                class="bg-[#2D6A4F] text-white px-6 py-2 rounded-lg hover:bg-[#1B4332]">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </main>
</div>

</body>
</html>
