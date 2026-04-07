@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- KPI Cards Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: Total Barang -->
        <div class="bg-white border border-gray-200 shadow-sm hover:shadow-md transition-shadow rounded-2xl p-6 border-l-4 border-l-blue-500 relative overflow-hidden group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Total Barang</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $totalBarang }}</h3>
                </div>
                <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center text-xl group-hover:bg-blue-500 group-hover:text-white transition-colors">
                    <i class="fa-solid fa-box"></i>
                </div>
            </div>
            <p class="text-sm text-green-600 mt-4 font-medium"><i class="fa-solid fa-arrow-trend-up mr-1"></i> +12% dari bulan lalu</p>
        </div>

        <!-- Card 2: Estimasi Nilai Aset -->
        <div class="bg-white border border-gray-200 shadow-sm hover:shadow-md transition-shadow rounded-2xl p-6 border-l-4 border-l-green-500 relative overflow-hidden group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Estimasi Nilai Aset</p>
                    <h3 class="text-2xl font-bold text-gray-800 tracking-tight">Rp {{ number_format($estimasiAset, 0, ',', '.') }}</h3>
                </div>
                <div class="w-10 h-10 rounded-full bg-green-50 text-green-500 flex items-center justify-center text-xl group-hover:bg-green-500 group-hover:text-white transition-colors">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>
            </div>
            <p class="text-sm text-gray-500 mt-4 font-medium">Total nilai inventaris terdata</p>
        </div>

        <!-- Card 3: Kondisi Baik -->
        <div class="bg-white border border-gray-200 shadow-sm hover:shadow-md transition-shadow rounded-2xl p-6 border-l-4 border-l-teal-500 relative overflow-hidden group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Kondisi Baik</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $kondisiBaik }}</h3>
                </div>
                <div class="w-10 h-10 rounded-full bg-teal-50 text-teal-500 flex items-center justify-center text-xl group-hover:bg-teal-500 group-hover:text-white transition-colors">
                    <i class="fa-solid fa-check-circle"></i>
                </div>
            </div>
            <p class="text-sm text-teal-600 mt-4 font-medium">96% dari total barang</p>
        </div>

        <!-- Card 4: Perlu Perbaikan -->
        <div class="bg-white border border-gray-200 shadow-sm hover:shadow-md transition-shadow rounded-2xl p-6 border-l-4 border-l-orange-500 relative overflow-hidden group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Perlu Perbaikan</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $perluPerbaikan }}</h3>
                </div>
                <div class="w-10 h-10 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center text-xl group-hover:bg-orange-500 group-hover:text-white transition-colors">
                    <i class="fa-solid fa-wrench"></i>
                </div>
            </div>
            <p class="text-sm text-red-500 mt-4 font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i> 4% butuh perhatian</p>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Pie Chart: Distribusi Kategori -->
        <div class="bg-white border border-gray-200 shadow-sm hover:shadow-md transition-shadow rounded-2xl p-6 lg:col-span-1 flex flex-col">
            <h3 class="text-lg font-bold text-gray-800 leading-tight">Distribusi Kategori</h3>
            <p class="text-xs text-gray-500 mb-6">Berdasarkan 4 kategori terdaftar</p>
            <div class="flex-1 flex aspect-square justify-center items-center relative w-full pb-4">
                <canvas id="categoryChart"></canvas>
            </div>
            
            <div class="mt-4 space-y-2">
                @foreach($chartKategori['labels'] as $index => $label)
                <div class="flex justify-between items-center text-sm">
                    <div class="flex items-center gap-2">
                        @php 
                            $colors = ['bg-[#1f4e38]', 'bg-[#d4af37]', 'bg-[#3b82f6]', 'bg-[#8b5cf6]'];
                        @endphp
                        <span class="w-3 h-3 rounded-full {{ $colors[$index] }}"></span>
                        <span class="text-gray-600 font-medium">{{ $label }}</span>
                    </div>
                    <span class="font-bold text-gray-800">{{ $chartKategori['data'][$index] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Bar Chart: Barang per Lokasi -->
        <div class="bg-white border border-gray-200 shadow-sm hover:shadow-md transition-shadow rounded-2xl p-6 lg:col-span-2 flex flex-col">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 leading-tight">Barang per Lokasi</h3>
                    <p class="text-xs text-gray-500">Distribusi di 7 area/gedung</p>
                </div>
                <button class="text-sm text-blue-600 hover:text-blue-800 font-medium px-3 py-1 bg-blue-50 hover:bg-blue-100 transition-colors rounded-lg">Detail</button>
            </div>
            <div class="flex-1 relative w-full h-[300px]">
                <canvas id="locationChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Bottom Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Aktivitas Terbaru -->
        <div class="bg-white border border-gray-200 shadow-sm hover:shadow-md transition-shadow rounded-2xl p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 leading-tight">Aktivitas Terbaru</h3>
                    <p class="text-xs text-gray-500">Pembaruan inventaris terakhir</p>
                </div>
                <a href="#" class="text-sm font-semibold text-yellow-600 hover:text-yellow-700">Lihat Semua &rarr;</a>
            </div>
            
            <div class="space-y-4">
                @foreach($aktivitasTerbaru as $index => $activity)
                <div class="flex items-start gap-4 p-3 rounded-xl hover:bg-gray-50 transition-colors cursor-pointer border border-transparent hover:border-gray-100">
                    <div class="mt-1">
                        @if($activity['status'] == 'Baik')
                            <div class="w-2.5 h-2.5 rounded-full bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.5)]"></div>
                        @elseif($activity['status'] == 'Perbaikan')
                            <div class="w-2.5 h-2.5 rounded-full bg-yellow-500 shadow-[0_0_8px_rgba(234,179,8,0.5)]"></div>
                        @else
                            <div class="w-2.5 h-2.5 rounded-full bg-blue-500 shadow-[0_0_8px_rgba(59,130,246,0.5)]"></div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-gray-800">{{ $activity['name'] }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $activity['action'] }} {{ $activity['user'] }} &mdash; {{ $activity['location'] }} &bull; {{ $activity['date'] }}</p>
                    </div>
                    <div>
                        @if($activity['status'] == 'Baik')
                            <span class="text-xs font-semibold px-2.5 py-1 bg-green-100 text-green-700 rounded-lg">Baik</span>
                        @elseif($activity['status'] == 'Perbaikan')
                            <span class="text-xs font-semibold px-2.5 py-1 bg-yellow-100 text-yellow-700 rounded-lg">Perbaikan</span>
                        @else
                            <span class="text-xs font-semibold px-2.5 py-1 bg-blue-100 text-blue-700 rounded-lg">Dipinjam</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Status Kondisi Barang -->
        <div class="bg-white border border-gray-200 shadow-sm hover:shadow-md transition-shadow rounded-2xl p-6">
            <h3 class="text-lg font-bold text-gray-800 leading-tight">Status Kondisi Barang</h3>
            <p class="text-xs text-gray-500 mb-6">Ringkasan semua kondisi inventaris</p>

            <div class="grid grid-cols-2 gap-4">
                <!-- Baik -->
                <div class="border border-green-400 bg-green-50 shadow-sm rounded-xl p-4 flex items-center justify-between hover:shadow-md transition-shadow cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-white text-green-500 flex items-center justify-center border border-green-200"><i class="fa-solid fa-check"></i></div>
                        <div>
                            <h4 class="text-xl font-bold text-green-800 leading-none mb-1">{{ $statusKondisi['baik'] }}</h4>
                            <p class="text-xs font-medium text-green-600">Baik</p>
                        </div>
                    </div>
                </div>

                <!-- Dipinjam -->
                <div class="border border-blue-400 bg-blue-50 shadow-sm rounded-xl p-4 flex items-center justify-between hover:shadow-md transition-shadow cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-white text-blue-500 flex items-center justify-center border border-blue-200"><i class="fa-solid fa-people-carry-box"></i></div>
                        <div>
                            <h4 class="text-xl font-bold text-blue-800 leading-none mb-1">{{ $statusKondisi['dipinjam'] }}</h4>
                            <p class="text-xs font-medium text-blue-600">Dipinjam</p>
                        </div>
                    </div>
                </div>

                <!-- Diperbaiki -->
                <div class="border border-yellow-400 bg-yellow-50 shadow-sm rounded-xl p-4 flex items-center justify-between hover:shadow-md transition-shadow cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-white text-yellow-500 flex items-center justify-center border border-yellow-200"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                        <div>
                            <h4 class="text-xl font-bold text-yellow-800 leading-none mb-1">{{ $statusKondisi['diperbaiki'] }}</h4>
                            <p class="text-xs font-medium text-yellow-600">Diperbaiki</p>
                        </div>
                    </div>
                </div>

                <!-- Rusak Ringan -->
                <div class="border border-orange-400 bg-orange-50 shadow-sm rounded-xl p-4 flex items-center justify-between hover:shadow-md transition-shadow cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-white text-orange-500 flex items-center justify-center border border-orange-200"><i class="fa-solid fa-triangle-exclamation"></i></div>
                        <div>
                            <h4 class="text-xl font-bold text-orange-800 leading-none mb-1">{{ $statusKondisi['rusak_ringan'] }}</h4>
                            <p class="text-xs font-medium text-orange-600">Rusak Ringan</p>
                        </div>
                    </div>
                </div>

                <!-- Rusak Berat -->
                <div class="border border-red-400 bg-red-50 shadow-sm rounded-xl p-4 flex items-center justify-between hover:shadow-md transition-shadow cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-white text-red-500 flex items-center justify-center border border-red-200"><i class="fa-solid fa-ban"></i></div>
                        <div>
                            <h4 class="text-xl font-bold text-red-800 leading-none mb-1">{{ $statusKondisi['rusak_berat'] }}</h4>
                            <p class="text-xs font-medium text-red-600">Rusak Berat</p>
                        </div>
                    </div>
                </div>

                <!-- Hilang -->
                <div class="border border-purple-400 bg-purple-50 shadow-sm rounded-xl p-4 flex items-center justify-between hover:shadow-md transition-shadow cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-white text-purple-500 flex items-center justify-center border border-purple-200"><i class="fa-solid fa-question"></i></div>
                        <div>
                            <h4 class="text-xl font-bold text-purple-800 leading-none mb-1">{{ $statusKondisi['hilang'] }}</h4>
                            <p class="text-xs font-medium text-purple-600">Hilang</p>
                        </div>
                    </div>
                </div>

                <!-- Tidak Digunakan -->
                <div class="border border-gray-400 bg-gray-50 shadow-sm rounded-xl p-4 flex items-center justify-between hover:shadow-md transition-shadow cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-white text-gray-500 flex items-center justify-center border border-gray-200"><i class="fa-solid fa-folder-closed"></i></div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-800 leading-none mb-1">{{ $statusKondisi['tidak_digunakan'] }}</h4>
                            <p class="text-xs font-medium text-gray-600">Tidak Digunakan</p>
                        </div>
                    </div>
                </div>

                <!-- Penghapusan -->
                <div class="border border-slate-400 bg-slate-50 shadow-sm rounded-xl p-4 flex items-center justify-between hover:shadow-md transition-shadow cursor-pointer">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-white text-slate-500 flex items-center justify-center border border-slate-200"><i class="fa-solid fa-trash-can"></i></div>
                        <div>
                            <h4 class="text-xl font-bold text-slate-800 leading-none mb-1">{{ $statusKondisi['penghapusan'] }}</h4>
                            <p class="text-xs font-medium text-slate-600">Penghapusan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Data for charts
        const chartKategori = @json($chartKategori);
        const chartLokasi = @json($chartLokasi);

        // Chart.js Configuration for Category (Doughnut)
        const ctxCategory = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctxCategory, {
            type: 'doughnut',
            data: {
                labels: chartKategori.labels,
                datasets: [{
                    data: chartKategori.data,
                    backgroundColor: [
                        '#1f4e38', // Dark green / Inventaris Ruangan
                        '#d4af37', // Gold / Logistik
                        '#3b82f6', // Blue / Elektronik
                        '#8b5cf6'  // Purple / Kendaraan
                    ],
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false // Using custom legend in HTML
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += context.parsed + ' items';
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Chart.js Configuration for Location (Bar)
        const ctxLocation = document.getElementById('locationChart').getContext('2d');
        new Chart(ctxLocation, {
            type: 'bar',
            data: {
                labels: chartLokasi.labels,
                datasets: [{
                    label: 'Jumlah Barang',
                    data: chartLokasi.data,
                    backgroundColor: '#1f4e38', // Dark green matching branding
                    borderRadius: 4,
                    barPercentage: 0.6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6',
                            drawBorder: false,
                        },
                        ticks: {
                            stepSize: 20
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
