<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function lihat()
    {
        return view('laporan');
    }


    // public function laporanHariIni()
    // {
    //     // Mengambil data Hutang di mana tgl_hutang sama dengan hari ini
    //     $hutangHariIni = DB::table('hutangs')
    //         ->whereDate('tgl_hutang', '=', now()->toDateString())
    //         ->get();

    //     return view('laporan', compact('hutangHariIni'));
    // }

}
