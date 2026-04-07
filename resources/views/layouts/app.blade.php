<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris GKI - Dashboard</title>
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="flex h-screen overflow-hidden text-gray-800">

    <!-- Sidebar -->
    <aside class="w-64 bg-[#143e2b] flex-shrink-0 flex flex-col text-gray-200">
        <!-- Logo/Brand -->
        <div class="h-20 flex items-center px-6 border-b border-white/10">
            <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center text-green-900 font-bold text-xl mr-3 shadow-lg">GKI</div>
            <div>
                <h1 class="font-bold text-lg text-white tracking-wide">GKI Delima</h1>
                <p class="text-xs text-green-200/70 tracking-widest uppercase">Sistem Inventaris</p>
            </div>
        </div>
        
        <!-- Profile -->
        <div class="p-6 border-b border-white/10 flex items-center">
            <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center mr-3 font-semibold text-white">AD</div>
            <div>
                <p class="text-sm font-semibold text-white">Admin</p>
                <p class="text-xs text-green-200">Administrator</p>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <a href="#" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium mb-1 bg-white/10 text-yellow-500 border-l-4 border-yellow-500 transition-all">
                <i class="fa-solid fa-chart-pie w-6"></i> Dashboard
            </a>
            <a href="#" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium mb-1 hover:bg-white/10 hover:text-yellow-500 transition-all">
                <i class="fa-solid fa-boxes-stacked w-6"></i> Inventaris
            </a>
            <a href="#" class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium mb-4 hover:bg-white/10 hover:text-yellow-500 transition-all">
                <i class="fa-solid fa-qrcode w-6"></i> QR Scanner
            </a>

            <p class="px-3 text-xs font-semibold text-green-400 uppercase tracking-widest mt-6 mb-2">Status Khusus</p>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-sm mb-1 hover:bg-white/10 hover:text-yellow-500 transition-all">
                <i class="fa-solid fa-people-carry-box w-6"></i> Barang Dipinjam
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-sm mb-1 hover:bg-white/10 hover:text-yellow-500 transition-all">
                <i class="fa-solid fa-screwdriver-wrench w-6"></i> Dalam Perbaikan
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-sm mb-1 hover:bg-white/10 hover:text-yellow-500 transition-all">
                <i class="fa-solid fa-circle-exclamation w-6"></i> Status Lainnya
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-sm mb-4 hover:bg-white/10 hover:text-yellow-500 transition-all">
                <i class="fa-solid fa-clock-rotate-left w-6"></i> Riwayat
            </a>

            <p class="px-3 text-xs font-semibold text-green-400 uppercase tracking-widest mt-6 mb-2">Lainnya</p>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-sm mb-1 hover:bg-white/10 hover:text-yellow-500 transition-all">
                <i class="fa-solid fa-chart-line w-6"></i> Laporan
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-sm mb-1 hover:bg-white/10 hover:text-yellow-500 transition-all">
                <i class="fa-solid fa-users w-6"></i> Pengguna
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg text-sm mb-1 hover:bg-white/10 hover:text-yellow-500 transition-all">
                <i class="fa-solid fa-gear w-6"></i> Pengaturan
            </a>
            
            <div class="px-3 mt-8">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-3 py-2.5 rounded-lg text-sm font-semibold text-red-300 hover:text-red-100 hover:bg-red-900/40 transition-colors">
                        <i class="fa-solid fa-arrow-right-from-bracket w-6"></i> Keluar
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden bg-[#f4f7f5]">
        <!-- Topbar -->
        <header class="h-20 bg-white shadow-sm flex items-center justify-between px-8 z-10">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
                <p class="text-sm text-gray-500 mt-0.5">Selamat datang kembali, Admin</p>
            </div>
            <div class="flex items-center space-x-6">
                <div class="text-sm text-gray-500 font-medium bg-gray-100 px-4 py-2 rounded-full border border-gray-200">
                    <i class="fa-regular fa-calendar mr-2"></i> Selasa, 7 April 2026
                </div>
                <button class="bg-[#143e2b] hover:bg-green-900 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-md hover:shadow-lg flex items-center gap-2">
                    <i class="fa-solid fa-qrcode"></i> Scan QR Code
                </button>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-8">
            @yield('content')
        </main>
    </div>

</body>
</html>
