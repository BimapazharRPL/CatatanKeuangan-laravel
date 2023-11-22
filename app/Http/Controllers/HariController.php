<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class HariController extends Controller
{
    public function tampilkanDataPerTanggal()
    {
        // Mengambil data pemasukan dan pengeluaran
        $dataPemasukan = Pemasukan::all();
        $dataPengeluaran = Pengeluaran::all();
    
        // Menggabungkan data pemasukan dan pengeluaran
        $semuaData = $dataPemasukan->concat($dataPengeluaran);
    
        // Mengelompokkan data berdasarkan tanggal
        $groupedData = $semuaData->groupBy('tanggal');
    
        // Menghitung total pemasukan dan pengeluaran per tanggal
        $totals = $groupedData->map(function ($item) {
            $totalPemasukan = $item->where('model', Pemasukan::class)->sum('jumlah');
            $totalPengeluaran = $item->where('model', Pengeluaran::class)->sum('jumlah');
    
            return [
                'hari' => Carbon::parse($item->first()->tanggal)->format('l'),
                'total_pemasukan' => $totalPemasukan,
                'total_pengeluaran' => $totalPengeluaran,
            ];
        });
    
        // Tampilkan data
        return view('hari', compact('groupedData', 'totals'));
    }
    
}
