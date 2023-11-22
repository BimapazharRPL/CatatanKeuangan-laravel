<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class BulanController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear = $request->input('year', now()->year);
        $pemasukanData = Pemasukan::whereYear('tanggal', $selectedYear)->get();
            $pengeluaranData = Pengeluaran::whereYear('tanggal', $selectedYear)->get();
        
            return view('bulan', compact('pengeluaranData', 'pemasukanData', 'selectedYear'));
    }
   

    // public function index()
    // {
    //     // Ambil data pengeluaran per bulan
    //     $pengeluaranData = Pengeluaran::selectRaw('SUM(jumlah) as total, MONTH(tanggal) as bulan')
    //         ->groupBy('bulan')
    //         ->get();

    //     // Ambil data pemasukan per bulan
    //     $pemasukanData = Pemasukan::selectRaw('SUM(jumlah) as total, MONTH(tanggal) as bulan')
    //         ->groupBy('bulan')
    //         ->get();
            
    //     return view('bulan', compact('pengeluaranData', 'pemasukanData'));
    // }

    // public function showChart()
    // {
    //     $pengeluaranData = Pengeluaran::all(); // Anda dapat mengganti ini sesuai kebutuhan
    //     $pemasukanData = Pemasukan::all(); // Anda dapat mengganti ini sesuai kebutuhan
    
    //     // dd($pengeluaranData, $pemasukanData);
    
    //     return view('bulan', compact('pengeluaranData', 'pemasukanData'));
    // }
    
}
