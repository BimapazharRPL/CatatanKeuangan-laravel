<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BulanController extends Controller
{
    public function index(Request $request)
     {
        $pengeluaranData = DB::table('pengeluarans')->get();

        // Grupkan data pengeluaran berdasarkan bulan
        $monthlyDataPengeluaran = $pengeluaranData->groupBy(function ($date) {
            return Carbon::parse($date->tanggal)->format('m');
        })->map(function ($group) {
            return $group->sum('jumlah');
        });

        $pemasukanBulan = Pemasukan::selectRaw('YEAR(tanggal) as tahun, MONTH(tanggal) as bulan, SUM(jumlah) as total_pemasukan')
            ->groupBy('tahun', 'bulan')
            ->get();

        $pengeluaranBulan = Pengeluaran::selectRaw('YEAR(tanggal) as tahun, MONTH(tanggal) as bulan, SUM(jumlah) as total_pengeluaran')
            ->groupBy('tahun', 'bulan')
            ->get();

        $dataPerBulan = [];
        foreach ($pemasukanBulan as $pemasukan) {
            $tahun = $pemasukan->tahun;
            $bulan = $pemasukan->bulan;
            $dataPerBulan[$tahun . '-' . $bulan]['total_pemasukan'] = $pemasukan->total_pemasukan;
            $dataPerBulan[$tahun . '-' . $bulan]['tahun'] = $tahun;
            $dataPerBulan[$tahun . '-' . $bulan]['bulan'] = $bulan;
        }

        foreach ($pengeluaranBulan as $pengeluaran) {
            $tahun = $pengeluaran->tahun;
            $bulan = $pengeluaran->bulan;
            $dataPerBulan[$tahun . '-' . $bulan]['total_pengeluaran'] = $pengeluaran->total_pengeluaran;
            $dataPerBulan[$tahun . '-' . $bulan]['tahun'] = $tahun;
            $dataPerBulan[$tahun . '-' . $bulan]['bulan'] = $bulan;
        }
            return view('bulan', compact('dataPerBulan'));

     }
    
    
    //     public function getDataPerbulan(Request $request)
    // {
    //     $tahun = $request->get('tahun', date('Y'));

    //     // Ambil data pengeluaran
    //     $pengeluaranData = DB::table('pengeluarans')
    //         ->selectRaw('MONTH(tanggal) as bulan, SUM(jumlah) as total_pengeluaran')
    //         ->whereYear('tanggal', $tahun)
    //         ->groupBy('bulan');

    //     // Ambil data pemasukan
    //     $pemasukanData = DB::table('pemasukans')
    //         ->selectRaw('MONTH(tanggal) as bulan, SUM(jumlah) as total_pemasukan')
    //         ->whereYear('tanggal', $tahun)
    //         ->groupBy('bulan');

    //     // Ambil data bulanan untuk pengeluaran
    //     $monthlyDataPengeluaran = $pengeluaranData->get();

    //     // Ambil data bulanan untuk pemasukan
    //     $monthlyDataPemasukan = $pemasukanData->get();

    //     // ... (sisa logika pemrosesan data)

    //     return response()->json($completeData);
    // }
    // public function index(Request $request)
    // {
    //     $selectedYear = $request->input('year', now()->year);
    //     $pemasukanData = Pemasukan::whereYear('tanggal', $selectedYear)->get();
    //         $pengeluaranData = Pengeluaran::whereYear('tanggal', $selectedYear)->get();
        
    //         return view('bulan', compact('pengeluaranData', 'pemasukanData', 'selectedYear'));
    // }
   

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
