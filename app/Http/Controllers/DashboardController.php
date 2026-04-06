<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fitur untuk Kosongkan DB (menggunakan Query Real ke DB yang saat ini 0)
        $totalBarang = \App\Models\Item::count();
        $estimasiAset = \App\Models\Item::sum('purchase_price');
        $kondisiBaik = \App\Models\Item::where('condition', 'Baik')->count();
        $perluPerbaikan = \App\Models\Item::whereIn('condition', ['Diperbaiki', 'Rusak Ringan', 'Rusak Berat'])->count();

        // Data Chart Kategori - Count item per category
        $categories = \App\Models\Category::withCount('items')->get();
        $chartKategori = [
            'labels' => $categories->pluck('name')->toArray(),
            'data' => $categories->pluck('items_count')->toArray()
        ];
        if (empty($chartKategori['labels'])) {
            $chartKategori = ['labels' => ['Belum Ada Data'], 'data' => [1]];
        }

        // Data Chart Lokasi
        $locations = \App\Models\Location::withCount('items')->get();
        $chartLokasi = [
            'labels' => $locations->pluck('name')->toArray(),
            'data' => $locations->pluck('items_count')->toArray()
        ];
        if (empty($chartLokasi['labels'])) {
            $chartLokasi = ['labels' => ['Belum Ada Data'], 'data' => [0]];
        }

        // Aktivitas Terbaru (ambil 5 teratas)
        $activities = \App\Models\Activity::with('item.location')->latest()->take(5)->get();
        $aktivitasTerbaru = $activities->map(function($act) {
            return [
                'name' => $act->item->name ?? 'Unknown Item',
                'action' => $act->action_type,
                'user' => 'Admin', // Dummy User relation doesn't exist yet for activities
                'location' => $act->item->location->name ?? 'Unknown Location',
                'date' => $act->created_at->format('d M'),
                'status' => $act->item->condition ?? 'Baik',
                'color' => 'blue',
            ];
        })->toArray();

        // Rekapitulasi Kondisi Barang (Count by grouping)
        $kondisiCounts = \App\Models\Item::selectRaw('condition, COUNT(*) as count')
                                ->groupBy('condition')
                                ->pluck('count', 'condition')
                                ->toArray();

        $statusKondisi = [
            'baik' => $kondisiCounts['Baik'] ?? 0,
            'dipinjam' => $kondisiCounts['Dipinjam'] ?? 0,
            'diperbaiki' => $kondisiCounts['Diperbaiki'] ?? 0,
            'rusak_ringan' => $kondisiCounts['Rusak Ringan'] ?? 0,
            'rusak_berat' => $kondisiCounts['Rusak Berat'] ?? 0,
            'hilang' => $kondisiCounts['Hilang'] ?? 0,
            'tidak_digunakan' => $kondisiCounts['Tidak Digunakan'] ?? 0,
            'penghapusan' => $kondisiCounts['Penghapusan'] ?? 0,
        ];

        return view('dashboard', compact(
            'totalBarang', 'estimasiAset', 'kondisiBaik', 'perluPerbaikan',
            'chartKategori', 'chartLokasi', 'aktivitasTerbaru', 'statusKondisi'
        ));
    }
}
