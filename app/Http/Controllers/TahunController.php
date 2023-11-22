<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
// use DateTime;
use Illuminate\Http\Request;

class TahunController extends Controller
{
    public function tampilkanGrafikTahun()
    {
        $pemasukanTahun = Pemasukan::selectRaw('YEAR(tanggal) as tahun, SUM(jumlah) as total_pemasukan')
        ->groupBy('tahun')
        ->get();

    $pengeluaranTahun = Pengeluaran::selectRaw('YEAR(tanggal) as tahun, SUM(jumlah) as total_pengeluaran')
        ->groupBy('tahun')
        ->get();

    return view('tahun', compact('pemasukanTahun', 'pengeluaranTahun'));
     }
    




    //     public function showChart(Request $request)
    // {
    //     $selectedYear = $request->input('year', date('Y'));

    //     $pemasukanData = Pemasukan::selectRaw('SUM(jumlah) as total, YEAR(tanggal) as tahun')
    //         ->whereYear('tanggal', $selectedYear)
    //         ->groupBy('tahun')
    //         ->get();

    //     $pengeluaranData = Pengeluaran::selectRaw('SUM(jumlah) as total, YEAR(tanggal) as tahun')
    //         ->whereYear('tanggal', $selectedYear)
    //         ->groupBy('tahun')
    //         ->get();

    //     return view('tahun', compact('pengeluaranData', 'pemasukanData', 'selectedYear'));
    // }

    
    
    
    // public function index(Request $request)
    // {
    //     $selectedYear = $request->input('year', now()->year);
    //     $selectedPeriod = $request->input('period', 10); // Periode default 10 bulan

    //     $pemasukanData = Pemasukan::whereYear('tanggal', $selectedYear)
    //         ->whereMonth('tanggal', '>=', now()->subMonths($selectedPeriod)->month)
    //         ->get();

    //     $pengeluaranData = Pengeluaran::whereYear('tanggal', $selectedYear)
    //         ->whereMonth('tanggal', '>=', now()->subMonths($selectedPeriod)->month)
    //         ->get();

    //     return view('tahun', compact('pemasukanData', 'pengeluaranData', 'selectedYear', 'selectedPeriod'));
    // }
}
