<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class KatagoriController extends Controller
{
    
    public function tampilkanDataPerKategori()
    {
        // Mengambil data pemasukan dan pengeluaran
        $dataPemasukan = Pemasukan::all();
        $dataPengeluaran = Pengeluaran::all();

        // Menggabungkan data pemasukan dan pengeluaran
        $semuaData = $dataPemasukan->concat($dataPengeluaran);

        // Mengelompokkan data berdasarkan kategori
        $groupedData = $semuaData->groupBy('katagori');

        // Tampilkan data
        return view('katagori', compact('groupedData'));
    }

}
