<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Inventaris GKI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .glass-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 relative overflow-hidden bg-slate-50">

    <!-- Decorative blobs -->
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[50%] bg-blue-100 rounded-full blur-[100px] opacity-60"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[40%] bg-indigo-100 rounded-full blur-[100px] opacity-60"></div>

    <div class="max-w-6xl w-full grid grid-cols-1 lg:grid-cols-2 gap-16 items-center z-10">
        
        <!-- Left Column: Branding & Info -->
        <div class="space-y-8 pl-0 lg:pl-12">
            <!-- Badges -->
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 text-white text-xs font-bold px-3 py-1.5 rounded-full flex items-center">
                    GKI
                </div>
                <div class="bg-blue-100 text-blue-700 text-sm font-semibold px-4 py-1.5 rounded-full">
                    GKI Delima
                </div>
            </div>

            <div class="space-y-4">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
                    Sistem Inventaris <br>
                    <span class="text-blue-600">GKI Delima</span>
                </h1>
                <p class="text-gray-600 text-lg max-w-md leading-relaxed">
                    Kelola aset gereja dengan mudah dan efisien menggunakan sistem inventaris modern dengan QR code scanner.
                </p>
            </div>

            <!-- Stats/Feature Cards -->
            <div class="flex flex-wrap gap-4 pt-4">
                <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm min-w-[160px]">
                    <h3 class="text-2xl font-bold text-blue-600 mb-1">500+</h3>
                    <p class="text-sm text-gray-500 font-medium">Total Barang</p>
                </div>
                <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm min-w-[160px]">
                    <h3 class="text-xl font-bold text-green-600 mb-1 flex items-center gap-2">
                        <i class="fa-solid fa-qrcode"></i> QR
                    </h3>
                    <p class="text-sm text-gray-500 font-medium">Scan Ready</p>
                </div>
            </div>
        </div>

        <!-- Right Column: Login Form -->
        <div class="flex justify-center lg:justify-end pr-0 lg:pr-12">
            <div class="bg-white/95 backdrop-blur-lg border border-gray-200 shadow-xl w-full max-w-md rounded-[2rem] p-10 relative transition-all">
                
                <div class="flex flex-col items-center mb-8">
                    <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 text-2xl mb-4">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 text-center">Selamat Datang</h2>
                    <p class="text-sm text-gray-500 text-center mt-1">Silakan login untuk melanjutkan</p>
                </div>

                @if($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 text-sm rounded-xl text-center font-medium">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                    @csrf
                    
                    <!-- Email -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Email</label>
                        <input type="email" name="email" value="nama@gkidelima.org"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all text-gray-800"
                            placeholder="nama@gkidelima.org" required>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-2 uppercase tracking-wide">Password</label>
                        <input type="password" name="password" value="password"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-100 outline-none transition-all text-gray-800"
                            placeholder="••••••••" required minlength="6">
                    </div>

                    <!-- Role Selection -->
                    <div class="pt-2">
                        <label class="block text-xs font-semibold text-gray-700 mb-3 uppercase tracking-wide">Pilih Role</label>
                        <div class="grid grid-cols-2 gap-3">
                            <!-- Admin Option (Selected) -->
                            <label class="cursor-pointer relative">
                                <input type="radio" name="role" value="admin" class="peer sr-only" checked>
                                <div class="rounded-xl border-2 border-transparent bg-red-50 py-3 px-4 text-center peer-checked:border-red-200 peer-checked:bg-red-50 hover:bg-red-50/70 transition-all active:scale-95 flex flex-col items-center gap-1">
                                    <i class="fa-regular fa-user text-red-600 mb-1 text-lg"></i>
                                    <span class="text-sm font-semibold text-red-800">Admin</span>
                                </div>
                            </label>
                            
                            <!-- User Option -->
                            <label class="cursor-pointer relative">
                                <input type="radio" name="role" value="user" class="peer sr-only">
                                <div class="rounded-xl border-2 border-transparent bg-blue-50 py-3 px-4 text-center peer-checked:border-blue-200 peer-checked:bg-blue-100 hover:bg-blue-50/70 transition-all active:scale-95 flex flex-col items-center gap-1">
                                    <i class="fa-regular fa-user text-blue-600 mb-1 text-lg"></i>
                                    <span class="text-sm font-semibold text-blue-800">User</span>
                                </div>
                            </label>
                        </div>
                        <p class="text-[10px] text-center text-gray-400 mt-3">View & Print - Lihat dan cetak</p>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3.5 rounded-xl transition-all shadow-md hover:shadow-lg mt-4 flex justify-center items-center gap-2">
                        Login
                    </button>
                    
                    <p class="text-xs text-center text-gray-500 mt-4">
                        Demo: Email apapun dengan password minimal 6 karakter
                    </p>
                </form>

            </div>
        </div>

    </div>

</body>
</html>
